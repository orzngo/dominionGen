<?php
class Sort{
	static function sortByCost($targetList){
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
