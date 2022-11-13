<?php
	// version 7.3.9

	function convertDate($usr_date){
	// if statement will run for numeric date input ie 09092021
	  $isNumeric = is_numeric($usr_date);
	  if ($isNumeric){
		// separating as day month and year
		$usr_date_split = str_split($usr_date, 4);

		// converting input to standart format
		$usr_date_split[0] = join(str_split($usr_date_split[0], 2), "/");
		$usr_date_split = join($usr_date_split, "/");

		return date("M-d-Y", strtotime($usr_date_split));
	  }
	  return date("Y-m-d", strtotime($usr_date));
	}

	$usr_input = readline("Enter date: ");
	print convertDate($usr_input);


?>