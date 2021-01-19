<?php
    if(!isset($_SERVER['HTTP_REFERER'])){
        header('location: index.php');
        exit;
    }