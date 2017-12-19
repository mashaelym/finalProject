<?php

class Manage
{
	/**
	 * Private variable to store instance of iterator so we can
	 * cache the results
	 */
	private static $fileIterator = null;

	/**
	 * Autoloader
	 *
	 * More efficient autoloader that gets all the php files at once
	 * Static instance of autoloader so iteration only happens once per file
	 **/
	public static function load($class)
	{
		//get class name
		$parts = explode('\\', $class);
		$className = end($parts) . '.php';
				
		//use directory iterator to get list of files
		//__DIR__ gives us the web root
		$directoryIterator = new RecursiveDirectoryIterator(__DIR__);
		
		//only launch new instance if we already don't have one
		if (is_null(self::$fileIterator))
		{	
			self::$fileIterator = new RecursiveIteratorIterator($directoryIterator);
		}
		
		//include all files in the webroot directory
		foreach (self::$fileIterator as $file)
		{
			if (!$file->isDir())
			{
				//include files
				if(strtolower($file->getFilename()) == strtolower($className))
				{
					require_once $file->getPathname();
					return;
				}
			}
		
		}
	}
	
}

spl_autoload_register('Manage::load');