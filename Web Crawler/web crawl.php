<?php
	// version 7.3.9
	
	// converting rating string to float
	function ratingToFloat($price){
		$var = (float) 0;
		switch ($price){
			case "One":
				$var = 1.0;
				break;
			case "Two":
				$var = 2.0;
				break;
			case "Three":
				$var = 3.0;
				break;
			case "Four":
				$var = 4.0;
				break;
			case "Five":
				$var = 5.0;
				break;
			default:
				$var = 0.0;
				break;
		}

		return $var;
	}
	
	// uses regular expression to extract content for keyword from html
	function getContents($html, $word){
		$pattern = '';
		switch ($word){
			case "title":
				$pattern = '/title="(.*?)"/';
				break;
			case "price":
				$pattern = '/<p class="price_color">£(.*?)<\/p>/';
				break;
			case "stock":
				$pattern = '/<p class="instock availability">(?:.+>)(.*?)<\/p>/';
				break;
			case "rating":
				$pattern = '/<p class="star-rating (.*?)"/';
				break;
			case "url":
				$pattern = '/href="(.*?)"/';
				break;
		}

		$result = array();
		preg_match($pattern, $html, $result);
		return $result[1];
	}
	
	// removes whitespaces linebreak from data
	function RM_WS_LB($data){
		$rm_ws_lb_pattern = '/[\s]+(?:[\s])|[\r\n]/';
		return preg_replace($rm_ws_lb_pattern, "", $data);
	}

	$new_line_character = "\n";
	
	// geting content from the url to scrape
	$url_to_scrape = "https://books.toscrape.com/";
	$response_html = file_get_contents($url_to_scrape);

	$clean_response = RM_WS_LB($response_html);
	
	// using regular expression to extract the list of category with their urls
	$listing_pattern = '/<li><a href="(.*?)">(.*?)<\/a>/';
	preg_match_all($listing_pattern, $clean_response, $matches);

	$urls = $matches[1]; // all urls goes here
	$listings = $matches[2]; // all category title goes here

	$required_index = 0;
	echo "LISTING: ".$new_line_character;
	
	// displaying all the category available
	foreach($listings as $key => $listing){
		if($key == 0 or $key == 1)
			continue;	
		echo $listing.$new_line_character;
	}

	// getting the category 'Science' with its url
	$selected_category = 'Science';
	
	foreach($listings as $key => $listing){
		if($listing == $selected_category){
			$required_index = $key;
		}
	}


	$category_url = $url_to_scrape.$urls[$required_index];

	// jumping to the Science category
	// getting content from the url
	$response_html = file_get_contents($category_url);	
	$clean_response = RM_WS_LB($response_html);

	// using regular expression to get all available products
	$li_pattern = '~<li class="col-xs-6 col-sm-4 col-md-3 col-lg-3">~';
	$card_lists = preg_split($li_pattern, $clean_response);
	array_shift($card_lists);

	$listing_available = $card_lists;

	$new_array = array(array(
		'id',
		'category',
		'category_url',
		'title',
		'price',
		'stock',
		'rating',
		'url'
	));

	foreach($card_lists as $card_list){
	
		// generating random alphanumeric id
		$id = substr(bin2hex(random_bytes(20)), rand(0,32), 8);
		$category = $selected_category;

		$title = getContents($card_list, 'title');
		$price = substr(getContents($card_list, 'price'), 1); // removing pound sign

		$stock = getContents($card_list, 'stock');
		$rating = ratingToFloat(getContents($card_list, 'rating')); 

		$url = getContents($card_list, 'url');
		$url = $category_url."/../".$url;
		array_push(
			$new_array, 
			array(
				$id, $category, $category_url, $title, $price, $stock, $rating, $url
			)
		);
	}

	// dumping everything to a file.
	$file = fopen(strtolower($selected_category)."_listing.csv","w");

	foreach ($new_array as $line) {
		fputcsv($file, $line);
	}

	fclose($file);

?>