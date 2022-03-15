<?php

abstract class BaseController {
    protected Container $c;
    protected View $view;
    protected PDO $db;
    protected Auth $auth;

    public function __construct(Container $c) {
        $this->c = $c;
        $this->view = $this->c->getObject('view');
        $this->db = $this->c->getObject('db');
        $this->auth = $c->getObject('auth');
    }
}