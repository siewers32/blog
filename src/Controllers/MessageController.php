<?php


class MessageController extends BaseController
{
    private Message $msg;

    public function index() {
        $msg = new Message();
        $messages = $msg->fetchAll($this->db);
        $table = $this->view->render_table('messages', $messages);
        $this->view->add(':main', $table);
    }

    public function newmessage() {
        if($this->auth->auth()) {
            $msgform = str_replace(':author', $_SESSION['user']['user_id'], file_get_contents("../src/Views/forms/message.tpl") );
            $this->view->add(':main', $msgform);
            $this->view->render();
        } else {
            echo "Not Authenticated";
        }
    }

    public function create() {
        $msg = new Message();
        $msg->save($this->db);
    }

}