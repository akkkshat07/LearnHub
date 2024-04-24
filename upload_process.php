<?php
$un = "root";
$upw = "";
$host = "localhost:3308"; // Check if this port is correct
$conn = mysqli_connect($host, $un, $upw, "database_college");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if form is submitted
if(isset($_POST['submit'])) {
    // Get form data
    $course = $_POST['course'];
    $subject = $_POST['subject'];
    $topic = $_POST['topic'];
    $date = $_POST['date'];
    $summary = $_POST['summary'];

    // File upload
    $notes_upload = $_FILES['notes']['name'];
    $notes_tmp = $_FILES['notes']['tmp_name'];
    $notes_target = "Notes_upload/" . $notes_upload;

    $video_upload = $_FILES['video']['name'];
    $video_tmp = $_FILES['video']['tmp_name'];
    $video_target = "Video_upload/" . $video_upload;

    // Move uploaded files to target directory
    if (move_uploaded_file($notes_tmp, $notes_target) && move_uploaded_file($video_tmp, $video_target)) {
        // Insert data into database
        $query= "INSERT INTO tbl_notes_details (course, subject, topic, date, notes, video, summary) 
                  VALUES ('$course', '$subject', '$topic', '$date', '$notes_upload', '$video_upload', '$summary')";

        if (mysqli_query($conn, $query)) {
            echo '<script>alert("UPLOAD SUCCESSFUL");window.location="notesupload.php";</script>';
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Failed to upload files";
    }
}

mysqli_close($conn);
?>
