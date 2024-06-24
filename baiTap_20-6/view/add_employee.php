<?php
    session_start();
    $message = '';

    if (isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
        echo '<script>';
        echo 'window.alert("' . $message . '");';
        echo '</script>';
        unset($_SESSION['message']); 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>ABC company</title>
    <title>Add Employee</title>
</head>
<body>
    <div class="container d-flex flex-column justify-content-center align-items-center mt-4 border py-5 px-5">
        <h1>Add Employee</h1>
        <form id="add_employee_form" style="max-width: 300px; width: 400px" class="form" action="../controllers/controller.php" method="post">
            <input type="hidden" name="action" value="add">
            <label class="form-label" for="name">Name:</label>
            <input class="form-control" type="text" id="name" name="name" required><br>

            <label for="birth_date">Birth Date:</label>
            <input style="width:200px" class="form-control" type="date" id="birth_date" name="birth_date" required><br>

            <label for="basic_salary">Basic Salary:</label>
            <input class="form-control" type="number" step="0.01" id="basic_salary" name="basic_salary" required><br>

            <label for="employee_type">Employee Type:</label>
            <select style="width:200px" class="form-control" id="employee_type" name="employee_type" required>
                <option value="office">Office</option>
                <option value="production">Production</option>
                <option value="management">Management</option>
            </select><br>


            <!-- // selected option  -->
            <div id="office_employee_field">
                <label class="form-label" for="office_bonus">So ngay lam:</label><br>
                <input type="number" id="office_soNgayLam" name="office_soNgayLam">
                <br><br>
                <label class="form-label" for="office_bonus">Tro cap:</label><br>
                <input type="number" id="office_troCap" name="office_troCap">
                <br><br>
            </div>

            <div id="production_employee_fields">
                <label for="product_count">So san pham:</label><br>
                <input type="number" id="product_soSanPham" name="product_soSanPham"><br><br>
            </div>

            <div id="management_employee_field">
                <label for="management_bonus">He so chuc vu:</label><br>
                <input type="number" step="0.01" id="management_heSo" name="management_heSo">
                <br><br>
                <label for="management_bonus">Thuong:</label><br>
                <input type="number" id="management_thuong" name="management_thuong">
                <br><br>
            </div>

            <button class="btn btn-primary" type="submit">Add Employee</button>
            <a href="employee_list.php" class="btn btn-secondary">Xem Danh Sách</a>

     </form>
    </div>
    <script>
        const employeeTypeField = document.getElementById('employee_type');
        const officeField = document.getElementById('office_employee_field');
        const productionFields = document.getElementById('production_employee_fields');
        const managementField = document.getElementById('management_employee_field');

        function toggleFields() {
            const employeeType = employeeTypeField.value;
            officeField.style.display = employeeType === 'office' ? 'block' : 'none';
            productionFields.style.display = employeeType === 'production' ? 'block' : 'none';
            managementField.style.display = employeeType === 'management' ? 'block' : 'none';
        }

        employeeTypeField.addEventListener('change', toggleFields);

        toggleFields();
    </script>
</body>
</html>
