<?php
namespace classes;


use Classes\DbConnector;

require 'DbConnector.php';

class packageC{
    private $sendername;
    private $receivername;
    private $type;
    private $location;
    private $receiver_address;
    private $tele;
    private $weight;
    private $Package_ID;
    
    public function __construct($sendername,$receivername, $type,$location,$receiver_address,$tele,$weight){
        $this->sendername=$sendername;
        $this->receivername= $receivername;
        $this->type= $type;
        $this->location= $location;
        $this->receiver_address= $receiver_address;
        $this->tele= $tele;
        $this->weight= $weight;
    
         
    
}
public function package_booking($sendername,$receivername,$type,$location,$receiver_address,$tele,$weight){
    
    $dbcon = new DbConnector();
    $con = $dbcon->getConnection();

    $query = "INSERT INTO package_services (sender_name, receiver_name, parcel_type, receiver_address, sender_location, telephone_num, weight) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $pstmt = $con->prepare($query);
    
    $pstmt->bindValue(1, $sendername);
    $pstmt->bindValue(2, $receivername);
    $pstmt->bindValue(3, $type);
    $pstmt->bindValue(4, $location);
    $pstmt->bindValue(5, $receiver_address);
    $pstmt->bindValue(6, $tele);
    $pstmt->bindValue(7,$weight);
    $result = $pstmt->execute();

    if ($result) {
        return true;
    } else {
        return false;
    }

}
public function package_cancellation($Package_ID,$sendername,$type){
        
    $dbcon = new DbConnector();
    $con = $dbcon->getConnection();

    $query="DELETE FROM package_services WHERE Package_ID=?";
    $pstmt=$con->prepare($query);

    $pstmt->bindValue(1, $Package_ID);
    $result = $pstmt->execute();
    


    if ($result) {
        return true;
    } else {
        return false;
    }


   
}

}
?>