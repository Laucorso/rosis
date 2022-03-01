<x-admin icon="fa-edit" title="Icons">
<div class="row">
    @foreach( $icons as $icon )
    <div class="col-1 mb-2"><i class="fa fa-3x {{$icon}} text-primary" title="{{$icon}}"></i></div>
    @endforeach
</div>
</x-admin>