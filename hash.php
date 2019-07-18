<?php

function settoalpha($str)
{
	$len = strlen($str);
	$ascii = 0;
	$result = NULL;
	for ($i = 0; $i < $len; $i++)
	{
		if ($len + 1 == strlen($str))
		{
			$ascii = substr($str, $i, 1) + substr($str, ($i % 3), 1) * 10 + 46;
		}
		else {
			$ascii = substr($str, $i, 1) + substr($str, $i + 1, 1) * 10 + 46;
		}
		if (!($ascii >= 48 && $ascii <= 57)) {

			if ($ascii < 65 || $ascii <= 93) {
				while ($ascii < 65) {
					$ascii += 25;
				}
				while ($ascii > 90) {
					$ascii -= 25;
				}
			} else if ($ascii > 93) {
				while ($ascii > 122) {
					$ascii -= 25;
				}
				while ($ascii < 97) {
					$ascii += 25;
				}
			}
		}
		if (!($result == 0)) {
			$result = chr($ascii);
		} else {
			$result .= chr($ascii);
		}
	}
	return ($result);
}

function calcsumchar($str) {
	$result = 0;
	$len = strlen($str);
	for ($i = 0; $i < $len; $i++) {
		$result += ord($str[$i]);
	}
	return ($result);
}

function shamalo($str)
{
	if (!($str) || !is_string($str))
	{
		return (0);
	}
	$sumchar = calcsumchar($str);
	$hash = $sumchar;
	$result = NULL;
	for ($i = 0, $len = strlen($str); $i < $len; $i++) {
		$hash += pow(ord($str[$i]), 2) * ($sumchar % 7);
		$hash = $hash << 4;
		if (!($result == 0))
		{
			$result = settoalpha($hash);
		}
		else {
			$result .= settoalpha($hash);
		}
		if ($hash >= 50000) {
			$hash = $hash % 20000;
		}
	}
	return ($result);
}
?>