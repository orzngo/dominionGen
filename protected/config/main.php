<?php
class Configure{
	public static function cardClass(){
	//サプライに置いたり置かなかったり、割と挙動に影響
		return array(
			"基本",
			"呪い",
			"王国",
			"報償",
			"廃墟",
			"避難所",
			"その他"
		);
	}

	public static function cardSetName(){
	//抽選時のフィルタリングに利用？
		return array(
			"dominion" => "基本",
			"intrigue" => "陰謀",
			"seaside" => "海辺",
			"promo" => "プロモ",
			"alchemy" => "錬金術",
			"prosperity" => "繁栄",
			"cornucopia" => "収穫祭",
			"hinterlands" => "異郷",
			"darkages" => "暗黒時代",
		);
	}

	//ランダム抽選の対象としないカード名一覧
	//基本カード等ははじくので、アクションカードだがはじかない物等を記述
	public static function randomExcludeCard(){
		return array(
			"Sir Vander",
			"Sir Destry",
			"Sir Bailey",
			"Sir Martin",
			"Sir Michael",
			"Dame Anna",
			"Dame Josephine",
			"Dame Sylvia",
			"Dame Natalie",
			"Dame Molly",
		);
	}
	
	public static function defaultParameter(){
		return include(dirname(__FILE__) ."/defaultParams.php");
	}
}
