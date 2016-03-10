<?php
require_once('autoload.php');
$user = new user();
$user->checklogin();
if($_SESSION['accesslevel'] == 10) header('location:login.php');
$_pdo = new pdocrudhandler();
$users = $_pdo->select('user',array('*'),'where idUser = ?',array(2));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="images/loginfavicon.png"/>
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Manage Support Info</title>
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
    <div class="row" style="margin-top:20px">
        <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
            <form method="post">
                <fieldset>
                    <h2>Update Support Contact Information</h2>
                    <hr class="colorgraph">
                    <div class="form-group">
                        <input type="text" name="contactNumber" id="contactNumber" class="form-control input-lg" value="<?= $users['result'][0]->contactNumber?>">
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" id="email" class="form-control input-lg" value="<?= $users['result'][0]->email?>">
                    </div>
                    <hr class="colorgraph">
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <input type="submit" class="btn btn-lg btn-success btn-block" value="Update">
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <a href="index.php" class="btn btn-lg btn-primary btn-block">Go Home</a>
                        </div>
                        <input type="hidden" name="submit">
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
    <h3 class="bg-info text-center">Available support information in system</h3>
    <table table class="table table-hover table-bordered table-responsive">
        <thead>
        <tr>
            <th>Email</th>
            <th>Phone/Cell</th>
        </tr>
        </thead>
        <tbody>
            <tr>
                <td><?= $users['result'][0]->email; ?></td>
                <td><?= $users['result'][0]->contactNumber; ?></td>
            </tr>
        </tbody>
    </table>
<a class="bottom"><img src="images/up.png"></a>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
<script src="js/sign_in_up.js"></script>
<script src="js/scroll.js"></script>
<?php
if(isset($_POST['submit'])){
    $res = $_pdo->update('user',array('contactNumber'=>$_POST['contactNumber'],'email'=>$_POST['email']),'where idUser = ?',array(2));
    if($res['status'] = 'success' && $res['rowsAffected'] == 1){
        header('location:index.php');
    }
}
?>
</body>
</html>