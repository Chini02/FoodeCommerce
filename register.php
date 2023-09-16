<?php
session_start();

if (isset($_SESSION["username"])) {
    header("Location: index.php"); // Redirect to the desired page
    exit; // Ensure that the script exits after the redirect
}
// 
require "inc/header.php" ;

include "config/config.php" ;



if (isset($_POST["submit"])){
    $fullname         = $_POST["fullname"];
    $username         = $_POST["username"];
    $email            = $_POST["email"];
    $password         = $_POST["password"];
    $confirmepassword = $_POST["confirmpwd"];
    $image            = "user.png";
    if(empty($fullname) || empty($email) || empty($password) || empty($username)){
        echo "<script>alert('The Input still empty')</script>";
    }else {
        if($password == $confirmepassword){
            $sql    = "INSERT INTO users (fullname,email,username,mypassword,image) VALUES (:fullname,:email,:username,:mypassword,:image)";
            $insert = $conn->prepare($sql);
            $hash   = password_hash($password, PASSWORD_DEFAULT);
            $result = $insert->execute([
                ":fullname"   => $fullname,
                ":email"      => $email,
                ":username"   => $username,
                ":mypassword" => $hash,
                ":image"      => $image
            ]);

            if ($result) {
                header("location: login.php");
            } else {
                echo "<script>alert('Registration failed. Please try again.')</script>";
            }
        }else {
            echo "<script>alert('The password not correct')</script>";
        }
    }

}
// 

?>
    
    <div id="page-content" class="page-content">
        <div class="banner">
            <div class="jumbotron jumbotron-bg text-center rounded-0" style="background-image: url('assets/img/bg-header.jpg');">
                <div class="container">
                    <h1 class="pt-5">
                        Register Page
                    </h1>
                    <p class="lead">
                        Save time and leave the groceries to us.
                    </p>

                    <div class="card card-login mb-5">
                        <div class="card-body">
                            <form class="form-horizontal" method="POST" action="register.php">
                                <div class="form-group row mt-3">
                                    <div class="col-md-12">
                                        <input name="fullname" class="form-control" type="text" placeholder="Full Name">
                                    </div>
                                </div>
                                <div class="form-group row mt-3">
                                    <div class="col-md-12">
                                        <input name="email" class="form-control" type="email" placeholder="Email">
                                    </div>
                                </div>
                                
                                <div class="form-group row mt-3">
                                    <div class="col-md-12">
                                        <input name="username" class="form-control" type="text" placeholder="Username">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <input name="password" class="form-control" type="password" placeholder="Password">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <input name="confirmpwd" class="form-control" type="password" placeholder="Confirm Password">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <!-- <div class="col-md-12">
                                        <div class="checkbox">
                                            <input id="checkbox0" required type="checkbox" name="terms">
                                            <label for="checkbox0" class="mb-0">I Agree with <a href="terms.html" class="text-light">Terms & Conditions</a> </label>
                                        </div>
                                    </div> -->
                                </div>
                                <div class="form-group row text-center mt-4">
                                    <div class="col-md-12">
                                        <button name="submit" type="submit" class="btn btn-primary btn-block text-uppercase">Register</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<?php
require "inc/footer.php" 
?>
