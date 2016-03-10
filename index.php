<?php
require_once('autoload.php');
$user = new user();
$user->checklogin();
$_pdo = new pdocrudhandler();
$res = $_pdo->select("user",array("*"),"where idUser = ?", array(2));
if($res['status'] = 'success' && $res['rowsAffected'] == 1){
    $username = strtoupper($_SESSION['username']);
    $userrole = ($_SESSION['accesslevel'] != 10) ? "Admin" : "General User";
    $email = $res['result'][0]->email;
    $phone = $res['result'][0]->contactNumber;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Smart Bill Maker | WingBiz Soft</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" type="text/css" href="frontpage/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="frontpage/font-awesome/css/font-awesome.min.css" />

    <script type="text/javascript" src="frontpage/js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="frontpage/bootstrap/js/bootstrap.min.js"></script>
    <style>
        .container a{text-decoration: none;}
        .tile{cursor: pointer;}
        .page-footer{width: 100%;padding-top: 9px;margin: 20px 0 40px;border-top: 1px solid #eee; text-align: center;color: #3071A9; letter-spacing:2px; }
        .page-footer b{color: #d9534f;}
        .page-header{text-align: center;}
        .dynamicTile .col-sm-2.col-xs-4{padding:5px}
        .bigicon{font-size:67px;color:#fff;margin-top:20px;margin-bottom:10px}
        .icontext{color:#fff;font-size:27px}
        .bigicondark{font-size:67px;color:#000;margin-top:20px;margin-bottom:10px}
        .icontextdark{color:#000;font-size:27px}
        .dynamicTile .col-sm-4.col-xs-8{padding:5px}
        #tile1{background:#7C91C7}
        #tile2{background:#3B579D}
        #tile3{background:#153178}
        #tile4,#tile5{background:#EACF46}
        #tile6{background:#FFED94}
        #tile7{background:#fff}
        #tile8{background:#03133C}
        #tile10,#tile9{background:#EACF46}
        #tile11{background: #d9534f;}
        #tile12{background: #269abc;}
        #tile13{background: #5cb85c;}
        #tile14{background: #ec51a3;}
        .tilecaption{position:relative;top:50%;transform:translateY(-50%);-webkit-transform:translateY(-50%);-ms-transform:translateY(-50%);margin:0!important;text-align:center;color:#fff;font-family:Segoe UI;font-weight:lighter}
    </style>

</head>
<body>
<div class="page-header">
    <h2 style="color: #d9534f;">Smart Bill Maker<small style="font-size: 14px; margin-left: 1%;color: #3071A9;">for smart meters.</small></h2>
</div>
<div class="container">
<!-- Metro Tiles - START -->
<div class="container dynamicTile">
<div class="row">
    <a href="<?= ($_SESSION['accesslevel'] != 10)? 'manageuser.php' : '#'?>">
    <div class="col-sm-2 col-xs-4">
        <div id="tile8" class="tile">
            <div class="carousel slide" data-ride="carousel" onclick="mobileAlert('<?="Hi, ".$username."!" ?>')">
                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <div class="item active text-center">
                        <div>
                            <span class="fa fa-user bigicon"></span>
                        </div>
                        <div class="icontext">
                            Hi,
                        </div>
                        <div class="icontext">
                            <?=$username."!"?>
                        </div>
                    </div>
                    <div class="item text-center">
                        <div>
                            <span class="fa fa-tasks bigicon"></span>
                        </div>
                        <div class="icontext">
                            Manage Users
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </a>
    </div>
    <div class="col-sm-4 col-xs-8">
        <div id="tile7" class="tile">
            <div class="carousel slide" data-ride="carousel">
                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <div class="item active">
                        <img src="frontpage/images/1.png" class="img-responsive" />
                    </div>
                    <div class="item">
                        <img src="frontpage/images/2.png" class="img-responsive" />
                    </div>
                    <div class="item">
                        <img src="frontpage/images/3.png" class="img-responsive" />
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="col-sm-4 col-xs-8">
        <a href="<?= ($_SESSION['accesslevel'] != 10)? 'supportinfo.php' : '#'?>">
        <div id="tile10" class="tile">
            <div class="carousel slide" data-ride="carousel"  onclick="mobileAlert('Contact support\nPhone: <?=$phone?>\nEmail: <?=$email?>')">
                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <div class="item active text-center">
                        <div>
                            <span class="fa fa-phone bigicon"></span>
                        </div>
                        <div class="icontext">
                            <?=$phone;?>
                        </div>
                    </div>
                    <div class="item text-center">
                        <div>
                            <span class="fa fa-check-circle bigicon"></span>
                        </div>
                        <div class="icontext">
                            <?=$email;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </a>
    </div>
    <div class="col-sm-2 col-xs-4">
        <div id="tile6" class="tile">
            <div class="carousel slide" data-ride="carousel">
                <!-- Wrapper for slides -->
                <div class="carousel-inner" onclick="mobileAlert('Your IP Address: <?= gethostbyname(trim(`hostname`));?>')">
                    <div class="item active text-center">
                        <div>
                            <span class="fa fa-wifi bigicondark"></span>
                        </div>
                        <div class="icontextdark">
                            <?= gethostbyname(trim(`hostname`));?>
                        </div>
                        <div class="icontextdark">
                            <span class="fa fa-check"></span>
                        </div>
                    </div>
                    <div class="item text-center">
                        <div>
                            <span class="fa fa-info-circle bigicondark"></span>
                        </div>
                        <div class="icontextdark">
                            IP Address
                        </div>
                        <div class="icontextdark">
                            <?= gethostbyname(trim(`hostname`));?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row ">
<div class="col-sm-2 col-xs-4">
    <a href="s1.php">
    <div id="tile3" class="tile">
        <div class="carousel slide" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active text-center">
                    <div>
                        <span class="fa fa-list-alt bigicon"></span>
                    </div>
                    <div class="icontext">
                        Generate
                    </div>
                    <div class="icontext">
                        Bills
                    </div>
                </div>
                <div class="item text-center">
                    <div>
                        <span class="fa fa-reddit-square bigicon"></span>
                    </div>
                    <div class="icontext">
                        Click me!
                    </div>
                    <div class="icontext">
                        For Bills
                    </div>
                </div>
            </div>
        </div>
    </div>
    </a>
</div>
<div class="col-sm-2 col-xs-4">
    <div id="tile1" class="tile">
        <div class="carousel slide" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner" >
                <div class="item active text-center" onclick="window.location.href = 'currency.php'">
                    <div>
                        <span class="fa fa-money bigicon"></span>
                    </div>
                    <div class="icontext">
                        Manage
                    </div>
                    <div class="icontext">
                        Currencies
                    </div>
                </div>
                <div class="item text-center" onclick="window.location.href = 'company.php'">
                    <div>
                        <span class="fa fa-institution bigicon"></span>
                    </div>
                    <div class="icontext">
                        Manage
                    </div>
                    <div class="icontext">
                        Companies
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-sm-2 col-xs-4">
    <div id="tile2" class="tile">
        <a href="billtype.php">
        <div class="carousel slide" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active text-center">
                    <div>
                        <span class="fa fa-header bigicon"></span>
                    </div>
                    <div class="icontext">
                        Manage
                    </div>
                    <div class="icontext">
                        Bill Titles
                    </div>
                </div>
                <div class="item text-center">
                    <div>
                        <span class="fa fa-plus-circle bigicon"></span>
                    </div>
                    <div class="icontext">
                        Add
                    </div>
                    <div class="icontext">
                        Bill Title
                    </div>
                </div>
                <div class="item text-center">
                    <div>
                        <span class="fa fa-edit bigicon"></span>
                    </div>
                    <div class="icontext">
                        Edit
                    </div>
                    <div class="icontext">
                        Bill Title
                    </div>
                </div>
                <div class="item text-center">
                    <div>
                        <span class="fa fa-remove bigicon"></span>
                    </div>
                    <div class="icontext">
                        Remove
                    </div>
                    <div class="icontext">
                        Bill Title
                    </div>
                </div>
            </div>
        </div>
        </a>
    </div>
</div>
<div class="col-sm-2 col-xs-4">
    <div id="tile3" class="tile">
        <div class="carousel slide" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active text-center" onclick="window.open('https://www.linkedin.com/in/amoiz1992','_blank')">
                    <div>
                        <span class="fa fa-linkedin bigicon"></span>
                    </div>
                    <div class="icontext">
                        WingBiz
                    </div>
                    <div class="icontext">
                        Soft
                    </div>
                </div>
                <div class="item text-center" onclick="window.open('https://www.facebook.com/wingbizsoft','_blank')">
                    <div>
                        <span class="fa fa-facebook-square bigicon"></span>
                    </div>
                    <div class="icontext">
                        WingBiz
                    </div>
                    <div class="icontext">
                        Soft
                    </div>
                </div>
                <div class="item text-center">
                    <div>
                        <span class="fa fa-skype bigicon"></span>
                    </div>
                    <div class="icontext">
                        Add Me!
                    </div>
                    <div class="icontext">
                        amoiz1992
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-sm-2 col-xs-4">
    <div id="tile3" class="tile">
        <a href="tutorial.php">
        <div class="carousel slide" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active text-center">
                    <div>
                        <span class="fa fa-question-circle bigicon"></span>
                    </div>
                    <div class="icontext">
                        Need
                    </div>
                    <div class="icontext">
                        Help
                    </div>
                </div>
                <div class="item text-center">
                    <div>
                        <span class="fa fa-lightbulb-o bigicon"></span>
                    </div>
                    <div class="icontext">
                        Click
                    </div>
                    <div class="icontext">
                        Me!
                    </div>
                </div>
            </div>
        </div>
        </a>
    </div>
</div>
<div class="col-sm-2 col-xs-4">
    <div id="tile9" class="tile">
        <a href="login.php">
        <div class="carousel slide" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active text-center">
                    <div>
                        <span class="fa fa-sign-out bigicon"></span>
                    </div>
                    <div class="icontext">
                        Sign out
                    </div>
                </div>
                <div class="item text-center">
                    <div>
                        <span class="fa fa-unlock bigicon"></span>
                    </div>
                    <div class="icontext">
                        <?= ($_SESSION['accesslevel'] == 1000) ? "Life Time" : date("F j, Y, g:i a",strtotime($_SESSION['licenseexpiry'])); ?>
                    </div>
                </div>
            </div>
        </div>
        </a>
    </div>
</div>
</div>
<?php if($_SESSION['accesslevel'] != 10){ ?>
<div class="row">
    <div class="col-sm-2 col-xs-4">
        <div id="tile13" class="tile">
            <a href="billhistory.php">
                <div class="carousel slide" data-ride="carousel">
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div class="item active text-center">
                            <div>
                                <span class="fa fa-history bigicon"></span>
                            </div>
                            <div class="icontext">
                                View Bill History
                            </div>
                        </div>
                        <div class="item text-center">
                            <div>
                                <span class="fa fa-history bigicon"></span>
                            </div>
                            <div class="icontext">
                                View old bills
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-sm-4 col-xs-8">
        <div id="tile11" class="tile">
            <a href="resetdb.php">
                <div class="carousel slide" data-ride="carousel">
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div class="item active text-center">
                            <div>
                                <span class="fa fa-refresh bigicon"></span>
                            </div>
                            <div class="icontext">
                                Refresh the database
                            </div>
                            <div class="icontext">
                                Reset to factory settings
                            </div>
                        </div>
                        <div class="item text-center">
                            <div>
                                <span class="fa fa-remove bigicon"></span>
                            </div>
                            <div class="icontext">
                                Empty the database
                            </div>
                            <div class="icontext">
                                Factory Reset
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-sm-4 col-xs-8">
        <div id="tile12" class="tile">
            <a href="undo.php">
                <div class="carousel slide" data-ride="carousel">
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div class="item active text-center">
                            <div>
                                <span class="fa fa-undo bigicon"></span>
                            </div>
                            <div class="icontext">
                                Undo last transaction
                            </div>
                        </div>
                        <div class="item text-center">
                            <div>
                                <span class="fa fa-undo bigicon"></span>
                            </div>
                            <div class="icontext">
                                Revert the last step
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-sm-2 col-xs-4" onclick="mobileAlert('<?="License to : ".$_SESSION['username']; ?>')">
        <div id="tile14" class="tile">
                <div class="carousel slide" data-ride="carousel">
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div class="item active text-center">
                            <div>
                                <span class="fa fa-info-circle bigicon"></span>
                            </div>
                            <div class="icontext">
                                License to
                            </div>
                            <div class="icontext">
                                <?=$_SESSION['username']; ?>
                            </div>
                        </div>
                        <div class="item text-center">
                            <div>
                                <span class="fa fa-info bigicon"></span>
                            </div>
                            <div class="icontext">
                                Valid till
                            </div>
                            <div class="icontext">
                                <?=($_SESSION['accesslevel'] == 1000) ? "Forever" : date("F j, Y",strtotime($_SESSION['licenseexpiry'])); ?>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
<?php }?>
</div>
</div>
<div class="page-footer"><b>WingBiz Soft</b> - We provide your business, wings to fly, so you can go round the world.</div>
<script type="text/javascript">
    $(document).ready(function () {
        $(".tile").height($("#tile1").width());
        $(".carousel").height($("#tile1").width());
        $(".item").height($("#tile1").width());

        $(window).resize(function () {
            if (this.resizeTO) clearTimeout(this.resizeTO);
            this.resizeTO = setTimeout(function () {
                $(this).trigger('resizeEnd');
            }, 10);
        });

        $(window).bind('resizeEnd', function () {
            $(".tile").height($("#tile1").width());
            $(".carousel").height($("#tile1").width());
            $(".item").height($("#tile1").width());
        });

    });
    function mobileAlert(text){
        if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
            alert(text);
        }
    }
</script>
<!-- Metro Tiles - END -->
</body>
</html>