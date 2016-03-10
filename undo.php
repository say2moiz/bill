<?php
require_once('autoload.php');
$user = new user();
$user->checklogin();
if($_SESSION['accesslevel'] == 10) header('location:login.php');
$_pdo = new pdocrudhandler();
$res = $_pdo->select('billgenerationhistory',array('idBillGenerationHistory'),'order by idBillGenerationHistory desc limit 1');
$res2 = $_pdo->select('billgenerationhistory',array('*'));
if($res['rowsAffected'] == 0 || $res2['rowsAffected'] < 2){
    header('location:index.php');
}
$res1 = $_pdo->select('oldbills',array('*'),'where idBillingHistory2 = ? and deletedFromPrimaryTables = ?',array($res['result'][0]->idBillGenerationHistory,0));
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
    <span <?php echo isset($_GET['status']) ? "style='display:none;'" : "" ?>>
    <h3 class="bg-danger text-center">You generated the following bills last time. Are you sure, you want to undo this?</h3>
    <table table class="table table-hover table-bordered table-responsive" style="font-size: 12px;">
        <thead>
        <tr>
            <th>S.No.</th>
            <th>Meter Number</th>
            <th>Company Name</th>
            <th>Bill Title</th>
            <th>Customer Name</th>
            <th>Customer Address</th>
            <th>Old Reading</th>
            <th>Old Readout time</th>
            <th>Current Reading</th>
            <th>New Readout Time</th>
            <th>Energy Used</th>
            <th>Unit Price</th>
            <th>Charges</th>
        </tr>
        </thead>
        <tbody>
        <?php for($l=0;$l<count($res1['result']);$l++){
            $delFile = $res1['result'][$l]->pair;
            ?>
            <tr>
                <td><?=$l+1; ?></td>
                <td><?= $res1['result'][$l]->meterNumber; ?></td>
                <td><?= $res1['result'][$l]->companyName; ?></td>
                <td><?= $res1['result'][$l]->billType; ?></td>
                <td><?= $res1['result'][$l]->cname; ?></td>
                <td><?= $res1['result'][$l]->caddress; ?></td>
                <td><?= $res1['result'][$l]->previousReading; ?></td>
                <td><?= $res1['result'][$l]->oldReadTime; ?></td>
                <td><?= $res1['result'][$l]->currentReading; ?></td>
                <td><?= $res1['result'][$l]->newReadTime; ?></td>
                <td><?= $res1['result'][$l]->energyUsed; ?></td>
                <td><?= $res1['result'][$l]->unitPrice; ?></td>
                <td><?= $res1['result'][$l]->charges; ?></td>
            </tr>
        <?php }?>
        </tbody>
    </table>
    <div class="row" style="margin-top:20px">
        <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
            <form method="post">
                <fieldset>
                    <div class="row" style="margin-top: 5px;">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <a href="index.php" class="btn btn-info btn-block btn-lg">Go Home</a>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <input type="submit" name="undo" class="btn btn-lg btn-danger btn-block" value="Undo">
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
    </span>
    <?php
    if(isset($_GET['status'])){
        if($_GET['status'] == 'success'){
            ?>
            <div class="alert alert-success" role="alert" id="success" style="margin-top: 10px;">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                <span id="successMsg">You have successfully un done the last bill generation transaction. <a href="index.php">Go Home</a></span>
            </div>
        <?php
        }}
    ?>
<a class="bottom"><img src="images/up.png"></a>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
<script src="js/sign_in_up.js"></script>
<script src="js/scroll.js"></script>
<?php
if(isset($_POST['undo']) && !isset($_GET['status'])){
    $rowsAff = $_pdo->update('oldbills',array('deletedFromPrimaryTables' => 1,'dateDeletedFromPrimaryTables' => date('Y-m-d h:i:d')),'where idBillingHistory2 = ?',array($res['result'][0]->idBillGenerationHistory));
    if($rowsAff['rowsAffected'] > 0){
        $_pdo->delete('bill','where idBillGenerationHistory = ?',array($res['result'][0]->idBillGenerationHistory));
        $_pdo->delete('billgenerationhistory','where idBillGenerationHistory = ?',array($res['result'][0]->idBillGenerationHistory));
        $pair = explode(',',$delFile);
        $link = $pair[0]."-".$pair[1];
        unlink('pdfs/'.$link); // delete file
        $_pdo->insert('truncatehistory',array('idUser' => $_SESSION['userid'],'`table`' => "bill,billgenerationhistory",'timeStamp' => date('Y-m-d h:i:s'),'`undo`' => 1,'idBillGenerationHistory' => $res['result'][0]->idBillGenerationHistory));
        header('location:undo.php?status=success');
    }
}
?>
</body>
</html>