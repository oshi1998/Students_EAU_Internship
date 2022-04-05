<?php

if($_SESSION["AUTH_ROLE"]!="ผู้ดูแลระบบ"){
    header("location:home.php");
}