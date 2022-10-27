<?php

namespace app\controllers;

use core\Controller;
use app\models\{HomeModel, NavigationModel, SiteConfigModel};

class DefaultController extends Controller{
    public function __construct() {
        parent::__construct();
        $this->homeData = new HomeModel();
        $this->navigationData = new NavigationModel();
        $this->siteConfigData = new SiteConfigModel();
    }
    
    public function show_homepage(){
        $home_content = $this->homeData->get_home_content();
        $this->view->assign('content', $home_content);
        $this->configure_site();
        
        //$this->view->assign('debugbarMessages', $home_content);

        $this->view->display('layouts/main');
    }
    
    private function configure_site(){
        $site_title = $this->siteConfigData->get_site_title();
        $main_title = $this->siteConfigData->get_main_title();
        $sub_title = $this->siteConfigData->get_sub_title();
        
        $this->view->assign('site_title', $site_title);
        $this->view->assign('main_title', $main_title);
        $this->view->assign('sub_title', $sub_title);
        
        $navigation = $this->navigationData->get_nav();
        $this->view->assign("navigation", $navigation);
    }
}
