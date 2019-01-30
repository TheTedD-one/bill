<?php

$menu = [
    [
        'options' => [
            'class' => 'navigation-header'
        ],
        'template' => '<span>Меню</span> <i class="icon-menu" title="Main pages"></i>',
    ],
    [
        'label' => 'Счета',
        'template' => '<a href="{url}" class="nav-link"><i class="icon-file-check"></i><span>{label}</span></a>',
        'url' => ['bill/index'],
    ],
    [
        'label' => 'Тест',
        'options' => ['class' => 'nav-item nav-item-submenu'],
        'template' => '<a href="#" class="nav-link"><i class="icon-stack"></i><span>{label}</span></a>',
        'items' => [
            [
                'label' => 'Тест 1',
                'url' => ['kindergarden/index'],
            ],
            [
                'label' => 'Тест 2',
                'url' => ['site/index'],
            ],
            [
                'label' => 'Тест 3',
                'url' => ['site/about'],
            ],
        ]
    ],
];

return $menu;