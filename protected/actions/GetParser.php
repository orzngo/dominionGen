<?php
class GetParser{
	public static function parseIndexParams($getParams){
		$params=array();
		$defaultParams = Configure::defaultParameter();
		//セット名のチェックボックス
		$params['usingSet'] = array();
		$usingSet = (isset($_GET['usingSet']))?$_GET['usingSet'] : $defaultParams['usingSet'];
		foreach($cardSetName as $key => $value){
			$params['usingSet'][$key] = false;
		}
		//チェックが付いている＝送信されて来たチェックボックスについては、trueにする
		foreach($usingSet as $value){
			$params['usingSet'][$value] = true;
		}
		return $params;
	}
}
