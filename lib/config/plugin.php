<?php

return array(
    'name' => 'Логотип категории',
    'description' => 'Плагин позволяет добавить логотип категории',
    'vendor'=>903438,
    'version'=>'1.0.0',
    'img'=>'img/logocategory.png',
    'shop_settings' => true,
    'frontend'    => true,
    'icons'=>array(
        16=>'img/logocategory.png',
    ),
    'handlers' => array(
        'backend_category_dialog' => 'backendCategoryDialog',
        'backend_products' => 'backendProducts',
        'frontend_category' => 'frontendCategory',
        'category_delete' => 'categoryDelete',
    ),

);
//EOF
