<?php
ob_start();
session_start();
$un = "root";
$upw = "";
$host = "localhost:3308";
$conn = mysqli_connect($host, $un, $upw, "database_college");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (empty($_SESSION['un'])) {
    header('location:login.php');
    exit;
} else {
    $mobile = $_POST['mobile'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $sem = $_POST['sem'] ?? '';
    $old_pic = $_POST['old_pic'] ?? '';
    $new_pic_path = '';

    if (!empty($_FILES['profile']['name'])) {
        $new_pic = $_FILES['profile']['name'];
        $target = "profile_upload/" . basename($new_pic);
        if (move_uploaded_file($_FILES['profile']['tmp_name'], $target)) {
            $new_pic_path = $target;
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        $new_pic_path = $old_pic;
    }

    $user = $_SESSION['un'];
    
    $query = "UPDATE registration SET sem=?, phno=?, email=?, photo=?, password=? WHERE username=?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ssssss", $sem, $mobile, $email, $new_pic_path, $password, $user);
    if (mysqli_stmt_execute($stmt)) {
        echo '<script>alert("SUCCESSFULLY UPDATED");window.location="profile.php";</script>';
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
    
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>
