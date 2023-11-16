<?php
namespace classes;
use PDO;

use Classes\DbConnector;

require 'DbConnector.php';
class profile{
    private $uid;
    private $pwd;
    private  $User_ID;
    

    public function UpdateProfile( $uid,$pwd,$User_ID){
        $dbcon = new DbConnector();
        $con = $dbcon->getConnection();

        $query1 = "UPDATE user SET  Username=?, Password=? WHERE User_ID=?";
        $pstmt = $con->prepare($query1);
        $pstmt->bindValue(1, $uid);
        $pstmt->bindValue(2, $pwd);
        $pstmt->bindValue(3, $User_ID);
        $pstmt->execute();

        if ($pstmt) {
            return true;
        } else {
            return false;
        }
        
    }
    public function diplayPessengerDetails($User_ID)
    {
        $dbcon = new DbConnector();
        $con = $dbcon->getConnection();
        $query = "SELECT * FROM user WHERE User_ID=?";
        $pstmt = $con->prepare($query);
        $pstmt->bindValue(1, $User_ID);
        $pstmt->execute();

        $result = $pstmt->fetch(PDO::FETCH_OBJ);
        return $result;
    }
    
}
?>