<?php

  include("dbconnection.php");

  if(isset($_GET['id']))
  {
    $id=$_GET['id'];
    $sql="DELETE FROM employees WHERE id=$id";
    if(mysqli_query($con,$sql))
    {
        echo "deleted";
    }
    else{
        echo "deleting error";
    }
  }
header("Location: view_employee.php");
?>