<?php	
	if($method=='POST'){			
		//Добавление
		$data = array();		
		$exploded = explode('&', file_get_contents('php://input'));
		
		foreach($exploded as $pair) {
			$item = explode('=', $pair);
			if (count($item) == 2) {
				$data[urldecode($item[0])] = urldecode($item[1]);
			}
		}
		$phones = array_shift($data);
		
		if(isJSON($phones)){
			$phones = json_decode($phones,true);
		}		
		
		if(is_array($phones)){
			$phones = json_decode($phones,true);			
			
			//Проверки входных данных
			if (!isset($phones['source_id'])) getError('Не указан источник');			
			if (!is_int($phones['source_id'])) getError('Источник должен быть числом');			
			if (!isset($phones['items'])) getError('Не указаны items');
			if (!is_array($phones['items'])) getError('Items должен быть массивом');
			if (!count($phones['items'])) getError('Список items пуст');
			
			//Находим в базе номера телефонов, которые источник добавлял за последние 24 часа
			
			$exception = [];
			$time = time()-86400;
			$sql = 'SELECT CONCAT(`code`,`phone`) FROM `contacts` WHERE `source_id`='.$phones['source_id'].' AND `timeset`>'.$time;
			$result = $mysqli->query($sql);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) $exception[] = $row['phone'];
				
			}
			
			//Собираем массив для вставки
			$insert = [];
			$cinsert = 0;
			foreach($phones['items'] as $item){
				if (!isset($item['phone'])) continue;
				$phone = preg_replace("/[^0-9]/", '', $item['phone']);				
				$phone = substr($phone, -10);
				if (strlen($phone)!=10) continue;
				if (in_array($phone,$exception)) continue; 
				
				$code = substr($phone,0,3);
				$phone = substr($phone,-7);
				
				$cinsert++;
				$insert[] = '("'.$phones['source_id'].'","'.addslashes($item['name']).'","'.$code.'","'.$phone.'","'.addslashes($item['email']).'","'.time().'")';						
			}
			
			if (count($insert)){
				$sql = 'INSERT INTO `contacts` (`source_id`,`name`,`code`,`phone`,`email`,`timeset`) VALUES '.implode(',',$insert);
				
				$result = $mysqli->query($sql);
				getError('Успешно вставлено '.$cinsert.' записей',200);				
			} else getError('Нет данных для вставки',200);		
			
		} else getError('Bad data');
	} else if (($method=='GET') && (isset($_GET['phone']))){				
		$phone = preg_replace("/[^0-9]/", '', $_GET['phone']);	
		if (strlen($phone)!=10) getError('Не верный формат номера');
		$code = substr($phone,0,3);
		$phone = ltrim(substr($phone,-7),0);
		$sql = 'SELECT `source_id`,`name`,`email` FROM `contacts` WHERE `code`="'.$code.'" AND `phone`='.$phone;
		$result = $mysqli->query($sql);
		$finded = [];
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$finded[] = $row;			
			}
		}
		getError($finded,200);
	} else getError('Bad request');
