<?php

class shopLogocategoryPluginSettingsAction extends waViewAction {

    public function execute() {
        $app_settings_model = new waAppSettingsModel();
        $settings = $app_settings_model->get(array('shop', 'logocategory'));
        $this->view->assign('settings', $settings);
    }

}
