<?php require("../common/config.php")?>
<?php

// print_r($_POST);

$action = $_POST['action'];
$data = $_POST['data'];

switch($action) {
	case "create":
		$table = key($data[0]);
		$fields = reset($data[0]);
		$id = $dao[$table]->insert($fields);
		$dataArr = array_merge(array("DT_RowId" => "$id"), reset($data));
		$retData = array(
			"data" => array(
				"0" => $dataArr
			)
		);
		echo json_encode($retData);
		break;
	case "edit":
		$keyid = explode("|",key($data));
// 		print_r($keyid);
		$key = $keyid[0];
		$id = $keyid[1];
		$table = key($data[key($data)]);
		$fields = reset($data[key($data)]);
		$dao[$table]->update($fields, "$key = \"$id\"");
		$dataArr = array();
		$dataArr = array_merge(array("DT_RowId" => key($data)), reset($data));
		$retData = array(
			"data" => array(
				"0" => $dataArr
			)
		);
		echo json_encode($retData);
		break;
	case "remove":
		$keyid = explode("|",key($data));
		$key = $keyid[0];
		$id = $keyid[1];
		$table = key($data[key($data)]);
		$dao[$table]->delete("$key = \"$id\"");
		$dataArr = array();
		$dataArr["DT_RowId"] = key($data);
		$retData = array(
				"data" => array(
						"0" => $dataArr
				)
		);
		echo json_encode($retData);
		break;
	default:
		print_r($_POST);
		break;
}
// 	echo "<br>$query<br>";
// 	print_r($_POST);

?>