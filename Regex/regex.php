<?php
	// version 7.3.9
	
	// using regular expression to split the given string on @.
	$provided_str = "abc@grepsr.com";
	$result = preg_split("/@/", $provided_str);

	print_r($result);

?>