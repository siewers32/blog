<?php

abstract class BaseController {
    protected View $view;
    protected PDO $db;
    protected Auth $auth;

    public function __construct(Container $c) {
        $this->view = $c->get('view');
        $this->db = $c->get('db');
        $this->auth = $c->get('auth');
    }
}