<?php
require_once 'data/validation.php';
if (methodIsPost()) {
    session_start();
    session_destroy();
    redirectTo('login.php');
} else {
    redirectTo('view.php');
}
