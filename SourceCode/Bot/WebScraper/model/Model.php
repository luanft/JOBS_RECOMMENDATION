<?php
// $_SERVER["DOCUMENT_ROOT"]
require_once $_SERVER ["DOCUMENT_ROOT"] . '/Lib/connection.php';
class Model {
	protected $connection;
	public function __construct() {
		$this->connection = new Connection ();
	}
}
;
class XpathObject {
	public $xpath_code;
	public $job;
	public $company;
	public $location;
	public $description;
	public $salary_xpath;
	public $requirement;
	public $benifit;
	public $expired;
	public $tags;
	public function __construct() {
	}
}
class AccountObject {
	public $AccountId;
	public $UserName;
	public $Email;
	public $Password;
	public $AccountType;
}
class AccountModel extends Model {
	public function __construct() {
		parent::__construct ();
	}
	public function insert($userName, $email, $password, $accountType) {
		if ($this->isExisted ( $userName ))
			return false;
		$sql = "INSERT INTO `account`(`UserName`, `Email`, `Password`, `AccountType`) VALUES ('$userName','$email','$password','$accountType')";
		$this->connection->connect ();
		$rs = $this->connection->write ( $sql );
		$this->connection->close ();
		return $rs;
	}
	public function getAccountInformation($userName) {
		$sql = "SELECT `AccountId`, `UserName`, `Email`, `Password`, `AccountType` FROM `account` WHERE `UserName`='$userName'";
		$this->connection->connect ();
		$rs = $this->connection->read ( $sql );
		$this->connection->close ();
		return $rs;
	}
	public function getAccountId($userName) {
		$sql = "SELECT `AccountId` FROM `account` WHERE `UserName`='$userName'";
		$this->connection->connect ();
		$data = $this->connection->read ( $sql );
		$this->connection->close ();
		if ($data) {
			if (mysqli_num_rows ( $data ) > 0) {
				$rows = mysqli_fetch_assoc ( $data );
				return $rows ['AccountId'];
			} else {
				return NULL;
			}
		} else {
			return NULL;
		}
	}
	public function isExisted($userName) {
		return $this->getAccountId ( $userName ) ? true : false;
	}
	public function getAccountObject($userName) {
		$data = $this->getAccountInformation ( $userName );
		if ($data) {
			
			if (mysqli_num_rows ( $data ) > 0) {
				$rows = mysqli_fetch_assoc ( $data );
				$obj = new AccountObject ();
				$obj->AccountId = $rows ['AccountId'];
				$obj->AccountType = $rows ['AccountType'];
				$obj->Email = $rows ['Email'];
				$obj->UserName = $rows ['UserName'];
				$obj->Password = $rows ['Password'];
				return $obj;
			} else {
				return NULL;
			}
		} else
			return NULL;
	}
}
class ResumeModel extends Model {
	public function __construct() {
		parent::__construct ();
	}
	public function getResumeId($accountId) {
		$sql = "SELECT `ResumeId` FROM `resume` WHERE `AccountId`=='$accountId'";
		$this->connection->connect ();
		$data = $this->connection->read ( $sql );
		$this->connection->close ();
		if ($data) {
			if (mysqli_num_rows ( $data ) > 0) {
				$rows = mysqli_fetch_assoc ( $data );
				return $rows ['ResumeId'];
			} else {
				return NULL;
			}
		} else {
			return NULL;
		}
	}
	public function isExisted($accountId) {
		return $this->getResumeId ( $accountId ) ? true : false;
	}
	public function addResume($AccountId, $Name, $Birthday, $Gender = 'male', $MaritalStatus = 'no', $PlaceOfBirth = '', $Hometown = '', $Nationality = 'Viet Nam', $Avatar = '', $Address = '', $Email, $Phone = '', $Hobby = '') {
		$sql = "INSERT INTO `resume`(`AccountId`, `Name`, `Birthday`, `Gender`, `MaritalStatus`, `PlaceOfBirth`, `Hometown`, `Nationality`, `Avatar`, `Address`, `Email`, `Phone`, `Hobby`)" + " VALUES ('$AccountId','$Name','$Birthday','$Gender','$MaritalStatus','$PlaceOfBirth','$Hometown','$Nationality','$Avatar','$Address','$Email','$Phone','$Hobby')";
	}
}
class JobModel extends Model {
	public function __construct() {
		parent::__construct ();
	}
	public function AddNewJob($AccountId, $JobName, $Location, $Salary, $Description, $Company, $Tags, $Requirement, $Benifit, $Expired, $Source) {
		$sql = "INSERT INTO `job`(`AccountId`, `JobName`, `Location`, `Salary`, `Description`, `Company`, `Tags`, `Requirement`, `Benifit`, `Expired`, `Source`)" + " VALUES ('$AccountId','$JobName','$Location','$Salary','$Description','$Company','$Tags','$Requirement','$Benifit','$Expired','$Source')";
		$this->connection->connect ();
		$ret = $this->connection->write ( $sql );
		$this->connection->close ();
		return $ret;
	}
	public function isExist($source) {
		$sql = "SELECT `JobId` FROM `job` WHERE `Source` = '$source'";
		$this->connection->connect ();
		$ret = $this->connection->read ( $sql );
		$this->connection->close ();
		if ($ret) {
			if (mysqli_num_rows ( $ret ) > 0) {
				return true;
			}
			return false;
		} else {
			return false;
		}
	}
}
class CompanyModel extends Model {
	public function __construct() {
		parent::__construct ();
	}
	public function addDescription($CompanyId, $AccountId, $CompanyName, $CompanyDescription, $Email, $Phone, $Fax, $Address, $Website, $Logo) {
		$sql = "INSERT INTO `company_sumary`(`AccountId`, `CompanyName`, `CompanyDescription`, `Email`, `Phone`, `Fax`, `Address`, `Website`, `Logo`) " + "VALUES ('$CompanyId', '$AccountId', '$CompanyName', '$CompanyDescription', '$Email', '$Phone', '$Fax', '$Address', '$Website', '$Logo')";
		$this->connection->connect ();
		$ret = $this->connection->write ( $sql );
		$this->connection->close ();
		return $ret;
	}
	public function isExist($accountId) {
		$sql = "SELECT `CompanyId` FROM `company_sumary` WHERE `AccountId` = '$accountId'";
		$this->connection->connect ();
		$ret = $this->connection->read ( $sql );
		$this->connection->close ();
		if ($ret) {
			if (mysqli_num_rows ( $ret ) > 0) {
				return true;
			}
			return false;
		} else {
			return false;
		}
	}
}
class XPathModel extends Model {
	public function __construct() {
		parent::__construct ();
	}
	public function save($home_url, $base_url, $xpath_code, $login_url, $login_data, $job_xpath, $company_xpath, $location_xpath, $description_xpath, $salary_xpath, $requirement_xpath, $benifit_xpath, $expired_xpath, $tags_xpath) {
		$home_url = addslashes ( $home_url );
		$base_url = addslashes ( $base_url );
		$xpath_code = addslashes ( $xpath_code );
		$login_url = addslashes ( $login_url );
		$login_data = addslashes ( $login_data );
		$job_xpath = addslashes ( $job_xpath );
		$company_xpath = addslashes ( $company_xpath );
		$location_xpath = addslashes ( $location_xpath );
		$description_xpath = addslashes ( $description_xpath );
		$salary_xpath = addslashes ( $salary_xpath );
		$requirement_xpath = addslashes ( $requirement_xpath );
		$benifit_xpath = addslashes ( $benifit_xpath );
		$expired_xpath = addslashes ( $expired_xpath );
		$tags_xpath = addslashes ( $tags_xpath );
		
		$this->connection->connect ();
		$this->connection->write ( "INSERT INTO `job_xpath`(`home_url`, `base_url`, `xpath_code`, `login_url`, `login_data`, `job_xpath`, `company_xpath`, `location_xpath`, `description_xpath`, `salary_xpath`, `requirement_xpath`, `benifit_xpath`, `expired_xpath`, `tags_xpath`) VALUES ('$home_url','$base_url','$xpath_code','$login_url','$login_data','$job_xpath','$company_xpath','$location_xpath','$description_xpath','$salary_xpath','$requirement_xpath','$benifit_xpath', '$expired_xpath', '$tags_xpath')" );
		$this->connection->close ();
	}
	public function get($home_url) {
		$this->connection->connect ();
		$data = $this->connection->read ( "SELECT  * from job_xpath where home_url='" . $home_url . "'" );
		$this->connection->close ();
		return $data;
	}
	public function getAll() {
		$this->connection->connect ();
		$data = $this->connection->read ( "SELECT * from job_xpath" );
		$this->connection->close ();
		return $data;
	}
	public function update($page_url, $base_url, $xpath_code, $login_url, $login_data, $job, $company, $location, $decription, $salary, $requirement, $benifit, $exprired, $tags) {
		$this->connection->connect ();
		$sql = "Update job_xpath set
				home_url='".$page_url."',
						base_url='".$base_url."',
			xpath_code='" . $xpath_code . "',
					login_url='".$login_url."',
							login_data='".$login_data."',
			job_xpath='" . $job . "',
    		company_xpath='" . $company . "',
    		location_xpath='" . $location . "',
    		description_xpath='" . $decription . "',
    salary_xpath='" . $salary . "',
    requirement_xpath='" . $requirement . "',
    benifit_xpath='" . $benifit . "',
    expired_xpath='" . $exprired . "',
    tags_xpath='" . $tags . "' where home_url='" . $page_url . "'";
		$this->connection->write ( $sql );
		$this->connection->close ();
	}
}

?>