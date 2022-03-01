<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

use AddonPayments\Api\ServicesConfig;
use AddonPayments\Api\ServicesContainer;
use AddonPayments\Api\Entities\Exceptions\ApiException;
use AddonPayments\Api\HostedPaymentConfig;
use AddonPayments\Api\Entities\HostedPaymentData;
use AddonPayments\Api\Services\HostedService;
use AddonPayments\Api\Entities\Enums\HppVersion;

use App\Mail\OrderReceived;
use App\Models\Product;
use App\Models\Order;
use App\Models\Invoice;
use App\Models\Coupon;
use App\Models\WebPage;

class WebController extends Controller
{
    protected $cart_items = [
        ['id'=>1,'sku'=>'RF-001','image'=>'home-product-1.jpg','name'=>'Ramo de la semana','qty'=>1,'price'=>24.90]
    ];

    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function test() {
        //$invoice = new Invoice();
        //$invoice->getDocument();
        $order = Order::latest()->first();
        //$t = '{"CAVV":"","SRD":"c3BJUzI4T0RqSWNKRU1qNA==","HPP_CARD_TYPE":"Q1JFRElU","HPP_ISSUING_COUNTRY_CODE":"SVJM","HPP_COMMERCIAL":"RkFMU0U=","HPP_ISSUING_BANK":"QWxsaWVkIElyaXNoIEJhbmtzLCBQLkwuQy4=","CVNRESULT":"TQ==","PASREF":"MTY0MDk0OTM5MDQ1OTY4NTU=","MESSAGE":"WyBzaXN0ZW1hIGRlIHBydWViYSBdIE1lbnNhamUgZGUgcmVzcHVlc3RhIGRlIGxhIHBhc2FyZWxhIFtBVVRIT1JJU0VEXQ==","DS_TRANS_ID":"","ACCOUNT":"aW50ZXJuZXQ=","AVSPOSTCODERESULT":"TQ==","AMOUNT":"MTI0ODA=","TIMESTAMP":"MjAyMTEyMzExMjE1NTY=","pas_uuid":"Mzg3ZDZhNDItYTg2Mi00MjhlLThjOWQtNDU1MTYzZjY2YjBj","HPP_ISSUING_COUNTRY":"SVJFTEFORA==","AUTHCODE":"MTIzNDU=","AVSADDRESSRESULT":"TQ==","AUTHENTICATION_VALUE":"","ECI":"Ng==","HPP_LANG":"ZXM=","MESSAGE_VERSION":"","BATCHID":"MTAzMTMzNQ==","XID":"","SHA1HASH":"NGFjMzBlYTFmOTUxNDNhNWM5MWQ0NWMwMDljYjVlMzBhYTNjZWRhMQ==","ORDER_ID":"MzExMjIwMjFfMTItMTVfU0RLX3YyLTEtMF9ORUl4T0VZeE5ESXROeg==","HPP_FRAUDFILTER_RESULT":"Tk9UX0VYRUNVVEVE","RESULT":"MDA=","MERCHANT_ID":"YWRkb25waHB0ZXN0"}';
        //$a = json_decode($t);
        //file_put_contents( storage_path().'/logs/xavi.log', "\n". __FILE__ .":". __LINE__ ."\n".var_export($a, true)."\n", FILE_APPEND );
        \App\helpers\AppHelper::encrypt('WO-2022000022');
        //Mail::to('xamones@gmail.com')->send(new OrderReceived($order));
        return view('pay-end')->with('order',$order);
    }
    public function commands( Request $request ) {
        if( $request->isMethod('post') ) {
            switch( $request->cmd ) {
                case 'storeSessionData':
                    session(['shipping'=>$request->shipping]);
                    session(['dedication'=>$request->dedication]);
                    session(['sender_email'=>$request->sender_email]);
                    session(['sender_name'=>$request->sender_name]);
                    session(['sender_phone'=>$request->sender_phone]);
                    session(['sender_newsletter'=>($request->newsletter??false)]);
                    session(['sender_invoice'=>($request->invoice ?? false)]);
                    if( $request->has('invoice') ) {
                        session(['invoice_name'=>$request->invoice_name]);
                        session(['invoice_nif'=>$request->invoice_nif]);
                        session(['invoice_address'=>$request->invoice_address]);
                        session(['invoice_city'=>$request->invoice_city]);
                        session(['invoice_zip'=>$request->invoice_zip]);
                    }
                    session(['name'=>$request->name]);
                    session(['phone'=>$request->phone]);
                    session(['address'=>$request->address]);
                    session(['city'=>$request->city]);
                    session(['zip'=>$request->zip]);
                    session(['info'=>$request->info]);
                    session(['notification'=>($request->notification??true)]);
                    session(['delivery_type'=>$request->delivery_type]);        
                    break;
                case 'deleteCartItem':
                    \Cart::session($request->session()->get('_token'))->remove($request->cartId);
                    break;
                case 'order':
                    $order = Order::find($request->id);
                    $order->getDocument();
                    break;
                case 'invoice':
                    $invoice = Invoice::where('order_id',$request->id)->get();
                    $invoice[0]->getDocument();
                    break;
            }
        }
        return '{}';
    }
    public function blog( Request $request ) {
        return view('blog')->with('entries',WebPage::where('type','blog')->where('active',true)->get());
    }
    public function index( Request $request )
    {
        return view('home');
    }
    public function urgent( Request $request )
    {
        return view('urgent');
    }
    public function show( Request $request, $id )
    {
        $product = Product::getBySlug($id);
        if( $product ) {
            return view('product')->with('product',$product);
        }
    }
    public function bouquets( Request $request )
    {
        return view('products')->with('products',Product::getBouquets())->with('background','ramos.jpg')->with('title','Ramos');
    }
    public function plants( Request $request )
    {
        return view('products')->with('products',Product::getPlants())->with('background','plantas.jpg')->with('title','Plantas');
    }
    public function bouquetComplements( Request $request )
    {
        return view('products')->with('products',Product::getBouquetComplements())->with('background','ramos.jpg')->with('title','Complementos para Ramos');
    }
    public function plantComplements( Request $request )
    {
        return view('products')->with('products',Product::getPlantComplements())->with('background','plantas.jpg')->with('title','Complementos para Plantas');
    }
    public function buy( Request $request, $id )
    {
        $product = Product::getBySlug($id);
        if( $product ) {
            \Cart::session($request->session()->get('_token'))->add(array(
                'id' => $product->id,
                'name' => $product->getLocalizedName(),
                'price' => $product->getPrice(),
                'quantity' => 1,
                'attributes' => array(),
            ));
            if( $request->has('today') )
                return redirect(localized_route('pay'))->with('today',true);
            return redirect(localized_route('pay'));
        }
        return back();
    }
    public function cart( Request $request ) {
        file_put_contents( storage_path().'/logs/xavi.log', "\n". __FILE__ .":". __LINE__ ."\n".var_export($request->all(), true)."\n", FILE_APPEND );
        $cart = \Cart::session($request->session()->get('_token'));
        if( $request->isMethod('post') ) {
            $product = Product::find($request->id);
            $cart->add([
                'id' => $product->id,
                'name' => $product->getLocalizedName(),
                'price' => $product->getPrice(),
                'quantity' => 1,
                'attributes' => array(),
            ]);
            $items = explode(',',$request->items);
            foreach( $items as $item ) {
                if( $item ) {
                    $product = Product::find($item);
                    $cart->add([
                        'id' => $product->id,
                        'name' => $product->getLocalizedName(),
                        'price' => $product->getPrice(),
                        'quantity' => 1,
                        'attributes' => array(),
                    ]);
                }
            }
        }
        $items = $cart->getContent();
        $cart_items = array();
        foreach( $items as $item ) {
            $product = Product::find($item->id);
            $sku = $product->sku;
            if( $product->images ) {
                $images = explode('|',$product->images );
                $image = $images[0];
            } else {
                $image = '';
            }
            $cart_items[] = ['qty'=>$item->quantity,'id'=>$item->id,'name'=>$item->name,'price'=>$item->price,'sku'=>$sku,'image'=>$image];
        }
        return view('cart')->with('complements',Product::getAllComplements())->with('items',$cart_items)->with('jsonData','{"items":[1]}');
    }
    public function pay( Request $request )
    {
        $items = \Cart::session($request->session()->get('_token'))->getContent();
        $cart_items = array();
        $total = 0;
        foreach( $items as $item ) {
            $cart_items[] = ['qty'=>$item->quantity,'id'=>$item->id,'name'=>$item->name,'price'=>$item->price];
            $total += $item->price;
        }
        if( $request->isMethod('get') ) {
            return view('pay')->with('data',['total' => $total,'items' => $cart_items]);
        }
        file_put_contents( storage_path().'/logs/xavi.log', "\n". __FILE__ .":". __LINE__ ."\n".var_export($request->all(), true)."\n", FILE_APPEND );
        if( $request->cmd == 'end_purchase' ) {
            file_put_contents( storage_path().'/logs/xavi.log', "\n". __FILE__ .":". __LINE__ ."\n".var_export(json_decode($request->data,true), true)."\n", FILE_APPEND );
            return view('pay')->with('data',$data);
        }
        if( $request->cmd == 'coupon' ) {
            $coupon = Coupon::where('reference',$request->coupon)->where('active',true)->first();
            if( $coupon ) {
                if( (!$coupon->starts || $coupon->starts->format('Ymd') <= now()->format('Ymd')) && (!$coupon->ends || $coupon->ends->format('Ymd') >= now()->format('Ymd')) ) {
                    file_put_contents( storage_path().'/logs/xavi.log', "\n". __FILE__ .":". __LINE__ ."\n".var_export($coupon->toArray(), true)."\n", FILE_APPEND );
                    return response()->json(['status'=>'valid','value'=>$coupon->value,'type'=>'percentage','reference'=>$coupon->reference]);
                }
            }
            return response()->json(['status'=>'not-valid']);
        }
        file_put_contents( storage_path().'/logs/xavi.log', "\n". __FILE__ .":". __LINE__ ."\n".var_export($request->all(), true)."\n", FILE_APPEND );
        if( $request->cmd == "payment" ) {
            file_put_contents( storage_path().'/logs/xavi.log', "\n". __FILE__ .":". __LINE__ ."\n".var_export($request->all(), true)."\n", FILE_APPEND );
            $request->cmd = 'storeSessionData';
            $this->commands($request);
            $new_id = Order::all()->count()+1;
            $order = new Order();
            $order->status = Order::STATUS_OPEN;
            $order->reference = 'WP-'.date('Y').sprintf('%06d', $new_id);
            $order->transaction = '';
            $order->email = $request->sender_email;
            $order->total = $request->amount;
            $order->sender_name = $request->sender_name;
            $order->sender_phone = $request->sender_phone;
            $order->sender_newsletter = $request->newsletter ?? false;
            $order->sender_invoice = $request->invoice ?? false;
            if( $request->has('invoice') ) {
                $order->invoice_name = $request->invoice_name;
                $order->invoice_nif = $request->invoice_nif;
                $order->invoice_address = $request->invoice_address;
                $order->invoice_city = $request->invoice_city;
                $order->invoice_zip = $request->invoice_zip;
            }
            $order->addressee_name = $request->name;
            $order->addressee_phone = $request->phone;
            $order->addressee_address = $request->address;
            $order->addressee_city = $request->city;
            $order->addressee_zip = $request->zip;
            $order->addressee_info = $request->info;
            $order->addressee_dedication = $request->dedication ?? '';
            $order->notification = $request->notification ?? false;
            $order->addressee_delivery_type = $request->delivery_type;
            $order->coupon = $request->reference;
            if( $order->coupon ) {
                $coupon = Coupon::where('reference',$order->coupon)->first();
                if( $coupon )
                    $order->coupon_value = $coupon->value;
            }
            $date='';
            switch( $request->delivery_type ) {
                case 0:
                    $date = \Date::createFromTimestamp($request->delivery_date)->format('D d-m-Y');
                    break;
                case 1:
                    $date = today()->format('D d-m-Y');
                    break;
                case 2:
                    $date = \App\Helpers\AppHelper::nextBusinessDay2(false);
                    break;
                case 3:
                    $date = \Date::createFromTimestamp($request->delivery_date)->format('D d-m-Y');
                    break;
            }
            switch( $request->delivery_time ) {
                case 0:
                    $date .= ' 08:30-21:30';
                    break;
                case 1:
                    $date .= ' 08:30-14:30';
                    break;
                case 2:
                    $date .= ' 15:00-21:30';
                    break;
            }
            $order->addressee_delivery_date = strtoupper($date);
            $order->items = $request->items;
            $order->shipping = $request->shipping;
            $order->payment_method = $request->paying_method;
            $order->save();
            if( $request->paying_method == 'card' ) {
                $config = new ServicesConfig();
                $config->merchantId = config('addon-payments.merchantId');
                $config->accountId = config('addon-payments.accountId');
                $config->sharedSecret = config('addon-payments.sharedSecret');
                $config->channel = "ECOM"; // Puede ser MOTO o ECOM según la operativa que quiera realizar
                $config->serviceUrl = config('addon-payments.serviceUrl');
                $config->hostedPaymentConfig = new HostedPaymentConfig();
                $config->hostedPaymentConfig->version = HppVersion::VERSION_2;
                $config->hostedPaymentConfig->setLanguage(app()->getLocale());
                $service = new HostedService($config);
                try {
                    $hppJson = $service->charge($request->amount)->withCurrency("EUR")->serialize();
                    $hpp = json_decode($hppJson,true);
                    $order->reference = $hpp['ORDER_ID'];
                    $order->transaction = $hppJson;
                    $order->status = Order::STATUS_OPEN;
                    $order->save();
                    return view('pay-card')->with('json',$hppJson);
                } catch (ApiException $e) {
                    file_put_contents( base_path('addon-payments-fails.log'), date("Y-m-d H:i:s").$e->getMessage()."\n", FILE_APPEND );
                    return $e->getMessage();
                }
            }
            if( $request->paying_method == 'paypal' ) {
                return view('pay-paypal')->with('amount',$request->amount)->with('order_id',$order->reference);
            }
        }
        abort(404);
        //return view('pay')->with('paying_method',$request->paying_method);
    }

