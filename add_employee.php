<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include("dbconnection.php");

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $country_code = $_POST['country_code'];
    $mobile_number = $_POST['mobile_number'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $hobbies = implode(", ", $_POST['hobbies']);
    
   
    $photo = $_FILES['photo']['name'];
    $photo_tmp = $_FILES['photo']['tmp_name'];
    $photo_folder = "uploads/" . basename($photo);
    $allowed_extensions = array('jpg', 'jpeg', 'png', 'gif');
    $file_extension = pathinfo($photo, PATHINFO_EXTENSION);

    
    if (!is_dir('uploads')) {
        mkdir('uploads', 0755, true); 
    }

    if (in_array($file_extension, $allowed_extensions)) {
        if (move_uploaded_file($photo_tmp, $photo_folder)) {
            $sql = "INSERT INTO employees (first_name, last_name, email, country_code, mobile_number, address, gender, hobbies, photo) 
                    VALUES ('$first_name', '$last_name', '$email', '$country_code', '$mobile_number', '$address', '$gender', '$hobbies', '$photo')";
        
            if (mysqli_query($con, $sql)) {
                header("Location: view_employee.php");
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($con);
            }
        } else {
            echo "Failed to upload photo.";
        }
    } else {
        echo "Only JPG, JPEG, PNG, and GIF files are allowed.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 50%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
            border-radius: 10px;
            margin-top: 30px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 8px;
            font-weight: bold;
        }
        input, select, textarea {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
        }
        input[type="submit"] {
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #218838;
        }
        .photo-upload {
            padding: 10px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Add Employee</h2>
        <form method="POST" enctype="multipart/form-data">
            <label>First Name:</label>
            <input type="text" name="first_name" required>

            <label>Last Name:</label>
            <input type="text" name="last_name" required>

            <label>Email:</label>
            <input type="email" name="email" required>

            <label>Country Code:</label>
            <select name="country_code" required>
                <option value="+91">+91 India</option>
                <option value="+1">+1 USA</option>
                
            </select>

            <label>Mobile Number:</label>
            <input type="number" name="mobile_number" required>

            <label>Address:</label>
            <textarea name="address" rows="4" required></textarea>

            <label>Gender:</label>
            <input type="radio" name="gender" value="Male" required> Male
            <input type="radio" name="gender" value="Female" required> Female

            <label>Hobbies:</label>
            <input type="checkbox" name="hobbies[]" value="Reading"> Reading
            <input type="checkbox" name="hobbies[]" value="Traveling"> Traveling
            <input type="checkbox" name="hobbies[]" value="Sports"> Sports

            <div class="photo-upload">
                <label>Photo:</label>
                <input type="file" name="photo" accept="image/*" required>
            </div>

            <input type="submit" value="Add Employee">
        </form>
    </div>
</body>
</html>
