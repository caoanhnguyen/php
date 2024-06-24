<?php
	require_once '../controllers/DBmanager.php';

	class employeeDAO{
		private static $connect;
		private static $add_employee_query = "INSERT INTO employee VALUE (null,?,?,?,?,?,?,?,?,?)";
		private static $delete_employee_query = "DELETE FROM employee WHERE id = ?";
		private static $get_employee_list = "SELECT * FROM employee";
		private static $get_employee_by_id = "SELECT * FROM employee WHERE id = ?";
		private static $update_employee = "UPDATE employee SET name=?, date_of_birth=?, basic_salary=?, so_ngay_lam=?, tro_cap=?, so_san_pham=?, he_so_CV=?, thuong=? WHERE id=?";
		private static $test_update = "UPDATE employee SET name = ? WHERE basic_salary = ?";

		public function __construct() {
	        if (self::$connect === null) {
	            self::$connect = (new DBmanager())->getConnection();
	        }
	    }

		public function add_employee($employee){
			try{
				$stmt = self::$connect->prepare(self::$add_employee_query);

				$name = $employee->getName();
				$dateOFBirth = $employee->getDateOfBirth();
				$basicSalary = $employee->getBasicSalary();
				$employeeType = $employee->getEmployeeType();
				$soNgayLam = NULL;
				$troCap = NULL;
				$soSanPham = NULL;
				$heSoChucVu = NULL;
				$thuong = NULL;
				if($employee instanceof officeEmployee){
					$soNgayLam = $employee->getSoNgayLam();
					$troCap = $employee->getTroCap();
				}elseif($employee instanceof productionEmployee){
					$soSanPham = $employee->getSoSanPham();
				}elseif($employee instanceof managementEmployee){
					$heSoChucVu = $employee->getHeSoChucVu();
					$thuong = $employee->getThuong();
				}
				$stmt->bind_param("ssisiiidi",$name,$dateOFBirth,$basicSalary,$employeeType,$soNgayLam,$troCap,$soSanPham,$heSoChucVu,$thuong);
				if ($stmt->execute()) {
		            return ['success' => true];
		        } else {
		            return ['success' => false, 'message' => $stmt->error];
		        }
			}catch (Exception $e){
				echo '<script>';
                echo 'window.alert("' . $e->getMessage() . '");';
                echo '</script>';
			}
		}

		public function delete_employee($id){
			try{
				$stmt = self::$connect->prepare(self::$delete_employee_query);
				$stmt->bind_param("i",$id);
				if ($stmt->execute()) {
		            return ['success' => true];
		        } else {
		            return ['success' => false, 'message' => $stmt->error];
		        }
			}catch (Exception $e){
				echo '<script>';
                echo 'window.alert("' . $e->getMessage() . '");';
                echo '</script>';
			}
		}

		public function get_employee_list(){
			try{
				$result = self::$connect->query(self::$get_employee_list);
				$employees = [];

	            if ($result->num_rows > 0) {
	                while ($row = $result->fetch_assoc()) {
	                    $employee_type = $row['employee_type'];
	                    $id = $row['id'];
	                    $name = $row['name'];
	                    $birth_date = $row['date_of_birth'];
	                    $basicSalary = $row['basic_salary'];

	                    switch ($employee_type) {
	                        case 'office':
	                            $employee = new officeEmployee($id,$name, $birth_date, $basicSalary, $employee_type, $row['so_ngay_lam'], $row['tro_cap']);
	                            break;
	                        case 'production':
	                            $employee = new productionEmployee($id,$name, $birth_date, $basicSalary, $employee_type, $row['so_san_pham']);
	                            break;
	                        case 'management':
	                            $employee = new managementEmployee($id,$name, $birth_date, $basicSalary, $employee_type, $row['he_so_CV'], $row['thuong']);
	                            break;
	                        default:
	                            continue 2;
	                    }
	                    $employees[] = $employee;
	                }
	            }
	            return $employees;
			}catch(Exception $e){
				echo '<script>';
                echo 'window.alert("' . $e->getMessage() . '");';
                echo '</script>';
			}
		}

		public function get_employee_by_id($id){
		    try{
		        $stmt = self::$connect->prepare(self::$get_employee_by_id);
		        $stmt->bind_param("i", $id);
		        $stmt->execute();
		        
		        $result = $stmt->get_result(); // Lấy kết quả từ câu truy vấn
		        
		        if ($result->num_rows > 0) {
		            $row = $result->fetch_assoc();
		            $employee_type = $row['employee_type'];
		            $id = $row['id'];
		            $name = $row['name'];
		            $birth_date = $row['date_of_birth'];
		            $basicSalary = $row['basic_salary'];

		            switch ($employee_type) {
		                case 'office':
		                    return new officeEmployee($id, $name, $birth_date, $basicSalary, $employee_type, $row['so_ngay_lam'], $row['tro_cap']);
		                    break;
		                case 'production':
		                    return new productionEmployee($id, $name, $birth_date, $basicSalary, $employee_type, $row['so_san_pham']);
		                    break;
		                case 'management':
		                    return new managementEmployee($id, $name, $birth_date, $basicSalary, $employee_type, $row['he_so_CV'], $row['thuong']);
		                    break;
		                default:
		                    return null; // Trường hợp không xác định loại nhân viên
		            }
		        } else {
		            return null; // Không tìm thấy nhân viên
		        }
		    } catch (Exception $e) {
		        echo '<script>';
		        echo 'window.alert("' . $e->getMessage() . '");';
		        echo '</script>';
		        return null; // Xử lý ngoại lệ và trả về null
		    }
		}

		public function update_employee($employee,$id) {
	        try {

	        	// $id = $employee->getId();
		        $name = $employee->getName();
		        $dateOfBirth = $employee->getDateOfBirth();
		        $basicSalary = $employee->getBasicSalary();
		        $employeeType = $employee->getEmployeeType();
		        $soNgayLam = NULL;
		        $troCap = NULL;
		        $soSanPham = NULL;
		        $heSoChucVu = NULL;
		        $thuong = NULL;

		        switch ($employeeType) {
		            case 'office':
		                $soNgayLam = $employee->getSoNgayLam();
		                $troCap = $employee->getTroCap();
		                break;
		            case 'production':
		                $soSanPham = $employee->getSoSanPham();
		                break;
		            case 'management':
		                $heSoChucVu = $employee->getHeSoChucVu();
		                $thuong = $employee->getThuong();
		                break;
		            default:
		                // Xử lý trường hợp không hợp lệ (nếu cần)
		                break;
		        }

	            $stmt = self::$connect->prepare(self::$update_employee);
	            // Binding các tham số
	            $stmt->bind_param("ssiiiidii", $name, $dateOfBirth, $basicSalary, $soNgayLam, $troCap, $soSanPham, $heSoChucVu, $thuong, $id);
	            // $stmt->bind_param("si",$name,$basicSalary);
	            if ($stmt->execute()) {
	                return ['success' => true];
	            } else {
	                return ['success' => false, 'message' => $stmt->error];
	            }
	        } catch (Exception $e) {
	            echo '<script>';
	            echo 'window.alert("' . $e->getMessage() . '");';
	            echo '</script>';
	            return ['success' => false, 'message' => $e->getMessage()];
	        }
		}

	}
?>