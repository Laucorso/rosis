<div class="card shadow mb-4">
    <input type="hidden" name="id" value="{{$web_page->id ?? 0}}">
    <div class="card-body">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true"><i class="fa fa-book"></i> General</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="content-es-tab" data-toggle="tab" href="#content-es" role="tab" aria-controls="content-es" aria-selected="true"><img width="18" src="{{asset('images/es.svg')}}"> Contenido</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="content-ca-tab" data-toggle="tab" href="#content-ca" role="tab" aria-controls="content-ca" aria-selected="true"><img width="18" src="{{asset('images/ca.svg')}}"> Contingut</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="content-en-tab" data-toggle="tab" href="#content-en" role="tab" aria-controls="content-en" aria-selected="true"><img width="18" src="{{asset('images/en.svg')}}"> Content</a>
            </li>
        </ul>
        <div class="tab-content border border-top-0 rounded-bottom small bg-white">
            {{-- GENERAL --}}
            <div class="p-4 tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
                <div class="row justify-content-end">
                    <div class="custom-control custom-switch mr-3">
                        <input type="checkbox" name="active" class="custom-control-input" id="activeSwitch" {{$web_page->active?'checked':''}}>
                        <label class="custom-control-label" for="activeSwitch">activa</label>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-2">
                        <label class="form-label-sm">Tipo</label>
                        <select class="custom-select custom-select-sm" name="type">
                            <option>Seleccionar tipo...</option>
                            <option value="generic"{{$web_page->type=='generic'?' selected':''}}>Genérica</option>
                            <option value="simple"{{$web_page->type=='simple'?' selected':''}}>Simple</option>
                            <option value="blog"{{$web_page->type=='blog'?' selected':''}}>Entrada Blog</option>
                            <option value="care"{{$web_page->type=='care'?' selected':''}}>Entrada Cuidados</option>
                        </select>
                    </div>
                    <div class="form-group col-sm-4">
                        <label class="form-label-sm">Categorias separadas por |</label>
                        <input type="text" class="form-control form-control-sm" name="categories" value="{{$web_page->categories??''}}">
                    </div>
                    <div class="form-group col-sm-6">
                        <label class="form-label-sm">Tags separadas por |</label>
                        <input type="text" class="form-control form-control-sm" name="tags" value="{{$web_page->tags??''}}">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-12 col-md-4">
                        <label>Imagen</label>
                        <div id="header-image">
                            @if( $web_page->header_image )
                                <img src="{{$web_page->header_image}}">
                            @endif
                        </div>
                    </div>                                
                </div>
                <div class="row">
                    <div class="form-group col-4">
                        <label>SEO Titulo (máx. 60)</label>
                        <div class="input-group input-group-sm mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><img width="24" src="{{asset('images/es.svg')}}"></div>
                            </div>
                            <input type="text" class="form-control" name="seo_title_es" maxlength="60" value="{{$web_page->seo_title_es}}">
                        </div>
                        <div class="input-group input-group-sm mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><img width="24" src="{{asset('images/ca.svg')}}"></div>
                            </div>
                            <input type="text" class="form-control" name="seo_title_ca" maxlength="60" value="{{$web_page->seo_title_ca}}">
                        </div>
                        <div class="input-group input-group-sm mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><img width="24" src="{{asset('images/en.svg')}}"></div>
                            </div>
                            <input type="text" class="form-control" name="seo_title_en" maxlength="60" value="{{$web_page->seo_title_en}}">
                        </div>
                    </div>
                    <div class="form-group col-8">
                        <label>SEO Descripción (máx. 160)</label>
                        <div class="input-group input-group-sm mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><img width="24" src="{{asset('images/es.svg')}}"></div>
                            </div>
                            <input type="text" class="form-control" name="seo_description_es" maxlength="160" value="{{$web_page->seo_description_es}}">
                        </div>
                        <div class="input-group input-group-sm mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><img width="24" src="{{asset('images/ca.svg')}}"></div>
                            </div>
                            <input type="text" class="form-control" name="seo_description_ca" maxlength="160" value="{{$web_page->seo_description_ca}}">
                        </div>
                        <div class="input-group input-group-sm mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><img width="24" src="{{asset('images/en.svg')}}"></div>
                            </div>
                            <input type="text" class="form-control" name="seo_description_en" maxlength="160" value="{{$web_page->seo_description_en}}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label>Nombre</label>
                            <div class="input-group input-group-sm mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><img width="24" src="{{asset('images/es.svg')}}"></div>
                                </div>
                                <input type="text" class="form-control" name="name_es" value="{{$web_page->name_es??''}}">
                            </div>
                            <div class="input-group input-group-sm mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><img width="24" src="{{asset('images/ca.svg')}}"></div>
                                </div>
                                <input type="text" class="form-control" name="name_ca" value="{{$web_page->name_ca??''}}">
                            </div>
                            <div class="input-group input-group-sm mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><img width="24" src="{{asset('images/en.svg')}}"></div>
                                </div>
                                <input type="text" class="form-control" name="name_en" value="{{$web_page->name_en??''}}">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Slug <i class="small">si se deja en blanco se genera automaticamente a partir del nombre</i></label>
                            <div class="input-group input-group-sm mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><img width="24" src="{{asset('images/es.svg')}}"></div>
                                </div>
                                <input type="text" class="form-control" name="slug_es" value="{{$web_page->es_slug??''}}">
                            </div>
                            <div class="input-group input-group-sm mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><img width="24" src="{{asset('images/ca.svg')}}"></div>
                                </div>
                                <input type="text" class="form-control" name="slug_ca" value="{{$web_page->ca_slug??''}}">
                            </div>
                            <div class="input-group input-group-sm mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><img width="24" src="{{asset('images/en.svg')}}"></div>
                                </div>
                                <input type="text" class="form-control" name="slug_en" value="{{$web_page->en_slug??''}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name">Descripción</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><img width="24" src="{{asset('images/es.svg')}}"></span>
                        </div>
                        <textarea class="form-control form-control-sm" name="description_es">{{$web_page->description_es}}</textarea>
                    </div>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><img width="24" src="{{asset('images/ca.svg')}}"></span>
                        </div>
                        <textarea class="form-control form-control-sm" name="description_ca">{{$web_page->description_ca}}</textarea>
                    </div>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><img width="24" src="{{asset('images/en.svg')}}"></span>
                        </div>
                        <textarea class="form-control form-control-sm" name="description_en">{{$web_page->description_en}}</textarea>
                    </div>
                </div>
            </div>
            {{-- CONTENIDO --}}
            <div class="tab-pane fade" id="content-es" role="tabpanel" aria-labelledby="content-es-tab">
                <textarea id="content-es-html" name="content_es">{{$web_page->content_es}}</textarea>
            </div>
            <div class="tab-pane fade" id="content-ca" role="tabpanel" aria-labelledby="content-ca-tab">
                <textarea id="content-ca-html" name="content_ca">{{$web_page->content_ca}}</textarea>
            </div>
            <div class="tab-pane fade" id="content-en" role="tabpanel" aria-labelledby="content-en-tab">
                <textarea id="content-en-html" name="content_en">{{$web_page->content_en}}</textarea>
            </div>
        </div>
        <div class="row justify-content-end mt-2">
            <div class="col-auto">
                <button class="btn btn-sm btn-primary" name="cmd" value="save">{{$web_page->id ? 'Guardar Cambios' : 'Añadir Página'}}</button>
            </div>
            <div class="col-auto">
                <button class="btn btn-sm btn-success" name="cmd" value="preview">Previsualizar</button>
            </div>
        </div>
    </div>
