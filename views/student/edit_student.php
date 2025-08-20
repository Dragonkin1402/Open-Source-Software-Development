<?php
require_once '../../functions/auth.php';
checkLogin('../../index.php');
?>
<!DOCTYPE html>
<html>

<head>
    <title>DNU - OpenSource</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include '../menu.php'; ?>
    <div class="container mt-3">
        
        <h3 class="mt-3">CHỈNH SỬA SINH VIÊN</h3>
        
        <?php
        // Kiểm tra có ID không
        if (!isset($_GET['id']) || empty($_GET['id'])) {
            header("Location: ../student.php?error=Không tìm thấy sinh viên");
            exit;
        }
        
        $id = $_GET['id'];
        
        // Lấy thông tin sinh viên
        require_once '../../functions/student_functions.php';
        $student = getStudentById($id);
        
        if (!$student) {
            header("Location: ../student.php?error=Không tìm thấy sinh viên");
            exit;
        }
        
        // Hiển thị thông báo lỗi
        if (isset($_GET['error'])) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                ' . htmlspecialchars($_GET['error']) . '
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>';
        }
        ?>
        
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form action="../../handle/student_process.php" method="POST">
                            <input type="hidden" name="action" value="edit">
                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($student['id']); ?>">
                            
                            <div class="mb-3">
                                <label for="student_code" class="form-label">Mã sinh viên</label>
                                <input type="text" class="form-control" id="student_code" name="student_code" 
                                       value="<?php echo htmlspecialchars($student['student_code']); ?>" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="student_name" class="form-label">Họ và tên</label>
                                <input type="text" class="form-control" id="student_name" name="student_name" 
                                       value="<?php echo htmlspecialchars($student['student_name']); ?>" required>
                            </div>
                            
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="../student.php" class="btn btn-secondary me-md-2">Hủy</a>
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
