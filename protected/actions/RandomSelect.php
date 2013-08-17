<?php
class RandomSelect{
	static function select($params, $usedCard = array()){
		$cardList = new CardList();
		$targetCards = $cardList->getCards(array(
			"set" => $params['usingSet'],
			"class" => 2,
		));
		$selectedIndex = array_rand($targetCards,10);
		$result = array();
		foreach($selectedIndex as $index){
			$result[] = $targetCards[$index];
		}
		return self::_sortByCost($result);
	}
	private static function _sortByCost($targetList){
		uasort($targetList, function($first, $second){
			if($first['cost'] < $second['cost'])
				return -1;
			else if($first['cost'] == $second['cost'])
				return 0;
			else if($first['cost'] > $second['cost'])
				return 1;
		});
		return $targetList;
	}
}
