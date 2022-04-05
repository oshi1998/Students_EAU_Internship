<?php

if($_SESSION["AUTH_ROLE"]!="นักศึกษา"){
    header("location:home.php");
}