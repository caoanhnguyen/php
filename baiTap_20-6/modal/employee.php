<?php
	abstract class Employee{
		protected $id;
		protected $name;
		protected $dateOfBirth;
		protected $basicSalary;
		protected $employeeType;

		public function __construct($id,$name,$dateOfBirth,$basicSalary,$employeeType){
			$this->id = $id;
			$this->name = $name;
			$this->dateOfBirth = $dateOfBirth;
			$this->basicSalary = $basicSalary;
			$this->employeeType = $employeeType;
		}

		abstract public function getSalary();

		// Getters
		public function getId() {
	        return $this->id;
	    }

	    public function getName() {
	        return $this->name;
	    }

	    public function getDateOfBirth() {
	        return $this->dateOfBirth;
	    }

	    public function getBasicSalary() {
	        return $this->basicSalary;
	    }

	    public function getEmployeeType() {
	        return $this->employeeType;
	    }

	    // Setters
	    public function setName($name) {
	        $this->name = $name;
	    }

	    public function setDateOfBirth($dateOfBirth) {
	        $this->dateOfBirth = $dateOfBirth;
	    }

	    public function setBasicSalary($basicSalary) {
	        $this->basicSalary = $basicSalary;
	    }

	    public function setEmployeeType($employeeType) {
	        $this->employeeType = $employeeType;
	    }

	}

	class officeEmployee extends Employee{
		private $soNgayLam;
		private $troCap;

		public function __construct($id,$name,$dateOfBirth,$basicSalary,$employeeType,$soNgayLam,$troCap){

			parent::__construct($id,$name,$dateOfBirth,$basicSalary,$employeeType);
			$this->soNgayLam = $soNgayLam;
			$this->troCap = $troCap;
		}

		public function getSalary(){
			return ($this->basicSalary + $this->soNgayLam*200000 + $this->troCap);
		}

		// Getters
	    public function getSoNgayLam() {
	        return $this->soNgayLam;
	    }

	    public function getTroCap() {
	        return $this->troCap;
	    }

	    // Setters
	    public function setSoNgayLam($soNgayLam) {
	        $this->soNgayLam = $soNgayLam;
	    }

	    public function setTroCap($troCap) {
	        $this->troCap = $troCap;
	    }
	}

	class productionEmployee extends Employee{
		private $soSanPham;

		public function __construct($id,$name,$dateOfBirth,$basicSalary,$employeeType,$soSanPham){

			parent::__construct($id,$name,$dateOfBirth,$basicSalary,$employeeType);
			$this->soSanPham = $soSanPham;
		}

		public function getSalary(){
			return ($this->basicSalary + $this->soSanPham*2000);
		}

		// Getters
	    public function getSoSanPham() {
	        return $this->soSanPham;
	    }

	    // Setters
	    public function setSoSanPham($soSanPham) {
	        $this->soSanPham = $soSanPham;
	    }
	}

	class managementEmployee extends Employee{
		private $heSoChucVu;
		private $thuong;

		public function __construct($id,$name,$dateOfBirth,$basicSalary,$employeeType,$heSoChucVu, $thuong){

			parent::__construct($id,$name,$dateOfBirth,$basicSalary,$employeeType);
			$this->heSoChucVu = $heSoChucVu;
			$this->thuong = $thuong;
		}

		public function getSalary(){
			return ($this->basicSalary*$this->heSoChucVu + $this->thuong);
		}

		// Getters
	    public function getHeSoChucVu() {
	        return $this->heSoChucVu;
	    }

	    public function getThuong() {
	        return $this->thuong;
	    }

	    // Setters
	    public function setHeSoChucVu($heSoChucVu) {
	        $this->heSoChucVu = $heSoChucVu;
	    }

	    public function setThuong($thuong) {
	        $this->thuong = $thuong;
	    }
	}

	
?>