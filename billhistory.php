<?php
require_once('autoload.php');
session_start();
$_pdo = new pdocrudhandler();
$billTitles = $_pdo->select('billtitle',array('*'));
if($_SESSION['accesslevel'] == 1000){
    $companies = $_pdo->select('company',array('*'));
}else{
    $companies = $_pdo->select('company',array('*'),'where idCompany = ?',array($_SESSION['companyid']));
}
$rows = $_pdo->select('oldbills',array('*'),'where deletedFromPrimaryTables = ?',array(0));
if($rows ['rowsAffected'] == 0){header('location:index.php');}
if(isset($_POST['billtype']) && $_POST['billtype'] != "-1"){
    $qry = "select pair,timeStamp,group_concat(cname) as cname,group_concat(caddress) as caddress,group_concat(companyName) as companyName,
    group_concat(billType) as billType,group_concat(meterNumber) as meterNumber,
    group_concat(previousReading) as previousReading,group_concat(oldReadTime) as oldReadTime,
    group_concat(currentReading) as currentReading,group_concat(newReadTime) as newReadTime,
    group_concat(energyUsed) as energyUsed,group_concat(unitPrice) as unitPrice,group_concat(charges) as charges
    from oldbills where deletedFromPrimaryTables = ? and idCompany = ? and idBillTitle = ? group by pair order by idOldBills desc";
    $temp1 = explode("_",$_POST['cname'])[1];
    $temp2 = explode("_",$_POST['billtype'])[1];
    $res = $_pdo->customSelect($qry,array(0,$temp1,$temp2));
    if($res['rowsAffected'] > 1){
        for($i=0;$i<count($res['result']);$i++){
            $cnameArr[] = explode(',',$res['result'][$i]->cname);
            $caddressArr[] = explode(',',$res['result'][$i]->caddress);
            $companyNameArr[] = explode(',',$res['result'][$i]->companyName);
            $billTypeArr[] = explode(',',$res['result'][$i]->billType);
            $meterNumerArr[] = explode(',',$res['result'][$i]->meterNumber);
            $previousReadingArr[] = explode(',',$res['result'][$i]->previousReading);
            $oldReadTimeArr[] = explode(',',$res['result'][$i]->oldReadTime);
            $currentReadingArr[] = explode(',',$res['result'][$i]->currentReading);
            $newReadTimeArr[] = explode(',',$res['result'][$i]->newReadTime);
            $energyUsedArr[] = explode(',',$res['result'][$i]->energyUsed);
            $unitPriceArr[] = explode(',',$res['result'][$i]->unitPrice);
            $chargesArr[] = explode(',',$res['result'][$i]->charges);
            $date[] = date("F j, Y, g:i a",strtotime($res['result'][$i]->timeStamp));
            $pairArr[] = $res['result'][$i]->pair;
        }
    }elseif($res['rowsAffected'] != 0){
        $cnameArr[] = explode(',',$res['result']->cname);
        $caddressArr[] = explode(',',$res['result']->caddress);
        $companyNameArr[] = explode(',',$res['result']->companyName);
        $billTypeArr[] = explode(',',$res['result']->billType);
        $meterNumerArr[] = explode(',',$res['result']->meterNumber);
        $previousReadingArr[] = explode(',',$res['result']->previousReading);
        $oldReadTimeArr[] = explode(',',$res['result']->oldReadTime);
        $currentReadingArr[] = explode(',',$res['result']->currentReading);
        $newReadTimeArr[] = explode(',',$res['result']->newReadTime);
        $energyUsedArr[] = explode(',',$res['result']->energyUsed);
        $unitPriceArr[] = explode(',',$res['result']->unitPrice);
        $chargesArr[] = explode(',',$res['result']->charges);
        $date[] = date("F j, Y, g:i a",strtotime($res['result']->timeStamp));
        $pairArr[] = $res['result']->pair;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="images/bill.ico"/>
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bill Generation History</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/scroll.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.min.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</head>
<body>
<div class="row" style="margin-top: 5px;">
    <div class="col-xs-12 col-md-12"><a href="index.php" class="btn btn-success btn-block btn-lg">Go Home</a></div>
</div>
<a class="top"><img src="images/down.png"></a>
</br>
<form method="post">
    <div class="form-group">
        <!--<input type="text" name="cname" id="cname" class="form-control input-lg" placeholder="Company Name" value="<?php /*if(isset($_POST['cname'])){echo $_POST['cname'];}*/?>" required>-->
        <select class="form-control" id="cname" name="cname" required>
            <?php for($l=0;$l<count($companies['result']);$l++){?>
                <option <?php if(isset($_POST['cname']) && $_POST['cname'] == $companies['result'][$l]->companyName."_".$companies['result'][$l]->idCompany) echo "selected";?> value="<?= $companies['result'][$l]->companyName."_".$companies['result'][$l]->idCompany?>"><?= $companies['result'][$l]->companyName;?></option>
            <?php } ?>
        </select>
    </div>
    <div class="form-group">
        <!--<label for="sel1">Select list:</label>-->
        <select class="form-control" id="billtype" name="billtype" required title="This will display as your bill heading" onchange="this.form.submit()">
            <option value="-1">Select Bill Title</option>
            <?php for($l=0;$l<count($billTitles['result']);$l++){?>
                <option <?php if(isset($_POST['billtype']) && $_POST['billtype'] == $billTitles['result'][$l]->title."_". $billTitles['result'][$l]->idBillTitle) echo "selected";?> value="<?= $billTitles['result'][$l]->title."_". $billTitles['result'][$l]->idBillTitle?>"><?= $billTitles['result'][$l]->title;?></option>
            <?php } ?>
        </select>
    </div>
</form>
<?php
if(isset($res['rowsAffected']) && $res['rowsAffected'] != 0){
for($j=0;$j<count($res['result']);$j++){
?>
<form method="post">
<h3 class="bg-info text-center"><?= $date[$j]." - Bills";?></h3>
<table class="table table-hover table-bordered table-responsive" style="font-size: 12px;">
    <thead>
    <tr>
        <th>S.No.</th>
        <th>Company Name</th>
        <th>Customer Name</th>
        <th>Customer Address</th>
        <th>Bill Title</th>
        <th>Meter Number</th>
        <th>Old Reading</th>
        <th>Old Readout time</th>
        <th>Current Reading</th>
        <th>New Readout time</th>
        <th>Energy Used</th>
        <th>Unit Price</th>
        <th>Charges</th>
    </tr>
    </thead>
    <tbody>
    <?php for($k=0;$k<count($cnameArr[$j]);$k++){;?>
        <tr>
            <td><?= $k+1;?></td>
            <td><?= $companyNameArr[$j][$k]?></td>
            <td><?= $cnameArr[$j][$k]?></td>
            <td><?= $caddressArr[$j][$k]?></td>
            <td><?= $billTypeArr[$j][$k]?></td>
            <td><?= $meterNumerArr[$j][$k]?></td>
            <td><?= $previousReadingArr[$j][$k]?></td>
            <td><?= $oldReadTimeArr[$j][$k]?></td>
            <td><?= $currentReadingArr[$j][$k]?></td>
            <td><?= $newReadTimeArr[$j][$k]?></td>
            <td><?= $energyUsedArr[$j][$k]?></td>
            <td><?= $unitPriceArr[$j][$k]?></td>
            <td><?= $chargesArr[$j][$k]?></td>
        </tr>
    <?php }?>
    </tbody>
</table>
<div class="row">
    <div class="col-xs-12 col-md-12">
        <a class="btn btn-primary btn-block btn-lg" href="pdfs/<?=str_replace(",","-",$pairArr[$j])?>" target="_blank">Generate PDF</a>
    </div>
</div>
</form>
<?php }}else{
    ?><h3 class="text-danger bg-danger text-center">No bills available for selected company & bill type</h3><?php
}?>
<a class="bottom"><img src="images/up.png"></a>
<script>
    $(document).ready(function(){
        $('.top').click(function () {
            $('html, body').animate({scrollTop:$(document).height()}, 'slow');
            return false;
        });
        $('.bottom').click(function () {
            $('html, body').animate({scrollTop:0}, 'slow');
            return false;
        });
    });
</script>
</body>
</html>