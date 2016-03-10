<?php
require_once('autoload.php');
$user = new user();
$user->checklogin();
if($_SESSION['accesslevel'] == 10) header('location:login.php');
$_pdo = new pdocrudhandler();
//$rows = $_pdo->select('bill');
//if($rows ['rowsAffected'] == 0){header('location:index.php');}
//echo $rows ['rowsAffected']; exit;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="images/loginfavicon.png"/>
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Reset Database</title>
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
    <div class="row" style="margin-top:20px">
        <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
            <form method="post">
                <fieldset id="fieldset" <?php echo isset($_GET['status']) ? "style='display:none;'" : ""?>>
                    <h2>Refresh Database OR Factory Reset</h2>
                    <hr class="colorgraph">
                    <div class="form-group">
                        <b class="alert-danger">All the data related to bill generation will be removed. Are you sure you want to do it?<b>
                    </div>
                    <hr class="colorgraph">
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <input type="submit" class="btn btn-lg btn-success btn-block" value="Yes, Reset">
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
    <?php
    if(isset($_GET['status'])){
    if($_GET['status'] == 'success'){
        ?>
        <div class="alert alert-success" role="alert" id="success" style="margin-top: 10px;">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span id="successMsg">Database has been successfully reset to factory settings. <a href="index.php">Go Home</a></span>
        </div>
        <?php
    }elseif($_GET['status'] == 'empty'){
        ?>
        <div class="alert alert-danger" role="alert" id="success" style="margin-top: 10px;">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span id="successMsg">Cannot perform reset, nothing to reset. <a href="index.php">Go Home</a></span>
        </div>
        <?php
    }elseif($_GET['status'] == 'ukerr'){
        ?>
        <div class="alert alert-danger" role="alert" id="success" style="margin-top: 10px;">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span id="successMsg">Unknown error occurred, cannot perform reset, contact administrator. <a href="index.php">Go Home</a></span>
        </div>
    <?php
    }}
    ?>
</div>
<a class="bottom"><img src="images/up.png"></a>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
<script src="js/sign_in_up.js"></script>
<script src="js/scroll.js"></script>
<?php
if(isset($_POST['submit']) && !isset($_GET['status'])){
    $ids ="";
    /*$res = $_pdo->select('bill',array('idBillGenerationHistory'));
    $inClause = "(";
    for($i=0;$i<count($res['result']);$i++){
        $inClause .= ($i < count($res['result'])-1) ? "?," : "?";
        $whereClauseValArr[] = $res['result'][$i]->idBillGenerationHistory;
    }
    $inClause .= ")";*/
    $disIds = $_pdo->customSelect('select distinct (idBillGenerationHistory) from bill');
    if($disIds['rowsAffected'] == 1){
        $ids = $disIds['result']->idBillGenerationHistory;
    }elseif($disIds['rowsAffected'] > 1){
        for($i=0;$i<count($disIds['result']);$i++){
            $ids .= ($i < count($disIds['result'])-1) ? $disIds['result'][$i]->idBillGenerationHistory."," : $disIds['result'][$i]->idBillGenerationHistory;
        }
    }
    //$rowsAff = $_pdo->update('oldbills',array('deletedFromPrimaryTables' => 1,'dateDeletedFromPrimaryTables' => date('Y-m-d h:i:d')),'where idBillingHistory1 and idBillingHistory2 in '.$inClause,$whereClauseValArr);
    $undel = $_pdo->select('oldbills',array('*'),'where deletedFromPrimaryTables = ?', array(0));
    if($undel['rowsAffected'] > 0){
    $rowsAff = $_pdo->update('oldbills',array('deletedFromPrimaryTables' => 1,'dateDeletedFromPrimaryTables' => date('Y-m-d h:i:d')));
    if($rowsAff['rowsAffected'] > 0){
        $_pdo->truncate('bill');
        $_pdo->truncate('billgenerationhistory');
        $files = glob('pdfs/*'); // get all file names
        foreach($files as $file){ // iterate files
            if(is_file($file))
                unlink($file); // delete file
        }
        $_pdo->insert('truncatehistory',array('idUser' => $_SESSION['userid'],'`table`' => "bill,billgenerationhistory",'timeStamp' => date('Y-m-d h:i:s'),'truncate' => 1,'idBillGenerationHistory' => $ids));
        header('location:resetdb.php?status=success');
    }else{
        header('location:resetdb.php?status=ukerr');
    }
    }else{
        header('location:resetdb.php?status=empty');
    }
}
?>
</body>
</html>