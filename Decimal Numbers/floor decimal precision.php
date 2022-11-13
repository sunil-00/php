<?php
	// version 7.3.9

	// floor decimal numbers with any provided precision


	// 2.99999 * 100
	// 299.998...
	// flooring
	// 299
	// 299/100
	// 299
	function convert($value, $precision)
	{
		$multipler = pow(10, $precision); 
		$result = floor($value * $multipler) / $multipler;

		return $result;
	}

	$new_line_character = "\n";

	print convert(2.99999, 2).$new_line_character;
	print convert(199.99999, 4).$new_line_character;

?>