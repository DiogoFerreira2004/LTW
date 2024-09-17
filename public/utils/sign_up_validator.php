<?php

function validateSignUp($name, $username, $email, $password, $r_password, &$password_hash, &$error_message): bool
{
    if (empty($_POST["name"])) {
        $error_message = "Name is required!";
        return false;
    }

    if (empty($_POST["username"])) {
        $error_message = "Username is required!";
        return false;
    }

    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $error_message = "Invalid email format!";
        return false;
    }

    if (strlen($_POST["password"]) < 6) {
        $error_message = "Password must be at least 6 characters!";
        return false;
    }

    if (!preg_match("/[a-z]/i", $_POST["password"])) {
        $error_message = "Password must contain at least one letter!";
        return false;
    }

    if (!preg_match("/[0-9]/", $_POST["password"])) {
        $error_message = "Password must contain at least one number!";
        return false;
    }

    if ($_POST["password"] !== $_POST["r_password"]) {
        $error_message = "Passwords do not match!";
        return false;
    }

    $password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
    return true;
}