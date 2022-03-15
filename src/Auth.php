<?php

class Auth {
    public function auth()
    {
        if (isset($_SESSION['user'])) {
            return true;
        } else {
            return false;
        }
    }
}

