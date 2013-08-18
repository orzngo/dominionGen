<?php
$rootPath = dirname(__FILE__);
include_once($rootPath . "/../../config/main.php");


$fp = fopen($rootPath . "/listSource.txt","r");
if(!$fp){
	exit;
}
$targetfp = fopen($rootPath . "/../../cardList.tsv","w");
while(!feof($fp)){
	$line = fgets($fp);
	if(strpos($line,'<tr class="tr2"') === false && strpos($line,'<tr class="tr3"') === false )
		continue;

	$rawData = explode(">",$line);
	$data = array();
	$value = split('<',$rawData[2]);	$data['no'] = $value[0];
	$value = split("<",$rawData[12]);	$data['set'] = array_search($value[0], Configure::cardSetName());
	$value = split("<",$rawData[18]);	$data['class'] = array_search($value[0], Configure::cardClass());
	$value = split("<",$rawData[5]);	$data['name'] = $value[0];
	$value = split("<",$rawData[10]);	$data['rawName'] = $value[0];
	$value = split("<",$rawData[14]);	$data['cost'] = (int)$value[0];
	$value = split("<",$rawData[20]);
	$data['isAction'] = (strpos($value[0], 'アクション') !== false)?1:0;
	$data['isReaction'] = (strpos($value[0], 'リアクション') !== false)?1:0;
	$data['isVictoryPoint'] = (strpos($value[0], '勝利点') !== false)?1:0;
	$data['isTreasue'] = (strpos($value[0], '財宝') !== false)?1:0;
	if($data['class'] != 2 || (strpos($value[0], '騎士')))
		$data['isRandomTarget'] = 0;
	else
		$data['isRandomTarget'] = 1;


	$dataString = implode("\t",$data);

	fputs($targetfp, $dataString."\n");
};
fclose($fp);
fclose($targetfp);



