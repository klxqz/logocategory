<?php

return array(
    'name' => 'Логотип категории',
    'description' => 'Плагин позволяет добавить логотип категории',
    'vendor' => '985310',
    'version' => '1.0.2',
    'img' => 'img/logocategory.png',
    'shop_settings' => true,
    'frontend' => true,
    'handlers' => array(
        'backend_category_dialog' => 'backendCategoryDialog',
        'backend_products' => 'backendProducts',
        'frontend_category' => 'frontendCategory',
        'category_delete' => 'categoryDelete',
    ),
);
//EOF
