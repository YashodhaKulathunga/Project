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
    private $Name;
    private $email;
    private $PhoneNo;
    private $address;
    private $CID;

    public function __construct(
        $Model = null,
        $Number = null,
        $color = null,
        $seats = null,
        $ID = null,
        $Name = null,
        $email = null,
        $PhoneNo = null,
        $address = null,
        $CID = null
    ) {
        $this->Model = $Model;
        $this->Number = $Number;
        $this->color = $color;
        $this->seats = $seats;
        $this->ID = $ID;
        $this->Name = $Name;
        $this->email = $email;
        $this->PhoneNo = $PhoneNo;
        $this->address = $address;
        $this->CID = $CID;
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

    public function Emp_Registration($CID, $Name, $PhoneNo)
    {
        $dbcon = new DbConnector();
        $con = $dbcon->getConnection();

        $query1 = "INSERT INTO conductor(Conductor_ID, Name, Contact_No) VALUES (?, ?, ?)";

        $pstmt1 = $con->prepare($query1);
        $pstmt1->bindValue(1, $CID);
        $pstmt1->bindValue(2, $Name);
        $pstmt1->bindValue(3, $PhoneNo);

        if ($pstmt1->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function EmpExists($CID)
    {
        $dbcon = new DbConnector();
        $con = $dbcon->getConnection();

        $query = "SELECT COUNT(*) FROM conductor WHERE Conductor_ID = ?";
        $pstmt = $con->prepare($query);
        $pstmt->bindValue(1, $CID);
        $pstmt->execute();

        $count = $pstmt->fetchColumn();

        return ($count > 0);
    }
}
?>
