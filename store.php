<?php
$fn = $_POST['fn'] ?? '';
$ln = $_POST['ln'] ?? '';
$father = $_POST['father'] ?? '';
$mother = $_POST['mother'] ?? '';
$dob = $_POST['dob'] ?? '';
$gender = $_POST['gender'] ?? '';
$course = $_POST['course'] ?? '';
$sem = $_POST['sem'] ?? '';
$reg = $_POST['reg'] ?? '';
$addr = $_POST['addr'] ?? '';
$city = $_POST['city'] ?? '';
$pin = $_POST['pin'] ?? '';
$phno = $_POST['phno'] ?? '';
$email = $_POST['email'] ?? '';
$user = $_POST['username'] ?? '';
$pw = $_POST['pw'] ?? '';
$cpw = $_POST['cpw'] ?? '';
$regdate = date('d/m/Y');

/* PROFILE UPLOAD   */
$pic = $_FILES['profile']['name'] ?? '';
$target = "profile_upload/" . $pic;
move_uploaded_file($_FILES['profile']['tmp_name'], $target);

$un = "root";
$upw = "";
$host = "localhost:3308";
$conn = mysqli_connect($host, $un, $upw, "database_college");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if username already exists
$usernameExistsQuery = "SELECT COUNT(*) as count FROM registration WHERE username = '$user'";
$usernameExistsResult = mysqli_query($conn, $usernameExistsQuery);
$usernameExistsRow = mysqli_fetch_assoc($usernameExistsResult);
$usernameCount = $usernameExistsRow['count'];

if ($usernameCount > 0) {
    echo '<script>alert("Username already exists. Please choose a different username.");window.location="registration.php";</script>';
    exit; // Exit to prevent further execution
}

// Continue with the rest of your code
$query = "INSERT INTO registration (regdate, first_name, last_name, father_name, mother_name, dob, gender, course, sem, register_no, address, city, pin, phno, email, photo, username, password, status) 
          VALUES ('$regdate', '$fn', '$ln', '$father', '$mother', '$dob', '$gender', '$course', '$sem', '$reg', '$addr', '$city', '$pin', '$phno', '$email', '$pic', '$user', '$pw', 'reject')";

if ($pw == $cpw) {
    mysqli_query($conn, $query);
    echo '<script>alert("REGISTERED SUCCESSFULLY");window.location="login.php";</script>';
} else {
    echo '<script>alert("PASSWORD DOES NOT MATCH");window.location="registration.php";</script>';
}

mysqli_close($conn);

?>
