<?php

class FormValidator
{

    public static function isPostEmpty(): bool
    {

        if (isset($_POST) && !empty($_POST)) {

            return true;
        } else return false;
    }

    public static function isFieldsEmpty(): bool
    {

        foreach ($_POST as $field) {
            if (empty($field)) {
                $error = 'Il y un champ vide';
                return false;
            }
            return true;
        }
    }
    public static function isShortName(string $name, int $long): bool
    {
        if (strlen($name) <= $long) {

            return true;
        }
        return false;
    }

    public static function isEmail(string $email): bool
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

            return true;
        }
        return false;
    }

    public static function isPassword(string $password, int $long = 6): bool
    {
        if (strlen($password) >= $long) {

            return true;
        } else false;
    }
}
