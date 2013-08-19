<?php
class RandomSelect{
	static function select($conditions, $usedCard = array()){
		$cardList = new CardList();
		$targetCards = $cardList->getCards(array(
			'set' => $conditions['usingSet'],
			'isRandomTarget' => 1,
		));
		$selectedIndex = array_rand($targetCards,10);
		$result = array();

		//プラチナ
		if($conditions['usePlatinum'] =="anytime"){
			$usePlatinum = true;
		}else{
			$usePlatinum = false;
		}
		$supply = array();
		foreach($selectedIndex as $index){
			$supply[] = $targetCards[$index];
			if($usePlatinum == false && $targetCards[$index]['set'] == 'prosperity'){
				$rand = mt_rand(0,1);
				if(($conditions['usePlatinum'][0] == "prosperity") || ($conditions['usePlatinum'] == 'random' && $rand == 0)){
					$usePlatinum = true;
				}
			}
		}

		$optionalCards = array();
		if($usePlatinum){
			$card = $cardList->getCards(array("rawName"=>array("Platinum", "Colony")));
			$optionalCards[] = $card[0];
			$optionalCards[] = $card[1];
		}

		$result['supply'] = Sort::sortByCost($supply);
		$result['optionalCards'] = Sort::sortByCost($optionalCards);
		return $result;
	}
}
