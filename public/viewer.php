<?php
include_once("../protected/config/main.php");
include_once("../protected/actions/main.php");
include_once("../protected/models/CardList.php");

$result = GetParse::parseViewerParams($_GET);
$cardList = $result['supply'];
$optionalList = $result['optionalCards'];
$setNames = Configure::cardSetName();
if(is_null($cardList)){
	echo "カードセットが指定されていません！";
}else{
	echo "<h1>本日のセット</h1>";
	echo "<ul>";
	foreach($cardList as $card){
		$setName = mb_strcut($setNames[$card['set']],0,6);
		echo "<li>$setName \${$card['cost']} {$card['name']}</li>";
	}
	echo "</ul>";
	echo "<ul>";
	foreach($optionalList as $card){
		$setName = mb_strcut($setNames[$card['set']],0,6);
		echo "<li>$setName \${$card['cost']} {$card['name']}</li>";
	}
	echo "</ul>";
}
