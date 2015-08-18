<?php

class shopLogocategoryPluginBackendDeleteimageController extends waJsonController {

    public function execute() {
        $category_id = waRequest::post('category_id');
        $category_model = new shopCategoryModel();
        $category = $category_model->getById($category_id);


        $image_path = wa()->getDataPath('plugins/logocategory/images/', 'shop');
        $name = $category['image'];

        if ($name && file_exists($image_path . $name)) {
            if (@!unlink($image_path . $name)) {
                $this->response['message'] = 'Ошибка удаления ' . $image_path . $name;
            } else {
                $this->response['message'] = 'Изображение удалено';
            }
        }

        $category_model->updateById($category_id, array('image' => ''));
    }

}
