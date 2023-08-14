<?php
    session_start();
    $conn=mysqli_connect('localhost','admin','root@123','Panim');
    if(!$conn)
    {
        echo "Connection Error: ".mysqli_connect_error();
    }
    
    if($_SESSION['username'] == null)
    {
        header("Location: index.php");
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
        width:450%;
        padding:20px;
    }
    .form-label{
            width:200px;
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

                <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false" 
                    style="font-size: 10px;border-radius: 8px; height: 50px; width:120px;">
                    <?php echo"<h5>".$_SESSION['username']."</h5>"?>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                    <a href="logout.php"><li><button class="dropdown-item" type="button">Logout</button></li></a>
                </ul>
                </div>
            </div>
        </nav>

        <!--Add Employee Form-->
        <div class="container my-4">
            <div class="panel panel-default">
                <div class="panel-heading" style="font-size:25px">Add Employee</div>
                <br>
                <div class="panel-body">
                    <form method="post" enctype="multipart/form-data">
                        <div class="col-lg-3 col-md-12 col-sm-12">
                        <label for="fname" class="form-label">Firstname:</label><br>
                        <input type="text" class="form-control" id="fname" name="fname">
                        </div>
                        <div class="col-lg-3 col-md-12 col-sm-12">
                        <label for="lname" class="form-label">Lastname:</label><br>
                        <input type="text" class="form-control" id="lname" name="lname">
                        </div>
                        <div class="col-lg-3 col-md-12 col-sm-12">
                        <label for="contact" class="form-label">Contact Number:</label><br>
                        <input type="text" class="form-control" id="contact" name="contact">
                        </div>
                        <div class="col-lg-3 col-md-12 col-sm-12">
                        <label for="contact" class="form-label">Upload File:</label><br>
                        <input type="file" class="file-control" id="file" name="file">
                        </div>
                        <br>
                        <div class="mb-3">
                            <button class="btn btn-primary" type="submit" id="create" name="create" data-inline="true">Create</button> 
                        <a href="dashboard.php"><button class="btn btn-primary" type="button" id="back" name="back" data-inline="true">Back</button></a> 
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>

<?php
if(isset($_POST['create']))
{
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $contact=$_POST['contact'];

    $file=$_FILES['file']['name']; 
    $user_id = $_SESSION['userId'];

    $sql="insert into ems(firstName,lastName,contact,filename,userId) values('$fname','$lname','$contact','$file','$user_id')";
    if(mysqli_query($conn,$sql))
    {
        move_uploaded_file($_FILES['file']['tmp_name'],"uploads/$file");
        echo "
            <!DOCTYPE html>
            <script>
            function redir()
            {
            window.location.assign('dashboard.php');
            }
            </script>
            <body onload='redir();'></body>";
    }
    else 
    {
        echo "Error in procedure: ".mysqli_error($conn);
    }

    $_SESSION['message'] = "New Employee Added!";
    $_SESSION['msg_type'] = "success";
    
}



?>