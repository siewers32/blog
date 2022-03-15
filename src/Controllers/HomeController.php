<?php


class HomeController extends BaseController
{

    public function index() {
        $form = file_get_contents("../src/Views/forms/login.tpl");
        $this->view->add(':main', $form);
        $this->view->render();
    }

}