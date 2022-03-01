<section class="module-extra-small">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="module-title font-alt mb-2">
                    {{__('PROMOCIONES')}}
                </h2>
            </div>
        </div>
        <div class="row multi-columns-row">
            @foreach (\App\Models\Product::getPromotions('0R|0P') as $item)
            <x-shop-gallery-item :item="$item"/>
            @endforeach
        </div>
    </div>
</section>
