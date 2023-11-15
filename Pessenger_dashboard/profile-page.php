<?php
session_start();
require_once('../Classes/Pessenger.php');
require_once('../Classes/DbConnector.php');

use classes\Pessenger;
use Classes\DbConnector;

$dbcon = new DbConnector();
$con = $dbcon->getConnection();

// Check if the User_ID is set in the session

///if (isset($_SESSION['User_ID'])) {
$User_ID = "USER0006";
$user = new Pessenger(null, null, null, null, null,null, null);

// Fetch user details
$result = $user->diplayPessengerDetails($User_ID);

// Check if the result is a valid object
if ($result !== false) {
    $name = $result->Name;
    $email = $result->Email;
    $uid = $result->Username;
    $pno = $result->Phone_Number;
    $pwd = $result->Password;

    if (isset($_POST['update'])) {
        // Process form data and update the profile
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $uid = trim($_POST['username']);
        $pno = trim($_POST['phone_no']);
        $pwd = trim($_POST['password']);

        if ($user->updateProfile($name, $email, $uid, $pno, $pwd,$User_ID)) {
            $success = 'Profile Updated Successfully';
        } else {
            $errors[] = "Failed to Update Profile";
        }
    }
} else {
    // Handle the case where user details couldn't be retrieved
    $errors[] = "Failed to Fetch User Details";
}
//} else {
// Handle the case where User_ID is not set in the session
// $errors[] = "User is not logged in. Please ensure the session is properly set.";
//}
?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Sinhala:wght@100;300;400;500;600;700;800;900&family=Poppins:wght@400;500;600;700&family=Roboto:wght@100;300;400;500;700;900&family=Urbanist:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,900&display=swap" rel="stylesheet">

    <title>Profile</title>
</head>

<body>
    <section>
        <div class="row">
            <div id="topbar">
                <div>
                    <h2>Journey Ease</h2>
                </div>
                <div>
                    <span>Welcome <?php
                                    if (isset($_SESSION["name"])) {
                                        echo $_SESSION["name"] . ' ! ';
                                    } else {
                                        echo 'user ! ';
                                    }
                                    ?></span>
                </div>
            </div>
        </div>
        <div id="sidebar">
            <div class="pt-5">
                <ul class="pt-4">
                    <li><a href="dashboard-page.php">Dashboard</a></li>
                    <li><a href="feedback-page.php">Feedback</a></li>
                    <li><a href="profile-page.php" class="active">Profile</a></li>
                    <li><a href="#">Logout</a></li>
                </ul>
            </div>
        </div>
        <div id="content">
            <!--breadcum bar-->
            <div class="row p-4 pb-0 pt-5">
                <div class="col pt-3">
                    <nav class="bread-card p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li>Home </li>
                            <li class="active">Profile</li>
                        </ol>
                    </nav>
                </div>
            </div>


            <!-- User Detail Update Card -->

            <div class="card custom-card">
                <h5 class="card-title styled-heading p-3">Update User Details</h5>
                <div class="card-body">

                    <form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                        <?php
                        if (isset($errors) && count($errors) > 0) {
                            foreach ($errors as $error_msg) {
                                echo '<div class="alert alert-danger">' . $error_msg . '</div>';
                            }
                        }
                        if (isset($success)) {
                            echo '<div class="alert alert-success">' . $success . '</div>';
                        }
                        ?>

                        <div class="mb-4 row">
                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" placeholder=" name" name="name" value="<?php echo $name; ?>">
                            </div>
                        </div>


                        <div class="mb-4 row">
                            <label for="name" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="email" placeholder="Email" value="<?php echo $email; ?>">
                            </div>
                        </div>
                        <div class="mb-4 row">
                            <label for="phoneNumber" class="col-sm-2 col-form-label">Username</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="username" placeholder="Enter username" name="username" value="<?php echo $uid; ?>">
                            </div>

                        </div>
                        <div class="mb-4 row">
                            <label for="phoneNumber" class="col-sm-2 col-form-label">Phone number</label>
                            <div class="col-sm-10">
                                <input type="tel" class="form-control" id="phoneNumber" placeholder="Enter Phone Number" name="phone_no" value="<?php echo $pno; ?>">
                            </div>

                        </div>
                        <div class="mb-4 row">
                            <label for="password" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="password" name="password" value="<?php echo $pwd; ?>" placeholder="Enter Password" required>
                            </div>
                        </div>


                        <div class="pt-3">
                            <button type="submit" class="btn btn-primary update-button" name="update">Update</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        </div>
        </div>
    </section>
</body>

</html>