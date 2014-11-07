<?php
App::uses('AbstractPasswordHasher', 'Controller/Component/Auth');

class CustomPasswordHasher extends AbstractPasswordHasher {
    public function hash($password) {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function check($password, $hashedPassword) {
        return password_verify($password, $hashedPassword);
    }
}
?>