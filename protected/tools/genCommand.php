<?php
/**
 * usage
 * php genCommand.php
 * php genCommand.php --usingSet="dominion" --usingSet="seaside" .......
 *
 */
$rootPath = dirname(__FILE__);
include_once($rootPath . "/../config/main.php");
include_once($rootPath . "/../actions/main.php");
include_once($rootPath . "/../models/CardList.php");

$options = getopt("",array(
	"usingSet::",
	"usePlatinum::",
));
$params = GetParse::parseSearchParams($options);

$selectedCards = RandomSelect::select($params);


$setNames = Configure::cardSetName();
echo("サプライ\n");
foreach($selectedCards['supply'] as $card){
	$setName =mb_strcut($setNames[$card['set']],0,6);
	echo "  [$setName]\${$card['cost']} {$card['name']}\n";
}
echo("オプションカード\n");
foreach($selectedCards['optionalCards'] as $card){
	$setName =mb_strcut($setNames[$card['set']],0,6);
	echo "  [$setName]\${$card['cost']} {$card['name']}\n";
}
