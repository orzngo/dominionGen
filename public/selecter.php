<?php
$rootPath = dirname(__FILE__);
include_once($rootPath . "/../protected/config/main.php");
include_once($rootPath . "/../protected/actions/main.php");
include_once($rootPath . "/../protected/models/CardList.php");



$params = GetParse::parseSearchParams($_GET);
$selectedCards = RandomSelect::select($params);

$resultNumbers = array(
	'card' => array(),
	'option' => array()
);
foreach($selectedCards['supply'] as $card){
	$resultNumbers['card'][] = $card['no'];
}
foreach($selectedCards['optionalCards'] as $card){
	$resultNumbers['option'][] = $card['no'];
}
$query = http_build_query($resultNumbers);
header("Location: ./viewer.php". "?" . $query);
exit;
