<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type="image/png" href="images/bill.ico"/>
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Bill Generated Successfully</title>
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
    <a class="top"><img src="images/down.png"></a>
    <h3 class="bg-success text-center">Sussessfully generated the following bills! </h3>
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
        <?php
        for($k=0;$k<count($_SESSION['bills']['result']);$k++){?>
        <tr>
            <td><?= $k+1;?></td>
            <td><?= $_SESSION['bills']['result'][$k]->companyName;?></td>
            <td><?= $_SESSION['bills']['result'][$k]->cname;?></td>
            <td><?= $_SESSION['bills']['result'][$k]->caddress;?></td>
            <td><?= $_SESSION['bills']['result'][$k]->billType;?></td>
            <td><?= $_SESSION['bills']['result'][$k]->meternum;?></td>
            <td><?= round($_SESSION['bills']['result'][$k]->previousReading,3);?></td>
            <td><?= $_SESSION['bills']['result'][$k]->oldReadTime;?></td>
            <td><?= round($_SESSION['bills']['result'][$k]->currentReading,3);?></td>
            <td><?= $_SESSION['bills']['result'][$k]->newReadTime;?></td>
            <td><?= round($_SESSION['bills']['result'][$k]->energyUsed,3)." - ".$_SESSION['bills']['result'][$k]->unit;?></td>
            <td><?= $_SESSION['currency'].". ".$_SESSION['bills']['result'][$k]->unitPrice;?></td>
            <td><?= $_SESSION['currency'].". ".ceil($_SESSION['bills']['result'][$k]->charges);?></td>

        </tr>
        <?php
        }
        require_once('html2pdf.php');
        html2pdf();
        ?>
        </tbody>
    </table>
    <form method="post">
    <div class="row">
        <div class="col-xs-12 col-md-12">
            <input type="submit" value="Generate PDF" name="generateBills" class="btn btn-primary btn-block btn-lg" tabindex="7">
        </div>
    </div>
    <div class="row" style="margin-top: 5px;">
        <div class="col-xs-12 col-md-12"><a href="index.php" class="btn btn-info btn-block btn-lg">Go Home</a></div>
    </div>
    </form>
    <a class="bottom"><img src="images/up.png"></a>
    <?php
    if(isset($_POST['generateBills'])){
        header('location:pdfs/'.$_SESSION['pair']);
    }
    ?>
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