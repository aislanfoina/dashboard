<?php require("../common/config.php")?>
<?php
if(_any('json'))
	$inputJSON = _any('json');
else
	$inputJSON = file_get_contents('php://input');
	
$request= json_decode( $inputJSON, TRUE ); //convert JSON into array
$response = array('status'=>'JSON error');

switch(trim(strtolower($request['action']))) {
	case "new_invoice":
		$id_customer = (isset($_SESSION["id_customer"])?$_SESSION["id_customer"]:0);
		$id_project = (isset($_SESSION["id_project"])?$_SESSION["id_project"]:0);
		$cnt = $dao['invoices']->getCntInvoicebyCustomer($id_customer,date("Y"))[0]['cnt']+1;
		$data['number'] = "SRV-".date("y").str_pad($id_customer, 4, "0", STR_PAD_LEFT).str_pad($cnt, 2, "0", STR_PAD_LEFT)."A-".str_pad((date("y").str_pad($id_customer, 4, "0", STR_PAD_LEFT).str_pad($cnt, 2, "0", STR_PAD_LEFT))%9, 1, "0", STR_PAD_LEFT); //"SRV-16000101A-00";
		$data['id_issuer'] = "0";
		$data['id_customer'] = $id_customer;
		$data['id_project'] = $id_project;
		$data['issue_date'] = date("y-m-d");
		$data['due_date'] = date("y-m-d",strtotime("+5 DAY"));
		$data['id_status'] = "3";
		
		$id = $dao['invoices']->insertInvoices($data);
		$response['status']="OK";
		$response['redirect']="invoice_detail.php?id=$id";
		break;

	case "dup_invoice":
		$id_customer = (isset($_SESSION["id_customer"])?$_SESSION["id_customer"]:0);
		$id_project = (isset($_SESSION["id_project"])?$_SESSION["id_project"]:0);
		
		if($id = $dao['invoices']->duplicateInvoicebyIdProjectLast($id_project)) {
			$response['status']="OK";
			$response['redirect']="invoice_detail.php?id=$id";
		} 
		else {
			$cnt = $dao['invoices']->getCntInvoicebyCustomer($id_customer,date("Y"))[0]['cnt']+1;
			$data['number'] = "SRV-".date("y").str_pad($id_customer, 4, "0", STR_PAD_LEFT).str_pad($cnt, 2, "0", STR_PAD_LEFT)."A-".str_pad((date("y").str_pad($id_customer, 4, "0", STR_PAD_LEFT).str_pad($cnt, 2, "0", STR_PAD_LEFT))%9, 1, "0", STR_PAD_LEFT); //"SRV-16000101A-00";
			$data['id_issuer'] = "0";
			$data['id_customer'] = $id_customer;
			$data['id_project'] = $id_project;
			$data['issue_date'] = date("y-m-d");
			$data['due_date'] = date("y-m-d",strtotime("+5 DAY"));
			$data['id_status'] = "3";
		
			$id = $dao['invoices']->insertInvoices($data);
			$response['status']="OK";
			$response['redirect']="invoice_detail.php?id=$id";
		}
		break;
		
	case "del_invoice":
		$id_invoice = (isset($_SESSION["id_invoice"])?$_SESSION["id_invoice"]:0);
		$dao['invoices']->updateExclude($id_invoice);
		$response['status']="OK";
		$response['redirect']="invoices.php";
		break;
		
	case "save_invoice":
		$id_invoice = (isset($_SESSION["id_invoice"])?$_SESSION["id_invoice"]:0);
		$dao['invoices']->updateSave($id_invoice);
		$response['status']="OK";
		$response['redirect']="invoice_detail.php?id=$id_invoice";
		break;
		
	case "edit_invoice":
		$id_invoice = (isset($_SESSION["id_invoice"])?$_SESSION["id_invoice"]:0);
		$dao['invoices']->updateEdit($id_invoice);
		$response['status']="OK";
		$response['redirect']="invoice_detail.php?id=$id_invoice";
		break;
		
	case "pay_invoice":
		$id_invoice = (isset($_SESSION["id_invoice"])?$_SESSION["id_invoice"]:$request['id']);
		$dao['invoices']->updatePaid($id_invoice);
		$response['status']="OK";
		$response['redirect']="invoices.php";
		break;
		
	case "del_invoice_item":
		$id_invoice = (isset($_SESSION["id_invoice"])?$_SESSION["id_invoice"]:0);
		$idItem = $request['id'];
		$dao['invoiceitems']->deleteItem($idItem);
		$response['status']="OK";
// 		$response['redirect']="invoice_detail.php?id=$id_invoice";
		break;
		
	case "save_note":
		$id_project = (isset($_SESSION["id_project"])?$_SESSION["id_project"]:0);
		$title = $request['notes_title'];
		$description = $request['notes_description'];
		$dao['notes']->saveProjectNote($id_project, $title, $description);
		$response['status']="OK";
		$response['reload']="";
		break;

	case "save_invoice_note":
		$id_invoice = (isset($_SESSION["id_invoice"])?$_SESSION["id_invoice"]:0);
		$title = $request['notes_title'];
		$description = $request['notes_description'];
		$dao['notes']->saveInvoiceNote($id_invoice, $title, $description);
		$response['status']="OK";
		$response['reload']="";
		break;		
	case "login":
		break;
				
	case "create_transaction":
		$name = trim($request['name']);
		$pass = trim($request['pass']);
		$userId = $daoUsers->checkLogin($name, $pass);
		if($userId !== false) {
			$request['transaction_id_owner'] = $userId;
			$daoTransactions->savebyPrefix("transaction_",$request);
			$response['status']="OK";
		}
		break;

	case "finalize_transaction":
		$name = trim($request['name']);
		$pass = trim($request['pass']);
		$userId = $daoUsers->checkLogin($name, $pass);
		if($userId !== false) {
			$daoTransactions->finalizeTransaction($request['id'], $userId);
			$response['status']="OK";
		}
		break;
		
	case "delete_transaction":
		$name = trim($request['name']);
		$pass = trim($request['pass']);
		$userId = $daoUsers->checkLogin($name, $pass);
		if($userId !== false) {
			$daoTransactions->deleteTransaction($request['id'], $userId);
			$response['status']="OK";
		}
		break;
			
	case "create_transaction_from_project":
		$name = trim($request['name']);
		$pass = trim($request['pass']);
		$userId = $daoUsers->checkLogin($name, $pass);
		if($userId !== false) {
			$projects = $daoProjects->getProjectbyId($request['id_project']);
			if(count($projects>0)) {
				$daoTransactions->createTransactionbyProject($projects[0], $request['date'], $userId);
				$response['status']="OK";
			}
		}
		break;
				
	case "create_transaction_from_user":
		$name = trim($request['name']);
		$pass = trim($request['pass']);
		$userId = $daoUsers->checkLogin($name, $pass);
		if($userId !== false) {
			$users = $daoUsers->getUsersbyId($request['id_user']);
			if(count($users>0)) {
				$daoTransactions->createTransactionbyUser($users[0], $request['date'], $userId);
				$response['status']="OK";
			}
		}
		break;

	case "create_transaction_from_reimbursement":
		$name = trim($request['name']);
		$pass = trim($request['pass']);
		$userId = $daoUsers->checkLogin($name, $pass);
		if($userId !== false) {
			$reimbursements = $daoReimbursements->getbyIdUserMonthYear($request['id_user'], $request['date']);
			if(count($reimbursements>0)) {
				$reimbursed = array();
				$tmpValue = 0;
				foreach($reimbursements as $reimbursement) {
					$tmpValue += $reimbursement['value'];
				}
				$reimbursed['value'] = $tmpValue;
				$reimbursed['id'] = $reimbursements[0]['id'];
				$reimbursed['username'] = $reimbursements[0]['username'];
				$daoTransactions->createTransactionbyReimbursed($reimbursed, $request['date'], $userId);
				$response['status']="OK";
			}
		}
		break;
		
	case "create_transaction_from_slip":
		$name = trim($request['name']);
		$pass = trim($request['pass']);
		$userId = $daoUsers->checkLogin($name, $pass);
		if($userId !== false) {
			$slips = $daoSlips->getSlipbyId($request['id_slip']);
			if(count($slips>0)) {
				$daoTransactions->createTransactionbySlip($slips[0], $userId);
				$response['status']="OK";
			}
		}
		break;
		
	case "get_credit":
		$name = trim($request['name']);
		$pass = trim($request['pass']);
		$userId = $daoUsers->checkLogin($name, $pass);
		if($userId !== false) {
			$response['status']="OK";
		}
		break;
					
	case "authorize_credit":
		$name = trim($request['name']);
		$pass = trim($request['pass']);
		$userId = $daoUsers->checkLogin($name, $pass);
		if($userId !== false) {
			$response['status']="OK";
		}
		break;
					
	case "del_credit":
		$name = trim($request['name']);
		$pass = trim($request['pass']);
		$userId = $daoUsers->checkLogin($name, $pass);
		if($userId !== false) {
			$response['status']="OK";
		}
		break;
					
		default:
		break;
}
$response['debug']=_any('json');
//print_r($response);
header('Content-Type: application/json');
echo json_encode($response);
?>