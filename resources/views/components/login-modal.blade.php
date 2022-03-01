{{-- LOGIN MODAL --}}
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="ajax-form needs-validation" method="POST" action="{{ localized_route('login') }}" novalidate>
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title font-alt">{{__('Inicia sesión')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="login-error" class="row text-danger mb-3" style="display:none">
                        <div class="col">
                            {{__('Error no se ha podido acceder!')}}
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="email" placeholder="{{__('Correo electrónico')}}" required>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="{{_('Contraseña')}}" required>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="custom-control-label" for="remember">{{ __('Remember Me') }}</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-link" href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
                    <button type="submit" class="btn btn-b">{{__('Acceder')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@push('styles')
<style>
body.modal-open-noscroll
{
    margin-right: 0 !important;
    padding-right: 0 !important;
    overflow: hidden;
}
.modal-open-noscroll .fixed-top, .modal-open .fixed-bottom
{
    margin-right: 0!important;
    padding-right: 0 !important;
}
</style>
@endpush

@push('scripts')
<script>
    $('#loginModal').on('shown.bs.modal', function (event) {
        $("input[name=email]").focus();
    })
    $(document).ready(function () {
        $('.modal').on('show.bs.modal', function () {
            if ($(document).height() > $(window).height()) {
                $('body').addClass("modal-open-noscroll");
            } else {
                $('body').removeClass("modal-open-noscroll");
            }
        });
        $('.modal').on('hiden.bs.modal', function () {
            $('body').removeClass("modal-open-noscroll");
        });
        $('.ajax-form').on('submit',function(event) {
            if( this.checkValidity() !== false ) {
                $.post($(this).attr('action'),$(this).serialize(),function( data ){
                    window.location.reload()
                }).fail(function( data ){
                    $('#login-error').show();
                });
            }
            event.preventDefault();
            this.classList.add('was-validated');
        });
    })
</script>
@endpush