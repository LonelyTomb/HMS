<?php

namespace HMS\Processor;
/**
 * Class Functions
 * @package HMS\Processor
 */
class Functions
{
	/**
	 * Outputs variable and terminates continuous execution;
	 *
	 * @param string $item value to output
	 * @param bool $rule terminate or not
	 *
	 * @return void
	 */
	public static function debug($item = '', bool $rule = true)
	{
		var_dump($item);
		if ($rule) {
			exit;
		}
	}

	/**
	 * Escapes given string
	 *
	 * @param string $item value to escape
	 *
	 * @return string
	 */
	public static function escape(string $item): string
	{
		$item = trim($item);
		$item = stripslashes($item);
		$item = htmlentities($item);
		return $item;
	}

	/**
	 * Redirect to given path
	 *
	 * @param string $path the file directory from existing project root
	 *
	 * @return void
	 */
	public static function redirect(string $path)
	{
		$path = Site::getRoot() . $path;
		header("location: $path");
		exit;
	}

	/**
	 * Looks for an item within a multidimensional array
	 * or return false if no found
	 *
	 * @param  array $array POST or GET array.
	 *
	 * @param string $item key of item to be found
	 *
	 * @return mixed
	 */
	public static function get(array $array, string $item)
	{
		// if (!is_array($array)) return false;
		if (isset($array[$item])) {
			return $array[$item];
		}
		foreach ($array as $key => $subArray) {
			if (isset($subArray[$item])) {
				return $subArray[$item];
			}
		}
		return false;
	}

	/**
	 *  PHP Materialize error toast function
	 *
	 * @param string $item Alert message
	 *
	 * @param int $time duration of popup;
	 *
	 * @return void
	 */
	public static function toast(string $item, int $time = 4000)
	{
		echo "<script>Materialize.toast('{$item}',{$time})</script>";
	}

	/**
	 * @param array $options
	 */
	public static function jGrowl(array $options)
	{
		$message = $options['message'] ?? '';
		$header = $options['header'] ?? '';
		$theme = $options['theme'] ?? 'bg-primary';
		$position = $options['position'] ?? 'top-right';
		$sticky = $options['sticky'] ?? false;
		$life = $options['life'] ?? 5000;


		echo "<script>
    (function () {
        $.jGrowl('{$message}', {
            header: '{$header}',
            theme: '{$theme}',
            position:'{$position}',
            life:'{$life}'
        });
    })()

</script>";
	}

	/**
	 * @param string $string
	 */
	public static function toggleActive(string $string)
	{

		echo Input::getExists($string) ? 'active' : '';


	}
}