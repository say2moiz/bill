<?php
require_once('autoload.php');
$user = new user();
$user->checklogin();
if($_SESSION['accesslevel'] == 10) header('location:login.php');
$_pdo = new pdocrudhandler();
if($_SESSION['accesslevel'] != 1000){
    $users = $_pdo->select('user',array('*'),'where idUser = ?',array($_SESSION['userid']));
}else{
    $users = $_pdo->select('user',array('*'));
}
$companies = $_pdo->select('company',array('*'));
if(isset($_GET['id'])){
    $editRes = $_pdo->select('user',array('*'),'where idUser = ?',array(base64_decode($_GET['id'])));
    $editUserName = $editRes['result'][0]->userName;
    $editEmail = $editRes['result'][0]->email;
    $editContactNumer = $editRes['result'][0]->contactNumber;
    $editAccessLevel = $editRes['result'][0]->accessLevel;
    $editLicenseExpiry = $editRes['result'][0]->licenseExpiryDate;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="images/loginfavicon.png"/>
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Manage Users</title>
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
            <form method="post" onsubmit=" return validate();">
                <fieldset>
                    <h2><?=(isset($_GET['id'])) ? "Edit User" : "Add Users"?></h2>
                    <hr class="colorgraph">
                    <div class="form-group">
                        <input type="text" name="userName" id="userName" class="form-control input-lg" placeholder="Enter user name here..." value="<?= (isset($_GET['id'])) ? $editUserName : ''?>" required>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" id="email" class="form-control input-lg" placeholder="Enter email here..." value="<?= (isset($_GET['id'])) ? $editEmail : ''?>" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="contactNumber" id="contactNumber" class="form-control input-lg" placeholder="Enter number here..." value="<?= (isset($_GET['id'])) ? $editContactNumer : ''?>" data-autoplay="off" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" id="password" class="form-control input-lg" placeholder="Enter password here..." required>
                    </div>
                    <div class="form-group">
                        <select class="form-control" style="height: 46px;" name="accessLevel" id="accessLevel">
                            <option value="-1">Select access level</option>
                            <option value="10" <?= (isset($_GET['id']) && $editAccessLevel == 10) ? "selected" : ""?>>General user</option>
                            <option value="100" <?= (isset($_GET['id']) && $editAccessLevel == 100) ? "selected" : ""?>>Super user</option>
                        </select>
                    </div>
                    <?php if(isset($_GET['id'])){ ?>
                    <div class="form-group">
                        <input type="text" name="licenseExpiryDate" id="licenseExpiryDate" class="form-control input-lg" value="<?= (isset($_GET['id'])) ? "License expiring on ".date("F j, Y, g:i a",strtotime($editLicenseExpiry)) : ''?>" readonly>
                    </div>
                    <?php }?>
                    <hr class="colorgraph">
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <input type="submit" class="btn btn-lg btn-success btn-block" value="Submit">
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
    <h3 class="bg-info text-center">Available users in system</h3>
    <table table class="table table-hover table-bordered table-responsive">
        <thead>
        <tr>
            <th>S.No.</th>
            <th>User Name</th>
            <th>Email</th>
            <th>Contact Number</th>
            <th>Access Level</th>
            <th>Delete</th>
            <th>Edit</th>
        </tr>
        </thead>
        <tbody>
        <?php for($l=0;$l<count($users['result']);$l++){
            if($users['result'][$l]->accessLevel == 10) $accessLevelString = "General user";
            elseif($users['result'][$l]->accessLevel == 100) $accessLevelString = "Super user";
            else $accessLevelString = "Administrator";
            ?>
            <tr>
                <td><?=$l+1; ?></td>
                <td><?= $users['result'][$l]->userName; ?></td>
                <td><?= $users['result'][$l]->email; ?></td>
                <td><?= $users['result'][$l]->contactNumber; ?></td>
                <td><?= $accessLevelString?></td>
                <td>
                    <a href="removeuser.php?id=<?= base64_encode($users['result'][$l]->idUser);?>">
                        <img src="images/delete.png" alt="Delete" title="Click to delete user">
                    </a>
                </td>
                <td>
                    <a href="manageuser.php?id=<?= base64_encode($users['result'][$l]->idUser);?>">
                        <img src="images/edit.png" alt="Edit" width="18" title="Click to edit title">
                    </a>
                </td>
            </tr>
        <?php }?>
        </tbody>
    </table>
<a class="bottom"><img src="images/up.png"></a>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
<script src="js/sign_in_up.js"></script>
<script src="js/scroll.js"></script>
<script>
    function validate(){
        if($('#accessLevel').val() == -1){
            if($('#accessLevel').val() == -1)
                $('#accessLevel').css('border','1px solid red');
            return false;
        }else{
            return true;
        }
    }
</script>
<?php
if(isset($_POST['submit']) && !isset($_GET['id'])){
    $res = $_pdo->insert('user',array('userName'=>$_POST['userName'],'email'=>$_POST['email'],'contactNumber' => $_POST['contactNumber'],'password' => md5($_POST['password']),'accessLevel' => $_POST['accessLevel'],'idCompany' => $_SESSION['companyid']));
    if($res['status'] = 'success' && $res['rowsAffected'] == 1){
        header('location:manageuser.php');
    }
}else if(isset($_POST['submit']) && $_GET['id']){
    $res = $_pdo->update('user',array('userName'=>$_POST['userName'],'email'=>$_POST['email'],'contactNumber' => $_POST['contactNumber'],'password' => md5($_POST['password']),'accessLevel' => $_POST['accessLevel'],'idCompany' => $_SESSION['companyid']),'where idUser = ?',array(base64_decode($_GET['id'])));
    if($res['status'] = 'success' && $res['rowsAffected'] == 1){
        header('location:manageuser.php');
    }
}
?>
</body>
</html>