<?php
include("dbconnection.php");


if (!isset($_GET['id'])) {
    echo "Employee ID not specified!";
    exit;
}


$id = $_GET['id'];


$sql = "SELECT * FROM employees WHERE id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Employee not found!";
    exit;
}

$employee = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        form {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin: 10px 0 5px;
        }
        input[type="text"],
        input[type="email"],
        input[type="number"],
        select {
            width: 100%;
            padding: 10px;
            margin: 5px 0 20px;
            border: 1px solid #ddd;
            border-radius: 3px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<h2>Edit Employee</h2>

<form  method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $employee['id']; ?>">
    <label for="first_name">First Name:</label>
    <input type="text" id="first_name" name="first_name" value="<?php echo $employee['first_name']; ?>" required>

    <label for="last_name">Last Name:</label>
    <input type="text" id="last_name" name="last_name" value="<?php echo $employee['last_name']; ?>" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo $employee['email']; ?>" required>

    <label for="country_code">Country Code:</label>
    <input type="text" id="country_code" name="country_code" value="<?php echo $employee['country_code']; ?>" required>

    <label for="mobile_number">Mobile Number:</label>
    <input type="number" id="mobile_number" name="mobile_number" value="<?php echo $employee['mobile_number']; ?>" required>
    
    
    <label for="gender">Gender:</label>
    <select id="gender" name="gender">
        <option value="Male" <?php if ($employee['gender'] == 'Male') echo 'selected'; ?>>Male</option>
        <option value="Female" <?php if ($employee['gender'] == 'Female') echo 'selected'; ?>>Female</option>
    </select>

    <label for="hobbies">Hobbies:</label>
    <input type="text" id="hobbies" name="hobbies" value="<?php echo $employee['hobbies']; ?>" required>

    <label for="photo">Photo:</label>
    <input type="file" id="photo" name="photo">

    <input type="submit" value="Update Employee">
</form>

</body>
</html>


<?php
include("dbconnection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $country_code = $_POST['country_code'];
    $mobile_number = $_POST['mobile_number'];
    $gender = $_POST['gender'];
    $hobbies = $_POST['hobbies'];

    
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        $photo = $_FILES['photo']['name'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($photo);
        move_uploaded_file($_FILES['photo']['tmp_name'], $target_file);

        $sql = "UPDATE employees SET first_name=?, last_name=?, email=?, country_code=?, mobile_number=?, gender=?, hobbies=?, photo=? WHERE id=?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ssssssssi", $first_name, $last_name, $email, $country_code, $mobile_number, $gender, $hobbies, $photo, $id);
    } else {
    
        $sql = "UPDATE employees SET first_name=?, last_name=?, email=?, country_code=?, mobile_number=?, gender=?, hobbies=? WHERE id=?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("sssssssi", $first_name, $last_name, $email, $country_code, $mobile_number, $gender, $hobbies, $id);
    }

    if ($stmt->execute()) {
        header("Location: view_employee.php");
    } else {
        echo "Error updating record: " . $stmt->error;
    }
    
    $stmt->close();
}
?>
