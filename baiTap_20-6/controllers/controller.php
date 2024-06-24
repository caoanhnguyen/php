<?php
	session_start();

	require_once '../modal/employee.php';
	require_once '../DAO/employeeDAO.php';
	require_once '../controllers/DBmanager.php';

	class employeeController{
		private $employeeDAO;

		public function __construct(){
			$this->employeeDAO = new employeeDAO();
		}

		public function addEmployee() {
	        //lay du lieu tu trang nhap lieu
        	$name = $_POST['name'];
			$birth_date = $_POST['birth_date'];
			$basicSalary = $_POST['basic_salary'];
			$employee_type = $_POST['employee_type'];

			$office_soNgayLam = isset($_POST['office_soNgayLam']) ? $_POST['office_soNgayLam'] : NULL;
			$office_troCap = isset($_POST['office_troCap'])?$_POST['office_troCap']:NULL;
			$production_soSanPham = isset($_POST['product_soSanPham']) ? $_POST['product_soSanPham'] : NULL;
			$management_heSo = isset($_POST['management_heSo']) ? $_POST['management_heSo'] : NULL;
			$management_thuong = isset($_POST['management_thuong']) ? $_POST['management_thuong'] : NULL;

			//phan loai emplyee, tao employee
			if($employee_type === "office"){
				$employee = new officeEmployee(null,$name,$birth_date,$basicSalary,$employee_type,$office_soNgayLam,$office_troCap);
			}elseif ($employee_type === "production"){
				$employee = new productionEmployee(null,$name,$birth_date,$basicSalary,$employee_type,$production_soSanPham);
			}elseif($employee_type === "management"){
				$employee = new managementEmployee(null,$name,$birth_date,$basicSalary,$employee_type,$management_heSo,$management_thuong);
			}

	        $result =  $this->employeeDAO->add_employee($employee);

	        if($result['success']){
	        	$_SESSION['message'] = "Employee added successfully!";
	        }else{
	        	$_SESSION['message'] = "Employee added failed!";
	        }
	        header("Location: ../view/add_employee.php");
	        exit();
    	}

    	public function deleteEmployee(){
    		$id = $_POST['id'];
    		$result =  $this->employeeDAO->delete_employee($id);

	        header("Location: ../view/employee_list.php");
	        exit();
    	}

    	public function getEmployeeList(){
    		return $this->employeeDAO->get_employee_list();
    	}

    	public function getEmployeeById($id){
    		return $this->employeeDAO->get_employee_by_id($id);
    	}

    	public function updateEmployee(){
    		$id = $_POST['id'];
    		// echo "<div>" .$id. "<div>";
    		$name = $_POST['name'];
			$birth_date = $_POST['birth_date'];
			$basicSalary = $_POST['basic_salary'];
			$employee_type = $_POST['employee_type'];

			$office_soNgayLam = isset($_POST['office_soNgayLam']) ? $_POST['office_soNgayLam'] : NULL;
			$office_troCap = isset($_POST['office_troCap'])?$_POST['office_troCap']:NULL;
			$production_soSanPham = isset($_POST['product_soSanPham']) ? $_POST['product_soSanPham'] : NULL;
			$management_heSo = isset($_POST['management_heSo']) ? $_POST['management_heSo'] : NULL;
			$management_thuong = isset($_POST['management_thuong']) ? $_POST['management_thuong'] : NULL;

			//phan loai emplyee, tao employee
			if($employee_type === "office"){
				$employee = new officeEmployee(null,$name,$birth_date,$basicSalary,$employee_type,$office_soNgayLam,$office_troCap);
			}elseif ($employee_type === "production"){
				$employee = new productionEmployee(null,$name,$birth_date,$basicSalary,$employee_type,$production_soSanPham);
			}elseif($employee_type === "management"){
				$employee = new managementEmployee(null,$name,$birth_date,$basicSalary,$employee_type,$management_heSo,$management_thuong);
			}

	        $result = $this->employeeDAO->update_employee($employee,$id);

	        if($result['success']){
	        	$_SESSION['message'] = "Employee updated successfully!";
	        }else{
	        	$_SESSION['message'] = "Employee updated failed!";
	        }
	        header("Location: ../view/employee_list.php");
	        exit();
    	}
	}

	// Xử lý action từ form gửi POST
	$controller = new employeeController();

	if (isset($_POST['action'])) {
	    if ($_POST['action'] == 'add') {
	        $controller->addEmployee();
	    } elseif ($_POST['action'] == 'delete') {
	        $controller->deleteEmployee();
	    } elseif ($_POST['action'] == 'update') {
	    	$controller->updateEmployee();
	    }
	}
?>