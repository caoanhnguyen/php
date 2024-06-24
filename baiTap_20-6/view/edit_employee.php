<?php
    require_once '../modal/employee.php';
    require_once '../controllers/controller.php';   

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST['id'];
        $controller = new employeeController();
        $employee = $controller->getEmployeeById($id);

        if (!$employee) {
            echo "Employee not found!";
            exit();
        }
    } else {
        echo "Invalid request!";
        exit();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Edit Employee</title>
</head>
<body>
    <div class="container d-flex flex-column justify-content-center align-items-center mt-4 border py-5 px-5">
        <h1>Edit Employee</h1>
        <form id="add_employee_form" style="max-width: 300px; width: 400px" class="form" action="../controllers/controller.php" method="post">
            <input type="hidden" name="action" value="update">
            
            <label class="form-label" for="name">ID:</label>
            <input class="form-control" type="text" id="id" name="id" value="<?php echo $employee->getId();?>"readonly required><br>

            <label class="form-label" for="name">Name:</label>
            <input class="form-control" type="text" id="name" name="name" value="<?php echo $employee->getName();?>" required><br>

            <label for="birth_date">Birth Date:</label>
            <input style="width:200px" class="form-control" type="date" id="birth_date" name="birth_date" value="<?php echo $employee->getDateOfBirth();?>" required><br>

            <label for="basic_salary">Basic Salary:</label>
            <input class="form-control" type="number" step="0.01" id="basic_salary" name="basic_salary" value="<?php echo $employee->getBasicSalary();?>" required><br>

            <label for="employee_type">Employee Type:</label>
            <input class="form-control" type="text" id="employee_type" name="employee_type" value="<?php echo $employee->getEmployeeType();?>"readonly required><br>

            <?php if ($employee instanceof officeEmployee): ?>
                <div id="office_employee_field">
                    <label class="form-label" for="office_soNgayLam">So ngay lam:</label><br>
                    <input type="number" id="office_soNgayLam" name="office_soNgayLam" value="<?php echo $employee->getSoNgayLam(); ?>">
                    <br><br>
                    <label class="form-label" for="office_troCap">Tro cap:</label><br>
                    <input type="number" id="office_troCap" name="office_troCap" value="<?php echo $employee->getTroCap(); ?>">
                    <br><br>
                </div>
            <?php elseif ($employee instanceof productionEmployee): ?>
                <div id="production_employee_fields">
                    <label for="product_soSanPham">So san pham:</label><br>
                    <input type="number" id="product_soSanPham" name="product_soSanPham" value="<?php echo $employee->getSoSanPham(); ?>">
                    <br><br>
                </div>
            <?php elseif ($employee instanceof managementEmployee): ?>
                <div id="management_employee_field">
                    <label for="management_heSo">He so chuc vu:</label><br>
                    <input type="number" step="0.01" id="management_heSo" name="management_heSo" value="<?php echo $employee->getHeSoChucVu(); ?>">
                    <br><br>
                    <label for="management_thuong">Thuong:</label><br>
                    <input type="number" id="management_thuong" name="management_thuong" value="<?php echo $employee->getThuong(); ?>">
                    <br><br>
                </div>
            <?php endif; ?>

            <button class="btn btn-primary" type="submit">Update</button>
            <a href="employee_list.php" class="btn btn-secondary">Xem Danh Sách</a>

     </form>
    </div>
</body>
</html>
