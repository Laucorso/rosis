<x-web solid>
    <div class="main">
        <section class="module-small">
            <div class="container">
                <div class="row">
                    <style>
                        .icon-bubble:before {
                            content: url('{{asset('images/chat.svg')}}');
                            margin-right: 4px;
                        }
                        .blog-entry-summary p {
                            display: -webkit-box;
                            -webkit-line-clamp: 7;
                            -webkit-box-orient: vertical;
                            overflow: hidden;
                        }
                    </style>
{{-- COLUMNA IZQUIERTA--}}
                    <div class="col-sm-9 border-right">
                        @foreach( $entries as $entry )
                        <div class="row">
                            <div class="col-md-5">
                                <img width="1000" height="1000" src="{{$entry->header_image}}">
                            </div>
                            <div class="col-md-7">
                                <div class="d-flex flex-column h-100">
                                    <div class="blog-entry-category font-alt">
                                        <a href="#">BLOG</a> / <a href="#">Plantas</a>
                                    </div>                               
                                    <div class="blog-entry-header mt-3">
                                        <h2 class="blog-entry-title"><a href="{{$entry->getSlug()}}">{{$entry->getName()}}</a></h2>
                                    </div>
                                    <div class="blog-entry-summary">
                                        <p>{!!$entry->getDescription()!!}</p>
                                    </div>                                                               
                                    <div class="blog-entry-bottom mt-auto mb-3 post-meta text-uppercase">
                                        <hr class="divider-w">
                                        <div class="row">
                                            <div class="blog-entry-comments col-6">
                                                <i class="icon-bubble"></i>{{__('Sin comentarios')}}
                                            </div>
                                            <div class="blog-entry-date col-6">
                                                <span class="float-right">{{$entry->getDate()}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if( !$loop->last )
                            <hr class="divider-w my-4">
                        @endif
                        @endforeach
                    </div>
{{-- COLUMNA DERECHA--}}
                    <div class="col-sm-3">
                        <div class="row">
                            <div class="col-sm-12 p-0">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <hr class="divider-d">
        @include('layouts.last-section')
    
    </div>
</x-web>