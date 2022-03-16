<?php


class AuthController extends BaseController
{
    public function login() {
        $form = file_get_contents("../src/Views/forms/login.tpl");
        if(isset($_SESSION['user'])) {
            $this->view->add(':main', '<h3>Welkom, je bent ingelogd</h3>');
        } else {
            $this->view->add(':main', $form);
        }
        $this->view->render();
    }

    public function logout() {
        $_SESSION = array();
        session_unset();
        session_destroy();
        $this->login();
    }

    public function register() {
        $form = file_get_contents("../src/Views/forms/register.tpl");
        $this->view->add(':main', $form);
        $this->view->render();
    }

    public function authenticate() {
        $user = new User();
        $result = $user->fetchByEmail($this->db, $_POST['email']);
        if($result && password_verify($_POST['password'], $result['password'])) {
            foreach(array_merge($user->fillable, array($user->pk)) as $udata) {
                $_SESSION['user'][$udata] = $result[$udata];
            }
        } else {
            $_SESSION = array();
        }
        $this->login();
    }

}