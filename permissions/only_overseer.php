<?php

if($_SESSION["AUTH_ROLE"]!="หัวหน้างาน"){
    header("location:home.php");
}