</div>            
<script>
    $('input[name=name_es]').focus();
    new XMMDropbox('header-image',{extensions:['webp','gif','png','jpg','svg'],preview:true})
    /*
    const buttonList = [
        ['undo', 'redo'],
        ['formatBlock'],
        ['bold', 'underline', 'italic', 'strike', 'subscript', 'superscript'],
        ['removeFormat'],
        ['outdent', 'indent'],
        ['align'],
        ['table', 'link', 'image', 'video'],
        ['imageGallery'],
        ['fullScreen', 'showBlocks', 'codeView'],
        ['preview'],
        ['template']
    ];
    const templates = [
        {
            name: 'Template-1',
            html: '<p>HTML source1</p>'
        },
        {
            name: 'Template-2',
            html: '<p>HTML source2</p>'
        }
    ];

    const editorEs = SUNEDITOR.create('content-es-html',{
        imageGalleryUrl: 'https://admin.risistirem.com/gallery',
        templates: templates,
        buttonList: buttonList
    });
    const editorCa = SUNEDITOR.create('content-ca-html',{
        imageGalleryUrl: 'https://admin.risistirem.com/gallery',
        templates: templates,
        buttonList: buttonList
    });
    const editorEn = SUNEDITOR.create('content-en-html',{
        imageGalleryUrl: 'https://admin.risistirem.com/gallery',
        templates: templates,
        buttonList: buttonList
    });
    $('#target').on('submit',function (event){
        editorEs.save();
        editorCa.save();
        editorEn.save();
    });
    */
    tinymce.init({
        selector: '#content-es-html',
        plugins: ['image','emoticons'],
        height: 800
    });
    tinymce.init({
        selector: '#content-ca-html',
    });
    tinymce.init({
        selector: '#content-en-html',
    });
</script>
