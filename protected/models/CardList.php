<?php

class CardList{
	private $_list=array();
	public function CardList(){
		$this->_list = $this->_loadCardList();
	}

	/**
	 * 条件を配列で指定し、条件全てに合致するカード全てを返します
	 */
	public function getCards($condition=array()){
		if(empty($condition)){
			return $this->_list;
		}
		return $this->filter($this->_list, $condition);
	}

	/**
	 * 指定したカード群から、条件にあったもののみを返します
	 */
	public function filter($target, $condition=array()){
		$result = array();
		foreach($target as $card){
			$hitFlag = true;
			foreach($condition as $key => $value){
				//TODO: evalか何か効かせて、一致以外の条件検索できるようにしたい
				if($card[$key] !== $value){
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
		$fp = fopen(dirname(__FILE__) . "/../cardList.tsv", "r");
		$result = array();
		while(!feof($fp)){
			$line = fgets($fp);
			if(!$line) continue;
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
