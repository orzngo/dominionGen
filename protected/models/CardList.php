<?php
//カード一覧の検索等を請け負う

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
	 * 使えるコマンド
	 * 数字系
	 *			X	:Xに一致する物を検索します
	 *			-X	:X以下の値の物を検索します
	 *			X-	:X以上の値の物を検索します
	 *			X-Y	:X以上Y以下の物を検索します
	 */
	public function filter($target, $conditions=array()){
		$result = array();
		foreach($target as $card){
			$hitFlag = true;
			foreach($conditions as $key => $condition){
				$hitFlag2 = false;
				$hit = false;
				if(!is_array($condition))
					$condition = array($condition);
				foreach($condition as $conditionValue){
					$value = explode("-",$conditionValue);
					if(count($value)>1){//-が少なくとも一回指定されてる
						//$value[0]が最小値、$value[1]が最大値と見なす
						if(is_numeric($value[0]) && is_numeric($value[1])){//ともに数字
							if(($value[0] <= $card[$key]  && $card[$key] <= $value[1]))
								$hit = true;
						}else if(is_numeric($value[0])){
							if(($value[0] <= $card[$key]))
								$hit = true;
						}else{
							if(($card[$key] <= $value[1]))
								$hit = true;
						}
					}else{//-は少なくとも指定されていない
						$value = $value[0];
						//普通に一致するか検索
						if(($card[$key] == $value))
							$hit = true;
					}
					if($hit){
						$hitFlag2 = true;
						break;
					}
				}
				if(!$hitFlag2){
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
