<?php
    session_start();
    //$_SESSION = array();
    session_destroy();
    session_unset();
        //unset($_SESSION['zalogowany']);
    header("Location: https://www.rafalhudaszek.pl");
        
?>