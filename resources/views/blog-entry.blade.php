<x-web solid title="{{$page->getSeoTitle()}}" description="{{$page->getSeoDescription()}}">
    <style>
        .icon-bubble:before {
            content: url('{{asset('images/chat.svg')}}');
            margin-right: 4px;
        }
    </style>
    <div class="main">
        <section class="module">
            <div class="container">
                <div class="row">
                    <div class="col-8">
                        <h1>{{$page->getName()}}</h1>
                        <div class="blog-entry-bottom mt-auto mb-3 post-meta text-uppercase">
                            <hr class="divider-w">
                            <div class="row">
                                <div class="blog-entry-comments col-6">
                                    <i class="icon-bubble"></i>{{__('Sin comentarios')}}
                                </div>
                                <div class="blog-entry-date col-6">
                                    <span class="float-right">{!! $page->getDate() !!}</span>
                                </div>
                            </div>
                        </div>
                        <div class="mb-2">
                            {!! $page->getDescription() !!}
                        </div>
                        {!! $page->getContent() !!}
                    </div>
                </div>
            </div>
        </section>
        <hr class="divider-d">
        @include('layouts.last-section')
    </div>
</x-web>