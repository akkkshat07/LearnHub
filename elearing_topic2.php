<?php
$notes_id = $_GET['notes_id'];
$un = "root";
$upw = "";
$host = "localhost";
$conn = new mysqli($host, $un, $upw, "college");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("SELECT * FROM tbl_notes_details WHERE notes_id = ?");
$stmt->bind_param("s", $notes_id);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_object()) {
    echo "<a href='Notes_upload/" . htmlspecialchars($row->notes) . "'>Notes Download</a>";
    echo "<a href='Video_upload/" . htmlspecialchars($row->video) . "'>video Download</a>";
} else {
    echo "No notes found";
}

$stmt->close();
$conn->close();
?>
