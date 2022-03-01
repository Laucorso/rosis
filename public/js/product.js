$('.flexslider').flexslider({
    animation: "slide",
    controlNav: "thumbnails"
});
$('.owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    dots: false,
    navText : ['<i class="fa fa-3x fa-caret-left" aria-hidden="true"></i>','<i class="fa fa-3x fa-caret-right" aria-hidden="true"></i>'],
    responsive:{
        0:{items:3},
        600:{items:3},
        1000:{items:4}
    }
});
$(".item").on("click", function (e) {
    let id = $(e.currentTarget).data('id');
    $('.item[data-id="'+id+'"]').toggleClass('selected');
    calc();
});
function calc() {
    var p  = Number($('#selected_price').text());
    p = p * $("input[name='qty']").val();
    var s = 0;
    $('#price').text(p.toFixed(2));
    var items = [];
    $('.item.selected').each(function() {
        console.log(this);
        if( $(this).parent().hasClass('cloned') ) {
            s += Number($(this).data('price'));
            items.push($(this).data('id'));
        }
    });
    $("input[name='items']").val(items.toString());
    $('#options_price').text(s.toFixed(2));
    s+=p;
    $('#total').text(s.toFixed(2));
}
function optionClick(e,t,p,i) {
    $("input[name='id']").val(i);
    $('#size_option .border').removeClass('selected');
    $(e.target).closest('.work-item').children().addClass('selected');
    $('#selected_option').text(t+' ');
    $('#selected_price').text(p.toFixed(2));
    calc();
}
calc();