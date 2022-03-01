<x-admin icon="fa-tachometer-alt" title="Panel de Control" action="dashboard" :message="isset($message) ? $message : null">
    <div id="ordersTable" class="row">
    @include('admin.order-cards')
    </div>
    <div id="orderData" class="card shadow mb-4" style="display:none"></div>
@push('scripts')
    <script>
    $('[data-toggle="tooltip"]').tooltip();
    function orderClicked(id) {
        $('.page-loader').show();
        $('#orderData').load("{{route('admin.orders')}}",{_token:"{{csrf_token()}}",cmd:"get",id:id},function(){
            $('.page-loader').hide();
            $('#ordersTable').hide();
            $('#orderData').show();
        });
    }
    function postSet(id,field,data) {
        $('.page-loader').show();
        $('#ordersTable').load("{{route('admin.orders')}}",{_token:"{{csrf_token()}}",cmd:"set",id:id,field:field,data:data},function(){
            $('.page-loader').hide();
        });
    }
    function callPhone(number,name) {
        console.log(number,name);
        $.post('commands',{_token:"{{csrf_token()}}",cmd:"call",number:number,name:name});
    }
    </script>
@endpush

</x-admin>