<?php


class MessageController extends BaseController
{
    private Message $msg;

    public function index() {
        $msg = new Message();
        $messages = $msg->fetchAll($this->db);
        $table = $this->view->render_table('messages', $messages);
        $this->view->add(':main', $table);
        $this->view->render();
    }

    public function newmessage() {
        if($this->auth->auth()) {
            echo "Authenticated";
        } else {
            echo "Not Authenticated";
        }
    }

}