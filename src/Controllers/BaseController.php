<?php

abstract class BaseController {
    protected Container $c;
    protected View $view;
    protected PDO $db;

    public function __construct(Container $c) {
        $this->c = $c;
        $this->view = $this->c->getObject('view');
        $this->db = $this->c->getObject('db');
    }
}