<?php
require_once('autoload.php');
$_pdo = new pdocrudhandler();
$companies = $_pdo->select('company',array('*'));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="images/loginfavicon.png"/>
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Login</title>
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
                    <h2>Please Sign In</h2>
                    <hr class="colorgraph">
                    <div class="form-group">
                        <select class="form-control" style="height: 46px;" name="cname" id="cname">
                            <option value="-1">Select Company</option>
                            <?php for($l=0;$l<count($companies['result']);$l++){?>
                                <option value="<?= $companies['result'][$l]->idCompany;?>"><?= $companies['result'][$l]->companyName;?></option>
                            <?php }?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" name="username" id="username" class="form-control input-lg" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password">
                        <input type="hidden" name="submit">
                    </div>
				<span class="button-checkbox">
					<button type="button" class="btn" data-color="info">Remember Me</button>
                    <input type="checkbox" name="remember_me" id="remember_me" checked="checked" class="hidden">
					<a href="" class="btn btn-link pull-right">Forgot Password?</a>
				</span>
                    <hr class="colorgraph">
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <input type="submit" class="btn btn-lg btn-success btn-block" value="Sign In">
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <a href="#" class="btn btn-lg btn-primary btn-block">Register</a>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
    <?php
    if(isset($_GET['status'])){
        if($_GET['status'] == 'failure'){
        ?>
            <div class="alert alert-danger" role="alert" id="error"  style="margin-top: 10px;">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                <span id="errorMsg">Please enter the valid credentials.</span>
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
$user = new user();
$user->logout();
if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $companyid = $_POST['cname'];
    if($user->login($username,$password,$companyid)){
        header("location:index.php");
    }else{
        header("location:login.php?status=failure");
    }
}
?>
</body>
</html>