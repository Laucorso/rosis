<x-web>
    <section class="module bg-dark-30 vh-100" data-background="{{asset('images')}}/{{$image??'default.jpg'}}">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 offset-sm-3">
                    <h2 class="module-title font-alt mb-0">{{$title??'TITULO'}}</h2>
                </div>
            </div>
        </div>
    </section>
</x-web>