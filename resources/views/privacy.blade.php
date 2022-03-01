<x-web>
    <section class="module bg-dark-60" data-background="images/privacy_bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 offset-sm-3">
                    <h2 class="module-title font-alt mb-0">{{__('Política de Privacidad')}}</h2>
                </div>
            </div>
        </div>
    </section>
    <div class="main">
        <section class="module-small">
            <div class="container">
                <div class="entry clr" itemprop="text">
                    @include('layouts.lang.'.locale().'.privacy')
                </div>
            </div>
        </section>
    </div>
</x-web>