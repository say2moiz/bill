<?php
require_once('autoload.php');
$user = new user();
$user->checklogin();
$_pdo = new pdocrudhandler();
$res = $_pdo->delete("billtitle","where idBillTitle = ?", array($_GET['id']));
if($res['status'] = 'success' && $res['rowsAffected'] == 1){
    header('location:billtype.php');
}
?>
