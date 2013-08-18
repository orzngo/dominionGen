<?php
class GetParse{
	static $defaultParams = array();
	public static function parseIndexParams($getParams=array()){
		$params=array();
		if(empty($getParams)){
			$getParams = $_GET;
		}
		self::$defaultParams = Configure::defaultParameter();
		$cardList = new CardList();

		//セット名のチェックボックス
		$params['usingSet'] = array();
		$usingSet = (isset($getParams['usingSet']))?$getParams['usingSet'] : self::$defaultParams['usingSet'];
		foreach(Configure::cardSetName() as $key => $value){
			$params['usingSet'][$key] = false;
		}
		//チェックが付いている＝送信されて来たチェックボックスについては、trueにする
		foreach($usingSet as $value){
			$params['usingSet'][$value] = true;
		}

		//プロモカード
		$params['usingPromoCard'] = array();
		$promoCards = $cardList->getCards(array("set"=>"promo"));
		$usingPromoCard = (isset($getParams['usingPromoCard']))?$getParams['usingPromoCard'] : self::$defaultParams['usingPromoCard'];
		foreach($promoCards as $value){
			$params['usingPromoCard'][$value['rawName']] = false;
		}
		//チェックが付いている＝送信されて来たチェックボックスについては、trueにする
		foreach($usingPromoCard as $key => $value){
			$params['usingPromoCard'][$value] = true;
		}

		return $params;
	}
	public static function parseSearchParams($getParams=array()){
		$params=array();
		if(empty($getParams)){
			$getParams = $_GET;
		}
		self::$defaultParams = Configure::defaultParameter();

		$params['usingSet'] = (isset($getParams['usingSet']))?$getParams['usingSet'] : self::$defaultParams['usingSet'];
		$params['usingPromoCard'] = (isset($getParams['usingPromoCard']))?$getParams['usingPromoCard'] : self::$defaultParams['usingPromoCard'];
		$params['usePlatinum'] = (isset($getParams['usePlatinum']))?$getParams['usePlatinum'] : self::$defaultParams['usePlatinum'];
		$params['isRandomTarget'] = (isset($getParams['isRandomTarget']))?$getParams['isRandomTarget'] : 1;
		return $params;
	}
}
