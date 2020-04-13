<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: *');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Credentials: true');
$images = [
	["name" => "My First Image", "uri" => "https://place-hold.it/400"],
	["name" => "My Second Image", "uri" => "https://place-hold.it/400"],
	["name" => "My Thrid Image", "uri" => "https://place-hold.it/400"],
];

foreach($images as $key => $image) {
	$image[$key]['image_id'] = $key + 1;
}
echo json_encode($images);