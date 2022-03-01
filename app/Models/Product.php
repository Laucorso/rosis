<?php

namespace App\Models;

use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $attributes = [
        'price' => 0,
        'sale_price' => 0,
        'categories' => '',
        'images' => '',
        'tax_type' => '',
        'weight' => 0,
        'dimensions' => '',
        'seo' => '',
        'meta' => '',
        'subitems' => '',
        'stock' => 0
    ];

    public function setRequest( Request $request, $prefix = 'product_' ) {
        $fields = [
            'type',
            'parent_id',
            'sku',
            'es_slug',
            'ca_slug',
            'en_slug',
            'tags',
            'price',
            'sale_price',
            'tax_type',
            'weight',
            'dimensions',
            'stock',
            'active'
        ];
        foreach( $fields as $field ) {
            $this->$field = $request->get($prefix.$field);
        }
//        $this->name = $request->get($prefix.'name');
//        $this->categories = $request->get($prefix.'categories');
//        $this->description = $request->get($prefix.'description');
//        $this->images = $request->get($prefix.'images');
//        $this->seo = $request->seo;
//        $this->meta = $request->meta;
//        $this->subitems = $request->subitems;
    }
    public static function getBySlug( $slug ) {
        $locale = App::currentLocale();
        $product = Product::where($locale.'_slug',$slug)->first();
        return $product;
    }
    public function getComplements() {
        if( $this->isPlant() )
            return Product::getPlantComplements();
        if( $this->isBouquet() )
            return Product::getBouquetComplements();
        return [];
    }
    public function hasSizes() {
        $variations = $this->getVariations();
        foreach( $variations as $variation ) {
            if( Str::contains($variation->getLocalizedName(),'PREMIUM') )
                return true;
        }
        return false;
    }
    public function getItems() {
        if( $this->subitems != '' ) {
            $items = [];
            $subitems = json_decode($this->subitems,true);
            foreach( $subitems as $key => $data ) {
                $product = Product::find($key);
                $name = $product->getLocalizedName();
                $items[] = ['qty'=>$data,'name'=>$name,'image'=>$product->images];
            }
            return $items;
        } else {
            return [];
        }
    }
    public function getPrice($var_type=null) {
        if( !$var_type || $this->type == 'variation' )
            return $this->sale_price ?: $this->price;
        if( $var_type && $this->type == 'variable' ) {
            $variations = Product::where('parent_id',$this->id)->get();
            foreach( $variations as $variation ) {
                if( Str::contains($variation->getLocalizedName(),$var_type) )
                    return $variation->getPrice();
            }
        }
        return 0;
    }
    public function getVariations() {
        if( $this->type != 'variable' )
            return array();
        return Product::where('parent_id',$this->id)->get();
    }
    public function getVariationId($var_type=null) {
        if( !$var_type || $this->type == 'variation' )
            return $this->id;
        if( $var_type && $this->type == 'variable' ) {
            $variations = $this->getVariations();
            foreach( $variations as $variation ) {
                if( Str::contains($variation->getLocalizedName(),$var_type) )
                    return $variation->id;
            }
        }
        return 0;
    }
    public function getLocalizedSEO( $key, $locale=null ) {
        if( !$locale )
            $locale = App::currentLocale();
        $items = json_decode($this->seo,true);
        return $items[$locale][$key]??'';
    }
    public function getLocalizedName($locale=null) {
        if( !$locale )
            $locale = App::currentLocale();
        $names = json_decode($this->name,true);
        return $names[$locale];
    }
    public function getLocalizedDescription($locale=null) {
        if( !$locale )
            $locale = App::currentLocale();
        $data = json_decode($this->description,true);
        return $data[$locale] ?? '';
    }
    public function getImages() {
        return explode('|',$this->images);
    }
    public function isBouquet() {
        // test
        return preg_match("/0R/",$this->categories) && $this->type != 'variation' ? true : false;
    }
    public function isPlant() {
        return preg_match("/0P/",$this->categories) && $this->type != 'variation' ? true : false;
    }
    public function isBouquetOrPlant() {
        return preg_match("/(0R|0P)/",$this->categories) && $this->type != 'variation' ? true : false;
    }
    public function isBouquetComplement() {
        return preg_match("/0CR/",$this->categories) && $this->type != 'variation' ? true : false;
    }
    public function isPlantComplement() {
        return preg_match("/0CP/",$this->categories) && $this->type != 'variation' ? true : false;
    }
    public function isComplement() {
        return preg_match("/0C/",$this->categories) && $this->type != 'variation' ? true : false;
    }
    public function isBouquetOrPlantComplement() {
        return preg_match("/(0R|0P)/",$this->categories) && $this->type != 'variation' ? true : false;
    }
    public function getItem() {
        $images = explode('|',$this->images);
        $names = json_decode($this->name,true);
        $tag = null;
        if( $this->sale_price ) {
            $prices = array($this->sale_price,$this->price);
            if( $this->type == 'simple' )
                $tag = 'onsale';
        } else {
            $prices = array($this->price);
        }
        if( !$this->active ) {
            $tag = 'soldout';
        }
        return [
            'id' => $this->id,
            'name' => $names[locale()],
            'slug' => $this[locale().'_slug'],
            'name-es' => $names['es'],
            'name-ca' => $names['ca'],
            'name-en' => $names['en'],
            'image' => $images[0] ?? 'blank.jpg',
            'slug-es' => $this['es_slug']?:'blank',
            'slug-ca' => $this['ca_slug']?:'blank',
            'slug-en' => $this['en_slug']?:'blank',
            'prices' => $prices,
            'tag' => $tag,
            'search' => $names[locale()].'|'.$this->tags,
        ];
    }
    public static function getProducts( $categories, $all = false ) {
        $items = [];
        $order = OrderList::where('categories',$categories)->first();
        if( $order && $all == false ) {
            $list = explode(',',$order->list);
            foreach( $list as $item ) {
                $product = Product::find($item);
                if( $product->active )
                    $items[] = $product->getItem();
            }
        } else {
            $products = Product::where('active',true)->orderBy('order')->get();
            foreach( $products as $product ) {
                if( $product->type == 'simple' || $product->type == 'variable' ) {
                    $pattern = '('.$categories.')';
                    if( preg_match("/$pattern/",$product->categories) && $product->type != 'variation' ? true : false ) {
                        $items[] = $product->getItem();
                    }
                }
            }
        }
        return $items;
    }
    public static function getPromotions( $categories ) {
        $items = [];
        $products = Product::all();
        foreach( $products as $product ) {
            if( $product->type == 'simple' || $product->type == 'variation' ) {
                $pattern = '('.$categories.')';
                if( preg_match("/$pattern/",$product->categories) ) {
                    if( $product->sale_price )
                        $items[] = $product->getItem();
                }
            }
        }
        return $items;
    }
    public static function getBouquets() {
        $items = [];
        $products = Product::all();
        foreach( $products as $product ) {
            if( $product->type == 'simple' || $product->type == 'variable' ) {
                if( $product->isBouquet() ) {
                    $images = explode('|',$product->images);
                    $names = json_decode($product->name,true);
                    $tag = null;
                    if( $product->sale_price ) {
                        $prices = array($product->sale_price,$product->price);
                        if( $product->type == 'simple' )
                            $tag = 'onsale';
                    } else {
                        $prices = array($product->price);
                    }
                    $items[] = $product->getItem();
                }
            }
        }
        return $items;
    }
    public function getCategories() {
        $ret = array();
        $cats = explode('|',$this->categories);
        foreach( $cats as $cat ) {
            foreach( config('rosistirem.categories') as $c ) {
                foreach( $c as $key => $value ) {
                    if( $cat == '0'.$key.'0' )
                        $ret[] = "$key => $value";
                }
            }
        }
        return implode(' | ',$ret);
    }
    public static function getPlants() {
        $items = [];
        $products = Product::where('active',true)->get();
        foreach( $products as $product ) {
            if( $product->type == 'simple' || $product->type == 'variable' ) {
                if( $product->isPlant() ) {
                    $items[] = $product->getItem();
                }
            }
        }
        return $items;
    }
    public static function getAllComplements() {
        $items = [];
        $products = Product::where('active',true)->get();
        foreach( $products as $product ) {
            if( $product->type == 'simple' || $product->type == 'variable' ) {
                if( $product->isComplement() ) {
                    $items[] = $product->getItem();
                }
            }
        }
        return $items;
    }
    public static function getBouquetComplements() {
        $items = [];
        $products = Product::where('active',true)->get();
        foreach( $products as $product ) {
            if( $product->type == 'simple' || $product->type == 'variable' ) {
                if( $product->isBouquetComplement() ) {
                    $items[] = $product->getItem();
                }
            }
        }
        return $items;
    }
    public static function getPlantComplements() {
        $items = [];
        $products = Product::where('active',true)->get();
        foreach( $products as $product ) {
            if( $product->type == 'simple' || $product->type == 'variable' ) {
                if( $product->isPlantComplement() ) {
                    $items[] = $product->getItem();
                }
            }
        }
        return $items;
    }
    public static function getVariables() {
        return Product::where('type','variable')->get();
    }
    public static function getRaw() {
        return Product::where('type','raw')->get();
    }
}
