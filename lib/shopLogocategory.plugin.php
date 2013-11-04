<?php
class shopLogocategoryPlugin extends shopPlugin
{
    
    public function backendCategoryDialog($category)
    {        
        if($this->getSettings('status')) {
            $view = wa()->getView();
            $view->assign('category',$category);
            $template_path =wa()->getAppPath('plugins/logocategory/templates/CategoryField.html',  'shop');
    		$html = $view->fetch($template_path);
            return $html;
        }
    }
    
    public function backendProducts($params)
    {
        
        if($this->getSettings('status') && $params['type']=='category') {
            
            $category_info = $params['info'];
            
            $view = wa()->getView();
            $view->assign('image_dir',wa()->getDataUrl('plugins/logocategory/images/', true, 'shop'));
            $view->assign('image',$category_info['image']);            
            $template_path =wa()->getAppPath('plugins/logocategory/templates/BackendCategoryLogo.html',  'shop');
    		$html = $view->fetch($template_path);
            return array('title_suffix'=>$html);
           
           
        }
    }
    
    
    
    public function frontendCategory($category)
    {            
        if($this->getSettings('status') && $this->getSettings('default_output')) {
            $view = wa()->getView();
            $view->assign('image_dir',wa()->getDataUrl('plugins/logocategory/images/', true, 'shop'));
            $view->assign('image',$category['image']);            
            $template_path =wa()->getAppPath('plugins/logocategory/templates/FrontendCategoryLogo.html',  'shop');
            $html = $view->fetch($template_path);
            return $html;
        }
        
           
    }
    
    public function categoryDelete($category)
    {            
        $image_path = wa()->getDataPath('plugins/logocategory/images/',  'shop');
        $name = $category['image'];
        
        if($name && file_exists($image_path.$name)) {
            @!unlink($image_path.$name);
        }
           
    }
    
    
    
    public static function getImgUrl($category_id)
    {
        $category_model = new shopCategoryModel();
        $category = $category_model->getById($category_id);
        
        if($category['image']) {
            return wa()->getDataUrl('plugins/logocategory/images/'.$category['image'], true, 'shop');
        }    
    }
    
    
}