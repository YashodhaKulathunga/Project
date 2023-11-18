<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <!--bootsrap links-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    </head>
    <body>
<?php
/*if(isset($_GET["error"])){
    
    if($_GET["error"] == 1){
         echo '<script type="text/javascript">
              alert("Please submit the form through POST method");
              window.location="index.php";
          </script>';
    }
    else if($_GET["error"] == 2){
        echo '<script type="text/javascript">
              alert("Please submit the form through Send Now button");
              window.location="index.php";
          </script>';
        
    }
    else if($_GET["error"] == 3){
        echo '<script type="text/javascript">
              alert("Please fill all the fields");
              window.location="index.php";
          </script>';
       
    }
    else if($_GET["error"] == 4){
        echo '<script type="text/javascript">
              alert("Please enter an valid email");
              window.location="index.php";
          </script>';
       
    }
    
   
}*/




?>

<!DOCTYPE html>
<!-- Created By CodingLab - www.codinglabweb.com -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>Contact Us</title>
    
    <link rel="stylesheet" href="css/stylecu.css" />
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
   <?php
   
   require_once('../Classes/Pessenger.php');

//use classes\DbConnector;
use classes\Pessenger;

?>
<body>
  <div class="container">
    <div style="display:flex; justify-content: center; align-items:center; ">
    <?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit'])) {
        if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['message'])||empty($_POST['pno'])){
            echo '<div class="alert alert-danger" role="alert">Please Fill all feilds.</div>';
        }else{
            $name = $_POST['name'];
            $email=$_POST['email'];
            $message=$_POST['message'];
            $pno=$_POST['pno'];

            $contact = new Pessenger(null, null, null, null, null, null, null,null,null);
            if ($contact->contactUs($name,$email,$message,$pno)) {
                echo '<div class="alert alert-primary" role="alert">
                Thank you for reaching out! Your message has been submitted successfully. We appreciate your interest and will get back to you as soon as possible. Have a great day!!
              </div>';
            } else {
                echo '<div class="alert alert-danger" role="alert">Error!</div>';
            }

        }
        }else{
            echo '<div class="alert alert-danger" role="alert">Fill the form throught Submit Button..</div>';
        }

    }else{
        //echo '<div class="alert alert-danger" role="alert">Fill the form throught Submit Button.</div>';
    }



   ?>
</div>
  
    <div class="content">
      <div class="left-side">
        <div class="address details">
          <i class="fas fa-map-marker-alt"></i>
          <div class="topic">Address</div>
          <div class="text-one">No 2, Passara Road,</div>
          <div class="text-two">Badulla</div>
        </div>
        <div class="phone details">
          <i class="fas fa-phone-alt"></i>
          <div class="topic">Phone</div>
          <div class="text-one">+9412398456</div>
          
        </div>
        <div class="email details">
          <i class="fas fa-envelope"></i>
          <div class="topic">Email</div>
          <div class="text-one">JourneyEase@Bus.com</div>
      
        </div>
      </div>
      <div class="right-side">
        <div class="topic-text">Send us a message</div>
        <p><b>Have any questions?</b>Fill up the form and our Team will get back to you</p>
        <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <div class="input-box">
          <input type="text" name="name" placeholder="Enter your name">
        </div>
        <div class="input-box">
          <input type="text" name="pno" placeholder="Enter your phone number">
        </div>
        <div class="input-box">
          <input type="text" name="email" placeholder="Enter your email">
        </div>
        

        <div class="input-box message-box" >
          <textarea placeholder="Enter your message" name="message"></textarea>
          
        </div>
        <div class="button">
            <input type="submit" name="submit" value="Send Now" name="sendnow" >
        </div>
      </form>
    </div>
    </div>
  </div>
</body>
</html>
    </body>
</html>
