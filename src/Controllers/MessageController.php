<?php


class MessageController extends BaseController
{
    private Message $msg;

    public function index() {
        $msg = new Message();
        $view = $this->c->getObject('view');
        $messages = $msg->fetchAll($this->c->getObject('db'));
        $table = $view->render_table('messages', $messages);
        $view->add(':main', $table);
        $view->render();
    }

    public function create() {
        $msg = new Message(1, "de titel", "Dit is het bericht");
        $msg->toString();
        $user = new User("siwi@siewers.org", "welkom123");
    }

}