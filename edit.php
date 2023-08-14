<?php
    session_start();
    // Database connection
    $conn=mysqli_connect('localhost','admin','root@123','Panim');
    if(!$conn)
    {
        echo "Connection Error: ".mysqli_connect_error();
    }

    //authentication
    if($_SESSION['username'] == null)
    {
        header("Location: index.php");
    }

    
    $id=$_GET['edit'];

    // fetching data from database to update fields
    $sql="select * from ems where srNo=$id";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    $name1= $row['firstName'];
    $name2= $row['lastName'];
    $contact= $row['contact'];
    $filename = $row['filename'];

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

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
    .container{
        padding:25px;
    }
    </style>
  </head>

    <body>
        <!-- Navigation bar-->
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

        <!--Edit form-->
        <div class="container my-4">
            <div class="panel panel-default">
                <div class="panel-heading" style="font-size:25px">Update</div>
                <br>
                <div class="panel-body">
                    <form method="post" enctype="multipart/form-data">
                        <div class="col-lg-3 col-md-12 col-sm-12">
                        <label for="fname" class="form-label">Firstname:</label><br>
                        <input type="text" class="form-control" id="fname" name="fname" value="<?php echo $name1;?>">
                        </div>
                        <div class="col-lg-3 col-md-12 col-sm-12">
                        <label for="lname" class="form-label">Lastname:</label><br>
                        <input type="text" class="form-control" id="lname" name="lname" value="<?php echo $name2;?>">
                        </div>
                        <div class="col-lg-3 col-md-12 col-sm-12">
                        <label for="contact" class="form-label">Contact Number:</label><br>
                        <input type="text" class="form-control" id="contact" name="contact" value="<?php echo $contact;?>">
                        </div>
                        <div class="col-lg-3 col-md-12 col-sm-12">
                        <label for="contact" class="form-label">Upload File:</label><br>
                        <input type="file" class="file-control" id="file" name="file"><p> <?php echo $filename;?></p>
                        <input type="hidden" name="old_file" value="<?php echo $filename;?>">
                        </div>
                        <br>
                        <div class="mb-3">
                        <button class="btn btn-primary" type="submit" id="update" name="update" data-inline="true">Update</button> 
                        <a href="dashboard.php"><button class="btn btn-primary" type="button" id="back" name="back" data-inline="true">Back</button></a> 
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>

<?php

if(isset($_POST['update']))
{
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $contact=$_POST['contact'];
    $file=$_FILES['file']['name'];
    $old_file=$_POST['old_file']; 

        if($file != '')
        {
            $update_file = $_FILES['file']['name'];
        }
        else
        {
            $update_file = $old_file;
        }
        $sql="update ems set firstName='$fname',lastName='$lname',contact='$contact',filename='$update_file' where srNo=$id";
        $result=mysqli_query($conn,$sql);
        if($result)
        {
            if($_FILES['file']['name'] !='')
            {
                move_uploaded_file($_FILES['file']['tmp_name'],"uploads/$file");
                unlink("uploads/".$old_file);
            }
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

        $_SESSION['message'] = "Employee edited succesfully!";
        $_SESSION['msg_type'] = "success";
    
}
?>
<!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
   
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https:cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
-->