<?php
require_once('autoload.php');
$user = new user();
$user->checklogin();
if($_SESSION['accesslevel'] != 1000){
    header('location:login.php');
}
$_pdo = new pdocrudhandler();
$licensekeys = $_pdo->select('licensekeys',array('*'));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="images/loginfavicon.png"/>
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Manage License Keys</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/scroll.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<a class="top"><img src="images/down.png"></a>
<div class="container">
    <h3 class="bg-info text-center">Available Licenses</h3>
    <table table class="table table-hover table-bordered table-responsive">
        <thead>
        <tr>
            <th>S.No.</th>
            <th>License Key</th>
            <th>Days Valid For</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        <?php for($l=0;$l<count($licensekeys['result']);$l++){?>
            <tr>
                <td><?=$l+1; ?></td>
                <td><?= $licensekeys['result'][$l]->licenseKey; ?></td>
                <td><?= $licensekeys['result'][$l]->daysValidFor; ?></td>
                <td><?= ($licensekeys['result'][$l]->expired == 1) ? "<b style='color:red'>Expired</b>" : "<b style='color:green'>Valid</b>"?></td>
            </tr>
        <?php }?>
        </tbody>
    </table>
</div>
<a class="bottom"><img src="images/up.png"></a>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
<script src="js/sign_in_up.js"></script>
<script src="js/scroll.js"></script>
</body>
</html>