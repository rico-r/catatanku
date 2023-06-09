<?php
session_start();

function cleanData($data)
{
    $data = trim($data);
    $data = htmlentities($data);
    return $data;
}

$errorMsg = '';
function getPostData($name, $ifError)
{
    global $errorMsg;
    if (!isset($_POST[$name])) {
        if ($errorMsg == '') {
            $errorMsg = $ifError;
        }
        return '';
    }
    $value = cleanData($_POST[$name]);
    if ($value == '') {
        if ($errorMsg == '') {
            $errorMsg = $ifError;
        }
    } else {
        return $value;
    }
}

function getSessionData($name, $default = false)
{
    if (isset($_SESSION[$name])) {
        return cleanData($_SESSION[$name]);
    }
    return $default;
}

function getGetData($name, $default = false)
{
    if (isset($_GET[$name])) {
        return cleanData($_GET[$name]);
    }
    return $default;
}

function methodIsPost()
{
    return $_SERVER['REQUEST_METHOD'] == 'POST';
}

function redirectTo($dst)
{
    header("Location: $dst");
}

function isLogin()
{
    return getSessionData('userId') !== false;
}

function requireLogin()
{
    global $userId;
    if (!isLogin()) {
        redirectTo('login.php');
        die();
    }
    $userId = getSessionData('userId');
}

function requireNotLogin($dst)
{
    if (isLogin()) {
        redirectTo($dst);
        die();
    }
}
