<?php
include_once("../../config/main.php");


$fp = fopen("./listSource.txt","r");
if(!$fp){
	exit;
}
$targetfp = fopen("../../cardList.tsv","w");
while(!feof($fp)){
	$line = fgets($fp);
	if(strpos($line,'<tr class="tr2"') === false && strpos($line,'<tr class="tr3"') === false )
		continue;

	$rawData = explode(">",$line);

	$data = array(
		'no' => split("<",$rawData[2])[0],
		'set' => array_search(split("<",$rawData[12])[0], $cardSetName),
		'class' => array_search(split("<",$rawData[18])[0], $cardClass),
		'name' => split("<",$rawData[5])[0],
		'rawName' => split("<",$rawData[10])[0],
		'cost' => (int)split("<",$rawData[14])[0],
		'isAction' => (strpos(split("<",$rawData[20])[0], 'アクション') !== false)?1:0,
		'isReaction' => (strpos(split("<",$rawData[20])[0], 'リアクション') !== false)?1:0,
		'isVictoryPoint' => (strpos(split("<",$rawData[20])[0], '勝利点') !== false)?1:0,
		'isTreasure' => (strpos(split("<",$rawData[20])[0], '財宝') !== false)?1:0,
	);

	$dataString = implode("\t",$data);

	fputs($targetfp, $dataString."\n");
};
fclose($fp);
fclose($targetfp);



