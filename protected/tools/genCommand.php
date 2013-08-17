<?php
include_once("../config/main.php");
include_once("../actions/main.php");
include_once("../models/CardList.php");

$cardList = new CardList();
$targetSets = array(
	$cardList->getCards(array('set'=>'0')),
	$cardList->getCards(array('set'=>'8')),
	$cardList->getCards(array('set'=>'5')),
	$cardList->getCards(array('set'=>'4')),
);

$targetCards = array();
foreach($targetSets as $set){
	foreach($set as $card){
		$targetCards[] = $card;
	}
}

$selectedIndexs = array_rand($targetCards, 10);
foreach($selectedIndexs as $index){
	$card = $targetCards[$index];
	echo "{$card['name']}\n";
}


