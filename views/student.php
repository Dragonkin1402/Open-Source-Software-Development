<!DOCTYPE html>
<html>

<head>
    <title>DNU - OpenSource</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-3">
        <h3 class="mt-3">DANH SÁCH SINH VIÊN</h3>
        
        <?php
        // Hiển thị thông báo thành công
        if (isset($_GET['success'])) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                ' . htmlspecialchars($_GET['success']) . '
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>';
        }
        
        // Hiển thị thông báo lỗi
        if (isset($_GET['error'])) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                ' . htmlspecialchars($_GET['error']) . '
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>';
        }
        ?>
        
        <a href="create_student.php" class="btn btn-primary mb-3">Create</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">STT</th>
                    <th scope="col">ID</th>
                    <th scope="col">Mã sinh viên</th>
                    <th scope="col">Họ và tên</th>
                    <th scope="col">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // Gọi hàm để lấy dữ liệu students
                    require_once '../functions/student_functions.php';
                    $students = getAllStudents();
                    
                    foreach($students as $index => $stu){
                        $stt = $index + 1;
                        echo "<tr>
                            <th scope='row'>{$stt}</th>
                            <td>{$stu["id"]}</td>
                            <td>{$stu["student_code"]}</td> 
                            <td>{$stu["student_name"]}</td>
                            <td>
                                <button type='button' class='btn btn-warning'>Edit</button>
                                <button type='button' class='btn btn-danger'>Delete</button>
                            </td>
                        </tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>


</html>