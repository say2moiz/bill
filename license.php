<?php
session_start();
require_once('autoload.php');
$_pdo = new pdocrudhandler();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="images/loginfavicon.png"/>
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>License</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="container">
    <div class="row" style="margin-top:20px">
        <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
            <form method="post">
                <fieldset>
                    <h2>Enter License Key</h2>
                    <hr class="colorgraph">
                    <div class="form-group">
                        <input type="text" autocomplete="off" name="key" id="key" class="form-control input-lg" placeholder="Enter license key here...">
                    </div>
                    <hr class="colorgraph">
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <input type="submit" class="btn btn-lg btn-success btn-block" value="Submit">
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <a href="login.php" class="btn btn-lg btn-primary btn-block">Go Home</a>
                        </div>
                        <input type="hidden" name="submit">
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
    <?php
    if(isset($_GET['status'])){
        if($_GET['status'] == 'success'){
            ?>
            <div class="alert alert-success" role="alert" id="success" style="margin-top: 10px;">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                <span id="successMsg">You have successfully subscribed the license up to <?=date("F j, Y, g:i a",strtotime($_SESSION['newSub'])). " ";?><a href="login.php"><b>Go Login Now!</b></a></span>
            </div>
        <?php
        }else if($_GET['status'] == 'failure'){
            ?>
            <div class="alert alert-danger" role="alert" id="error"  style="margin-top: 10px;">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                <span id="errorMsg">Either you entered invalid key or expired key that has already been used. Please contact Administrator for the valid key.</span>
            </div>
        <?php
        }
    }
    ?>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
<script src="js/sign_in_up.js"></script>
<?php
if(isset($_POST['submit'])){
    $license = new license();
    $license->validateLicenseKey($_POST['key']);
}
?>
</body>
</html>