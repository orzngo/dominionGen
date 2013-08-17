<?php
$rootPath = dirname(__FILE__);
include_once($rootPath . "/../config/main.php");
include_once($rootPath . "/../actions/main.php");
include_once($rootPath . "/../models/CardList.php");

$selectedCards = RandomSelect::select(array('usingSet'=>array('dominion','seaside')));


$setNames = Configure::cardSetName();
foreach($selectedCards as $key => $card){
	echo "[\${$card['cost']}]{$card['name']}/{$setNames[$card['set']]}\n";
}
