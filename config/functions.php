<?php
$current_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$error = (isset($_GET['error']) && $_GET['error'] != '') ? $_GET['error'] : '';
$success = (isset($_GET['success']) && $_GET['success'] != '') ? $_GET['success'] : '';
function get_query_string($keyword, $default){
	return (isset($_GET[$keyword]) && $_GET[$keyword] != '') ? $_GET[$keyword] : $default;
}

function format_money($value){
	return number_format($value, 2, '.', ',');
}

function get_total_load($Id){
	$load_list = loading()->list("accountId=$Id");
	$total = 0;
	foreach ($load_list as $row) {
		$total += $row->amount;
	}

	return $total;
}

function get_total_purchase($Id){
	$order_list = order_items()->list("userId=$Id");
	$total = 0;
	foreach ($order_list as $row) {
		$item = item()->get("Id=$row->itemId");
		$total += $item->price*$row->quantity;
	}

	return $total;
}

function get_available_balance($Id){
	return get_total_load($Id)-get_total_purchase($Id);
}

function char_limit($x, $length){
	$result = $x;
  if(strlen($x)<=$length)
  {
    $result = $x;
  }
  else
  {
    $y=substr($x,0,$length) . '...';
    $result = $y;
  }

	return $result;
}


function get_average_ratings($itemId){
  $rating_total = ratings()->count("itemId=$itemId");
	$total_rates = 0;
	$average = 0;

	if ($rating_total>0) {
		foreach (ratings()->list("itemId=$itemId") as $row) {
			$total_rates += $row->ratings;
		}
		if ($total_rates!==0) {
			$average = $total_rates/$rating_total;
			$average = floor($average);
		}
	}
	return $average;
}
/* =====================================Functions===================================== */
function send_message($number,$message){
		$ch = curl_init();
		$itexmo = array('1' => $number, '2' => $message, '3' => 'TR-FREDG563327_4I6RV', 'passwd' => '$]najkmlh!');
		curl_setopt($ch, CURLOPT_URL,"https://www.itexmo.com/php_api/api.php");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($itexmo));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		return curl_exec ($ch);
		curl_close ($ch);
}
/* =====================================Functions===================================== */
/* Retrieve one record */
function uploadFile($uploadedFile){
	// Where the file is going to be placed
	$target_path = "../media/";
	/* Add the original filename to our target path.
	Result is "uploads/filename.extension" */
	// $target_path = $target_path . basename( $uploadedFile['name']);
	$temp = explode(".", $uploadedFile["name"]);
	$newfilename = round(microtime(true)) . $uploadedFile["name"];
	if(move_uploaded_file($uploadedFile['tmp_name'], $target_path . $newfilename)) {
			return $newfilename;
		}
		else{
			return 0;
		}
}
/* Retrieve one record */
function uploadMultipleFile($uploadedFile){
	$filenameList = array();
	$countfiles = count($uploadedFile['name']);
	if ($countfiles>0){
		for($i=0;$i<$countfiles;$i++){
			// File name
		   	$filename = $uploadedFile['name'][$i];
		   	// Get extension
	  		 $ext = explode(".", $filename);
			 	 $newfilename = round(microtime(true)*($i+1)) . '.' . end($ext);
			   if(move_uploaded_file($uploadedFile['tmp_name'][$i],'../../media/'.$newfilename)){
			   		$filenameList[] = $newfilename;
				}
				else{
			   		$filenameList['error'] = true;
				}
		}
			return $filenameList;
	}
	else{
			return false;
	}
}
?>
