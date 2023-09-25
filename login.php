<?php
session_start();

if (isset($_SESSION["username"])) {
    header("Location: index.php"); // Redirect to the desired page
    exit; // Ensure that the script exits after the redirect
}
require "inc/header.php" ;
require "config/config.php";



if (isset($_POST["submit"])){
    $email            = $_POST["email"];
    $password         = $_POST["password"];
    $image            = "user.png";
    if(empty($email) || empty($password)){
        echo "<script>alert('The Input still empty')</script>";
    }else{
        $sql = "SELECT * FROM users WHERE email = :email ";
        $login = $conn->prepare($sql);
        $login->bindParam(':email', $email);
        
        $login->execute();

        $fetch = $login->fetch(PDO::FETCH_ASSOC);

        if ($login->rowCount() > 0) {
            // $hashedPassword = $fetch["mypassword"];
            if (password_verify($password, $fetch["mypassword"])) {
                $_SESSION["user_id"]  = $fetch["id"];
                $_SESSION["username"] = $fetch["username"];
                $_SESSION["email"]    = $fetch["email"];
                $_SESSION["image"]    = $fetch["image"];
                header("location: index.php");
                exit; // Exit after successful login
            }else {
                echo "<script>alert('Email or Username , Password not correct')</script>";
            }
        }else {
            echo "<script>alert('Email or Username , Password not correct')</script>";
        }
    }
}

?>

   
    <div id="page-content" class="page-content">
        <div class="banner">
            <div class="jumbotron jumbotron-bg text-center rounded-0" style="background-image: url('assets/img/bg-header.jpg');">
                <div class="container">
                    <h1 class="pt-5">
                        Login Page
                    </h1>
                    <p class="lead">
                        Save time and leave the groceries to us.
                    </p>

                    <div class="card card-login mb-5">
                        <div class="card-body">
                            <form class="form-horizontal" method="POST" action="login.php">
                                
                                <div class="form-group row mt-3">
                                    <div class="col-md-12">
                                        <input class="form-control" name="email" type="email" placeholder="Email">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <input class="form-control" name="password" type="password"  placeholder="Password">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <!-- <div class="col-md-12 d-flex justify-content-between align-items-center">
                                        <div class="checkbox">
                                            <input id="checkbox0" type="checkbox" name="remember">
                                            <label for="checkbox0" class="mb-0"> Remember Me? </label>
                                        </div>
                                        <a href="login.php" class="text-light"><i class="fa fa-bell"></i> Forgot password?</a>
                                    </div> -->
                                </div>
                                <div class="form-group row text-center mt-4">
                                    <div class="col-md-12">
                                        <button type="submit" name="submit" class="btn btn-primary btn-block text-uppercase">Log In</button>
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
