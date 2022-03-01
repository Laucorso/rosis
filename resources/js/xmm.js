class XMMDropbox {
    constructor( id,options=null ) {
        this.options = {};
        var defaults = {
            mode: null,
            extensions: ['jpg','jpeg','svg','gif','png','bmp','webp'],
            text: 'Suelta el archivo aquí o haz clic para navegar ...',
            name: id,
            preview: true,
            thumbs: false,
            multiple: false,
            height: '100px',
            icons: [
                '<svg class="add" xmlns="http://www.w3.org/2000/svg" viewBox="-1 -1 22 22"><path d="M11 9h4v2h-4v4H9v-4H5V9h4V5h2v4zm-1 11a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16z"/></svg>',
                '<svg class="delete" xmlns="http://www.w3.org/2000/svg" viewBox="-1 -1 22 22"><path d="M6 2l2-2h4l2 2h4v2H2V2h4zM3 6h14l-1 14H4L3 6zm5 2v10h1V8H8zm3 0v10h1V8h-1z"/></svg>',
                '<svg class="left" xmlns="http://www.w3.org/2000/svg" viewBox="-1 -1 22 22"><path d="M0 10a10 10 0 1 1 20 0 10 10 0 0 1-20 0zm2 0a8 8 0 1 0 16 0 8 8 0 0 0-16 0zm8-2h5v4h-5v3l-5-5 5-5v3z"/></svg>',
                '<svg class="right" xmlns="http://www.w3.org/2000/svg" viewBox="-1 -1 22 22"><path d="M20 10a10 10 0 1 1-20 0 10 10 0 0 1 20 0zm-2 0a8 8 0 1 0-16 0 8 8 0 0 0 16 0zm-8 2H5V8h5V5l5 5-5 5v-3z"/></svg>',
            ],
        };
        for( var property in defaults ) {
            this.options[property] = (options && options.hasOwnProperty(property)) ? options[property] : defaults[property];
        }
        this.container = typeof(id) == 'string' ? document.getElementById(id) : id;
        if( !this.options.mode && (this.container.tagName == 'A' || this.container.tagName == 'BUTTON') ) {
            this.options.mode = 'button';
            this.options.preview = false;
            this.dropbox = this.container;
            this.container = this.dropbox.parentNode;
        } else {
            this.dropbox = document.getElementById(id+'_dropbox');
        }
        if( !this.dropbox ) {
            this.dropbox = document.createElement('div');
            this.dropbox.classList.add('xmmdropbox');
            if( this.options.multiple )
                this.dropbox.classList.add('multi');
            if( this.options.text && !this.options.multiple ) 
                this.dropbox.innerHTML = '<p class="xmmdropbox_text">'+this.options.text+'</p>';
            if( this.options.multiple )
                this.dropbox.style.height = this.options.height;
			if( this.options.preview )
				this.dropbox.classList.add('preview');
            if( this.container.tagName == 'DIV' && !this.options.multiple && this.options.preview ) {
                if( this.container.children.length > 0 ) {
                    this.dropbox.innerHTML = '';
                    this.container.children[0].classList.add('xmmdropbox_image');
                    this.dropbox.appendChild(this.container.children[0]);
                }
            }
            this.container.appendChild( this.dropbox );
        }
        this.input = document.getElementById(id+'_input');
        if( !this.input ) {
            this.input = document.createElement('input');
            this.input.setAttribute('type','file');
            if( this.options.extensions ) {
                let exts = '';
                for( let n = 0; n < this.options.extensions.length; n++ )
                    exts +='.'+this.options.extensions[n]+',';
                this.input.setAttribute('accept',exts);
            }
            this.input.style.display = 'none';
            if( this.options.multiple )
                this.input.setAttribute('multiple',true);
            else
                this.input.setAttribute('name',this.options.name);
            this.container.appendChild( this.input );
        }
        if( this.options.multiple ) {
            this.inputData = document.createElement('input');
            this.inputData.setAttribute('name',this.options.name);
            this.inputData.setAttribute('type','hidden');
            this.container.appendChild( this.inputData );
        }

        this.button = document.getElementById(id+'_button');
        this.dropbox.addEventListener("click", function (e) {
            if( this.options.multiple ) {
                if( e.target.classList.contains('xmmdropbox') ) {
                    this.input.click();
                } else {
                    let dad = e.target.closest('.xmmdropbox-icon');
                    if( dad ) {
                        if( dad.classList.contains('add') )
                            this.input.click();
                        let item = dad.closest('.xmmdropbox-image');
                        if( item && dad.classList.contains('delete') ) {
                            item.parentNode.removeChild(item);
                        }
                        if( item && dad.classList.contains('left') ) {
                            let prev = item.previousSibling;
                            if( prev ) {
                                this.dropbox.insertBefore(item,prev);
                            }
                        }
                        if( item && dad.classList.contains('right') ) {
                            let next = item.nextSibling.nextSibling;
                            this.dropbox.insertBefore(item,next);
                        }
                    }
                }  
                this.arrangeIcons();
            } else {
                this.input.click();
            }
            e.preventDefault();
        }.bind(this), false);
        this.dropbox.addEventListener("dragenter", function (e) {
            e.stopPropagation();
            e.preventDefault();    
        }.bind(this), false);
        this.dropbox.addEventListener("dragover", function (e) {
            e.stopPropagation();
            e.preventDefault();
            this.dropbox.classList.add('xmmdropbox_active');   
        }.bind(this), false);
        this.dropbox.addEventListener("dragleave", function (e) {
            e.stopPropagation();
            e.preventDefault();
            this.dropbox.classList.remove('xmmdropbox_active');
        }.bind(this), false);
        this.dropbox.addEventListener("drop", function (e) {
            e.stopPropagation();
            e.preventDefault();
            if( e.dataTransfer.files.length ) {
                this.dropbox.classList.remove('xmmdropbox_active');
                if( this.isValid( e.dataTransfer.files ) ) {
                    this.input.files = e.dataTransfer.files;
                    this.handleFiles(e.dataTransfer.files);
                } else alert('Bad extension for the file! Expected '+this.options.extensions.toString());
            }
        }.bind(this), false);   
        this.input.onchange=function() {
            if( this.isValid( this.input.files ) ) {
                this.handleFiles( this.input.files );
            } else alert('Bad extension for the file! Expected '+this.options.extensions.toString());
        }.bind(this);
    }
    handleFiles( files ) {
        if( this.options.mode ) {
            let form = this.dropbox.closest('form');
            if( form ) form.submit();
            return;
        }
        if( !this.options.multiple ) {
            if( files.length == 1) {
                if( this.button ) this.button.disabled = false;
                if( this.options.preview ) {
                    const img = document.createElement("img");
                    img.classList.add('xmmdropbox_image');
                    img.file = files[0];
                    let child = this.dropbox.children[0];
                    this.dropbox.replaceChild(img,child);
                    const reader = new FileReader();
                    reader.onload = (function(aImg) { return function(e) { aImg.src = e.target.result; }; })(img);
                    reader.readAsDataURL(files[0]);
                } else {
                    const date = new Date(files[0].lastModified);
                    this.dropbox.childNodes[0].innerHTML = files[0].name;
                }
            }
        } else {
            for( let n = 0; n < files.length; n++ ) {
                this.create(files[n], null );
            }
            this.arrangeIcons();
        }
    }
    done() {
        let files = [];
        for( let n = 0; n < this.dropbox.children.length; n++ ) {
            let file = {
                file: this.dropbox.children[n].children[0].file,
                src: this.dropbox.children[n].children[0].src,
            }
            files.push(file);
        }
        this.inputData.value = JSON.stringify(files);
    }
    isValid( files ) {
        if( !this.options.extensions ) return true;
        let ext = files[0].name.match(/\.[0-9a-z]+$/i)[0];
        if( ext ) {
            ext = ext.match(/[0-9a-z]+$/i)[0];
            return this.options.extensions.indexOf(ext) >= 0;
        }
        return false;
    }
    arrangeIcons() {
        this.dropbox.style.height = this.options.height;
        for( let n = 0; n < this.dropbox.children.length; n++ ) {
            this.dropbox.style.height = null;
            if( n == 0 )
                this.dropbox.children[n].children[1].children[0].classList.add('hidden');
            else 
                this.dropbox.children[n].children[1].children[0].classList.remove('hidden');
            if( n == this.dropbox.children.length - 1 )
                this.dropbox.children[n].children[1].children[3].classList.add('hidden');
            else 
                this.dropbox.children[n].children[1].children[3].classList.remove('hidden');
        }
        this.done();
    }
    create( file, src ) {
        let item = document.createElement("div");
        item.classList.add('xmmdropbox-image');
        item.style.width = '19%';
        item.style.height = '19%';
        const img = document.createElement("img");
        if( src )
            img.src = src;
        if( file )
            img.file = { name: file.name, size: file.size, type: file.type };
        item.appendChild(img);
        const div = document.createElement("div");
        div.classList.add('xmmdropbox-overlay');
        let content = '';
        content += '<div class="xmmdropbox-icon left hidden">'+this.options.icons[2]+'</div>';
        content += '<div class="xmmdropbox-icon add">'+this.options.icons[0]+'</div>';
        content += '<div class="xmmdropbox-icon delete">'+this.options.icons[1]+'</div>';
        content += '<div class="xmmdropbox-icon right hidden">'+this.options.icons[3]+'</div>';
        if( this.dropbox.hasChildNodes() ) 
            this.dropbox.lastChild.children[1].children[3].classList.remove('hidden');
        div.innerHTML = content;
        if( !src ) {
            const reader = new FileReader();
            reader.onload = (function(aImg,dropbox) { return function(e) { 
                aImg.src = e.target.result;
                dropbox.done();
            }; })(img,this);
            reader.readAsDataURL(file);
        }
        item.appendChild(div);
        this.dropbox.appendChild(item);
    }
    add( images ) {
        if( images ) {
            for( let n = 0; n < images.length; n++ ) {
                let image = images[n];
                this.create(image.file,image.src);
            }
            this.arrangeIcons();
        }
    }
    set( data ) {
        this.clear();
        this.add(JSON.parse(data));
        this.inputData.value = data;
    }
    get() {
        return this.inputData.value;
    }
    clear () {
        this.dropbox.innerHTML = null;
    }
}