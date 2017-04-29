<?php

namespace HMS\Processor;

use HMS\Database\Database;
use HMS\Processor\{
	Functions,Input,Sessions
}
;
class Auth extends Database{

	private $valid = FALSE;
	public function __construct(){
		parent::__construct();
	}



	/**
	* Logs User In
			     *
			     * @param array $source
			     * @param array $params
			     * @return void
			     */
			    public function logIn(array $source, array $params=array()){
		$username = Functions::escape($source['username']);
		$password = Functions::escape($source['password']);
		$table = $params['table'] ?? "users";
		$column = $params['column'] ?? "username";
		$user = $this->db->get("$table","*",["$column"=>"$username"]);

		if($user){
			$this->valid = password_verify($password,$user['password']);
			if($this->valid){
			var_dump($user);
				$_SESSION['loggedIn'] = true;
				$_SESSION['user']['username'] = $user['username'];
				$_SESSION['user']['type'] = $user['type'];
				if($user['type'] == 'Admin'){
					Functions::redirect('Views/Admin/');
				}elseif($user['type'] == 'Patient'){
					Functions::redirect('Views/Patient/');
				}elseif($user['type'] == 'Doctor' || $user['type'] == 'Specialist'){
					Functions::redirect('Views/Doctor/');
				}
			}else{
			echo "Incorrect Password";
			}
		}
		return $this;
	}


	/**
	* Logs user Out and Redirect to given path
				 *
				 * @param string $key
				 * @param string $path
				 * @return void
				 */
			    public static function  logOut(string $key,string $path='index.php'){
		if(Input::catch($key) !== ""){
			Sessions::destroy();
		}
		Functions::redirect($path);
	}

	/**
	* Confirms login
		 *
		 * @param string $path
		 * @return void
		 */
		public static function confirmLogin(string $path='index.php'){
		$status = $_SESSION['loggedIn'] ?? FALSE;
			if($status == FALSE) Functions::redirect($path);
	}
	/**
	 * Confirms User Type
	 *
	 * @param string $type
	 * @return void
	 */
	public static function confirmType(string $type){
		if($_SESSION['user']['type'] !== $type){
			Functions::redirect('index.php');
		}
	}
}
