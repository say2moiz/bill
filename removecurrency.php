<?php
require_once('autoload.php');
$user = new user();
$user->checklogin();
$_pdo = new pdocrudhandler();
$res = $_pdo->delete("currency","where idCurrency = ?", array($_GET['id']));
if($res['status'] = 'success' && $res['rowsAffected'] == 1){
    header('location:currency.php');
}
?>
