<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Admin;
use App\Models\Product;
use App\Models\Order;
use App\Models\Traffic;
use App\Models\Redirection;
use App\Models\WebPage;
use App\Models\Coupon;
use App\Models\Invoice;
use App\Models\Item;
use App\Helpers\AppHelper;
use App\Mail\OrderReady;
use App\Mail\OrderPicked;

use Symfony\Component\DomCrawler\Crawler;

use Vonage\Message\Shortcode\Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }
    public function commands( Request $request ) {
        if( $request->isMethod('post') ) {
            file_put_contents( storage_path().'/logs/xavi.log', "\n". __FILE__ .":". __LINE__ ."\n".var_export($request->all(), true)."\n", FILE_APPEND );
            if( $request->cmd == 'call' ) {
                $phone = preg_replace('~[^0-9]~', "", $request->number);
                if( strlen($phone) >= 9 && substr($phone,0,2) == '34' ) {
                    $phone = substr($phone,-9);
                    AppHelper::call($phone,$request->name);
                }
            }
        }
    }
    public function order( Request $request, $id ) {
        $order = Order::find($id);
        $order->getDocument();
    }
    public function exportOrders( Request $request ) {
        return Order::exportCSV();
    }
    public function cashRegister( Request $request ) {
        if( $request->isMethod('get') ) {
            return view('admin.cash-register');
        }
        file_put_contents( storage_path().'/logs/xavi.log', "\n". __FILE__ .":". __LINE__ ."\n".var_export($request->all(), true)."\n", FILE_APPEND );
        return response()->redirect('/');
    }
    public function blogCare( Request $request ) {
        if( $request->isMethod('get') ) {
            return view('admin.blog-cares')->with('items',WebPage::where('type','care')->get());
        }
        file_put_contents( storage_path().'/logs/xavi.log', "\n". __FILE__ .":". __LINE__ ."\n".var_export($request->all(), true)."\n", FILE_APPEND );
        if( $request->action == 'edit' || $request->action == 'new' ) {
            return view('admin.blog-care')->with('item',WebPage::find($request->id))->with('products',Product::getProducts('0P'));
        }
        if( $request->action == 'validate' ) {
            return response()->json(['validates'=>true]);
        }
        if( $request->action == 'save' ) {
            $webPage = $request->id ? WebPage::find($request->id) : new WebPage();
            $webPage->type = 'care';
            $webPage->related_product = $request->related_product;
            $webPage->tech_name = $request->tech_name;
            $webPage->family = $request->family;
            $webPage->ubication = $request->ubication;
            $webPage->complexity = $request->complexity;
            $webPage->name_ca = $request->name_ca;
            $webPage->name_es = $request->name_es;
            $webPage->name_en = $request->name_en;
            $webPage->ca_slug = 'cures/'.Str::slug($webPage->name_ca);
            $webPage->es_slug = 'cuidados/'.Str::slug($webPage->name_es);
            $webPage->en_slug = 'cares/'.Str::slug($webPage->name_en);
            $webPage->description_ca = $request->intro_ca;
            $webPage->description_es = $request->intro_es;
            $webPage->description_en = $request->intro_en;
            $webPage->origin_ca = $request->origin_ca;
            $webPage->origin_es = $request->origin_es;
            $webPage->origin_en = $request->origin_en;
            $webPage->techs_ca = $request->techs_ca;
            $webPage->techs_es = $request->techs_es;
            $webPage->techs_en = $request->techs_en;
            $webPage->care_1_ca = $request->care_1_ca;
            $webPage->care_1_es = $request->care_1_es;
            $webPage->care_1_en = $request->care_1_en;
            $webPage->care_2_ca = $request->care_2_ca;
            $webPage->care_2_es = $request->care_2_es;
            $webPage->care_2_en = $request->care_2_en;
            $webPage->care_3_ca = $request->care_3_ca;
            $webPage->care_3_es = $request->care_3_es;
            $webPage->care_3_en = $request->care_3_en;
            $webPage->annotations_ca = $request->annotations_ca;
            $webPage->annotations_es = $request->annotations_es;
            $webPage->annotations_en = $request->annotations_en;
            if( $request->hasFile('header_image') && $request->file('header_image')->isValid() ) {
                $webPage->header_image = $request->file('header_image')->store('resources');
            }    
            $webPage->categories='';
            $webPage->tags='';
            $webPage->seo='';
            $webPage->content='';
            $webPage->active = true;
            $webPage->save();
        }
        if( $request->action == 'delete' ) {
        }
        return view('admin.blog-cares')->with('items',WebPage::where('type','care')->get());
    }
    public function getQR( Request $request ) {
        file_put_contents( storage_path().'/logs/xavi.log', "\n". __FILE__ .":". __LINE__ ."\n".var_export($request->all(), true)."\n", FILE_APPEND );
        return AppHelper::generateQR($request->code);
    }
    public function blogRosistirem( Request $request ) {
        if( $request->isMethod('get') ) {
            return view('admin.blog-rosistirem')->with('items',WebPage::where('type','care')->get());
        }
        file_put_contents( storage_path().'/logs/xavi.log', "\n". __FILE__ .":". __LINE__ ."\n".var_export($request->all(), true)."\n", FILE_APPEND );
        if( $request->action == 'edit' || $request->action == 'new' ) {
            return view('admin.blog-entry')->with('item',WebPage::find($request->id))->with('products',Product::getProducts('0P'));
        }
        if( $request->action == 'validate' ) {
            return response()->json(['validates'=>true]);
        }
        return view('admin.blog-rosistirem')->with('items',WebPage::where('type','care')->get());
    }
    public function qrCodes( Request $request ) {
        if( $request->isMethod('get') ) {
            return view('admin.qr-codes')->with('items',Item::where('type','qrcode')->get());
        }
        file_put_contents( storage_path().'/logs/xavi.log', "\n". __FILE__ .":". __LINE__ ."\n".var_export($request->all(), true)."\n", FILE_APPEND );
        if( $request->action == 'edit' || $request->action == 'new' ) {
            $qr = AppHelper::generateQR($request->name);
            return view('admin.qr-code')->with('item',Item::find($request->id));
        }
        if( $request->action == 'validate' ) {
            $item = Item::where('type','qrcode')->where('name',$request->name)->get()->first();
            if( $item && $item->id != $request->id ) {
                return response()->json([
                    'validates'=>false,
                    'field'=>'reference',
                    'message'=>'El código ya existe']);    
            }
            return response()->json(['validates'=>true]);
        }
        if( $request->action == 'save' ) {
            $item = $request->id ? Item::find($request->id) : new Item();
            $item->type = 'qrcode';
            $item->name = $request->name;
            $item->data = array();
            $item->save();
            return view('admin.qr-codes')->with('items',Item::where('type','qrcode')->get());
        }
        abort(404);
    }
    public function coupons( Request $request ) {
        if( $request->isMethod('get') ) 
            return view('admin.coupons')->with('items',Coupon::all());
        file_put_contents( storage_path().'/logs/xavi.log', "\n". __FILE__ .":". __LINE__ ."\n".var_export($request->all(), true)."\n", FILE_APPEND );
        if( $request->action == 'new' ) {
            $last = Coupon::all()->last();
            $coupon = new Coupon();
            if( $last ) {
                $coupon->value = $last->value;
                $coupon->starts = $last->starts;
                $coupon->ends = $last->ends;
                $coupon->active = $last->active;
            }
            return view('admin.coupon')->with('coupon',$coupon);
        }
        if( $request->action == 'validate' ) {
            $coupon = Coupon::where('reference',$request->reference)->get()->first();
            if( $coupon && $coupon->id != $request->id ) {
                return response()->json([
                    'validates'=>false,
                    'field'=>'reference',
                    'message'=>'El código ya existe']);    
            }
            return response()->json(['validates'=>true]);
        }
        if( $request->action == 'edit' ) {
            return view('admin.coupon')->with('coupon',Coupon::find($request->id));
        }
        if( $request->action == 'save' ) {
            $coupon = $request->id ? Coupon::find($request->id) : new Coupon();
            // Check if reference exists
            $coupon->reference = $request->reference;
            $coupon->name = $request->name;
            $coupon->email = $request->email;
            $coupon->value = $request->value;
            $coupon->starts = $request->starts ? Carbon::createFromFormat('d-m-Y', $request->starts) : null;
            $coupon->ends = $request->ends ? Carbon::createFromFormat('d-m-Y', $request->ends) : null;
            $coupon->active = isset($request->active) ? true : false;
            $coupon->save();
        }
        if( $request->action == 'delete' ) {
            $coupon = Coupon::findOrFail($request->id);
            $coupon->delete();
        }
        return view('admin.coupons')->with('items',Coupon::all());
    }
    public function orders(Request $request)
    {
        if( $request->isMethod('get') ) {
            if( Auth::user()->role == 'admin' )
                return view('admin.orders')->with('orders',Order::all());
            return view('admin.orders')->with('orders',Order::whereIn('status',['processing','ready','picked','complete'])->get());
        }
        // POST
        if( $request->cmd == 'set' ) {
            $order = Order::find($request->id);
            if( $request->field == 'courier' ) {
                if( is_array($request->data) ) {
                    $order->courier = $request->data[0];
                    $order->tracking_no = $request->data[1];
                } else {
                    $order->courier = $request->data;
                }
            }
            if( $request->field == 'status' )
                $order->status = $request->data;
            $order->save();
            return view('admin.order-cards')->with('new_orders',Order::whereIn('status',['processing','ready','picked'])->get());
        }
        if( $request->cmd == 'getImages' ) {
            $product = Product::find($request->id);
            $ret = "<div class='row'>";
            foreach( $product->getImages() as $image ) {
                $name = $product->getLocalizedName();
                $ret .= "<img class='col' src='resources/$image' alt='$name Image'/>";
            }
            $ret .= "</div>";
            return $ret;
        }
        if( $request->cmd == 'get' ) {
            $order = Order::find($request->id);
            return view('admin.order')->with('order',$order);
        }
        if( $request->cmd == 'save' ) {
            $order = Order::find($request->id);
            
            $courier = $order->courier;
            $status = $order->status;
            $addressee_delivery_date = $order->addressee_delivery_date;
            
            $order->tracking_no = $request->tracking_no ?? '';
            $order->status = $request->status;
            $order->courier = $request->courier;
            $order->addressee_delivery_date = $request->addressee_delivery_date;
            $order->save();
            if( $order->status != $status || $order->courier != $courier || $order->addressee_delivery_date != $addressee_delivery_date ) {
                $couriers = config('rosistirem.order.couriers');
                if( $order->status == 'ready' ) {
                    if( isset($couriers[$order->courier]['email']) ) {
                        //Mail::to($couriers[$order->courier]['email'])->send(new OrderReady($order,$couriers[$order->courier]));
                    }
                }
                if( $order->status == 'picked' ) {
                    if( isset($couriers[$order->courier]['email']) ) {
                        //Mail::to($couriers[$order->courier]['email'])->send(new OrderPicked($order,$couriers[$order->courier]));
                    }
                }
            }
            return back();
        }
        file_put_contents( storage_path().'/logs/xavi.log', "\n". __FILE__ .":". __LINE__ ."\n".var_export($request->all(), true)."\n", FILE_APPEND );
        if( Auth::user()->role == 'admin' )
            return view('admin.orders')->with('orders',Order::all());
        return view('admin.home')->with('new_orders',Order::whereIn('status',['processing','ready','picked'])->get());
    }
    public function categories(Request $request)
    {
        if( $request->isMethod('get') ) {
            $content = var_export(config('rosistirem.categories'),true);
            return view('admin.categories')->with('content',$content);
        }
        file_put_contents( storage_path().'/logs/xavi.log', "\n". __FILE__ .":". __LINE__ ."\n".var_export($request->all(), true)."\n", FILE_APPEND );
        if( $request->cmd == 'save' ) {
            $settings = require(config_path('rosistirem.php'));

            $categories = '';
            eval("\$categories =\"$request->code\";");
            $settings['categories'] = $categories;

            file_put_contents( storage_path().'/logs/xavi.log', "\n". __FILE__ .":". __LINE__ ."\n".var_export($settings, true)."\n", FILE_APPEND );


            //file_put_contents( config_path('rosistirem.php'), "<?php return ".var_export($settings, true).";" );
        }
        return redirect('/');
    }
    public function couriers(Request $request)
    {
        if( $request->isMethod('get') ) {
            return view('admin.couriers');
        }

    }
    public function invoices(Request $request)
    {
        if( $request->isMethod('get') ) {
            return view('admin.invoices')->with('invoices',Order::whereNotNull('invoice')->get());
        }
        if( $request->cmd == 'get' ) {
            $order = Order::find($request->id);
            return view('admin.order')->with('order',$order);
        }

    }
    public function users(Request $request)
    {
        if( $request->isMethod('get') )
            return view('admin.users')->with('items',Admin::all());
        // POST
        if( $request->has('cmd') ) {
            if( $request->cmd == 'chgpsw' ) {
                return back();
            }
        }
        if( $request->action == 'new' ) {
            return view('admin.user');
        }
        if( $request->action == 'edit' ) {
            return view('admin.user')->with('user',Admin::find($request->id));
        }
        if( $request->action == 'save' ) {
            if( $request->id ) {
                $admin = Admin::findOrFail($request->id);
                $admin->name = $request->name;
                $admin->email = $request->email;
                $admin->extension = $request->extension;
                if( $request->password !='' )
                    $admin->password = Hash::make($request->password);
                $admin->role = $request->role;
                $admin->save();
                return view('admin.users')->with('items',Admin::all())->with('message',['success',"$request->name se ha actualizado correctamente!"]);
            } else {
                Admin::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'role' => $request->role,
                    'extension' => $request->extension,
                    'password' => Hash::make($request->password)
                ]);
                // Send email to user to set password
                return view('admin.users')->with('items',Admin::all())->with('message',['success',"$request->name se ha añadido correctamente!\nSe le ha mandado un email para que establezca su contraseña."]);
            }
        }
        if( $request->action == 'delete' ) {
            Admin::findOrFail($request->id)->delete();
            return view('admin.users')->with('items',Admin::all())->with('message',['success',"$request->name se ha eliminado correctamente!"]);
        }
        return view('admin.users')->with('items',Admin::all());
    }
    public function adminLogin(Request $request)
    {
        if( $request->isMethod('get') )
            return view('admin.auth.login');

        $credential = $request->only(['email', 'password']);
        if (Auth::guard('admin')->attempt($credential, $request->filled('remember'))) {
            file_put_contents( storage_path().'/logs/admin.login.log', now().' '.$request->ip().' Login:'.Auth::guard('admin')->user()->email."\n", FILE_APPEND );
            return redirect()->route('admin.dashboard');
        } else {
            throw ValidationException::withMessages(['email' => 'invalid email or password']);
        }
    }
    public function adminLogout(Request $request)
    {
        file_put_contents( storage_path().'/logs/admin.login.log', now().' '.$request->ip().' Logout:'.Auth::guard('admin')->user()->email."\n", FILE_APPEND );
        Auth::guard('admin')->logout();
        return redirect(route('admin.login'));
    }
    public function index( Request $request )
    {
        if( Auth::guard('admin')->user()->role === 'seo' ) 
            return view('admin.web-analytics')->with('traffic',Traffic::all())->with('web_pages',Traffic::getUrls());
        if( Auth::guard('admin')->user()->role === 'marketing' ) 
            return view('admin.web-analytics')->with('traffic',Traffic::all())->with('web_pages',Traffic::getUrls());
        return view('admin.home')->with('new_orders',Order::whereIn('status',['processing','ready','picked'])->get());
    }

    public function complements( Request $request )
    {
        if( $request->isMethod('get') ) {
            return view('admin.complements');
        }
        return view('admin.complement');
    }
    public function webHome( Request $request )
    {
        if( $request->isMethod('get') ) {
            return view('admin.web-home')->with('settings',require(storage_path('web-home.php')))->with('products',Product::where('active',true)->get()->sortBy('name'));
        }
        file_put_contents( storage_path().'/logs/xavi.log', "\n". __FILE__ .":". __LINE__ ."\n".var_export($request->all(), true)."\n", FILE_APPEND );
        if( $request->cmd == 'save' ) {
            $settings = require(storage_path('web-home2.php'));
            file_put_contents( storage_path().'/logs/xavi.log', "\n". __FILE__ .":". __LINE__ ."\n".var_export($settings, true)."\n", FILE_APPEND );
            $settings = require(storage_path('web-home.php'));
            // Background
            if( $request->hasFile('header-background') && $request->file('header-background')->isValid() ) {
                $settings['header-background'] = $request->file('header-background')->store('resources');
            }
            $settings['header-title-es'] = $request->get('header-title-es');
            $settings['header-title-ca'] = $request->get('header-title-ca');
            $settings['header-title-en'] = $request->get('header-title-en');
            $settings['header-title-ru'] = $request->get('header-title-ru');
            $settings['header-subtitle-es'] = $request->get('header-subtitle-es');
            $settings['header-subtitle-ca'] = $request->get('header-subtitle-ca');
            $settings['header-subtitle-en'] = $request->get('header-subtitle-en');
            $settings['header-subtitle-ru'] = $request->get('header-subtitle-ru');
            $promotes = [];
            for( $n = 1; $n <= 6; $n++ ) {
                if( $request->get('header-product-'.$n) ) {
                    $product = Product::find($request->get('header-product-'.$n));
                    $names = json_decode($product->name,true);
                    $images = explode('|',$product->images);
                    $promotes[] = array(
                        'id' => $product->id,
                        'name-es' => $names['es'],
                        'name-ca' => $names['ca'],
                        'name-en' => $names['en'],
                        'image' => $images[0],
                        'slug-es' => $product->es_slug,
                        'slug-ca' => $product->ca_slug,
                        'slug-en' => $product->en_slug,
                        'prices' => 
                        array (
                        0 => $product->price,
                        ),
                        'tag' => NULL,              
                    );
                }
                $settings['promotes'] = $promotes;
            }
            $bouquets = [];
            for( $n = 1; $n <= 4; $n++ ) {
                if( $request->get('bouquet-'.$n) ) {
                    $product = Product::find($request->get('bouquet-'.$n));
                    $names = json_decode($product->name,true);
                    $images = explode('|',$product->images);
                    $bouquets[] = array(
                        'id' => $product->id,
                        'name-es' => $names['es'],
                        'name-ca' => $names['ca'],
                        'name-en' => $names['en'],
                        'image' => $images[0],
                        'slug-es' => $product->es_slug,
                        'slug-ca' => $product->ca_slug,
                        'slug-en' => $product->en_slug,
                        'prices' => 
                        array (
                        0 => $product->price,
                        1 => $product->sales_price,
                        ),
                        'tag' => NULL,              
                    );
                }
                $settings['bouquets'] = $bouquets;
            }
            $plants = [];
            for( $n = 1; $n <= 4; $n++ ) {
                if( $request->get('plant-'.$n) ) {
                    $product = Product::find($request->get('plant-'.$n));
                    $names = json_decode($product->name,true);
                    $images = explode('|',$product->images);
                    $plants[] = array(
                        'id' => $product->id,
                        'name-es' => $names['es'],
                        'name-ca' => $names['ca'],
                        'name-en' => $names['en'],
                        'image' => $images[0],
                        'slug-es' => $product->es_slug,
                        'slug-ca' => $product->ca_slug,
                        'slug-en' => $product->en_slug,
                        'prices' => 
                        array (
                        0 => $product->price,
                        1 => $product->sales_price,
                        ),
                        'tag' => NULL,              
                    );
                }
                $settings['plants'] = $plants;
            }
            file_put_contents( storage_path('web-home.php'), "<?php return ".var_export($settings, true).";" );
        }
        return view('admin.web-home')->with('settings',require(storage_path('web-home.php')))->with('products',Product::all()->sortBy('name'));;
    }
    public function importProducts( Request $request )
    {
        if( $request->isMethod('get') ) {
            return view('admin.import-products');
        }
        file_put_contents( storage_path().'/logs/xavi.log', "\n". __FILE__ .":". __LINE__ ."\n".var_export($request->all(), true)."\n", FILE_APPEND );

        if( $request->cmd === 'load-file' && $request->hasFile('importFile') && $request->importFile->extension() == 'xml' ) {
            $path = $request->importFile->store('temp');
            $xml = simplexml_load_file(storage_path('app/'.$path),'SimpleXMLElement', LIBXML_NOCDATA);
            $rows = $xml->product;
            $total = count($rows);
            $ids = array();
            file_put_contents(storage_path('app/'.$path.'.php'),'<?php return '.var_export($ids,true).';');
            return view('admin.steps')->with('label',"Importando $total productos...")->with('num',0)->with('total',$total)->with('data',$path);
        }
        if( $request->cmd === 'steps' ) {
            $path = $request->data;
            $xml = simplexml_load_file(storage_path('app/'.$path),'SimpleXMLElement', LIBXML_NOCDATA);
            $rows = $xml->product;
            $ids = require(storage_path('app/'.$path.'.php'));
            $num = 0;
            foreach( $rows as $row ) {
                if( $num++ < $request->step ) 
                    continue;
                if( $num > $request->step+5 )
                    break;
                if( $row->productstatus != 'Publish' )
                    continue;
                $product = new Product();
                if( $row->parentid != '' ) {
                    $product->parent_id = $ids["$row->parentid"][0];
                    if( $row->slug == $ids["$row->parentid"][1])
                        $row->slug.='-1';
                }
                $product->sku = $row->productsku;
                $product->es_slug = $row->slug;
                $product->ca_slug = $row->slug;
                $product->en_slug = $row->slug;
                $product->name = AppHelper::setLanguages(strip_tags($row->productname));
                $product->categories = $row->category;
                $product->tags = $row->tag;
                $product->type = $row->type;
                $product->description = AppHelper::setLanguages(strip_tags($row->description));
                //Import Images
                $images = [];
                if(!empty($row->featuredimage)) {
                    $images[] = $row->slug.'.jpg';
                    AppHelper::storeImage($row->featuredimage,public_path('images/products/'.$images[0]));
                }
                $gallery = explode('|',$row->productgallery);
                $n = 1;
                foreach($gallery as $image ) {
                    if(!empty($image)) {
                        $im = $row->slug.'_'.$n++.'.jpg';
                        AppHelper::storeImage($image,public_path('images/products/'.$im));
                        $images[] = $im;
                    }
                }
                $product->images = implode('|',$images);
                if( empty($row->price) )
                    $product->price = 0;    
                else
                    $product->price = floatval(str_replace(',','.',$row->price));
                if( empty($row->saleprice) )
                    $product->sale_price = 0;
                else
                    $product->sale_price = floatval(str_replace(',','.',$row->saleprice));
                $product->tax_type = $row->taxclass;
                if( empty($row->weight) )
                    $product->weight = 0;
                else
                    $product->weight = floatval(str_replace(',','.',$row->weight));
                $product->dimensions = $row->height.'x'.$row->width.'x'.$row->length;
                $product->stock = 0;
                $title = $row->{'wordpressseo-seotitle'};
                $title = str_replace('%%title%%',$row->productname,$title);
                $title = str_replace('%%page%%','',$title);
                $title = str_replace('%%sep%%','-',$title);
                $title = str_replace('%%sitename%%','ROSISTIREM',$title);
                $seo = '{"title":"'.$title.'","description":"'.$row->{'wordpressseo-metadescription'}.'"}';
                $product->seo = AppHelper::setLanguagesJSON($seo);
                $product->meta = '';
                $product->subitems = '';
                $product->active = false;
                $product->save();
                if( $row->parentid == '' ) {
                    $ids["$row->productid"] = [$product->id,(string)$row->slug];
                }
            }
            if( $num < count($rows) ) {
                file_put_contents(storage_path('app/'.$path.'.php'),'<?php return '.var_export($ids,true).';');
                $total = count($rows);
                return view('admin.steps')->with('label',"Importando $total productos...")->with('num',$num-1)->with('total',$total)->with('data',$path);    
            }
            Storage::delete($path);
            Storage::delete($path.'.php');

            return redirect()->route('admin.products');
        }
        if( $request->cmd === 'import-file' ) {
            $products = [];
            foreach( $request->all() as $key => $value ) {
                if( Str::startsWith($key,'id-') ) {
                    $products[] = Str::after($key,'id-');
                }
            }
            $path = $request->file;
            $xml = simplexml_load_file(storage_path('app/'.$path));
            $rows = $xml->product;
            $items = [];
            foreach( $rows as $product ) {
                if( in_array($product->productid, $products) || in_array($product->parentid, $products) ) {
                    $items[] = $product;
                }
            }
            Storage::delete($path);
            $count = count($items);
            return view('admin.import-products-3')->with('products',Product::all());
        }
        abort(404);
    }
    public function productOrder( Request $request ) {
        if( $request->isMethod('get') ) {
            return view('admin.product-order')->with('items',Product::all());
        }
        file_put_contents( storage_path().'/logs/xavi.log', "\n". __FILE__ .":". __LINE__ ."\n".var_export($request->all(), true)."\n", FILE_APPEND );
        // "/(0R|0P)/"
        $ret = array();
        if( $request->cmd == 'order' && $request->has('product_categories') ) {
            $products = Product::getProducts(implode('|',$request->product_categories),true);
            foreach( $products as $product ) {
                $ret[] = ['id'=>$product['id'],'image'=>$product['image'],'title'=>$product['name-es']];
            }
        }
        if( $request->cmd == 'save' ) {
            $orderList = \App\Models\OrderList::where('categories',implode('|',$request->product_categories))->first();
            if( $orderList == null ) {
                $orderList = new \App\Models\OrderList();
            }
            $orderList->categories = implode('|',$request->product_categories);
            $orderList->name = $orderList->categories;
            $orderList->list = $request->order;
            $orderList->save();
        }
        return response()->json($ret);
    }
    public function productWizard( Request $request ) {
        if( $request->isMethod('get') )
            return view('admin.product-wizard');
        // POST
        file_put_contents( storage_path().'/logs/xavi.log', "\n". __FILE__ .":". __LINE__ ."\n".var_export($request->all(), true)."\n", FILE_APPEND );
        $cmd = explode('|',$request->cmd);
        if( $cmd[0] == 'simple' ) {
            $cats = config('rosistirem.categories');
            $categories = [];
            if( $cmd[1] == 'bouquet' ) {
                $categories['Ramos'] = $cats['Ramos'];
            }
            if( $cmd[1] == 'plant' ) {
                $categories['Plantas'] = $cats['Plantas'];
            }
            $categories['Ocasiones Especiales'] = $cats['Ocasiones Especiales'];
            return view('admin.product-wizard-simple')->with('type',$cmd[1])->with('categories',$categories);
        }
        if( $cmd[0] == 'variable' ) {
            $cats = config('rosistirem.categories');
            $categories = [];
            if( $cmd[1] == 'bouquet' ) {
                $categories['Ramos'] = $cats['Ramos'];
            }
            if( $cmd[1] == 'plant' ) {
                $categories['Plantas'] = $cats['Plantas'];
            }
            $categories['Ocasiones Especiales'] = $cats['Ocasiones Especiales'];
            return view('admin.product-wizard-variable')->with('type',$cmd[1])->with('categories',$categories);;
        }
        if( $cmd[0] == 'next' ) {
            return view('admin.product-wizard-step')->with('data',$request->all());
        }
        if( $cmd[0] == 'raw' ) {
            return view('admin.product-wizard-raw');
        }
        if( $request->cmd == 'create' ) {
            $product = new Product();
            $product->active = isset($request->active) ? true : false;
            $product->categories = implode('|',$request->product_categories);
            $product->price = $request->product_price;
            $product->type = 'simple';
            //$request->product_type;
            $product->sku = $request->product_sku;
            $product->tags = $request->product_tags?:'';
            $product->name = AppHelper::setLanguages($request->product_name_es,$request->product_name_ca,$request->product_name_en);
            $product->es_slug = AppHelper::createSlug($product->getLocalizedName('es'),'es');
            $product->ca_slug = AppHelper::createSlug($product->getLocalizedName('ca'),'ca');
            $product->en_slug = AppHelper::createSlug($product->getLocalizedName('en'),'en');
            $product->description = AppHelper::setLanguages($request->product_description_es,$request->product_description_ca,$request->product_description_en);
            $product->images = '';
            $product_images = array();
            if( $request->has('product_images') ) {
                $images = json_decode($request->get('product_images'),true);
                $n = 0;
                foreach( $images as $image ) {
                    if( Str::of($image['src'])->startsWith('data') ) {
                        $d = AppHelper::getImageData($image['src']);
                        $dst = $product->es_slug;
                        if( $n ) $dst .= '_'.$n;
                        $dst .= '.'.$d['type'];
                        //AppHelper::storeImageBlob($d['data'],storage_path('app/resources/'.$dst));
                        file_put_contents(storage_path('app/resources/'.$dst),$d['data']);
                        $product_images[]=$dst;

                    } else {
                        $file = pathinfo($image['src'], PATHINFO_BASENAME);
                        file_put_contents( storage_path().'/logs/xavi.log', "\n". __FILE__ .":". __LINE__ ."\n".var_export($file, true)."\n", FILE_APPEND );
                    }
                    $n++;
                }
                $product->images = implode('|',$product_images);
            }   
            /*if( $request->hasFile('product_images') ) {
                $path = $request->product_images->store('temp');
                AppHelper::storeImage(storage_path('app/'.$path),storage_path('app/resources/').$product->es_slug.'.jpg');
                Storage::delete($path);
                $product->images = 'resources/'.$product->es_slug.'.jpg';
            }*/
            $product->save();
        }
        return view('admin.product-wizard');
    }
    public function products( Request $request ) {
        if( $request->isMethod('get') )
            return view('admin.products')->with('items',Product::all());
        // POST
        file_put_contents( storage_path().'/logs/xavi.log', "\n". __FILE__ .":". __LINE__ ."\n".var_export($request->all(), true)."\n", FILE_APPEND );
        if( $request->action == 'edit' ) {
            $product = Product::find($request->id);
            return view('layouts.admin.product-card')->with('product',$product)->with('variables',Product::getVariables());
        }       
        if( $request->cmd == 'get' ) {
            return response()->json(Product::find($request->data)->toJson());
        }
        if( $request->cmd == 'save' ) {
            $product = Product::find($request->id);
            $product->parent_id = $request->product_parent;
            $product->order = $request->product_order;
            $product->active = $request->active ? true : false;
            $product->sku = $request->product_sku;
            $product->name = AppHelper::setLanguages($request->product_name_es,$request->product_name_ca,$request->product_name_en);
            $product->es_slug = $request->product_slug_es?:AppHelper::createSlug($product->getLocalizedName('es'),'es');
            $product->ca_slug = $request->product_slug_ca?:AppHelper::createSlug($product->getLocalizedName('ca'),'ca');
            $product->en_slug = $request->product_slug_en?:AppHelper::createSlug($product->getLocalizedName('en'),'en');
            $product->categories = implode('|',$request->product_categories);
            $product->description = AppHelper::setLanguages($request->product_description_es,$request->product_description_ca,$request->product_description_en);
            $product->price = $request->product_price?:0;
            $product->sale_price = $request->sale_product_price?:0;
          
            $product->images = '';
            $product_images = array();
            if( $request->has('product_images') ) {
                $images = json_decode($request->get('product_images'),true);
                $n = 0;
                foreach( $images as $image ) {
                    if( Str::of($image['src'])->startsWith('data') ) {
                        $d = AppHelper::getImageData($image['src']);
                        $dst = $product->es_slug;
                        if( $n ) $dst .= '_'.$n;
                        $dst .= '.'.$d['type'];
                        file_put_contents(storage_path('app/resources/'.$dst),$d['data']);
                        $product_images[]=$dst;
                    } else {
                        $file = pathinfo($image['src'], PATHINFO_BASENAME);
                        $product_images[]=$file;
                    }
                    $n++;
                }
                $product->images = implode('|',$product_images);
            }   
            $product->save();
        }
        if( $request->cmd == 'add' ) {
            $product = new Product();

        }
        if( $request->cmd == 'delete' ) {
        }
        return view('admin.products')->with('items',Product::all());
    }
    public function test( Request $request ) {
        $invoice = Invoice::createWebInvoice(2);
        //$invoice = Invoice::find(1);
        $invoice->getDocument();
    }
    public function gallery( Request $request ) {
        file_put_contents( storage_path().'/logs/xavi.log', "\n". __FILE__ .":". __LINE__ ."\n".var_export($request->all(), true)."\n", FILE_APPEND );
        /*$products = Product::all();
        $result = array();
        foreach( $products as $product ) {

        }*/
        $disk = Storage::build([
            'driver' => 'local',
            'root' => public_path('images'),
        ]);
        $result = array();
        $files = $disk->files('');
        foreach( $files as $file ) {
            $result[] = ['src'=>'images/'.$file,'name'=>$file,'alt'=>'','tag'=>''];
            //file_put_contents( storage_path().'/logs/xavi.log', "\n". __FILE__ .":". __LINE__ ."\n".var_export($file, true)."\n", FILE_APPEND );
        }
        return response()->json([
            'statusCode' => 200, 
            'result' => $result
        ]);
    }
    public function parcelPoint( Request $request )
    {
        if( $request->isMethod('get') ) {
            return view('admin.parcel-point');
        }
    }
    public function redirections( Request $request )
    {
        if( $request->isMethod('get') ) {
            return view('admin.redirections')->with('redirections',Redirection::all());
        }
        file_put_contents( storage_path().'/logs/xavi.log', "\n". __FILE__ .":". __LINE__ ."\n".var_export($request->all(), true)."\n", FILE_APPEND );
        if( $request->cmd == 'save' ) {
            $redirection = $request->id ? Redirection::find($request->id) : new Redirection();
            $redirection->from = $request->from;
            $redirection->to = $request->to;
            $redirection->code = $request->type;
            $redirection->save();
        }
        if( $request->cmd == 'get' ) {
            $redirection = Redirection::find($request->id);
            return response()->json($redirection);
        }
        if( $request->cmd == 'del' ) {
            $redirection = Redirection::find($request->id);
            $redirection->delete();
            return response()->json($redirection);
        }
        return view('admin.redirections')->with('redirections',Redirection::all());
    }
    public function uploadImage( Request $request )
    {
        if( $request->isMethod('get') ) {
            return view('admin.upload-images');
        }
    }
    public function webAnalytics( Request $request )
    {
        if( $request->isMethod('get') ) {
            return view('admin.web-analytics')->with('traffic',Traffic::all())->with('web_pages',Traffic::getUrls());
        }
    }
    public function webPages( Request $request ) {
        if( $request->isMethod('get') )
            return view('admin.web-pages')->with('web_pages',WebPage::all());
        file_put_contents( storage_path().'/logs/xavi.log', "\n". __FILE__ .":". __LINE__ ."\n".var_export($request->all(), true)."\n", FILE_APPEND );
        if( $request->cmd == 'get' ) {
            $web_page = $request->data ? WebPage::find($request->data) : new WebPage();
            return view('admin.web-page')->with('web_page',$web_page);
        }
        if( $request->cmd == 'del' ) {
            $web_page = WebPage::find($request->data);
            $web_page->delete();
        }
        if( $request->cmd == 'save' ) {
            $web_page = $request->id ? WebPage::find( $request->id ) : new WebPage();
            if( $request->hasFile('header-image') && $request->file('header-image')->isValid() ) {
                $web_page->header_image = $request->file('header-image')->store('resources');
            }    
            $web_page->type = $request->type;
            $web_page->categories = $request->categories;
            $web_page->tags = $request->tags;
            $web_page->name_es = $request->name_es;
            $web_page->name_ca = $request->name_ca ?: $request->name_es;
            $web_page->name_en = $request->name_en ?: $request->name_es;
            $web_page->description_es = $request->description_es;
            $web_page->description_ca = $request->description_ca ?: $request->description_es;
            $web_page->description_en = $request->description_en ?: $request->description_es;
            $web_page->content_es = $request->content_es;
            $web_page->content_ca = $request->content_ca ?: $request->content_es;
            $web_page->content_en = $request->content_en ?: $request->content_es;
            $web_page->seo_title_es = $request->seo_title_es;
            $web_page->seo_title_ca = $request->seo_title_ca ?: $request->seo_title_es;
            $web_page->seo_title_en = $request->seo_title_en ?: $request->seo_title_es;
            $web_page->seo_description_es = $request->seo_description_es;
            $web_page->seo_description_ca = $request->seo_description_ca ?: $request->seo_description_es;
            $web_page->seo_description_en = $request->seo_description_en ?: $request->seo_description_es;
            $web_page->active = $request->active ? true : false;
            $web_page->es_slug = $request->slug_es ?: Str::slug($web_page->name_es);
            $web_page->ca_slug = $request->slug_ca ?: Str::slug($web_page->name_ca);
            $web_page->en_slug = $request->slug_en ?: Str::slug($web_page->name_en);

            $dom = new Crawler($request->content_es);

            $arrContextOptions=array(
                "ssl"=>array(
                    "verify_peer"=>false,
                    "verify_peer_name"=>false,
                ),
            );  
            
            foreach( $dom->filter('img') as $e ) {
                foreach ($e->attributes as $attrName => $attrNode) {
                    file_put_contents( storage_path().'/logs/xavi.log', "\n". __FILE__ .":". __LINE__ ."\n".var_export($attrName, true)."\n", FILE_APPEND );
                    file_put_contents( storage_path().'/logs/xavi.log', "\n". __FILE__ .":". __LINE__ ."\n".var_export($attrNode->nodeValue, true)."\n", FILE_APPEND );
                }
                $src = $e->getAttribute('src');
                if( strtolower(substr($src,0,4)) === 'http' ) {
                    $img = file_get_contents( $src,false,stream_context_create($arrContextOptions) );
                    $ext = pathinfo( $src, PATHINFO_EXTENSION );
                    file_put_contents( storage_path().'/logs/xavi.log', "\n". __FILE__ .":". __LINE__ ."\n".var_export($ext, true)."\n", FILE_APPEND );
                    $e->setAttribute('src','resources/blank.png');
                }
            }
            
            $content = $dom->filter('body')->html();

            $web_page->save();
        }
        return view('admin.web-pages')->with('web_pages',WebPage::all());
    }
}
