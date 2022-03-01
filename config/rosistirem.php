<?php
return [
    'order' => [
        'status' => [
            'open' => 'Creado',
            'failed' => 'Fallido',
            'processing' => 'En proceso',
            'cancelled' => 'Cancelado',
            'refunded' => 'Reembolsado',
            'ready' => 'Listo',
            'picked' => 'Recogido',
            'complete' => 'Completado'
        ],
        'couriers' => [
            'FlashFly' => [
                'name' => 'Ramón Flores',
                'phone' => '616842571',
                'email' => 'flashfly.es@gmail.com'
            ],
            'MRW' => [                
                'phone' => '000 000 000',
                'tracking' => true,
            ],
            'Glovers' => [
                'phone' => '000 000 000',
            ],
            'Nuestros Medios' => [
                'phone' => '000 000 000',
            ],
            'Otros' => [
                'phone' => '000 000 000',
            ]
        ],
        'zips'=>[
            [8001,8042],
            [8070,8071],
            [8075,8075],
            [8080,8080],
            [8110,8110],
            [8171,8174],
            [8190,8198],
            [8200,8208],
            [8220,8228],
            [8290,8290],
            [8320,8320],
            [8330,8330],
            [8338,8340],
            [8750,8750],
            [8805,8805],
            [8820,8820],
            [8830,8830],
            [8840,8840],
            [8850,8850],
            [8900,8924],
            [8930,8930],
            [8940,8940],
            [8950,8950],
            [8960,8960],
            [8970,8970],
            [28001,28055],
            [28223,28224]
        ]
    ],
    'dedication' => [
        'name_es' => 'Dedicatoria',
        'name_ca' => 'Dedicatoria',
        'name_en' => 'Dedication',
        'name_ru' => 'Dedication',
        'price' => 4.90,
        'id' => 'D'
    ],
    'shipping' => [
        'price' => 11.90,
        'range_price' => 4.90
    ],
    // PRODUCT CATEGORIES
    'categories' => [
        'Plantas' => [
            'PI' => 'Planta de Interior',
            'PE' => 'Planta de Exterior',
            'PA' => 'Planta Artificial',
            'PC' => 'Cactus'
        ],
        'Ramos' => [
            'RC'=>'Ramo de color',
            'RV'=>'Ramo de flor variada',
            'RR'=>'Ramo de Rosas',
            'RS'=>'Ramo de flor seca',
            'RN'=>'Ramo de novia',
            'RA'=>'Ramo artificial',
            'RX'=>'Ramos Supreme',
            'RM'=>'Mini-Ramos'
        ],
        'Ocasiones Especiales' => [
            'OSV'=>'San Valentin',
            'OSJ'=>'Sant Jordi',
            'ODM'=>'Dia de la Madre',
            'OCA'=>'Cumpleaños',
            'OBO'=>'Bodas',
            'OFU'=>'Funebre'
        ],
        'Complementos'=>[
            'CP'=>'Complemento Plantas',
            'CR'=>'Complemento Ramos'
        ],
        'Otros'=>[
            'XTR'=>'Tarjeta Regalo'
        ]
    ],
    'ip_blacklist'=>[
        [ip2long('66.249.64.1'),ip2long('66.249.66.255')],
        [ip2long('114.119.147.1'),ip2long('114.119.147.255')],
        [ip2long('87.250.224.1'),ip2long('87.250.224.255')],
        [ip2long('185.119.81.1'),ip2long('185.119.81.255')],
        [ip2long('5.255.253.1'),ip2long('5.255.253.255')],
        [ip2long('34.216.177.1'),ip2long('34.216.212.255')],
        [ip2long('95.108.213.1'),ip2long('95.108.213.255')],
    ]
];