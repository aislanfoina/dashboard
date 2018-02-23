<?php require("../common/config.php")?>
<?php
if(_any("expiration")) {
	$projects = $dao['projects']->getProjectsbyContractExpiration(2, _any("expiration"));
}
else {
	$projects = $dao['projects']->getProjectsbyContractExpiration(2);
	$projects = array_merge($projects, $dao['projects']->getProjectsbyContractExpiration(3));
}
foreach ($projects as $project) {
	$id_project = $project['id'];
	
// 	if($id_project != 5) { 
		$id_customer = $project['id_customer'];
		$cnt = $dao['invoices']->getCntInvoicebyCustomer($id_customer,date("Y"))[0]['cnt']+1;
		$invoiceNumber = "SRV-".date("y").str_pad($id_customer, 4, "0", STR_PAD_LEFT).str_pad($cnt, 2, "0", STR_PAD_LEFT)."A-".str_pad((date("y").str_pad($id_customer, 4, "0", STR_PAD_LEFT).str_pad($cnt, 2, "0", STR_PAD_LEFT))%9, 1, "0", STR_PAD_LEFT); //"SRV-16000101A-00";
		$data['number'] = $invoiceNumber;
		$data['id_issuer'] = "1";
		$data['id_customer'] = $id_customer;
		$data['id_project'] = $id_project;
		$data['issue_date'] = date("y-m-d");
		$dataVenc = date("y-m-d",strtotime("+10 DAY"));
		$data['due_date'] = $dataVenc;
		$dataVenc = date("d-m-y",strtotime("+10 DAY"));
		$data['id_status'] = "9";
		$id = $dao['invoices']->insertInvoices($data);
		
		$item['id_product'] = 2;
		$item['id_invoice'] = $id;
		$item['quantity'] = 1;
		$monthYear = date("M/y",strtotime("+10 DAY"));
		if($project['id_contract'] == 3)
			$monthYear = date("y",strtotime("+10 DAY"));
		$item['obs'] = "Hospedagem referente a $monthYear";
		$valorInvoice = $project['value'];
		$item['value'] = $valorInvoice;
		$item['id_status'] = 1;
				
		$dao['invoiceitems']->insertProducts($item);
		
		
		include("../common/tool_gerar_boleto_bb.php");
		
		$idSlip = $dao['slips']->saveSlipbySliparr($dadosboleto, $company, $project);
		$slip = $dao['slips']->getSlipbyId($idSlip)[0];
		$ourNumber = $slip['our_number'];
		
		$customer = $project['customer'];
		$from = "financeiro@foi.tech";
		$fromName = "Financeiro";
		$email = "aislan@foi.tech";
		$subject = "Emissão de fatura para $customer referente ao contrato ".$project['contract'];
		$body = "
	<html>
		<head>
			<title>Foi.tech - Fatura</title>
			<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
		</head>
		<body>
			Fatura para $customer emitida! <br/> 
			Vencimento para $dataVenc - Valor R$$valorInvoice<br/>
			Para impress&atilde;o acesse: <a href='http://foi.tech/erp/br/invoice_print_br.php?number=$invoiceNumber'>http://foi.tech/erp/br/invoice_print_br.php?number=$invoiceNumber</a><br/>
			Para boleto acesse: <a href='http://foi.tech/erp/br/slipView.php?slip_ournumber=$ourNumber'>http://foi.tech/erp/br/slipView.php?slip_ournumber=$ourNumber</a><br/>
			<br/>
			Obrigado!<br/>
			<br/>
			Financeiro Foi.tech<br/>		
		</body>
	</html>";
		
		amazonMail($from, $fromName, $email, $subject, $body);
		
		echo $body."<br/><br/>";
// 	}
}
echo "Done!<br/><br/>";
?>
