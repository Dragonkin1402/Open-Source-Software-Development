<?php
session_start();
require_once '../functions/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    handleLogin();
}

function handleLogin() {
    $conn = getDbConnection();
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    
    // Kiểm tra input rỗng
    if (empty($username) || empty($password)) {
        $_SESSION['error'] = 'Vui lòng nhập đầy đủ username và password!';
        header('Location: ../index.php');
        exit();
    }
    // Chuẩn bị câu lệnh SQL - chỉ tìm theo username
    $sql = "SELECT id, username, password FROM users WHERE username = ? LIMIT 1";
    // Chuẩn bị statement
    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) {
        $_SESSION['error'] = 'Lỗi truy vấn database: ' . mysqli_error($conn);
        header('Location: ../index.php');
        exit();
    }
    // Gắn tham số vào statement
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    // Kiểm tra có user nào khớp username không
    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);    
        if ($password === $user['password']) {
            // Đăng nhập thành công
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['success'] = 'Đăng nhập thành công!';
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            header('Location: ../views/student.php');
            exit();
        }
    }
    // Đăng nhập thất bại
    $_SESSION['error'] = 'Tên đăng nhập hoặc mật khẩu không đúng!';
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    header('Location: ../index.php');
    exit();
}
?>