@push('styles')
<link href="{{ asset('css/product.css') }}" rel="stylesheet">
@endpush
@push('scripts')
<script src="{{asset('js/product.js')}}"></script>
@endpush        
<x-web solid>
    <div class="main">
        <section class="module-small mt-5">
        <form method="POST" action="{{localized_route('pay')}}">
            @csrf
            <input type="hidden" name="data" value="{{$jsonData}}">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 offset-sm-3">
                        <h1 class="module-title font-alt mb-2">{{__('Cart')}}</h1>
                    </div>
                </div>
                <hr class="divider-w pt-5">
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-striped checkout-table table-borderless">
                            <tbody>
                                <tr>
                                    <th class="d-none d-md-table-cell"></th>
                                    <th>{{__('Product')}}</th>
                                    <th class="d-none d-md-table-cell text-right">{{__('Price')}}</th>
                                    <th class="text-center">{{__('Quantity')}}</th>
                                    <th class="text-right">{{__('Subtotal')}}</th>
                                    <th class="text-center">{{__('Remove')}}</th>
                                </tr>
                                @php $subtotal = 0; @endphp
                                @foreach( $items as $item )
                                @php $subtotal += $item['qty']*$item['price']; @endphp                                
                                <tr class="cart-item" data-sku="{{$item['sku']}}" data-id="{{$item['id']}}">
                                    <td class="d-none d-md-table-cell"><a href="#"><img src="{{asset('resources/'.$item['image'])}}" alt=" {{__('Image for')}} {{$item['name']}}"/></a></td>
                                    <td class="align-middle">
                                        <h5 class="name product-title font-alt m-0">{{$item['name']}}</h5>
                                    </td>
                                    <td class="d-none d-md-table-cell align-middle">
                                        <h5 class="product-title font-alt text-right price m-0"><span class="item-price">{{number_format($item['price'],2)}}</span> €</h5>
                                    </td>
                                    <td class="align-middle">
                                        <div class="def-number-input number-input safari_only mx-auto">
                                            <button onclick="event.preventDefault();this.parentNode.querySelector('input[type=number]').stepDown();calcCart()" class="minus"></button>
                                            <input class="quantity item-qty bg-transparent" min="0" value="{{$item['qty']}}" type="number" onchange="calcCart()">
                                            <button onclick="event.preventDefault();this.parentNode.querySelector('input[type=number]').stepUp();calcCart()" class="plus"></button>
                                        </div>          
                                    </td>
                                    <td class="align-middle">
                                        <h5 class="product-title font-alt text-right price item-total m-0">{{number_format($item['qty']*$item['price'],2)}} €</h5>
                                    </td>
                                    <td class="pr-remove align-middle"><a href="#" title="Remove" onclick="removeRow(event)"><i class="fa fa-times"></i></a></td>
                                </tr>
                                @endforeach
                                <tr class="cart-itsem" data-sku="DT-001" data-id="1">
                                    <td class="d-none d-md-table-cell"><a href="#"><img src="{{asset('images/dedicatoria.jpg')}}" alt="Men’s Casual Pack"/></a></td>
                                    <td colspan="3" class="d-none d-md-table-cell align-middle">
                                        <h5 class="product-title font-alt m-0">{{__('Dedication')}}</h5>
                                        <input id="dedication" type="text" class="form-control" name="dedication" value="{{session('dedication')}}" placeholder="{{__('Write something')}}" oninput="calcCart()" style="text-transform:none;">
                                    </td>
                                    <td class="align-middle">
                                        <h5 id="dedication-price" class="product-title font-alt text-right price item-total m-0">0 €</h5>
                                    </td>
                                    <td class="pr-remove align-middle"><a href="#" title="Remove" onclick="removeRow(event)"><i class="fa fa-times"></i></a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                {{--
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <input class="form-control" type="text" id="coupon" name="coupon" placeholder="{{__('Coupon Code')}}" oninput="inputCoupon()">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <button id="coupon_button" class="btn btn-round btn-g" onclick="applyCoupon(event)" disabled>{{__('Apply Coupon')}}<span class="spinner spinner-border spinner-border-sm ml-2" style="display:none;" role="status" aria-hidden="true"></span></button>
                        </div>
                    </div>
                </div>
                --}}
                <hr class="divider-w">
                <div class="row mt-70">
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-12">
                                <h5 class="font-alt">{{__('Add Complements')}}</h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 mb-20">
                                <div class="owl-carousel">
                                @foreach( $complements as $complement )
                                    <div class="item" data-price="{{$complement['prices'][0]}}" data-id="{{$complement['id']}}">
                                        <img src="{{asset('resources/'.$complement['image'])}}"/>
                                        <div class="text">{{$complement['name-'.locale()]}}</div>
                                        <div class="price">{{number_format($complement['prices'][0],2)}}</div>
                                    </div>
                                @endforeach
                                </div>
                            </div>
                        </div>    
                    </div>
                    <div class="col-sm-5 offset-sm-1">
                        <div class="shop-Cart-totalbox">
                            <h4 class="font-alt">{{__('Cart Total')}}</h4>
                            <table id="totals" class="table table-border checkout-table">
                                <tbody>
                                    <tr>
                                        <th>{{__('Products')}} :</th>
                                        <td id="products" class="text-right price">{{$subtotal}} €</td>
                                    </tr>
                                    <tr id="complements">
                                        <th>{{__('Complements')}} :</th>
                                        <td class="text-right price">0.00 €</td>
                                    </tr>
                                    <tr id="discount">
                                        <th>{{__('Discount')}} :</th>
                                        <td class="text-right price">0.00 €</td>
                                    </tr>
                                    <tr>
                                        <th>{{__('Total')}} :</th>
                                        <td id="total" class="text-right price">{{$subtotal}} €</td>
                                    </tr>
                                </tbody>
                            </table>
                            <a id="end_payment" class="btn btn-lg btn-block btn-round btn-d" href="{{localized_route('pay')}}">{{__('End purchase')}}<br><span></span></a>
                        </div>
                    </div>
                </div>
            </div>
            @push('scripts')
            <script>
                const coupon = {type:'none',value:0};
                const cartData = JSON.parse($("input[name=data]").val());

                function removeRow( e ) {
                    let id = $(e.target).closest('tr').data('id');
                    $(e.target).closest("tr").remove();
                    $.post('commands',{_token:"{{csrf_token()}}",cmd:"deleteCartItem",cartId:id});
                    calcCart();
                }
                function calcCart() {
                    let v=0,t=0,d=0,c=0;
                    let comps = [];
                    let items = [];
                    $(".cart-item").each(function(index){
                        items.push({
                            id:this.getAttribute('data-id'),
                            sku:this.getAttribute('data-sku'),
                            qty:Number($(this).find('.item-qty').val()),
                            name:$(this).find('.name').text()
                        });
                        let s = Number($(this).find(".item-price").text()) * Number($(this).find(".item-qty").val());
                        $(this).find(".item-total").text(s.toFixed(2)+' €');
                        v += s;
                    });
                    cartData.items = items;
                    cartData.dedication = $("#dedication").val();
                    if( $("#dedication").length > 0 && $("#dedication").val() != '' ) {
                        $("#dedication-price").text('4.90 €');
                        v += 4.9;
                    } else {
                        $("#dedication-price").text('0 €');
                    }
                    $(".item.selected").each(function(index){
                        c += Number(this.getAttribute('data-price'));
                        comps.push({
                            id:this.getAttribute('data-id'),
                            name:$(this).find('.text').text(),
                            price:Number(this.getAttribute('data-price'))
                        });
                    });
                    cartData.complements = comps;
                    $("#products").text(v.toFixed(2)+' €');                    
                    $("#complements .price").text(c.toFixed(2)+' €');
                    if( c == 0 )
                        $('#complements').hide();
                    else
                        $('#complements').show();

                    if( coupon.type == 'percentage' ) {
                        d = ((v+c) * coupon.value)/100;
                    }
                    if( coupon.type == 'fixed' ) {
                        d = coupon.value;
                    }
                    t = v + c - d;
                    $("#discount .price").text(d.toFixed(2)+' €');                        
                    if( d == 0 )
                        $('#discount').hide();
                    else
                        $('#discount').show();
                    $("#total").text(t.toFixed(2)+' €');
                    $("#end_payment span").text(t.toFixed(2)+' €');
                    console.log(cartData);
                    $("input[name=data]").val(JSON.stringify(cartData));
                }
                function applyCoupon(e) {
                    e.preventDefault();
                    var coupon_value = $("#coupon").val();
                    if( coupon_value != '' ) {
                        $(".spinner").show();
                        $.post("{{localized_route('pay')}}",{ _token:"{{csrf_token()}}",cmd:"coupon",coupon:coupon_value}, function( data ) {
                            if( data.status == 'valid' ) {
                                coupon.type = data.type;
                                coupon.value = data.value;
                                cartData.coupon = coupon_value;
                                calcCart();
                            } 
                            if( data.status == 'needs-login' ) {
                                $('#loginModal').modal('toggle')
                            }
                            $(".spinner").hide();
                        });
                    }
                }
                function inputCoupon() {
                    if( $('#coupon').val().length < 5 )
                        $('#coupon_button').attr('disabled',true);
                    else
                        $('#coupon_button').removeAttr('disabled');
                }
                $(".item").on("click", function (e) {
                    calcCart();
                });
                calcCart();
            </script>
            @endpush
        </form>
        </section>
        <hr class="divider-d">
        @include('layouts.last-section')
    </div>
    <x-login-modal/>
</x-web>