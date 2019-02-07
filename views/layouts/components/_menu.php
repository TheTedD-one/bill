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
        'label' => 'Реквизиты',
        'template' => '<a href="{url}" class="nav-link"><i class="icon-file-check"></i><span>{label}</span></a>',
        'url' => ['requisites/index'],
    ],
];

return $menu;