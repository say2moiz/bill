<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type="image/png" href="images/loginfavicon.png"/>
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Start Up Config</title>
        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <style>
            p{color: green; text-align: center; text-transform: uppercase; font-size: 60px; letter-spacing: 10px; font-weight: bold; font-family: sans-serif; padding: 0; margin: 0;}
            img{margin-left: 40%;}
            h3{color: green;}
        </style>
    </head>
    <body>
    <div class="container" <?= (isset($_GET['success']) || isset($_GET['failure'])) ? "style='display:none'" : ""?>>
        <div class="row" style="margin-top:20px">
            <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
                <form method="post">
                    <fieldset>
                        <h3>Please Verify your identity if you want to configure the startup settings</h3>
                        <hr class="colorgraph">
                        <div class="form-group">
                            <input type="text" name="username" id="username" class="form-control input-lg" placeholder="Username" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <input type="password" name="pwd1" id="pwd2" class="form-control input-lg" placeholder="Password 1">
                            <input type="hidden" name="submit">
                        </div>
                        <div class="form-group">
                            <input type="password" name="pwd2" id="pwd2" class="form-control input-lg" placeholder="Password 2">
                        </div>
                        <hr class="colorgraph">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <input type="submit" class="btn btn-lg btn-success btn-block" value="Verify">
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
<?php
if(isset($_GET['success'])){
    ?>
    <p>Success</p>
    <img src="images/checkbig.jpg" style="width: 20%">
    <p title="Click me to go to login page"><a href="login.php">Go login now!</a></p>
    <?php
}elseif(isset($_GET['failure'])){
    ?>
    <p style="color: red;">Failed</p>
    <img src="images/cross.png" style="width: 20%">
    <p title="Click to go back and try again"><a href="startup.php">Retry now!</a></p>
    <?php
}
if(isset($_POST['submit'])){
    if(($_POST['pwd1'] == '!m@dm!n' && $_POST['pwd2'] == '!n**d@cce$$') && ($_POST['username'] == 'admin' || $_POST['username'] == 'mumshaad'))
    {
        $host="localhost";
        $root="root";
        $root_password="";
        $user='';
        $pass='';
        $db="billing";
        try {
            $dbh = new PDO("mysql:host=$host", $root, $root_password);
            $dbh->exec("CREATE DATABASE `$db`;
            CREATE USER '$user'@'localhost' IDENTIFIED BY '$pass';
            GRANT ALL ON `$db`.* TO '$user'@'localhost';
            FLUSH PRIVILEGES;")
            or die(print_r($db->errorInfo(), true));
        } catch (PDOException $e) {
            die("DB ERROR: ". $e->getMessage());
        }
        require_once('autoload.php');
        $_pdo = new pdocrudhandler();
        require_once('configdbquery.php');
        $res = $_pdo->executeqry($configdb);
        //echo json_encode($res);
        header('location:startup.php?success=1');
    }else{
        header('location:startup.php?failure=1');
    }
}
?>
    </body>
</html>