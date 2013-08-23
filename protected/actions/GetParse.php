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

		//抽選方法
		$params['randomType'] = (isset($getParams['randomType']))?$getParams['randomType']: self::$defaultParams['randomType'];

		//白金、植民地抽出アルゴリズム
		$params['usePlatinum'] = (isset($getParams['usePlatinum']))?$getParams['usePlatinum']: self::$defaultParams['usePlatinum'];

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

	public static function parseViewerParams($getParams=array()){
		$params = array();
		if(empty($getParams)){
			$getParams = $_GET;
		}
		$cardNumbers = (isset($getParams['card']))?$getParams['card'] : null;
		$optionalNumbers = (isset($getParams['option']))?$getParams['option'] : null;
		if(is_null($cardNumbers))
			return null;

		$cardList = new CardList();
		$optionalCards = array();
		$cards = $cardList->getCards(
			array("no"=>$cardNumbers)
		);
		if(!is_null($optionalNumbers)){
			$optionalCards = $cardList->getCards(
				array("no"=>$optionalNumbers)
			);
		}
		$result['supply'] = Sort::sortByCost($cards);
		$result['optionalCards'] = Sort::sortByCost($optionalCards);
		return $result;
	}
}
