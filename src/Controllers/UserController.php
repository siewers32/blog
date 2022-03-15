<?php


class UserController extends BaseController
{
    function adduser() {
        $user = new User();
        $user->create($this->db);
        $this->view->add(':main', '<p>User created Succesfully</p>');
        $this->view->render();
    }
}