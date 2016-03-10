<?php
require_once('autoload.php');
$user = new user();
$user->checklogin();
$_pdo = new pdocrudhandler();
$billTitles = $_pdo->select('billtitle',array('*'));
if(isset($_GET['id'])){
    $editRes = $_pdo->select('billtitle',array('*'),'where idBillTitle = ?',array($_GET['id']));
    $editTitleName = $editRes['result'][0]->title;
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
    <title>Manage Bill Titles</title>
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
                    <h2><?=(isset($_GET['id'])) ? "Edit Bill Title" : "Add Bill Title"?></h2>
                    <hr class="colorgraph">
                    <div class="form-group">
                        <input type="text" name="title" id="title" class="form-control input-lg" placeholder="Enter new title here..." value="<?= (isset($_GET['id'])) ? $editTitleName : ''?>">
                    </div>
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
    <h3 class="bg-info text-center">Available titles in system</h3>
    <table table class="table table-hover table-bordered table-responsive">
        <thead>
        <tr>
            <th>S.No.</th>
            <th>Title</th>
            <th>Remove</th>
            <th>Edit</th>
        </tr>
        </thead>
        <tbody>
        <?php for($l=0;$l<count($billTitles['result']);$l++){?>
            <tr>
                <td><?=$l+1; ?></td>
                <td><?= $billTitles['result'][$l]->title; ?></td>
                <td>
                    <a href="removetitle.php?id=<?= $billTitles['result'][$l]->idBillTitle;?>">
                        <img src="images/delete.png" alt="Delete" title="Click to delete title">
                    </a>
                </td>
                <td>
                    <a href="billtype.php?id=<?= $billTitles['result'][$l]->idBillTitle;?>">
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
<?php
if(isset($_POST['submit']) && !isset($_GET['id'])){
    $res = $_pdo->insert('billtitle',array('title'=>$_POST['title'],'idUser'=>$_SESSION['userid'],'timeStamp'=>date('Y-m-d h:i:s')));
    if($res['status'] = 'success' && $res['rowsAffected'] == 1){
        header('location:billtype.php');
    }
}else if(isset($_POST['submit']) && $_GET['id']){
    $res = $_pdo->update('billTitle',array('title'=>$_POST['title'],'timeStamp'=>date('Y-m-d h:i:s')),'where idBillTitle = ?',array($_GET['id']));
    if($res['status'] = 'success' && $res['rowsAffected'] == 1){
        header('location:billtype.php');
    }
}
?>
</body>
</html>