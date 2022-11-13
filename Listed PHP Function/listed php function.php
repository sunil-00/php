<?php
	// version 7.3.9

	// PHP Listed Function
	$new_line_character = "\n";
	// is_int()
	$x = 12;
	$isInt = is_int($x);
	echo "is $x int? $isInt" . $new_line_character;

	$x = "12.5";
	$isInt = is_int($x);
	echo "is \"$x\" int? $isInt" . $new_line_character.$new_line_character;

	// is_numeric()
	$x = 12;
	$isNumeric = is_numeric($x);
	echo "is $x numeric? $isNumeric" . $new_line_character;

	$x = "12.5";
	$isNumeric = is_numeric($x);
	echo "is \"$x\" numeric? $isNumeric" . $new_line_character.$new_line_character;

	// is_integer()
	$x = 12;
	$isInteger = is_integer($x);
	echo "is $x integer? $isInteger" . $new_line_character;

	$x = "12.5";
	$isInteger = is_integer($x);
	echo "is \"$x\" integer? $isInteger" . $new_line_character.$new_line_character;

	// is_int() checks the type of variable, while is_numeric() checks the value of the variable.
?>