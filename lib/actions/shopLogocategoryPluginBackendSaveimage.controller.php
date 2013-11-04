<?php

class shopLogocategoryPluginBackendSaveimageController extends waJsonController 
{
    public function execute()
    {
       $file = waRequest::file('logocategory');
       $category_id = waRequest::post('category_id');
        if($file->uploaded()) {
            $image_path = wa()->getDataPath('plugins/logocategory/images/',  'shop');
            $name = $this->uniqueName($image_path);
            $app_settings_model = new waAppSettingsModel();
            $size = $app_settings_model->get(array('shop', 'logocategory'),'size');
            $resize = $app_settings_model->get(array('shop', 'logocategory'),'resize');
            try {
                if($resize) {
                    $file->waImage()->resize($size,$size)->save($image_path.$name);
                } else {
                    $file->waImage()->save($image_path.$name);
                }
                
                $this->response['preview'] = wa()->getDataUrl('plugins/logocategory/images/'.$name, true, 'shop');
              
                $category_model = new shopCategoryModel();
                $category = $category_model->getById($category_id);
                if($category['image']) {
                    @unlink($image_path.$category['image']);
                }
                $category_model->updateById($category_id,array('image'=>$name));
              
              
              
            } catch (Exception $e) {
                
                $this->setError($e->getMessage());
            }
        }
    }
    
    protected function uniqueName($path) 
    {
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        do {
            $name = '';
            for ($i = 0; $i < 10; $i++) {
                $n = rand(0, strlen($alphabet)-1);
                $name .= $alphabet{$n};
            }
            $name .= '.jpg';
        } while(file_exists($path.$name));
        
        return $name;
    }
}