<?php

use Classes\DbConnector;

require 'DbConnector.php';

class Counductor
{
    private $conductorID;
    private $BusID;
    private $LocationID;
    private $date;
    private $travel_in_km;
    private $fuel_in_liter;
    private $expences;
    private  $expence_item;
    private   $expence_rp;


    public function __construct($conductorID, $BusID, $LocationID, $date, $travel_in_km,  $fuel_in_liter, $expences, $expence_item,  $expence_rp)
    {
        $this->conductorID = $conductorID;
        $this->BusID = $BusID;
        $this->LocationID = $LocationID;
        $this->date = $date;
        $this->travel_in_km = $travel_in_km;
        $this->fuel_in_liter = $fuel_in_liter;
        $this->expences = $expences;
        $this->expence_item = $expence_item;
        $this->expence_rp =  $expence_rp;
    }

    public function fuel($BusID, $date, $travel_in_km,  $fuel_in_liter, $expences)
    {
        $dbcon = new DbConnector();
        $con = $dbcon->getConnection();

        $query = "SELECT Bus_ID FROM bus WHERE Bus_ID=?";
        $pstmt = $con->prepare($query);
        $pstmt->bindValue(1, $BusID);
        $pstmt->execute();
        $result = $pstmt->fetch(PDO::FETCH_OBJ);

        if ($result) {
            $query1 = "INSERT INTO fuel(Date,Distance,Fuel_Quantity,Price,Bus_ID)VALUES(?,?,?,?,?) ";

            $pstmt1 = $con->prepare($query1);
            $pstmt1->bindValue(1, $date);
            $pstmt1->bindValue(2, $travel_in_km);
            $pstmt1->bindValue(3, $fuel_in_liter);
            $pstmt1->bindValue(4, $expences);
            $pstmt1->bindValue(5, $BusID);

            if ($pstmt1->execute()) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    public function expence( $date, $expence_item,  $expence_rp ,$Bus_ID){
        $dbcon = new DbConnector();
        $con = $dbcon->getConnection();

        $query = "SELECT Bus_ID FROM bus WHERE Bus_ID=?";
        $pstmt = $con->prepare($query);
        $pstmt->bindValue(1, $Bus_ID);
        $pstmt->execute();
        $result = $pstmt->fetch(PDO::FETCH_OBJ);
        
        if ($result){
            $query1 = "INSERT INTO expences(Date,Item,Price,Bus_ID)VALUES(?,?,?,?) ";

            $pstmt1 = $con->prepare($query1);
            $pstmt1->bindValue(1, $date);
            $pstmt1->bindValue(2, $expence_item);
            $pstmt1->bindValue(3, $expence_rp);
            $pstmt1->bindValue(4, $Bus_ID);

            if ($pstmt1->execute()) {
                return true;
            }else{
                return false;
            }

        }else{
            return false;
        }
    }
}
