<?php
require_once('autoload.php');
$bill = new pdocrudhandler();
//$bill->insert('bill',array('meterNumber' => 123,'reading' => 1000,'idUser' => 1,'lastModified' => date('Y-m-d h:i:d')));
//$bill->insert('billinghistory',array('oldReading' => 900,'newReading' => 1000,'idUser' => 1,'timeStamp' => date('Y-m-d h:i:d')));
//$bill->insert('user',array('userName' => 'test','email' => 'test@test.com','contactNumber' => '03456603000','password' => md5('12345'),'isActive' => 1,'lastLogin' => date('Y-m-d h:i:d')));

//print_r($bill->delete('billinghistory','where idBillingHistory > ?',array(4)));
//$bill->delete('user','where lastLogin > ? and userName = ?',array('2015-06-13 21:27:13','test'));
//$bill->delete('user','where idUser = ?',array(13));

//print_r($bill->update('billinghistory',array('oldReading' => 000, 'newReading' => 199),'where idBillingHistory = ?',array(4)));
//$bill->update('billinghistory',array('oldReading' => 1000, 'newReading' => 1500, 'idUser' => 1),'where idBillingHistory = ? and timeStamp between ? and ?',array(3,'2015-06-15 01:08:52','2015-06-22 01:13:35'));

//print_r($bill->select('user',array(),'where lastLogin between ? and ? and idUser not in(?,?)',array('2015-06-13 21:17:19','2015-06-13 21:27:13',1,3)));
/*$qry = "select pp.partName,bb.brandName,b.buyerName,s.sellerName,
        p.userPurchaseDate,p.idPurchase,p.purchasedFor,p.remarks,p.price,p.quantity,p.unitOfPurchase from purchase p
        inner join buyer b on b.idBuyer=p.idBuyer
        inner join seller s on s.idSeller=p.idSeller
        inner join part pp on pp.idPart=p.idPart
        inner join brand bb on bb.idBrand=p.idBrand where bb.idBrand=? and p.idPart=? and s.idSeller=?
        and b.idBuyer=?";
echo "<pre>";print_r($bill->customSelect($qry,array(1,1,1,1)));*/
echo date('Y-m-d h:i:s',strtotime('1feb2016'));
?>