<?php

echo "bonjour\n";

// Is PDO installed?
if (!defined('PDO::ATTR_DRIVER_NAME')) {
	echo "PDO is unavailable\n";
	}
	elseif (defined('PDO::ATTR_DRIVER_NAME')) {
	echo "PDO is available\n";
	}

echo $_SERVER['SCRIPT_FILENAME']; ?>