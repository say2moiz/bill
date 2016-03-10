<?php
header('Content-Type: text/html; charset=ISO-8859-1');
require_once('autoload.php');
$user = new user();
$user->checklogin();
$_pdo = new pdocrudhandler();
$currencies = $_pdo->select('currency',array('*'),'order by currencyShortName');
$billTitles = $_pdo->select('billtitle',array('*'));
$companies = ($_SESSION['accesslevel'] == 1000)? $_pdo->select('company',array('*')) : $_pdo->select('company',array('*'),'where idCompany = ?',array($_SESSION['companyid']));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <link rel="shortcut icon" type="image/png" href="images/bill.ico"/>
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Billing Form</title>
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
<a class="top" style="display: none;"><img src="images/down.png"></a>
<div id="hideForm">
<div class="container">
    <div class="row" style="margin-top:20px">
        <div class="alert alert-danger" role="alert" id="error" style="display: none;">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span class="sr-only">Error:</span>
            <span id="errorMsg"></span>
        </div>
        <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
            <form role="form" method="post" enctype="multipart/form-data" onsubmit=" return validate();">
                <fieldset>
                    <h2>Billing Form</h2>
                    <hr class="colorgraph">
                    <div class="form-group">
                        <!--<input type="text" name="cname" id="cname" class="form-control input-lg" placeholder="Company Name" value="<?php /*if(isset($_POST['cname'])){echo $_POST['cname'];}*/?>" required>-->
                        <select class="form-control" id="cname" name="cname">
                            <!--<option value="-1">Select Company</option>-->
                            <?php for($l=0;$l<count($companies['result']);$l++){?>
                                <option value="<?= $companies['result'][$l]->companyName."_".$companies['result'][$l]->idCompany?>"><?= $companies['result'][$l]->companyName;?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input title="Use commas to break the address line" type="text" name="caddress" id="caddress" value="<?php if(isset($_POST['caddress'])){echo $_POST['caddress'];}?>" class="form-control input-lg" placeholder="Company Address"  required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="cphone" id="cphone" value="<?php if(isset($_POST['cphone'])){echo $_POST['cphone'];}?>" class="form-control input-lg" placeholder="Phone Number" required>
                    </div>
                    <div class="form-group">
                        <!--<label for="sel1">Select list:</label>-->
                        <select class="form-control" id="billtype" name="billtype" title="This will display as your bill heading">
                            <option value="-1">Select Bill Title</option>
                            <?php for($l=0;$l<count($billTitles['result']);$l++){?>
                            <option value="<?= $billTitles['result'][$l]->title."_". $billTitles['result'][$l]->idBillTitle?>"><?= $billTitles['result'][$l]->title;?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <input type="text" name="uprice" id="uprice" value="<?php if(isset($_POST['uprice'])){echo $_POST['uprice'];}?>" class="form-control input-lg" placeholder="Unit Price" required>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <select class="form-control" style="height: 46px;" name="currency" id="currencies">
                                <option value="-1">Select Currency</option>
                                <?php for($l=0;$l<count($currencies['result']);$l++){?>
                                <option value="<?= $currencies['result'][$l]->currencyShortName;?>"><?= $currencies['result'][$l]->currencyShortName;?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <span class="uploadLabel">Browse Excel File</span><input type="file" name="filename"/>
                    <hr class="colorgraph">
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <input type="submit" value="Submit" class="btn btn-primary btn-block btn-lg" tabindex="7" required>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <a href="login.php" class="btn btn-danger btn-block btn-lg">Logout</a>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 5px;">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <a href="index.php" class="btn btn-info btn-block btn-lg">Go Home</a>
                        </div>
                    </div>
                </fieldset>
                <input type="hidden" name="submit">
            </form>
        </div>
    </div>
</div>
</div>
<?php
if(isset($_GET['status'])){
if($_GET['status'] == 'ok'){
    ?>
    <div class="alert alert-success" role="alert" id="success" style="margin-top: 10px;">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <span id="successMsg">It seems you are using the software for the first time, no previous data found. So please process 1 more file to generate bills.</span>
    </div>
<?php
}}
?>
<script>
    function validate(){
        if($('#currencies').val() == -1 || $('#billtype').val() == -1){
            if($('#currencies').val() == -1)
                $('#currencies').css('border','1px solid red');
            if($('#billtype').val() == -1)
                $('#billtype').css('border','1px solid red');
            return false;
        }else{
            return true;
        }
    }
    $('#billtype').change(function(){
        $('#billtype').css('border','');
    });
    $('#currencies').change(function(){
        $('#currencies').css('border','');
    });
</script>
<?php
if(isset($_POST['submit'])){
    uploadfile($_POST);
    if($_POST['billtype'] == -1){
        echo "<script>$('#errorMsg').html('Please select the bill type');$('#error').show();</script>";
    }
}
if(isset($_POST['validate'])){
    for ($i=0;$i<5;$i++){
        if($i==0){
            $search_string = 'cname';
        }elseif($i==1){
            $search_string = 'caddress';
        }elseif($i==2){
            $search_string = 'meternum';
        }elseif($i==3){
            $search_string = 'readtime';
        }elseif($i==4){
            $search_string = 'reading';
        }
        foreach ($_POST as $key => $string) {
            if (strpos($string, $search_string) === 0) {
                $validColsArr[] = $string;
            }
        }
    }
    for($i=0;$i<count($validColsArr);$i++){
        $tempValidCol = explode("_",$validColsArr[$i]);
        $newValidColArr[$tempValidCol[1]] = $tempValidCol[0];
    }
    $colToBeRemoved1 = array_keys($_POST,'-1');
    $colToBeRemoved2 = array_keys($_POST,'100');
    $colToBeRemoved = array_unique(array_merge($colToBeRemoved1,$colToBeRemoved2));
    $arrToBeProcessed = array_diff($_POST,array_splice($_POST,0,$_SESSION['colcount']));
    array_pop($arrToBeProcessed);
    foreach($arrToBeProcessed as $keys => $values){
        $newArr = explode('_',$keys);
        if(!in_array($newArr[1],$colToBeRemoved)){
            $postColDeleteArr[$newArr[0]][] = $keys;
        }
    }
    $resArr = $_pdo->insert('billGenerationHistory',array('date' => date('Y-m-d h:i:s'),'idBillTitle' => $_SESSION['idbilltype'],'idCompany' => $_SESSION['idcompany'], 'idUser' => $_SESSION['userid'], 'unitPrice' => $_SESSION['uprice'], 'fileName' => $_SESSION['filename']));
    for($j=0;$j<count($postColDeleteArr);$j++){
        for($i=0;$i<count($validColsArr);$i++){
            $finalArr[$j][] = $_POST[$postColDeleteArr[$j][$i]];
        }
    }
    ksort($newValidColArr);
    $newValidColArr = array_values($newValidColArr);
    for($j=0;$j<count($finalArr);$j++){
        for($i=0;$i<count($finalArr[$j]);$i++){
            if($newValidColArr[$i] == 'readtime'){
                $finalArr[$j][$i] = date('Y-m-d h:i:s',strtotime($finalArr[$j][$i]));
            }
            if($newValidColArr[$i] == 'reading' && strpos($finalArr[$j][$i],'MWh') > 0){
                $temp1 = explode("MWh",$finalArr[$j][$i]);
                $finalArr[$j][$i] = $temp1[0];
                $newFinalArr[$j]['unit'] = 'MWh';
            }
            if($newValidColArr[$i] == 'reading' && strpos($finalArr[$j][$i],'kWh') > 0){
                $temp1 = explode("kWh",$finalArr[$j][$i]);
                $finalArr[$j][$i] = $temp1[0];
                $newFinalArr[$j]['unit'] = 'kWh';
            }
            $newFinalArr[$j][$newValidColArr[$i]] = $finalArr[$j][$i];
        }
        $newFinalArr[$j]['companyAddress'] = $_SESSION['caddress'];
        $newFinalArr[$j]['companyName'] = $_SESSION['cname'];
        $newFinalArr[$j]['idCompany'] = $_SESSION['idcompany'];
        $newFinalArr[$j]['companyPhone'] = $_SESSION['cphone'];
        $newFinalArr[$j]['billType'] = $_SESSION['billtype'];
        $newFinalArr[$j]['idBillTitle'] = $_SESSION['idbilltype'];
        $newFinalArr[$j]['idUser'] = $_SESSION['userid'];
        $newFinalArr[$j]['idBillGenerationHistory'] = $resArr['lastInsertedId'];
    }
    for($j=0;$j<count($finalArr);$j++){
        $_pdo->insert('bill',$newFinalArr[$j]);
    }
    $res = $_pdo->select('billgenerationhistory',array('*'),' where idCompany = ? and idBillTitle = ? order by idBillGenerationHistory desc limit 2',array($_SESSION['idcompany'],$_SESSION['idbilltype']));
    if($res['rowsAffected'] > 1){
        $qry = "select b1.idBill as idBill1,b2.idBill as idBill2,b1.meternum,b1.reading as previousReading,b2.reading as currentReading,
        (b2.reading-b1.reading) as energyUsed,(select unitPrice from billgenerationhistory
        where idBillGenerationHistory = b2.idBillGenerationHistory) as unitPrice,
        (b2.reading-b1.reading)*(select unitPrice from billgenerationhistory where
        idBillGenerationHistory = b2.idBillGenerationHistory) as charges,
        b1.unit,b2.cname,b2.caddress,b2.companyName,b2.companyAddress,b2.companyPhone,b2.billType,b2.readtime as oldReadTime,b1.readtime as newReadTime
        from bill b1 join bill b2 on b1.meternum=b2.meternum
        where b1.idBillGenerationHistory = ? and b2.idBillGenerationHistory = ? order by b1.idBill";
        $res1 = $_pdo->customSelect($qry,array($res['result'][1]->idBillGenerationHistory,$res['result'][0]->idBillGenerationHistory));
        for($k=0;$k<count($res1['result']);$k++){
            $_pdo->insert('oldbills',array('cname' => $res1['result'][$k]->cname, 'caddress' => $res1['result'][$k]->caddress, 'companyName' => $res1['result'][$k]->companyName, 'companyAddress' => $res1['result'][$k]->companyAddress, 'companyPhone' => $res1['result'][$k]->companyPhone, 'billType' => $res1['result'][$k]->billType,'meterNumber' => $res1['result'][$k]->meternum, 'previousReading' => round($res1['result'][$k]->previousReading,3), 'oldReadTime' => $res1['result'][$k]->oldReadTime, 'currentReading' => round($res1['result'][$k]->currentReading,3), 'newReadTime' => $res1['result'][$k]->newReadTime, 'energyUsed' => round($res1['result'][$k]->energyUsed,3)." - ".$res1['result'][$k]->unit, 'unitPrice' => $_SESSION['currency'].". ".$res1['result'][$k]->unitPrice, 'charges' => $_SESSION['currency'].". ".ceil($res1['result'][$k]->charges), 'idBillingHistory1' => $res['result'][1]->idBillGenerationHistory, 'idBillingHistory2' => $res['result'][0]->idBillGenerationHistory,'pair'=> $res['result'][1]->idBillGenerationHistory.",".$res['result'][0]->idBillGenerationHistory, 'billingHistoryDate1' => $res['result'][1]->date, 'billingHistoryDate2' => $res['result'][0]->date,'idBill1' => $res1['result'][$k]->idBill1, 'idBill2' => $res1['result'][$k]->idBill2,'idBillTitle' => $_SESSION['idbilltype'],'idCompany' => $_SESSION['idcompany'], 'timeStamp' => date('Y-m-d h:i:s'), 'fileName' => $_SESSION['filename'], 'idUser' => $_SESSION['userid']));
        }
        $_SESSION['bills'] = $res1;
        $_SESSION['pair'] = $res['result'][1]->idBillGenerationHistory."-".$res['result'][0]->idBillGenerationHistory;
        header('location:generatebills.php');
    }else{
        header('location:s1.php?status=ok');
    }
}
function readCSV($filename){
    $finalArr = array();
    $file = fopen($filename,"r");
    while(($data = fgetcsv($file))!== FALSE)
    {
        $rowString = '';
        for($i=0;$i<count($data);$i++){
            $rowString .= $data[$i];
            $rowString .= ";";
        }
        $rowString = rtrim($rowString,";");
        $finalArr[] = explode(";",$rowString);
    }
    //$_SESSION['colcount'] = count($finalArr[0]);
    return $finalArr;
}

function uploadfile($formArr){
    if(isset($_FILES['filename']) && $_FILES['filename']['error'] > 0){
        switch ($_FILES['filename']['error']) {
            case UPLOAD_ERR_INI_SIZE:
                echo "<script>$('#errorMsg').html('The File <b>".$_FILES['filename']['name']."</b> Exceeds The Maximum Permitted Size <i> 10 MB</i>');$('#error').show();</script>";
                break;
            case UPLOAD_ERR_FORM_SIZE:
                echo "<script>$('#errorMsg').html('The File <b>".$_FILES['filename']['name']."</b> Exceeds The Maximum Permitted Size <i> 10 MB</i>');$('#error').show();</script>";
                break;
            case UPLOAD_ERR_PARTIAL:
                echo "<script>$('#errorMsg').html('The Uploaded File Was Only Partially Uploaded');$('#error').show();</script>";
                break;
            case UPLOAD_ERR_NO_FILE:
                echo "<script>$('#errorMsg').html('Please select any excel file before you proceed');$('#error').show();</script>";
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
                echo "<script>$('#errorMsg').html('Missing A Temporary Folder');$('#error').show();</script>";
                break;
            case UPLOAD_ERR_CANT_WRITE:
                echo "<script>$('#errorMsg').html('Failed To Write File To Disk');$('#error').show();</script>";
                break;
            case UPLOAD_ERR_EXTENSION:
                echo "<script>$('#errorMsg').html('File Upload Stopped By Extension');$('#error').show();</script>";
                break;
            default:
                echo "<script>$('#errorMsg').html('Unknown Upload Error');$('#error').show();</script>";
                break;
        }
    }else{
        if(isset($_FILES['filename']) ){
            $type = explode('.',$_FILES['filename']['name']);
            if ($type[1] == "csv"){
                $filename = $_FILES['filename']['name'];
                if (is_uploaded_file($_FILES['filename']['tmp_name'])) {
                    move_uploaded_file($_FILES['filename']['tmp_name'], "importedfiles/" . $filename);
                    $dataArr = readCSV('importedfiles/'.$filename);
                    $_SESSION['colcount'] = count($dataArr[0]);
                    $_SESSION['filename'] = $filename;
                    ?>
                    <h3 class="bg-primary text-center">Company Details Filled In Form</h3>
                    <table class="table table-hover table-bordered table-responsive">
                        <thead>
                            <tr>
                                <th>Company Name</th>
                                <th>Company Address</th>
                                <th>Phone Number</th>
                                <th>Bill Type</th>
                                <th>Unit Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php $_SESSION['currency'] = $formArr['currency'];?>
                                <td><?= explode("_",$formArr['cname'])[0]; $_SESSION['cname'] =  explode("_",$formArr['cname'])[0];?></td>
                                <td><?= $formArr['caddress']; $_SESSION['caddress'] = $formArr['caddress'];?></td>
                                <td><?= $formArr['cphone']; $_SESSION['cphone'] = $formArr['cphone'];?></td>
                                <td><?= explode("_",$formArr['billtype'])[0]; $_SESSION['billtype'] =  explode("_",$formArr['billtype'])[0];?></td>
                                <td><?= $formArr['uprice']; $_SESSION['uprice'] = $formArr['uprice'];?></td>
                                <?php
                                $temp1 = explode("_",$formArr['cname']);
                                $temp2 = explode("_",$formArr['billtype']);
                                $_SESSION['idcompany'] = $temp1[1];
                                $_SESSION['idbilltype'] = $temp2[1];
                                ?>
                            </tr>
                        </tbody>
                    </table>
                    <h3 class="bg-primary text-center">Customer Billing Details From Excel File</h3>
                    <form method="post" id="billingDetails">
                    <table class="table table-hover table-bordered table-responsive" id="excelReadTable">
                        <thead>
                        <tr>
                            <th>S.No.</th>
                            <?php for($i=0;$i<count($dataArr[0]);$i++){?>
                                <th>
                                    <script>
                                        $(document).ready(function(){
                                            $('.top').show();
                                            $('.bottom').show();
                                        });
                                    </script>
                                    <select name="<?php echo $i;?>" id="billData_<?=$i?>" onchange="validateSelectedOptions(this.id);" class="form-control deleteSelectedOption" title="Select column names. To refresh all options in drop down menu use refresh button of browser or press Ctrl+R.">
                                        <option value="-1">Select</option>
                                        <option value="cname_<?= $i?>">Customer Name</option>
                                        <option value="caddress_<?= $i?>">Address</option>
                                        <option value="meternum_<?= $i?>">Meter Number</option>
                                        <option value="reading_<?= $i?>">Reading</option>
                                        <option value="readtime_<?= $i?>">Read Out Time</option>
                                        <!--<option value="100">Don't Use</option>-->
                                    </select>
                                </th>
                            <?php }?>
                        </tr>
                        </thead>
                        <tbody>
                        <?php for($j=0;$j<count($dataArr);$j++){ ?>
                            <tr>
                                <td><?=$j+1?></td>
                                <?php for($k=0;$k<count($dataArr[$j]);$k++){ ?>
                                    <td>
                                        <?= $dataArr[$j][$k];?>
                                        <input type="hidden" value="<?= $dataArr[$j][$k];?>" name="<?= $j."_".$k?>">
                                    </td>
                                <?php }?>
                            </tr>
                        <?php }?>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-xs-12 col-md-12">
                            <input type="submit" value="Validate" name="validate" id="validate" class="btn btn-primary btn-block btn-lg" tabindex="7">
                        </div>
                    </div>
                    </form>
                    <div class="row" style="margin-top: 5px;">
                        <div class="col-xs-12 col-md-12"><a href="index.php" class="btn btn-info btn-block btn-lg">Go Home</a></div>
                    </div>
                    <script>
                        $('#hideForm').hide();
                    </script>
                <?php
                }
            }else{
                echo "<script>$('#errorMsg').html('Please upload excel file with .csv extension only');$('#error').show();</script>";
            }
        }
    }
}
?>
<a class="bottom" style="display: none;"><img src="images/up.png"></a>
<script src="js/scroll.js"></script>
<script>
    var colCount;
    $(document).ready(function(){
        $('#billingDetails').submit(function(){
            var count = 0;
            colCount = ($('#excelReadTable tr:nth-child(1) th').length);
            for(var i=2;i<colCount+1;i++){
                if(parseInt($('#excelReadTable tr:nth-child(1) th:nth-child('+i+') select').val()) != -1){
                    count++;
                }else{
                    $('#excelReadTable tr:nth-child(1) th:nth-child('+i+') select').css('border','1px solid red');
                }
            }
            var submit = (count === 5) ? true : false;
            return submit;
        });
    });
    function validateSelectedOptions(id){
        $('#'+id).css('border','');
        $('#'+id).removeClass('deleteSelectedOption');
        var selectedValue = $('#'+id).val();
        var temp = selectedValue.split("_");
        $(".deleteSelectedOption > option").each(function () {
            if (this.value.indexOf(temp[0]) > -1) {
                $(".deleteSelectedOption option[value='" + this.value +"']").remove();
            }
        });
    }
</script>
</body>
</html>