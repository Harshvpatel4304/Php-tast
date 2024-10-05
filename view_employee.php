<?php
include("dbconnection.php");

$sql = "SELECT * FROM employees";
$result = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee List</title>
    <style>
    h2{
        text-align :center;
        
    }
    h4{
        text-align: right;

    }
    table{
        width: 100%;
        margin : 20px;

    }
      </style>  
</head>
<body>

<h2>Employee List</h2>
<h4><a href='add_employee'>Add New Employee</a><h4>
<table border="1">
    <tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Mobile</th>
        <th>Gender</th>
        <th>Hobbies</th>
        <th>Photo</th>
        <th>Created Date</th>
        <th>Action</th>
    </tr>

    <?php
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['first_name']}</td>
                <td>{$row['last_name']}</td>
                <td>{$row['email']}</td>
                <td>{$row['country_code']} {$row['mobile_number']}</td>
                <td>{$row['gender']}</td>
                <td>{$row['hobbies']}</td>
                <td><img src='uploads/{$row['photo']}' width='50'></td>
                <td>{$row['created_date']}</td>
                <td >
                    <a href='edit_employee.php?id={$row['id']}' >Edit</a>
                    <a href='delete_employee.php?id={$row['id']}' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                </td>
              </tr>";
    }
    ?>
</table>

</body>
</html>
