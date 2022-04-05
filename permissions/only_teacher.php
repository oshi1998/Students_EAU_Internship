<?php

if($_SESSION["AUTH_ROLE"]!="อาจารย์"){
    header("location:home.php");
}