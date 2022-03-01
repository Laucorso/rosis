<?php
return array (
    'es' => [
        //'Envíos hoy' => localized_route('urgent'),
        'Ramos' => [
            'Ramos'=>localized_route('bouquets'),
            'Centros florales'=> localized_route('flower-centers'),
        ],
        'Plantas' => [
            'Plantas' => localized_route('plants'),
            'Cuidados' => localized_route('blog-care'),
        ],
        'Ocasiones Especiales' => [
            'Arte Funerario' => localized_route('funerary-art'),
            'Bodas' => localized_route('weddings'),
            'Cumpleaños' => localized_route('birthdays'),
        ],
        'B2B/Eventos' => localized_route('events'),
        'Rosistirem' => [    
            'Sobre Rosistirem' => localized_route('about-us'),
            'Blog' => localized_route('blog')
        ],
        '<i class="xf xf-lang"></i><p class="sr-only">Idiomas</p>' => [
            'Català'=>Str::before(current_route('ca'),'?view'),
            'English'=>Str::before(current_route('en'),'?view'),
        ],
    ],
    'ca' => [
        //'Per avui' => localized_route('urgent'),
        'Rams' => [
            'Rams'=>localized_route('bouquets'),
            'Centres florals'=> localized_route('flower-centers'),
        ],
        'Plantes' => [
            'Plantes' => localized_route('plants'),
            'Cuidats' => localized_route('blog-care'),
        ],
        'Ocasions Especials' => [
            'Art Funerari' => localized_route('funerary-art'),
            'Bodas' => localized_route('weddings'),
            'Cumpleanys' => localized_route('birthdays'),
        ],
        'B2B/Events' => localized_route('events'),
        'Rosistirem' => [    
            'Sobre Rosistirem' => localized_route('about-us'),
            'Blog' => localized_route('blog'),
        ],
        '<i class="xf xf-lang"></i><p class="sr-only">Idiomes</p>' => [
            'Español'=>Str::before(current_route('es'),'?view'),
            'English'=>Str::before(current_route('en'),'?view'),
        ],
    ],
    'en' => [
        //'For today' => localized_route('urgent'),
        'Bouquets' => [
            'Bouquets'=>localized_route('bouquets'),
            'Flower centers'=> localized_route('flower-centers'),
        ],
        'Plants' => [
            'Plants' => localized_route('plants'),
            'Care' => localized_route('blog-care'),
        ],
        'Special Ocassions' => [
            'Funerary art' => localized_route('funerary-art'),
            'Weddings' => localized_route('weddings'),
            'Birthdays' => localized_route('birthdays'),
        ],
        'B2B/Events' => localized_route('events'),
        'Rosistirem' => [    
            'About Rosistirem' => localized_route('about-us'),
            'Blog' => localized_route('blog'),
        ],
        '<i class="xf xf-lang"></i><p class="sr-only">Languages</p>' => [
            'Español'=>Str::before(current_route('es'),'?view'),
            'Català'=>Str::before(current_route('ca'),'?view'),
        ],
    ]
);
