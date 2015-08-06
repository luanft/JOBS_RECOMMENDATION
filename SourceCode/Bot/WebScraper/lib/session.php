<?php
require_once 'model/Model.php';

class Session {
	public static function init() {
		$xpath = new XPathModel ();
		$xpath->getAll ();
		if (mysqli_num_rows ( $xpath ) > 0) {
			while ( $row = mysqli_fetch_assoc ( $xpath ) ) {
				$_SESSION ['home_url'] [] = $row ['home_url'];
				$_SESSION ['base_url'] [] = $row ['base_url'];
				$_SESSION ['xpath_code'] [] = $row ['xpath_code'];
				$_SESSION ['job_xpath'] [] = $row ['job_xpath'];
				$_SESSION ['company_xpath'] [] = $row ['company_xpath'];
				$_SESSION ['location_xpath'] [] = $row ['location_xpath'];
				$_SESSION ['description_xpath'] [] = $row ['description_xpath'];
				$_SESSION ['salary_xpath'] [] = $row ['salary_xpath'];
				$_SESSION ['requirement_xpath'] [] = $row ['requirement_xpath'];
				$_SESSION ['benifit_xpath'] [] = $row ['benifit_xpath'];
				$_SESSION ['expired_xpath'] [] = $row ['expired_xpath'];
				$_SESSION ['tags_xpath'] [] = $row ['tags_xpath'];
				$_SESSION ['login_url'] [] = $row ['login_url'];							
				$_SESSION ['login_data'] [] = $row ['login_data'];
				$_SESSION ['cookie_name'] [] = "cookie" . $row ['id'] . ".txt";
// 				if($row ['login_url'] != "")
// 					login($_SESSION ['login_url'] [], $_SESSION ['login_data'] [], $_SESSION ['cookie_name'] []);
			}
		}
	}
	public static function get_home_url() {
		return $_SESSION ['home_url'];
	}
	public static function get_base_url() {
		return $_SESSION ['base_url'];
	}
	public static function get_xpath_code() {
		return $_SESSION ['xpath_code'];
	}
	public static function get_job_xpath() {
		return $_SESSION ['job_xpath'];
	}
	public static function get_company_xpath() {
		return $_SESSION ['company_xpath'];
	}
	public static function get_location_xpath() {
		return $_SESSION ['location_xpath'];
	}
	public static function get_description_xpath() {
		return $_SESSION ['description_xpath'];
	}
	public static function get_salary_xpath() {
		return $_SESSION ['salary_xpath'];
	}
	public static function get_requirement_xpath() {
		return $_SESSION ['requirement_xpath'];
	}
	public static function get_benifit_xpath() {
		return $_SESSION ['benifit_xpath'];
	}
	public static function get_expired_xpath() {
		return $_SESSION ['expired_xpath'];
	}
	public static function get_tags_xpath() {
		return $_SESSION ['tags_xpath'];
	}
	public static function get_login_url() {
		return $_SESSION ['login_url'];
	}
	public static function get_login_data() {
		return $_SESSION ['login_data'];
	}
	public static function get_cookie_name() {
		return $_SESSION ['cookie_name'];
	}
	public function __construct() {
	}
	public static function clear() {
		session_unset ();
	}
}
?>