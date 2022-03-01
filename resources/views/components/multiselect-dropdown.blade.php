<style>
    .btn-group {
        width: 100%;
    }
    .group {
        text-transform: uppercase;
        font-weight: 800;
        font-size: 0.65rem;
        color: #b7b9cc;
        margin-bottom: -0.5rem;
    }
</style>
<label for="product-categories">Categorias</label>
<select data-placeholder="Seleccionar categorias..." class="custom-select custom-select-sm" id="product-categories" name="product-categories" multiple="multiple">
    @foreach( config('rosistirem.categories') as $cat=>$sub )
    <optgroup label="{{$cat}}" class="group">
        @foreach( $sub as $key=>$val )
        <option value="{{$key}}">{{$val}}</option>
        @endforeach
    </optgroup>
    @endforeach
</select>
@push('scripts')
<script type="text/javascript">
    $('#product-categories').multiselect();
</script>
@endpush
