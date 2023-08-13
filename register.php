<?php
    $conn=mysqli_connect('localhost','admin','root@123','Panim');
    if(!$conn)
    {
        echo "Connection Error: ".mysqli_connect_error();
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <!-- Including the bootstrap CDN -->
    <link rel="stylesheet" href=
        "https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src=
        "https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">
    </script>
    <script src=
        "https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js">
    </script>
    <script src=
        "https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js">
    </script>
    <title>EMS</title>

    <style>
        .nav-link{
            color: #636b6f;
            padding: 0 25px;
            font-size: 17px;
            font-weight: 600;
            letter-spacing: .lrem;
            text-decoration: none;
            text-transform: uppercase;
        }
    .panel-heading{
        color: #333;
        background-color:#fff;
        border-color:#d3e0e9;
        padding: 10px 15px;
        border-bottom: 1px solid black;
        border-top-right-radius: 3px;
        border-top-left-radius: 3px;
    }
    
    .panel-default{
        width:100%;
        padding: 10px 250px;
    }
    .form-control{
        width:80%;
        padding:20px;
    }
    .container{
        padding:25px;
    }
    </style>
  </head>
  <body>

    <!--Navigation bar-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <span class="navbar-text">
                <h2>EMS</h2>
            </span>

            <div class="collapse navbar-collapse" id="navbarContent">
                
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="login.php">
                    Login
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="register.php">
                    Register
                    </a>
                </li>
            </ul>
            </div>
        </div>
    </nav>

    <!--Register Form-->
    <div class="container my-4">
        <div class="panel panel-default">
            <div class="panel-heading" style="font-size:25px">Register</div>
            <br>
            <div class="panel-body">
            <form method="post">
                <div class="row mb-3">
                    <label for="inputName3" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputName3" name="name">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                    <input type="email" class="form-control" id="inputEmail3" name="username">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                    <input type="password" class="form-control" id="inputPassword3" name="password">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputCpassword3" class="col-sm-2 col-form-label">Confirm Password</label>
                    <div class="col-sm-10">
                    <input type="password" class="form-control" id="inputCpassword3" name="cpassword">
                    </div>
                </div>
                <input type="submit" name="register" class="btn btn-primary" id="register" value="Register">
                </form>
            </div>
        </div>
    </div>
    <?php
    
    if(isset($_POST['register']))
    {
        $username=$_POST['name'];
        $email=$_POST['username'];
        $password=$_POST['password'];
        $cpassword=$_POST['cpassword'];

        if($password == $cpassword) 
        {
            $sql = "insert into user (username,email,password) values ('$username','$email','$password')";
            $result = mysqli_query($conn,$sql);
            if($result)
            {
                echo "<script> alert('Registeration successful!') </script>";
                $username="";
                $email="";
                $_POST['password']="";
                $_POST['cpassword']="";
            }
            else
            {
                echo "<script> alert('Something Went wrong') </script>";
            }
        }
        else
        {
            echo "<script> alert('Password doesnt match') </script>";
        }
    }
    
    
    ?>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
    -->
  </body>
</html>