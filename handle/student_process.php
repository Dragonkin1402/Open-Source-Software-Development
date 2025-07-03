<?php
require_once '../functions/student_functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $student_code = trim($_POST['student_code']);
    $student_name = trim($_POST['student_name']);
    
    // Kiểm tra dữ liệu đầu vào
    if (empty($student_code) || empty($student_name)) {
        header("Location: ../create_student.php?error=Vui lòng điền đầy đủ thông tin");
        exit();
    }
    
    // Gọi hàm thêm sinh viên
    $result = addStudent($student_code, $student_name);
    
    if ($result) {
        header("Location: ../home.php?success=Thêm sinh viên thành công");
    } else {
        header("Location: ../create_student.php?error=Có lỗi xảy ra khi thêm sinh viên");
    }
} else {
    header("Location: ../home.php");
}
exit();
?>
