<?php
namespace classes;
use PDO;

use Classes\DbConnector;

require 'DbConnector.php';
class Pessenger{
    private $name;
    private $email;
    private $uid;
    private $pno;
    private $pwd;
    private  $pwdrepeat;
    private $feedback;
    private $Feedback_ID;
    private  $User_ID;


    public function __construct($name = null, $email = null, $uid = null, $pno = null, $pwd = null, $pwdrepeat = null, $feedback = null) {
        
        $this->name=$name;
        $this->email= $email;
        $this->uid=$uid;
        $this->pno=$pno;
        $this->pwd=$pwd;
        $this-> pwdrepeat= $pwdrepeat;
        $this->feedback=$feedback;
   

    }
    public function register($name, $email, $uid, $pno, $pwd, $pwdrepeat){

     
        $hashPassword = password_hash($pwd, PASSWORD_BCRYPT);

        $dbcon = new DbConnector();
        $con = $dbcon->getConnection();

        $query="INSERT INTO user(Name,Email,Username,Password,Phone_Number)VALUES(?,?,?,?,?)";
        $pstmt = $con->prepare($query);
        $pstmt->bindValue(1, $this->name);
        $pstmt->bindValue(2, $this->email);
        $pstmt->bindValue(3, $this->uid);
        $pstmt->bindValue(4, $this->pwd);
        $pstmt->bindValue(5, $this->pno);
        $pstmt->execute();
        $result = $pstmt->fetch(PDO::FETCH_OBJ);

        if($result){
            return true;
        }
        else{
            return false;
        }
    
    }
    public function login($uid,$pwd,$pwdrepeat){
        $dbcon = new DbConnector();
        $con = $dbcon->getConnection();

        $query = "select * from user where username = ?";
        $pstmt = $con->prepare($query);
        $pstmt->bindValue(1,$uid);
        $pstmt->execute();
        if ($pstmt->rowCount() > 0) {
            $getRow = $pstmt->fetch(PDO::FETCH_ASSOC);

            if ($pwd ===$pwdrepeat) {
                return true;
            } else {
                $errors[] = "Incorrect Username or Password";
            }
        } else {
            $errors[] = "Incorrect Username or Password";
        }

    }
    public function Feedback($email,$feedback){
        $dbcon = new DbConnector();
        $con = $dbcon->getConnection();

        $query = "SELECT User_ID FROM user WHERE Email=? ";
        $pstmt = $con->prepare($query);
        $pstmt->bindValue(1,$email);
        $pstmt->execute();
        $result = $pstmt->fetch(PDO::FETCH_OBJ);

        if($result){
            $User_ID = $result->User_ID;
        
            $query1 = "INSERT INTO feedback(User_ID,Feedback,Email)VALUES(?,?,?) ";

            $pstmt1 = $con->prepare($query1);
            $pstmt1->bindValue(1, $User_ID);
            $pstmt1->bindValue(2, $feedback);
            $pstmt1->bindValue(3, $email);

            if ($pstmt1->execute()) {
                return true;
            } else {
                return false;
            }
        }else{
            return false;
        }

       
        
    }
    public function UpdateProfile($name, $email, $uid, $pno, $pwd,$User_ID){
        $dbcon = new DbConnector();
        $con = $dbcon->getConnection();

        $query1 = "UPDATE user SET  Name=?, Email=?,Username=?, Password=?, Phone_Number=? WHERE User_ID=?";
        $pstmt = $con->prepare($query1);
        $pstmt->bindValue(1, $name);
        $pstmt->bindValue(2, $email);
        $pstmt->bindValue(3, $uid);
        $pstmt->bindValue(4, $pwd);
        $pstmt->bindValue(5, $pno);
        $pstmt->bindValue(6, $User_ID);
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
    
    public function getFeedbacks() {
        $dbcon = new DbConnector();
        $con = $dbcon->getConnection();

        $query = "SELECT Feedback, Email FROM feedback";
        $pstmt = $con->prepare($query);
        $pstmt->execute();
        
        // Fetch all feedback records as an associative array
        $feedbacks = $pstmt->fetchAll(PDO::FETCH_ASSOC);

        return $feedbacks;
    } 
    public function contactUs($name,$email,$message,$pno){
        $dbcon = new DbConnector();
        $con = $dbcon->getConnection();
        $query="INSERT INTO contac_us(name,email,phone_number,message)VALUES(?,?,?,?) ";
        $pstmt=$con->prepare($query);
        $pstmt->bindValue(1,$name);
        $pstmt->bindValue(2,$email);
        $pstmt->bindValue(3,$pno);
        $pstmt->bindValue(4,$message);
        $pstmt->execute();
        $result = $pstmt->fetch(PDO::FETCH_OBJ);
        
        if ($pstmt) {
            return true;
        } else {
            return false;
        }

        


    }
}