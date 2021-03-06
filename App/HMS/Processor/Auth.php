<?php

namespace HMS\Processor;

use HMS\Database\Database as DB;

/**
 * Class Auth
 * @package HMS\Processor
 */
class Auth
{
	private static $valid = FALSE;

	/**
	 * Logs User In
	 *
	 * @param array $source
	 * @param array $params
	 * @return void
	 */
	public static function logIn(array $source, array $params = array())
	{

		$username = Functions::escape($source['username']);
		$password = Functions::escape($source['password']);
		$table = $params['table'] ?? 'users';
		$column = $params['column'] ?? 'username';
		$user = DB::_db()->get("$table", '*', ["$column" => "$username"]);

		if ($user) {
			self::$valid = password_verify($password, $user['password']);
			if (self::$valid) {
				$_SESSION['loggedIn'] = true;
				$_SESSION['user']['username'] = $user['username'];
				$_SESSION['user']['type'] = $user['type'];
				Functions::toast('Login successful');
				self::redirectUser(Sessions::get('user/type'));
			} else {
				Functions::toast('Incorrect Login Details');
			}
		} else {
			Functions::toast('Incorrect Login Details');
		}
		return self::$valid;
	}

	/**
	 * Redirect user to given path
	 *
	 * @param string $user
	 * @return void
	 */
	public static function redirectUser(string $user)
	{
		if ($user === 'admin') {
			Functions::redirect('Views/Admin/');
		} elseif ($user === 'patient') {
			Functions::redirect('Views/Patient/');
		} elseif ($user === 'doctor' || $user === 'specialist') {
			Functions::redirect('Views/Doctor/');
		}
	}

	public
		/**
		 * @param string $key
		 * @param string $path
		 */
	static function logOut(string $key = 'logOut', string $path = 'index.php')
	{
		if (Input::getExists($key)) {
			Sessions::destroy();
			Functions::redirect($path);
		}
	}


	/**
	 * Confirms login
	 *
	 * @param string $path
	 * @return void
	 */
	public static function confirmLogin(string $path = 'index.php')
	{
		$status = Sessions::get('loggedIn') ?? FALSE;
		if ($status === FALSE): Functions::redirect($path);endif;
	}

	/**
	 * Confirms User Type
	 *
	 * @param string $type
	 * @return void
	 */
	public static function confirmType(string $type)
	{
		if (Sessions::get('user/type') !== $type) {
			Functions::redirect('index.php');
		}
	}

	/**
	 * Log in user if previous session exists
	 */
	public static function loginBySession()
	{
		if (Sessions::get('loggedIn')) :
			Auth::redirectUser(Sessions::get('user/type'));
		endif;
	}
}
