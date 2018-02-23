<?php require("../common/config.php")?>
<?php
$id = _any('id');
$val = _any('value');
// $print_r($_POST);
$majorArr = explode("||", $id); 
$arr = explode("|", $majorArr[0]);
switch($arr[0]) {
	case "update": //table|datatype|arrtablename|column|rowid
		switch($arr[1]) {
			case "text":
				$dao[$arr[2]]->update(array($arr[3] => $val), "id = ".$arr[4]);
				echo $val;
				break;
			case "date":
				$date = DateTime::createFromFormat('m-d-y', $val);
				$val = $date->format("Y-m-d");
				$dao[$arr[2]]->update(array($arr[3] => $val), "id = ".$arr[4]);
				echo _any('value');;
				break;
			case "money":
				$cur = preg_replace('/[\d\.-]+/', '', $val);
				$val = preg_replace('/[^\d\.-]+/', '', $val);
				$dao[$arr[2]]->update(array($arr[3] => $val), "id = ".$arr[4]);
				echo $cur.formatnumber($val);
				break;
			case "select": //table|select|arrtablename|column|rowid||selecttable|row|filterrow|filtervalue|default
				if($val) {
					$arrExt = explode("|", $majorArr[1]);
					if($arr[2] == "invoiceitems" && $arr[3] == "id_invoice") {
						$itemId = $dao['invoiceitems']->insertItemtoInvoiceIdfromProduct($arr[4],$dao['products']->getbyId($val));
					} else {
						$dao[$arr[2]]->update(array($arr[3] => $val), "id = ".$arr[4]);
					}
					$ret = $dao[$arrExt[0]]->getbyId($val);
					echo $ret[$arrExt[1]];
				} else {
					$arr = explode("|", $majorArr[1]);
					if($arr[2]!= " ")
						$rows = $dao[$arr[0]]->get($arr[2]." IN (".$arr[3].")");
					else
						$rows = $dao[$arr[0]]->get();
					$ret = array();
					foreach($rows as $row) {
						$ret[$row['id']] = utf8_encode($row[$arr[1]]);
						if($row['id'] == $arr[4])
							$ret['selected'] = $row['id'];
					}
					echo json_encode($ret);
				}
				break;
		}
		break;
	default:
		echo "Error! ".print_r($arr);
	
}
?>