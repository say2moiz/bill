<?php
class user extends pdocrudhandler{
    public function __construct(){
        $this->_pdo = $this->connect();
        session_start();
    }
    public function logout(){
        if(isset($_SESSION['login'])){
            $_SESSION['login'] = false;
            unset($_SESSION['idUser']);
            unset($_SESSION['userName']);
            session_destroy();
        }
    }
    public function login($username,$password,$companyid = 2){
        $res = $this->select('user',array("*"),"where userName = ? and password = ? and idCompany = ?",array($username,$password,$companyid));
        if($res['status'] == 'success' && $res['rowsAffected'] == 1){
            $this->update('user',array('lastLogin' => date('Y-m-d h:i:s')),'where idUser = ?',array($res['result']->idUser));
            $_SESSION['userid'] = $res['result'][0]->idUser;
            $_SESSION['currentLicenseDate'] = $res['result'][0]->licenseExpiryDate;
            $_SESSION['login'] = true;
            $_SESSION['username'] = $res['result'][0]->userName;
            $_SESSION['phone'] = $res['result'][0]->contactNumber;
            $_SESSION['accesslevel'] = $res['result'][0]->accessLevel;
            $_SESSION['licenseexpiry'] = $res['result'][0]->licenseExpiryDate;
            $_SESSION['companyid'] = $res['result'][0]->idCompany;
            if(strtotime(date('Y-m-d h:i:s')) < strtotime($res['result'][0]->licenseExpiryDate)){
                $_SESSION['license'] = true;
                $_SESSION['currentLicenseDate'] = $res['result'][0]->licenseExpiryDate;
            }else{
                $_SESSION['license'] = false;
            }
            return true;
        }
    }
    public function softwaresecuritychk(){
        //Extend this '1feb2016' date in case of security clearance
        if(strtotime(date('Y-m-d h:i:s')) > strtotime('10july2016')){
            header('location:license.php');
        }else{
            return true;
        }
    }
    public function checklogin(){
        $this->softwaresecuritychk();
        if($_SESSION['login'] == false ){
            header("location:login.php");
        }else if($_SESSION['license'] == false && $_SESSION['accesslevel'] != 1000){
            header('location:license.php');
        }
    }
}
?>