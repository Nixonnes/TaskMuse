<?php

class MyPDO extends PDO
{
	
	public function __construct($file = 'pdo_settings.ini')
	{
		$settings = parse_ini_file($file, TRUE);
		if (!$settings = parse_ini_file($file, TRUE)) throw new exception ('Unable to open'. $file. '.');

$dns = $settings['database']['driver'] .
        ':host=' . $settings['database']['host'] .
        ((!empty($settings['database']['port'])) ? (';port=' . $settings['database']['port']) : '') .
        ';dbname=' . $settings['database']['schema'];

				parent::__construct($dns, $settings['database']['username'], $settings['database']['password']);
	}
}
?>