<?php


class HomeController extends BaseController
{

    public function index() {
        $msg = new Message();
        $messages = $msg->fetchAll($this->c->getObject('db'));
        $table = $this->view->render_table('messages', $messages);
        $this->view->add(':main', $table);
        $this->view->render();
    }

}