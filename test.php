<?php

require './hashing/hash.php';

echo "bonjour\n";

// Is PDO installed?
if (!defined('PDO::ATTR_DRIVER_NAME')) {
	echo "PDO is unavailable\n";
	}
	elseif (defined('PDO::ATTR_DRIVER_NAME')) {
	echo "PDO is available\n";
	}

echo $_SERVER['SCRIPT_FILENAME'] . "\n";

echo "test of shamalo\n";
echo shamalo("1") . "\n";
echo shamalo("2") . "\n";
echo shamalo("3") . "\n";
echo shamalo("4") . "\n";
echo shamalo("5") . "\n";
echo shamalo("6") . "\n";
echo shamalo("7") . "\n";
echo shamalo("8") . "\n";
echo shamalo("9") . "\n\n";
echo shamalo("10") . "\n\n";
echo shamalo("bonjour") . "\n\n";
echo shamalo("bonjour123456789") . "\n\n";
echo shamalo("22") . "\n\n";




echo shamalo("1248rfiujdshglkjdsfhgjshdflgjl;esjlgresdlg;krsejoig;") . "\n";

?>