<?php
$un = "root";
$upw = "";
$host = "localhost:3308";
$conn = mysqli_connect($host, $un, $upw, "database_college");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$subject = mysqli_real_escape_string($conn, $_POST['subject'] ?? '');
$logo_upload = $_FILES['logo']['name'] ?? '';
$target2 = "Logo_upload/" . $logo_upload;

if (!empty($logo_upload)) {
    if (move_uploaded_file($_FILES['logo']['tmp_name'], $target2)) {
        $query = "INSERT INTO subject_master (subject, logo) VALUES ('$subject', '$logo_upload')";
        if (mysqli_query($conn, $query)) {
            echo '<script>alert("UPLOAD SUCCESSFULLY");window.location="subject_master.php";</script>';
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
} else {
    echo "No file uploaded.";
}

mysqli_close($conn);
?>
