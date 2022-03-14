<?php
class User {
    private string $fname;
    private string $prefix;
    private string $lname;
    private string $email;
    private string $password;

    public function __construct($email, $password) {
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }



    public function showPass() {
        echo $this->password;
    }
}
