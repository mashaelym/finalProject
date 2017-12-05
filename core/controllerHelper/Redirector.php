<?php

namespace httpRedirect;
class Redirector
{
	/**
	 * convert an array into urlParamsArray
	 * parameters
	 */
	public static function redirect(array $urlParamsArray)
	{
		$qs = http_build_query($urlParamsArray); 
		header('Location: index.php?' . $qs);
	}
}

?>