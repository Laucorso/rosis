<x-admin.modal icon='fa-user' title='Usuario' id="{{$user->id ?? 0}}">
    <div class="row">
        <input type="hidden" name="id" value="{{$user->id ?? 0}}">
        <div class="form-group col-sm-12">        
            <label for="name">Name</label>
            <input type="text" class="form-control form-control-sm" id="name" name="name" value="{{$user->name ?? ''}}" required autofocus>
        </div>
        <div class="form-group col-sm-12">        
            <label for="email">Email</label>
            <input type="text" class="form-control form-control-sm" id="email" name="email" value="{{$user->email ?? ''}}" required>
        </div>
        <div class="form-group col-sm-12">        
            <label for="password">Contraseña</label>
            <input type="password" class="form-control form-control-sm" id="password" name="password" value="">
        </div>
        <div class="form-group col-sm-12">        
            <label for="extension">Extensión</label>
            <input type="text" class="form-control form-control-sm" id="extension" name="extension" value="{{$user->extension ?? ''}}">
        </div>
        <div class="form-group col-sm-12">
            <label for="role">Rol</label>
            <select class="custom-select custom-select-sm" id="role" name="role" required>
                <option>Seleccionar rol...</option>
            @foreach( \App\Models\Admin::ROLES as $key => $value )
                <option value="{{$key}}">{{$value}}</option>
            @endforeach
            </select>
            <script>
                $('select[name^="role"] option[value="{{$user->role ?? ""}}"]').attr("selected","selected");
            </script>
        </div>
    </div>
</x-admin.modal>