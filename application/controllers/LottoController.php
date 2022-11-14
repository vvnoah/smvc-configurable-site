<?php

namespace app\controllers;

use core\Controller;
use app\models\{LottoModel, NavigationModel, SiteConfigModel};


class LottoController extends Controller{
    public function __construct() {
        parent::__construct();
        $this->lottoModel = new LottoModel();
        $this->navigationData = new NavigationModel();
        $this->siteConfigData = new SiteConfigModel();
    }
    
    public function index(){
        
        // Get lotto number array.
        $lottoGrid = $this->lottoModel->get_grid();
        $this->view->assign('lottoGrid', $lottoGrid);
        
        // Get partial view and assign to content.
        $content = $this->view->fetch('partialviews/lottoView');
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
        
        $navigation = $this->navigationData->get_nav_links();
        $this->view->assign("navigation", $navigation);
    }
}
