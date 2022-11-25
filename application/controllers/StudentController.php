<?php

namespace app\controllers;

use core\Controller;
use app\models\{NavigationModel, SiteConfigModel, StudentModel};

class StudentController extends Controller {
    public function __construct(){
        parent::__construct();
        $this->studentModel = new StudentModel;
        $this->navigation = new NavigationModel;
        $this->siteConfig = new SiteConfigModel;
    }

    public function index(){
        $student_data = $this->studentModel->get_student_data();
        $this->view->assign('student_data', $student_data);

        $content = $this->view->fetch('partialviews/studentsView');
        $this->view->assign('content', $content);

        $this->configure_site();
        $this->view->display('layouts/main');
    }

    private function configure_site(){
        $site_title = $this->siteConfig->get_site_title();
        $main_title = $this->siteConfig->get_main_title();
        $sub_title = $this->siteConfig->get_sub_title();

        $this->view->assign('site_title', $site_title);
        $this->view->assign('main_title', $main_title);
        $this->view->assign('sub_title', $sub_title);

        $nav = $this->navigation->get_nav_links();
        $this->view->assign('navigation', $nav);
    }
}