<?php
	// version 7.3.9

	$response = file_get_contents("https://dummyjson.com/products/search?q=Laptop");
	// converting the response string as json.
	$decoded_json = json_decode($response, true);

	// array to store information with headers.
	$new_array = array(array("Title", "Price", "Brand"));
	
	// looping through each product to get the desired content.
	foreach ($decoded_json["products"] as $key => $value){
		$title = $value["title"];
		$price = $value["price"];
		$brand = $value["brand"];

		array_push($new_array, array($title, $price, $brand));
	}
	
	// dumping everything to a file
	$file = fopen("laptop.csv","w");

	foreach ($new_array as $line) {
		fputcsv($file, $line);
	}

	fclose($file);

?>