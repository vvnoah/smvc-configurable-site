<?php

namespace app\controllers;

use core\Controller;
use app\models\{AboutModel, NavigationModel, SiteConfigModel};


class AboutController extends Controller{
    public function __construct() {
        parent::__construct();
        $this->aboutData = new AboutModel();
        $this->navigationData = new NavigationModel();
        $this->siteConfigData = new SiteConfigModel();
    }
    
    public function index(){
        $name = $this->aboutData->get_name();
        $class_group = $this->aboutData->get_class_group();
        $students = $this->aboutData->get_students();
        
        $this->view->assign('name', $name);
        $this->view->assign('class_group', $class_group);
        $this->view->assign('students', $students);
        
        $content = $this->view->fetch('partialviews/aboutView');
        $this->view->assign('content', $content);
        
        
        $this->configure_site();
        
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
