<?php require("../common/config.php")?>
<?php
$id = _any('id');
$p_id_priority = _any('value');
$column = _any('columnName');
$columnPosition = _any('columnPosition');
$columnId = _any('columnId');
$rowId = _any('rowId');

// print_r($_POST);

if($column == "Prioridade") {
	if($p_id_priority != 0) {
		$query_update = "UPDATE projects SET id_priority = $p_id_priority WHERE id = $id";
		$update = mysql_query($query_update, $gtp) or die(mysql_error());
		echo $p_id_priority;
// 		print_r($_POST);
	}
	else {
		echo "Prioridade Invalida! \nValor = $p_id_priority\n";
		print_r($_POST);
	}
}
else if($column == "Gasto") {
	if($p_id_priority != 0) {
		$query_update = "UPDATE reimbursements SET id_expense = $p_id_priority WHERE id = $id";
		$update = mysql_query($query_update, $gtp) or die(mysql_error());
		echo $p_id_priority;
		// 		print_r($_POST);
	}
	else {
		echo "Gasto Invalido! \nValor = $p_id_priority\n";
		print_r($_POST);
	}
}
else if($column == "Valor") {
	if($p_id_priority != "") {
		$r_value = fixnumberUS($p_id_priority);
		$query_update = "UPDATE reimbursements SET value = '$r_value' WHERE id = $id";
		$update = mysql_query($query_update, $gtp) or die(mysql_error());
		echo $p_id_priority;
		// 		print_r($_POST);
	}
	else {
		echo "Gasto Invalido! \nValor = $p_id_priority\n";
		print_r($_POST);
	}
}
else if(strstr($column,"Descri")) {
	if($p_id_priority != "") {
		$query_update = "UPDATE reimbursements SET description = '$p_id_priority' WHERE id = $id";
		$update = mysql_query($query_update, $gtp) or die(mysql_error());
		echo $p_id_priority;
		// 		print_r($_POST);
	}
	else {
		echo "$column Invalida! \nValor = $p_id_priority\n";
		print_r($_POST);
	}
}
else if($column == "N.F.") {
	if($p_id_priority != "") {
		$query_update = "UPDATE reimbursements SET nf = '$p_id_priority' WHERE id = $id";
		$update = mysql_query($query_update, $gtp) or die(mysql_error());
		echo $p_id_priority;
		// 		print_r($_POST);
	}
	else {
		echo "$column Invalida! \nValor = $p_id_priority\n";
		print_r($_POST);
	}
}
else {
	if($p_id_priority != "") {
// 		$column = str_replace("'", "", str_replace(" ", "", iconv('UTF-8', 'ASCII//TRANSLIT', $column)));;
		$dao['roles']->updateColumn($id, $column, $p_id_priority);
// 		$query_update = "UPDATE role SET $column = $p_id_priority WHERE id = $id";
// 		$update = mysql_query($query_update, $gtp) or die(mysql_error()."|".$query_update);
		echo $p_id_priority;
	}
	else {
		echo "$column Invalida! \nValor = $p_id_priority\n";
		print_r($_POST);
	}
}
?>