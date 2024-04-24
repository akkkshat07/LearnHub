<?php
ob_start(); 
session_start();
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$get = "SELECT * FROM registration WHERE username='$username' AND password='$password' AND status='accept'";
$un = "root";
$upw = "";
$host = "localhost:3308";
$conn = mysqli_connect($host, $un, $upw, "database_college");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$res = mysqli_query($conn, $get);
if (mysqli_num_rows($res) > 0) {
    $r = mysqli_fetch_object($res);
    $fn = $r->first_name;
    $ln = $r->last_name;
    $name = $fn . ' ' . $ln;
    $father = $r->father_name;
    $mother = $r->mother_name;
    $dob = $r->dob;
    $gender = $r->gender;
    $course = $r->course;
    $sem = $r->sem;
    $reg = $r->register_no;
    $phno = $r->phno;
    $email = $r->email;
    $profile_pic = $r->photo;
    $pasword = $r->password;
    $status = 'accept';

    $_SESSION['un'] = $username;
    $_SESSION['name'] = $name;
    $_SESSION['dob'] = $dob;
    $_SESSION['gender'] = $gender;
    $_SESSION['course'] = $course;
    $_SESSION['sem'] = $sem;
    $_SESSION['reg'] = $reg;
    $_SESSION['phno'] = $phno;
    $_SESSION['email'] = $email;
    $_SESSION['pic'] = $profile_pic;
    $_SESSION['pswd'] = $pasword;
    header("location:elearning.php");
} else {
    echo '<script>alert("NOT AUTHENTICATED");window.location="login.php";</script>';
}

mysqli_close($conn);
?>
