<?php
$menu = require(resource_path('menus/admin.php'));
?>
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="robots" content="noindex, nofollow"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>{{ config('app.name', 'Admin') }} - {{$title}}</title>
    <link rel="canonical" href="{{ config('app.url', 'https://admin.rosistirem.com') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{asset('images/favicon-192x192.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('images/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('images/favicon-96x96.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('images/favicon-32x32.png')}}">
    <!-- Styles -->
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    @stack('styles')
    {{--<script src="{{ asset('js/popper.min.js') }}"></script>--}}
</head>
<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="https://{{config('app.web_domain')}}">
                <div class="sidebar-brand-icon">
                    <img src="{{asset('images/favicon-32x32.png')}}" alt="icon">
                </div>
                <div class="sidebar-brand-text mx-3"><img src="{{asset('images/logo-light.png')}}" alt="logo"></div>
            </a>
            <hr class="sidebar-divider my-0">
            @foreach( $menu as $key => $value ) 
                @if( isset($value['icon']) ) 
                    @if( !isset($value['menu']) )
                    <li class="nav-item{{isset($value['href']) && secure_url($value['href']) == url()->current() ? ' active' : ''}}">
                        <a class="nav-link" href="{{secure_url($value['href'])}}">
                            <i class="fas fa-fw {{$value['icon']}}"></i><span>{{$key}}</span>
                        </a>
                    @else
                        <?php 
                            $active = false;
                            foreach ($value['menu'] as $key2 => $value2) {
                                if( !is_int($key2 ) && url()->current() == secure_url($value2) ) {
                                    $active = true;
                                }
                            }
                        ?>
                    <li class="nav-item{{$active ? ' active' : ''}}">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse{{Str::kebab($key)}}" aria-expanded="true" aria-controls="collapse{{Str::kebab($key)}}">
                            <i class="fas fa-fw {{$value['icon']}}"></i><span>{{$key}}</span>
                        </a>
                        <div id="collapse{{Str::kebab($key)}}" class="collapse{{$active ? ' show' : ''}}" aria-labelledby="heading{{Str::kebab($key)}}" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                            @foreach ($value['menu'] as $key2 => $value2 )
                                @if( is_int($key2) )
                                    <h6 class="collapse-header">{{$value2}}</h6>
                                @else
                                    <a class="collapse-item{{secure_url($value2) == url()->current() ? ' active' : ''}}" href="{{secure_url($value2)}}">{{$key2}}</a>
                                @endif                                   
                            @endforeach
                            </div>
                        </div>
                    @endif
                    </li>
                @else
                    @if( empty($value) )
                        <hr class="sidebar-divider my-0">
                    @else
                        <hr class="sidebar-divider">
                        <div class="sidebar-heading">{{$value}}</div>
                    @endif
                @endif
            @endforeach
            <hr class="sidebar-divider d-none d-md-block">
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <h3 id="admin-title"><i class="fas fa-fw {{$icon}}"></i> {{$title}} <div id="spinner" style="display:none;" class="spinner-border align-text-top ml-5" role="status"><span class="sr-only">Loading...</span></div></h3>
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><i class="fas fa-fw fa-user"></i> {{Auth::user()->name}}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#changePasswordModal">
                                    <i class="fas fa-lock fa-fw mr-2 text-gray-400"></i>
                                    Cambiar contraseña
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <div class="container-fluid">
                    @isset($message)
                        <div class="alert alert-{{$message[0]}} alert-dismissible fade show" role="alert">
                            @php echo $message[1]; @endphp
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                    @endisset
                    <form id="target" method="post" action="{{$action??'/'}}" enctype="multipart/form-data">
                        @csrf
                        {{$slot}}
                    </form>
                </div>
            </div>
            <footer class="sticky-footer bg-white py-2">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; {{date('Y')}} {{config('app.name')}} | Laravel v{{ Illuminate\Foundation\Application::VERSION }} | PHP v{{ PHP_VERSION }} | {{url()->current()}}</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <div class="page-loader">
		<div class="loader">Loading...</div>
	</div>
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Listo para Salir?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Seleccione "Logout" si quiere salir de esta sesión.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <form method="post" action="{{route('admin.logout')}}">
                        @csrf
                        <button type="submit" class="btn btn-primary">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changePasswordModalLabel">Desea cambiar su contraseña?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('admin.users')}}">
                        @csrf
                    <div class="row">
                        <div class="form-group col-sm-12">        
                            <label for="old_password">Contraseña Actual</label>
                            <input type="password" class="form-control form-control-sm" id="old_password" name="old_password" value="" required>
                        </div>
                        <div class="form-group col-sm-12">        
                            <label for="new_password">Nueva Contraseña</label>
                            <input type="password" class="form-control form-control-sm" id="new_password" name="new_password" value="" required>
                        </div>
                        <div class="form-group col-sm-12">        
                            <label for="new_password2">Repetir Contraseña</label>
                            <input type="password" class="form-control form-control-sm" id="new_password2" name="new_password2" value="" required>
                        </div>
                    </div>               
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="cmd" value="chgpsw">Cambiar</button>
                    </form>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/admin.js') }}"></script>
    @stack('scripts')
</body>
</html>
