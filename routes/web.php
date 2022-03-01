<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\WebController;

// RESOURCES ROUTE FOR CONDITIONAL AND SELECTIVE ACCESS
Route::get('/resources/{filename}', function(Request $request, $filename ) {
    $path = storage_path('app/resources/').$filename;
    if(!File::exists($path)) {
        $path = storage_path('app/resources/blank.png');
    }
    $file = File::get($path);
    $type = File::mimeType($path);
    if( $type == 'image/svg' )
        $type = 'image/svg+xml';
    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);
    return $response;
});

// ---- ADMIN ROUTES ----
Route::domain(config('app.admin_domain'))->group( function() {
    Route::middleware(['auth:admin'])->group(function () {
        Route::match(['get','post'],'/product-wizard', [AdminController::class,'productWizard'])->name('admin.product-wizard');
        Route::match(['get','post'],'/web-analytics', [AdminController::class,'webAnalytics']);
        Route::match(['get','post'],'/couriers', [AdminController::class,'couriers'])->name('admin.courier');
        Route::match(['get','post'],'/redirections', [AdminController::class,'redirections'])->name('admin.redirections');
        Route::match(['get','post'],'/parcel-point', [AdminController::class,'parcelPoint'])->name('admin.parcel-point');
        Route::match(['get','post'],'/', [AdminController::class,'index'])->name('admin.dashboard');
        Route::match(['get','post'],'/categories', [AdminController::class,'categories'])->name('admin.categories');
        Route::match(['get','post'],'/complements', [AdminController::class,'complements'])->name('admin.complements');
        Route::match(['get','post'],'/web-home', [AdminController::class,'webHome'])->name('admin.web-home');
        Route::match(['get','post'],'/import-products', [AdminController::class,'importProducts'])->name('admin.import-products');
        Route::match(['get','post'],'/products', [AdminController::class,'products'])->name('admin.products');
        Route::match(['get','post'],'/product-order', [AdminController::class,'productOrder'])->name('admin.product-order');
        Route::match(['get','post'],'/orders', [AdminController::class,'orders'])->name('admin.orders');
        Route::match(['get','post'],'/invoices', [AdminController::class,'invoices'])->name('admin.invoices');
        Route::match(['get','post'],'/coupons', [AdminController::class,'coupons'])->name('admin.coupons');
        Route::match(['get','post'],'/test', [AdminController::class,'test']);
        Route::match(['get','post'],'/web-pages', [AdminController::class,'webPages'])->name('admin.web-pages');
        Route::match(['get','post'],'/gallery', [AdminController::class,'gallery'])->name('admin.gallery');
        Route::match(['get','post'],'/users', [AdminController::class,'users'])->name('admin.users');
        Route::match(['get','post'],'/blog-care', [AdminController::class,'blogCare'])->name('admin.blog-care');
        Route::match(['get','post'],'/blog-rosistirem', [AdminController::class,'blogRosistirem'])->name('admin.blog-rosistirem');
        Route::match(['get','post'],'/qrcodes', [AdminController::class,'qrCodes'])->name('admin.qr-codes');
        Route::match(['get','post'],'/cash-register', [AdminController::class,'cashRegister'])->name('admin.cash-register');
        Route::match(['get','post'],'/upload-image', [AdminController::class,'uploadImage'])->name('admin.upload-image');
        Route::get('/order/{id}', [AdminController::class,'order'])->name('admin.order');
        Route::post('/logout', [AdminController::class,'adminLogout'])->name('admin.logout');
        Route::post('commands', [AdminController::class,'commands']);
        Route::get('getQR',[AdminController::class,'getQR']);
        Route::get('export-orders',[AdminController::class,'exportOrders'])->name('admin.export-orders');
    });
    Route::middleware(['guest:admin'])->group(function () {
        Route::match(['get','post'],'/login',[AdminController::class,'adminLogin'])->name('admin.login');
    });
});

// ---- WEB ROUTES ----

//Route::domain(config('app.web_domain'))->group( function() {
    //Route::middleware('cache.headers:public;max_age=3600;etag')->group(function() {
        Route::multilingual('/', [WebController::class,'index'])->name('home');
        Route::multilingual('urgent', [WebController::class,'urgent']);
        Route::multilingual('bouquets', [WebController::class,'bouquets']);
        Route::multilingual('plants', [WebController::class,'plants']);
        Route::multilingual('bouquet-complements', [WebController::class,'bouquetComplements']);
        Route::multilingual('plant-complements', [WebController::class,'plantComplements']);
        Route::multilingual('show/{id}', [WebController::class,'show']);
        Route::multilingual('buy/{id}', [WebController::class,'buy']);
        Route::multilingual('special-ocasions/{id}', [WebController::class,'specialOcasions']);
        Route::multilingual('valentines-day')->view('valentines',['products'=>\App\Models\Product::getProducts('0OSV0')]);;
        Route::multilingual('privacy');
        Route::multilingual('terms');
        Route::multilingual('cart', [WebController::class,'cart']);
        Route::multilingual('cart', [WebController::class,'cart'])->method('post');
        Route::multilingual('pay', [WebController::class,'pay']);
        Route::multilingual('pay', [WebController::class,'pay'])->method('post');
        Route::multilingual('contact');
        Route::multilingual('events')->view('events');
        Route::multilingual('flower-centers')->view('blank',['title'=>'Centros Florales']);
        Route::multilingual('blog-care')->view('blank',['title'=>'Cuidados']);
        Route::multilingual('funerary-art')->view('funerary',['products'=>\App\Models\Product::getProducts('0OFU0')]);
        Route::multilingual('weddings')->view('weddings',['products'=>\App\Models\Product::getProducts('0OBO0')]);
        Route::multilingual('birthdays')->view('birthdays',['products'=>\App\Models\Product::getProducts('0OCA0')]);
        Route::multilingual('about-us')->view('about');
        Route::multilingual('blog',[WebController::class,'blog']);
        Route::multilingual('shop')->view('blank',['title'=>'Shop']);
        Route::multilingual('my-account')->view('blank',['title'=>'Mi Cuenta']);

        Route::post('addonpayments', [WebController::class,'addonPayments']);
        Route::post('ca/addonpayments', [WebController::class,'addonPayments']);
        Route::post('es/addonpayments', [WebController::class,'addonPayments']);
        Route::post('en/addonpayments', [WebController::class,'addonPayments']);
        Route::post('commands', [WebController::class,'commands']);

        //Route::post('product', [WebController::class,'product']);

        Route::multilingual('login','App\Http\Controllers\Auth\LoginController@showLoginForm');
        Route::multilingual('login','App\Http\Controllers\Auth\LoginController@login')->method('post');
        Route::multilingual('logout','App\Http\Controllers\Auth\LoginController@logout')->method('post');

    Auth::routes();

        Route::get('empty_cart',[WebController::class,'emptyCart']);

        Route::get('test',[WebController::class,'test']);

        Route::get('{slug}',[WebController::class,'page']);
        Route::get('{lang}/{slug}',[WebController::class,'page_lang']);





        // });
//});