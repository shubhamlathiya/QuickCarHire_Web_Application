<?php
//header("HTTP/1.0 404 Not Found");
//include_once("404.php");
//exit();
//
if (!file_exists($page)) {
header("HTTP/1.0 404 Not Found");
include("404.php");
exit();
}

?>