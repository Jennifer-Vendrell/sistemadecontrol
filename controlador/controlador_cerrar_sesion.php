<?php
session_start();
session_destroy();
header("location:/sistemadecontrol/vista/login/login.php")
?>