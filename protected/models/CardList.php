<?php

class CardList{
	private $_list=array();
	public function CardList(){
		$_list = _loadCardList();
	}

	//条件を配列で指定し、条件全てに合致するカード全てを返します
	public function searchCards($condition=array()){
		if(empty($condition)){
			return $_list;
		}
		
		$result = array();
		foreach($_list as $card){
			$hitFlag = true;
			foreach($condition as $key => $value){
				if(!eval("return {$card[$key]}$value")){
					$hitFlag = false;
					break;
				}
			}
			if($hitFlag){
				$result[] = $card;
			}
		}
		return $result;

	}

	private function _loadCardList(){
		$fp = fopen(__FILE__ . "/../cardList.tsv", "r");
		$result = array();
		while(!feof($fp)){
			$line = fgets($fp);
			$rawData = explode("\t",$line);
			$card = array(
				'no' => $rawData[0],
				'set' => $rawData[1],
				'class' => $rawData[2],
				'name' => $rawData[3],
				'rawName' => $rawData[4],
				'cost' => $rawData[5],
				'isAction' => $rawData[6],
				'isReaction' => $rawData[7],
				'isVictoryPoint' => $rawData[8],
				'isTreasure' => $rawData[9],
			);
			$result[] = $card;
		}
		return $result;
	}
}
