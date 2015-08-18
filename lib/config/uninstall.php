<?php

$model = new waModel();
try {
    $model->exec("ALTER TABLE `shop_category` DROP `image`");
} catch (waDbException $e) {
    
}