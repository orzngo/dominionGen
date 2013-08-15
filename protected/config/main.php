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
			"alchemy" => "錬金術",
			"prosperity" => "繁栄",
			"cornucopia" => "収穫祭",
			"hinterlands" => "異郷",
			"darkages" => "暗黒時代",
			"promo" => "プロモ",
		);
	}
	
	public static function defaultParameter(){
		return include(dirname(__FILE__) ."/defaultParams.php");
	}
}
