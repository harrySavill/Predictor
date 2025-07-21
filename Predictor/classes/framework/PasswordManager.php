<?php

class PasswordManager
{
    public function hashPassword($password){
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public function verifyPassword($password, $hashedPassword){
        return password_verify($password, $hashedPassword);
    }

}