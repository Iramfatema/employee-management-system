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

    extract($_POST); //extracted all the values here with $type
    if(isset($_POST['name1']) && isset($_POST['name2']) 
        && isset($_POST['contact']))
    {
        $sql="insert into ems(firstName,lastName,contact) values('$name1','$name2','$contact')";
        if(mysqli_query($conn,$sql))
        {
            
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
    }
?>