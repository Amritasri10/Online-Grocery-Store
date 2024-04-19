<?php
session_start();
//This will destroy the session value
session_destroy();
//This will redirect to main page
echo "<script>window.location='index.php';</script>";
?>