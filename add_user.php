<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "ung_dung_co_xuong_khop_cua_ban";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

$uid = $_POST['uid'];
$email = $_POST['email'];
$full_name = $_POST['full_name'];

$sql = "INSERT INTO users (uid, email, full_name) 
        VALUES (?, ?, ?) 
        ON DUPLICATE KEY UPDATE 
        email = VALUES(email), 
        full_name = VALUES(full_name)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $uid, $email, $full_name);

if ($stmt->execute()) {
    echo "Thành công";
} else {
    echo "Lỗi: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
