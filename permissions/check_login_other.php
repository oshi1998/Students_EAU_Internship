<?php

if(!isset($_SESSION["AUTH_ID"])){
    header("location:login.php");
}