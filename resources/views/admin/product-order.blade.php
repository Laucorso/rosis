<x-admin icon="fa-magic" title="Ordenar Productos" action="{{route('admin.product-order')}}">
    <input type="hidden" name="order" value="">
    <div class="card shadow">
        <div class="card-body">
            <div class="row commands">
                <div class="col-10">
                    <style type="text/css">
                        .multiselect-container,.multiselect-native-select .btn-group
                        {
                            width: 100%;
                        }
                    </style>
                    <select data-placeholder="Seleccionar categorias..." class="custom-select custom-select-sm w-100" id="product_categories" name="product_categories[]" multiple="multiple">
                        @foreach( config('rosistirem.categories') as $cat=>$sub )
                        <optgroup label="{{$cat}}" class="group">
                            @foreach( $sub as $key=>$val )
                            <option value="0{{$key}}0">{{$val}}</option>
                            @endforeach
                        </optgroup>
                        @endforeach
                    </select>
                </div>
                <div class="col-2">
                    <button class="btn btn-sm btn-outline-primary w-100" name="cmd" value="order">ORDENAR PRODUCTOS</button>
                </div>
            </div>
            <div class="row commands mb-2" style="display:none;">
                <div class="col-6">
                    <button class="btn btn-sm btn-outline-danger w-100" name="cmd" value="cancel">CANCELAR</button>
                </div>
                <div class="col-6">
                    <button class="btn btn-sm btn-success w-100" name="cmd" value="save">GUARDAR ORDEN</button>
                </div>
            </div>
            <style>
           		#dragDrop { width: 100%; margin: 0 auto 0; position: relative; }
                .dd-vc { position: relative; top: 50%; transform: translateY(-50%); }
                .dd-transition { transition: all 0.3s ease; }
                .dd-shadow { box-shadow: 0 0 3px 1px rgba(0,0,0,0.3); }        
                .dd-slot { float: left; outline: 2px dashed rgba(54, 86, 132, 0.75); outline-offset: -15px; position: relative; pointer-events: none; }
                .dd-slot-num { text-align: center; color: rgba(0,0,0,0.1); font-size: 40px; position: absolute; width: 100%; }
                .dd-item { position: absolute; left: 0; top: 0; box-sizing: border-box; padding: 10px; cursor: grab; }
                .dd-item.dd-disabled { pointer-events: none; opacity: 0; }
                .dd-item.dd-selected { z-index: 20; cursor:grabbing }
                .dd-item-inner { background-repeat: no-repeat; background-size: cover; background-position: center; width: 100%; height: 100%; position: relative; }
                .dd-item-panel { width: 80%; height: 35px; background: #fff; position: absolute; left: 10%; bottom: -15px; z-index: 5; }
                .dd-item-title { font-size: 12px; color: #365684; text-align: center; line-height: 35px; text-transform:uppercase; display:-webkit-box;-webkit-line-clamp:1; -webkit-box-orient:vertical; overflow:hidden; }
            </style>
            <div id="dragDrop"></div>
        </div>
    </div>
@push('scripts')
<script>
    $('#product_categories').multiselect({
        numberDisplayed: 10,
        enableCollapsibleOptGroups: true,
        enableClickableOptGroups: true
    });
    $('#target').on('submit', function (event){
        $('.commands').toggle();
        event.preventDefault();
        event.stopPropagation();
        $('input[name=order]').val(_listedImageIds);
        let data = $(this).serializeArray();
        data.push( { "name":event.originalEvent.submitter.name,"value":event.originalEvent.submitter.value} );
        $.post( $('#target').attr('action'),data,function( response, status, xhr ) {
            //$("#product_categories").multiselect('clearSelection');
            _numOfImageSlots = response.length;
            _imageLibrary = [], _listedImageIds = [];
            _imageSlots = [], _selectedImageElement = null, _originalImageSlot = null, _originalClickCoords = null, _lastTouchedSlotId = null;
            $('#dragDrop').html('');
            response.forEach(function(item, index){
                _imageLibrary.push({id:item.id,image:item.image,title:item.title});
                _listedImageIds.push(item.id);
            });
            init();
        });
    });

    var _doc = window.document;
    var _numOfImageSlots = 12,_numOfImagesPerRow = 8,_imageMarginBottom = 30;
    var _imageAspectWidth = 4,_imageAspectHeight = 5;
    var _imageSlots = [],_selectedImageElement = null,_originalImageSlot = null,_originalClickCoords = null,_lastTouchedSlotId = null;
    var _imageLibrary = [], _listedImageIds = [];

    function init() {
        addImageSlots();
        drawImages();
        _doc.getElementById('dragDrop').addEventListener('mousemove', imageMousemove);
    }
    function addImageSlots() {
        var i = 0,len = _numOfImageSlots,item;
        var wrap = _doc.getElementById('dragDrop');
        for( ; i < len; i++ ) {
            item = _doc.createElement('div');
            item.setAttribute('class', 'dd-slot');
            item.setAttribute('style', 'width:' + ( 100 / _numOfImagesPerRow ) + '%;padding-bottom:' + ( ( 100 / _numOfImagesPerRow ) * ( _imageAspectHeight / _imageAspectWidth ) ) + '%;margin-bottom:' + _imageMarginBottom + 'px;');
            item.innerHTML = '<p class="dd-slot-num dd-vc">' + ( i + 1 ) + '</p>';
            wrap.appendChild(item);
        }
    }
    function drawImages() {
        var i = 0,len = _numOfImageSlots,item;
        var wrap = _doc.getElementById('dragDrop');
        var slot = _doc.getElementsByClassName('dd-slot')[0],bounds = slot.getBoundingClientRect(),itemWidth = bounds.width,itemHeight = bounds.height;
        var itemX,itemY;
        var imageId,image;
        for( ; i < len; i++ ) {
            imageId = _listedImageIds[i] || -1;
            image = getImageById( imageId );
            itemX = ( i % _numOfImagesPerRow ) * itemWidth;
            itemY = Math.floor( i / _numOfImagesPerRow ) * ( itemHeight + _imageMarginBottom );
            item = _doc.createElement('div');
            item.setAttribute('class', 'dd-item dd-transition' + ( imageId < 0 ? ' dd-disabled' : '' ));
            item.setAttribute('data-image-id', imageId);
            item.setAttribute('style', 'width:' + itemWidth + 'px;height:' + itemHeight + 'px;transform:translate3d(' + itemX + 'px,' + itemY + 'px,0);' );
            item.innerHTML = '<div class="dd-item-inner dd-shadow" style="' + ( image ? ( 'background-image:url(resources/' + image.image + ')' ) : '' ) + '"><div class="dd-item-panel dd-shadow"><h3 class="dd-item-title">' + ( image ? image.title : '' ) + '</h3></div></div>';
            wrap.appendChild(item);
            item.addEventListener('mousedown', imageMousedown);
            item.addEventListener('mouseup', imageMouseup);
            _imageSlots[i] = { width: itemWidth, height: itemHeight, x: itemX, y: itemY };
        }
    }
    function arrangeItems() {
        var i = 0, len = _listedImageIds.length, slot, ele;
        for( ; i < len; i++ ) {
            slot = _imageSlots[i];
            ele = _doc.querySelector('[data-image-id="' + _listedImageIds[i] + '"]');
            ele.style.transform = 'translate3d(' + slot.x + 'px,' + slot.y + 'px,0)';
        }
    }
    function imageMousedown( event ) {
        if( !_selectedImageElement ) {
            _selectedImageElement = event.currentTarget;
            _originalClickCoords = { x: event.pageX, y: event.pageY };
            _originalImageSlot = getIndexOfImageId( _selectedImageElement.getAttribute('data-image-id') );
            _selectedImageElement.classList.add('dd-selected');
            _selectedImageElement.classList.remove('dd-transition');
        }
    }
    function imageMousemove( event ) {
        if( _selectedImageElement ) {
            var wrap = _doc.getElementById('dragDrop'), bounds = wrap.getBoundingClientRect(), left = bounds.left, top = bounds.top;
            var pageX = event.pageX, pageY = event.pageY;
            var clickX = pageX - left, clickY = pageY - top, hoverSlotId = getSlotIdByCoords( { x: clickX, y: clickY } );
            var ele = _selectedImageElement, imageId = ele.getAttribute('data-image-id'), index = _originalImageSlot, newIndex = getIndexOfImageId( imageId ), x = _imageSlots[index].x, y = _imageSlots[index].y;
            var resultX = x + ( pageX - _originalClickCoords.x ), resultY = y + ( pageY - _originalClickCoords.y );
            if( hoverSlotId != undefined && _lastTouchedSlotId != hoverSlotId ) {
                _lastTouchedSlotId = hoverSlotId;
                _listedImageIds.splice( hoverSlotId, 0, _listedImageIds.splice( newIndex, 1 )[0] );
                arrangeItems();
            }
            ele.style.transform = 'translate3d(' + resultX + 'px,' + resultY + 'px,0)';
        }
    }
    function imageMouseup() {
        _selectedImageElement.classList.remove('dd-selected');
        _selectedImageElement.classList.add('dd-transition');
        _selectedImageElement = null;
        _originalClickCoords = null;
        arrangeItems();
    }
    function getSlotIdByCoords( coords ) {
        // Get the current slot being hovered over
        for( var id in _imageSlots ) {
            var slot = _imageSlots[id];
            if( slot.x <= coords.x && coords.x <= slot.x + slot.width && slot.y <= coords.y && coords.y <= slot.y + slot.height )
                return id;
        }
    }
    function getImageById( id ) {
        return _imageLibrary.find(function (image) {
            return image.id == id;
        });
    }
    function getIndexOfImageId( id ) {
        var i = 0, len = _listedImageIds.length;
        for( ; i < len; i++ )
            if ( _listedImageIds[i] == id )
                return i;
    }
    //init();
</script>
@endpush
</x-admin>