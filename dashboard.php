<?php
    session_start();

    $conn=mysqli_connect('localhost','admin','root@123','Panim');
    if(!$conn)
    {
        echo "Connection Error: ".mysqli_connect_error();
    }
    $dis="select * from ems";
    $res=mysqli_query($conn,$dis);
    $disp=mysqli_fetch_all($res,MYSQLI_ASSOC);


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
    <script>
        // function adduser()
        // {
        //     var name1 = $("#fname").val();
        //     /*used val() because just accessing the value of the field and not the whole element.
        //     $ stands for jQuery*/
        //     var name2 = $("#lname").val();
        //     var contact = $("#contact").val();

        //     $.ajax({
        //         url:"insert.php",
        //         type:'post',
        //         data:{
        //             name1:name1,
        //             name2:name2,
        //             contact:contact
        //         },
        //         success:function(data,status){
        //             //function to display data
        //             console.log(status);
        //         }
        //     });
        // }

    </script>
    <style>
        .form-control{
            width:400%;
            padding:8px;
            }
        .form-label{
            width:200px;
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

    <!-- Add Employee Modal -->
    <!-- <div class="modal fade" id="addEmpModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Employee</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="post">
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
                <br>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" onclick="adduser()">Create</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>    
        </div>
        </div>
    </div>
    </div> -->


    <!--panel body-->
    <div class="container my-4">
        <div class="panel panel-default">
            <div class="panel-body">Employees List
             <a href="addEmp.php">
            <button type="button" class="btn btn-secondary"
            style="float: right">Add Employee</button></a>
            </div>
        </div>
    </div>

    <?php
        if(isset($_SESSION['message'])):
    ?>
    <div class="alert alert-<?=$_SESSION['msg_type']?>">
        <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        ?>
    </div>
    <?php endif ?>

    <div class="container my-4">  
    <table class="table">
    <thead>
        <tr>
        <th scope="col">Sr.No.</th>
        <th scope="col">Firstname</th>
        <th scope="col">Lastname</th>
        <th scope="col">Contact Number</th>
        <th scope="col">File Name</th>
        <th scope="col" colspan="2" style="text-indent: 50px;">Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php
        foreach ($disp as $i)
        {
            echo "<tr id=".$i['srNo'].">
            <th scope='row'>".$i['srNo']."</th>
            <td>".$i['firstName']."</td>
            <td>".$i['lastName']."</td>
            <td>".$i['contact']."</td>
            <td><img src='";
            echo "uploads/".$i['filename'];
            echo "' width='200' height='150'></td>
            <td>
                <a href='edit.php?edit=".$i['srNo']."'class='btn btn-info'>Edit</a>
            </td>
            <td>
                <form method='post'>
                    <input type='hidden' name='deleteid' value=".$i['srNo'].">
                    <input type='hidden' name='del_file' value=".$i['filename'].">
                    <button type='submit' name='delete' class='btn btn-danger'>Delete</button>
                </form>
            </td>
            </tr>";
        }
        echo "</table>";
        ?>
        
    </tbody>
    </table>
    </div>

    <!--delete query-->
    <?php 
    if(isset($_POST['delete']))
    {
        $id = $_POST['deleteid'];
        $del_file = $_POST['del_file'];
        $sql1="delete from ems where srNo='$id'";
        $result=mysqli_query($conn,$sql1);
        if($result)
        {
            unlink("uploads/".$del_file);
           echo "<!DOCTYPE html>
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
            echo "Query Error: ".mysqli_error($conn);
        }
        $_SESSION['message'] = "Record has been deleted";
        $_SESSION['msg_type'] = "danger";

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
  </body>
</html>
