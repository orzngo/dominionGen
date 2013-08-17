<?php
include_once("../protected/config/main.php");
include_once("../protected/actions/main.php");
include_once("../protected/models/CardList.php");
$params = GetParse::parseIndexParams($_GET);

?>

<html>
	<head>
		<title>ドミニオンランダムセットジェネレータ</title>
	</head>
	<body>
<?php
echo "<div>利用するカードセット</div>";
foreach(Configure::CardSetName() as $key => $set)
{
	if($set == "プロモ")
		continue;
	$checked = ($params['usingSet'][$key]) ? "checked" : "";
	print("<input type='checkbox' name='usingSet[]' value='$key' $checked>$set</input>");
}

echo "<div>利用するプロモカード</div>";
$cardList = new CardList();

$promoCards = $cardList->getCards(array("set"=>"promo"));
foreach($promoCards as $card)
{
	$checked = ($params['usingPromoCard'][$card['rawName']]) ? "checked" : "";
	print("<input type='checkbox' name='usingPromoCard[]' value='{$card['rawName']}' $checked>{$card['name']}</input>");
}
?>
<div>カードの抽選方法</div>
<input type="radio" name="randomType" value="random6">コスト2~5を１枚ずつ+６枚ランダム</input>
<input type="radio" name="randomType" value="random10">完全ランダム</input>
<div>白金、植民地の扱い</div>
<input type="radio" name="usePlatinum" value="prosperity">繁栄があるときのみ</input>
<input type="radio" name="usePlatinum" value="random">常にランダム</input>
<input type="radio" name="usePlatinum" value="anytime">常に使用する</input>
<input type="radio" name="usePlatinum" value="notime">使用しない</input>

<div>このカードは絶対に利用する</div>
<p>抽選個数を超える枚数を選択すると、そのなかからランダムに抽選されます</p>
<div style="display:none;">
</div>

<div>このカードは絶対に利用しない</div>
<p>この結果カードの数が１０個以下になった場合、サプライは作成されません</p>


<div>設定終わり</div>
<button>作成</button><br>
サプライ毎に固有のURLが作られるので、面白いURLが出来たら@orzlaboまで教えてください
	</body>
</html>
