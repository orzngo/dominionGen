<?php
include_once("../protected/config/main.php");
include_once("../protected/actions/main.php");
include_once("../protected/models/CardList.php");
$params = GetParser::parseIndexParams($_GET);

?>

<html>
	<head>
		<title>ドミニオンランダムセットジェネレータ</title>
	</head>
	<body>
<?php
foreach(Configure::CardSetName() as $key => $set)
{
	if($set == "プロモ")
		continue;
	$checked = ($params['usingSet'][$key]) ? "checked" : "";
	print("<input type='checkbox' name='usingSet[]' value='$key' $checked>$set</input>");

	$CardList = new CardList();
	$result = $CardList->searchCards(array(
			"isReaction"=>"==1"
		));
	var_dump($result);
}
?>
	</body>
</html>
