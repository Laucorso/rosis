<?php
if( Auth::guard('admin')->user()->role === 'admin' ) {
    return [
        'Panel de Control' => [
            'icon' => 'fa-tachometer-alt',
            'href' => '/'
        ],
        '',
        'Asistentes' => [
            'icon' => 'fa-magic',
            'menu' => [
                'Crear Producto' => 'product-wizard',
            ]
        ],
        '',
        'Usuarios' => [
            'icon' => 'fa-users',
            'href' => 'users'
        ],
        '',
        'Categorias' => [
            'icon' => 'fa-list',
            'href' => 'categories'
        ],
        'Productos' => [
            'icon' => 'fa-book',
            'menu' => [
                'Listado' => 'products',
                'Ordenar' => 'product-order'
            ]
        ],
        'Pedidos' => [
            'icon' => 'fa-edit',
            'menu' => [
                'Listado' => 'orders',
                'Exportar' => 'export-orders',
                'Facturas' => 'invoices'
            ]
        ],
        'Clientes' => [
            'icon' => 'fa-users',
            'href' => 'customers'
        ],
        'Cupones' => [
            'icon' => 'fa-tags',
            'href' => 'coupons'
        ],
        'Códigos QR' => [
            'icon' => 'fa-qrcode',
            'href' => 'qrcodes'
        ],
        'Transportistas' => [
            'icon' => 'fa-truck',
            'href' => 'couriers'
        ],
        'Web',
        'Páginas' => [
            'icon' => 'fa-copy',
            'menu' => [
                'Paginas',
                'Inicio' => 'web-home',
                'Ramos' => 'web-buquets',
                'Plantas' => 'web-plants',
                'Otras' => 'web-pages',
                'Redirecciones' => 'redirections'
            ]
        ],
        'Blog' => [
            'icon' => 'fa-columns',
            'menu' => [
                'Blogs',
                'Rosistirem' => 'blog-rosistirem',
                'Cuidados' => 'blog-care'
            ]
        ],
        '',
        'Herramientas' => [
            'icon' => 'fa-cog',
            'menu' => [
                'Traducciones'=>'translations',
                'Marketing',
                'Mailing' => 'mailing',
                'Google Reviews' => 'google-reviews',
                'Web Analytics' => 'web-analytics',
                'Wordpress',
                'Importar Productos' => 'import-products',
                'Sincronizar BaseDatos' => 'database-sync'
            ]
        ],
        '',
        'Punto Parcel' => [
            'icon' => 'fa-gift',
            'href' => 'parcel-point'
        ]
    ];
} 
if( Auth::guard('admin')->user()->role === 'basic' ) {
    return [
        'Panel de Control' => [
            'icon' => 'fa-tachometer-alt',
            'href' => '/'
        ],
        '',
        'Productos' => [
            'icon' => 'fa-book',
            'href' => 'products'
        ],
        'Pedidos' => [
            'icon' => 'fa-edit',
            'href' => 'orders'
        ],
        '',
        'Punto Parcel' => [
            'icon' => 'fa-gift',
            'href' => 'parcel-point'
        ],
        '',
        'Calculadora' => [
            'icon' => 'fa-cash-register',
            'href' => 'cash-register'
        ]
    ];
}
if( Auth::guard('admin')->user()->role === 'seo' ) {
    return [
        'Web Analytics' => [
            'icon' => 'fa-chart-line',
            'href' => '/',
        ],
        '',
        'Productos' => [
            'icon' => 'fa-book',
            'href' => 'products'
        ],
        '',
        'Web',
        'Pedidos' => [
            'icon' => 'fa-edit',
            'href' => 'orders'
        ],
        'Páginas' => [
            'icon' => 'fa-copy',
            'menu' => [
                'Páginas',
                'Inicio' => 'web-home',
                'Ramos' => 'web-buquets',
                'Plantas' => 'web-plants',
                'Otras' => 'web-pages',
                'Redirecciones' => 'redirections'
            ]
        ],
        'Blog' => [
            'icon' => 'fa-columns',
            'menu' => [
                'Blogs',
                'Rosistirem' => 'blog-rosistirem',
                'Cuidados' => 'blog-cuidados'
            ]
        ],
    ];
}
if( Auth::guard('admin')->user()->role === 'marketing' ) {
    return [
        'Web Analytics' => [
            'icon' => 'fa-chart-line',
            'href' => '/',
        ],
        '',
        'Promociones' => [
            'icon' => 'fa-thumbs-up',
            'menu' => [
                'Cupones' => 'coupons',
                'Códigos QR' => 'qrcodes'
            ]
        ],
        'Productos' => [
            'icon' => 'fa-book',
            'menu' => [
                'Listado' => 'products',
                'Ordenar' => 'product-order'
            ]
        ],
        '',
        'Blog' => [
            'icon' => 'fa-columns',
            'menu' => [
                'Blogs',
                'Rosistirem' => 'blog-rosistirem',
                'Cuidados' => 'blog-care'
            ]
        ],    
   ];
}