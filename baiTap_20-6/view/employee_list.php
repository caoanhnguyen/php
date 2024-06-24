<?php
    require_once '../controllers/controller.php';
    $controller = new employeeController();
    $employees = $controller->getEmployeeList();
    $message = '';

    if (isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
        echo '<script>';
        echo 'window.alert("' . $message . '");';
        echo '</script>';
        unset($_SESSION['message']); // Xóa thông báo sau khi hiển thị
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Nhân Viên</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../asset/style.css">
    <script>
        function confirmDelete(form) {
            if (confirm("Are you sure you want to delete this employee?")) {
                form.submit();
            }
        };
    </script>
</head>
<body>
    <div class="container-fluid mt-4">
        <h1>Danh Sách Nhân Viên</h1>
        <table class="table border">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Birth Date</th>
                    <th>Basic Salary</th>
                    <th>Employee Type</th>
                    <th>Số Ngày Làm</th>
                    <th>Trợ Cấp</th>
                    <th>Số Sản Phẩm</th>
                    <th>Hệ Số Chức Vụ</th>
                    <th>Thưởng</th>
                    <th>Lương thực nhận</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($employees as $employee): ?>
                <tr>
                    <input type="hidden" name="id" value="<?php echo $employee->getId(); ?>">
                    <td id="employee_id"><?php echo $employee->getId(); ?></td>
                    <td ><?php echo $employee->getName(); ?></td>
                    <td><?php echo $employee->getDateOfBirth(); ?></td>
                    <td><?php echo $employee->getBasicSalary(); ?></td>
                    <td><?php echo $employee->getEmployeeType(); ?></td>
                    <?php if ($employee instanceof officeEmployee): ?>
                        <td><?php echo $employee->getSoNgayLam(); ?></td>
                        <td><?php echo $employee->getTroCap(); ?></td>
                        <td>NULL</td>
                        <td>NULL</td>
                        <td>NULL</td>
                    <?php elseif ($employee instanceof productionEmployee): ?>
                        <td>NULL</td>
                        <td>NULL</td>
                        <td><?php echo $employee->getSoSanPham(); ?></td>
                        <td>NULL</td>
                        <td>NULL</td>
                    <?php elseif ($employee instanceof managementEmployee): ?>
                        <td>NULL</td>
                        <td>NULL</td>
                        <td>NULL</td>
                        <td><?php echo $employee->getHeSoChucVu(); ?></td>
                        <td><?php echo $employee->getThuong(); ?></td>
                    <?php endif; ?>
                    <td><?php echo $employee->getSalary(); ?></td>
                    <td>
                        <form method="post" action="../controllers/controller.php" style="display:inline-block; margin:0;">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="id" value="<?php echo $employee->getId(); ?>">
                            <button class="btn btn-danger" type="button" onclick="confirmDelete(this.form)">Delete</button>
                        </form>
                        <form method="post" action="../view/edit_employee.php" style="display:inline-block; margin:0;">
                            <input type="hidden" name="id" value="<?php echo $employee->getId(); ?>">
                            <button class="btn btn-primary" type="submit">Edit</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <a href="add_employee.php" class="btn btn-secondary">Back</a>
    </div>
</body>
</html>
