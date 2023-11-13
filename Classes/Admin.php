<?php
namespace classes;

require 'DbConnector.php';
class Admin
{

    private $Model;
    private $Number;
    private $color;
    private $seats;
    private $ID;

    public function __construct($Model, $Number, $color, $seats, $ID)
    {
        $this->Model = $Model;
        $this->Number = $Number;
        $this->color = $color;
        $this->seats = $seats;
        $this->ID = $ID;
    }

    public function busRegistration($Model, $Number, $color, $seats, $ID)
    {
        $dbcon = new DbConnector();
        $con = $dbcon->getConnection();

        $query = "INSERT INTO bus(Type_of_Bus,Bus_Registration_Number,Colour,No_Of_Seats,Bus_ID) VALUES(?,?,?,?,?)";
        $pstmt1 = $con->prepare($query);
        $pstmt1->bindValue(1, $Model);
        $pstmt1->bindValue(2, $Number);
        $pstmt1->bindValue(3, $color);
        $pstmt1->bindValue(4, $seats);
        $pstmt1->bindValue(5, $ID);

        if ($pstmt1->execute()) {
            return true;
        } else {
            return false;
        }
    }



    public function busExists($ID)
    {
        $dbcon = new DbConnector();
        $con = $dbcon->getConnection();

        $query = "SELECT COUNT(*) FROM bus WHERE Bus_ID = ?";
        $pstmt = $con->prepare($query);
        $pstmt->bindValue(1, $ID);
        $pstmt->execute();

        $count = $pstmt->fetchColumn();

        return ($count > 0);
    }

}






?>