    public function addonPayments( Request $request ) {
        $config = new ServicesConfig();
        $config->merchantId = config('addon-payments.merchantId');
        $config->accountId = config('addon-payments.accountId');
        $config->sharedSecret = config('addon-payments.sharedSecret');
        $config->channel = "ECOM"; // Puede ser MOTO o ECOM según la operativa que quiera realizar
        $config->serviceUrl = config('addon-payments.serviceUrl');
        $config->hostedPaymentConfig = new HostedPaymentConfig();
        $config->hostedPaymentConfig->version = HppVersion::VERSION_2;
        $service = new HostedService($config);
        $responseJson = $request->hppResponse;
        $parsedResponse = $service->parseResponse($responseJson, true);
        file_put_contents( base_path('addon-payments.log'), "\n".date("Y-m-d H:i:s")." UTC ". __FILE__ .":". __LINE__ ."\n".var_export($parsedResponse, true)."\n", FILE_APPEND );
        $order = Order::firstWhere('reference',$parsedResponse->responseValues['ORDER_ID']);
        if( $parsedResponse->responseCode == '00' ) {
            if( $order ) {
                $order->status = Order::STATUS_PROCESSING;
                $order->transaction = $responseJson;
                $order->reference = 'WO-'.date('Y').sprintf('%06d', $order->id);
                $order->save();
                \Cart::session($request->session()->get('_token'))->clear();
                if( $order->invoice ) {
                    $invoice = Invoice::createOrderInvoice($order);
                }
                Mail::to('xamones@gmail.com')->send(new OrderReceived($order));
                Mail::to('rosistirem@gmail.com')->send(new OrderReceived($order));
                $request->session()->forget([
                    'shipping',
                    'dedication',
                    'sender_email',
                    'sender_name',
                    'sender_phone',
                    'sender_newsletter',
                    'sender_invoice',
                    'invoice_name',
                    'invoice_nif',
                    'invoice_address',
                    'invoice_city',
                    'invoice_zip',
                    'name',
                    'phone',
                    'address',
                    'city',
                    'zip',
                    'info',
                    'notification',
                    'delivery_type'
                ]);    
                return view('pay-end')->with('order',$order);
            }
        } else {
            if( $order ) {
                $order->status = Order::STATUS_FAILED;
                $order->transaction = $responseJson;
                $order->save();
            }
        }
        abort(500);
    }
    public function page( Request $request, $slug ) {
        $product = Product::getBySlug($slug);
        if( $product )
            return view('product')->with('product',$product);
        $page = WebPage::getBySlug($slug);
        if( $page ) {
            if( $page->type == 'blog' ) return view('blog-entry')->with('page',$page);
        }
        abort(404);
    }
    public function page_lang( Request $request, $lang, $slug ) {
        $product = Product::getBySlug($slug);
        if( $product )
            return view('product')->with('product',$product);            
        $page = WebPage::getBySlug($slug);
        if( $page ) {
            if( $page->type == 'blog' ) return view('blog-entry')->with('page',$page);
        }
        abort(404);
    }
    public function specialOcasions( Request $request, $id ) {
        abort(404);
    }
    public function emptyCart( Request $request ) {
        \Cart::session($request->session()->get('_token'))->clear();
        return redirect('/');
    }
    public function getBouquets() {
        return $this->bouquets;
    }
}
