<?php
function _get($name)
{
	return strip_tags($_GET[$name]);
}
function _post($name)
{
	return strip_tags($_POST[$name]);
}
function _any($name)
{
	if(isset($_GET[$name]))
		return strip_tags($_GET[$name]);
	if(isset($_POST[$name]))
		return strip_tags($_POST[$name]);
	return false;
}
function _dbg($debug_msg, $siteDebug)
{
	if ($siteDebug)
		echo "* $debug_msg<br>";
}

function formatnumber($number) {
	//	setlocale(LC_MONETARY, 'pt_BR');
	//	$numStr = money_format($format, $number);
	//	$locale = localeconv();
	//	$numStr = $locale['currency_symbol'].number_format($number, 2, $locale['decimal_point'], $locale['thousands_sep']);
	if($number == "") $number = 0;
	$numStr = number_format($number, 2, ".", ",");
	return $numStr;
}
function formatnumberBR($number) {
	//	setlocale(LC_MONETARY, 'pt_BR');
	//	$numStr = money_format($format, $number);
	//	$locale = localeconv();
	//	$numStr = $locale['currency_symbol'].number_format($number, 2, $locale['decimal_point'], $locale['thousands_sep']);
	if($number == "") $number = 0;
	$numStr = number_format($number, 2, ",", ".");
	return $numStr;
}
function formatnumberUS($number) {
	//	setlocale(LC_MONETARY, 'pt_BR');
	//	$numStr = money_format($format, $number);
	//	$locale = localeconv();
	//	$numStr = $locale['currency_symbol'].number_format($number, 2, $locale['decimal_point'], $locale['thousands_sep']);
	if($number == "") $number = 0;
	$numStr = number_format($number, 2, ".", ",");
	return $numStr;
}
function fixnumberUS($number) {
	if($number == "") $number = 0;
	$number = str_replace(".","",$number);
	$number = str_replace(",",".",$number);
	return $number;
}
function fixnumberBR($number) {
	if($number == "") $number = 0;
	$number = str_replace(",","",$number);
	$number = str_replace(".",",",$number);
	return $number;
}

function getStatusLabel($id) {
	global $dao;
	switch($id) {
		case $dao['status']->records['Ativo']:
		case $dao['status']->records['Concluido']:
		case $dao['status']->records['Finalizado']:
			return "label-success";
			break;
		case $dao['status']->records['Em andamento']:
		case $dao['status']->records['Em aberto']:
			return "label-info";
			break;
		case $dao['status']->records['Pago']:
			return "label-primary";
			break;
		case $dao['status']->records['Paralisado']:
			return "label-warning";
			break;
		case $dao['status']->records['Cancelado']:
		case $dao['status']->records['Excluido']:
			return "label-danger";
			break;
		default:
			return "label";
	}
}

function getStatusText($id) {
	switch($id) {
		case 1:
			return "Pendência";
			break;
		case 2:
			return "Aviso";
			break;
		case 3:
			return "Conforme";
			break;
		case 4:
			return "Urgência";
			break;
		case 5:
			return "Erro";
			break;
		default:
			return "Conforme";
	}
}

function getProgress($startDate, $endDate, $today = "now") {
	$stDt = strtotime($startDate);
	$edDt = strtotime($endDate);
	$tdDt = strtotime($today);
	
	$progress = (int)(($tdDt - $stDt)/86400);
	$total = (int)(($edDt - $stDt)/86400);
	
	return $progress;
}

function getProgressPercent($startDate, $endDate, $today = "now") {
	$stDt = strtotime($startDate);
	$edDt = strtotime($endDate);
	$tdDt = strtotime($today);
	
	$progress = $tdDt - $stDt;
	$total = $edDt - $stDt;
	
	$percent = (float)$progress / (float)$total;
	
	if($percent > 1)
		return 100;
	else if($percent < 0)
		return 0;
	else 
		return (int)($percent*100);
}

function getProgressStartProjectPercent($startProjectDate, $today = "now") {
	
	$stDt = date('z', strtotime(date('2017-m-d', strtotime($startProjectDate))));
	$tdDt = date('z', strtotime(date('2017-m-d', strtotime($today))));
	
	$progress = $tdDt - $stDt;
	if($progress < 0)
		$progress += 365;
	$total = 365;

	$percent = (float)$progress / (float)$total;

	if($percent > 1)
		return 100;
	else if($percent < 0)
		return 0;
	else
		return (int)($percent*100);
}

// if(!(isset($logged) && $logged)) {
// 	if(!isset($logged)) {
// 		session_start();
// 		$logged = false;
// 	}
// 	if (isset($_SESSION['GTP_User'])) {
// 		$colname_login = (get_magic_quotes_gpc()) ? $_SESSION['GTP_User'] : addslashes($_SESSION['GTP_User']);
// 		$query_top_login = sprintf("SELECT *, role.id as role_id FROM users LEFT JOIN role ON role.id = users.id_role WHERE username like '%s' AND users.id_status != 2", $colname_login);
// 		$top_login = mysql_query($query_top_login, $gtp) or die(mysql_error());
// 		$row_top_login = mysql_fetch_array($top_login, MYSQL_BOTH);
// 		$row_top_login['id'] = $row_top_login[0]; 
// 		$row_login = $row_top_login;
// 		$totalRows_top_login = mysql_num_rows($top_login);
// 		if($totalRows_top_login > 0)
// 			$logged = true;
// 	}
// }
if(isset($_SESSION['this_uri'])) {
	$_SESSION['last_uri'] = $_SESSION['this_uri'];
}
$_SESSION['this_uri'] = isset($_SERVER['REQUEST_URI'])?$_SERVER['REQUEST_URI']:false;

if(isset($_SESSION['this_php'])) {
	$_SESSION['last_php'] = $_SESSION['this_php'];
}
$_SESSION['this_php'] = $_SERVER['PHP_SELF'];

if(_any('clear')) {
	if(isset($_SESSION['last_project_load'])) {
		$_SESSION['last_project_load'] = "";
		unset($_SESSION['last_project_load']);
	}
	if(isset($_SESSION['last_task_load'])) {
		$_SESSION['last_task_load'] = "";
		unset($_SESSION['last_task_load']);
	}
	if(isset($_SESSION['last_user_load'])) {
		$_SESSION['last_user_load'] = "";
		unset($_SESSION['last_user_load']);
	}
}

function js2PhpTime($jsdate){
	if(preg_match('@(\d+)/(\d+)/(\d+)\s+(\d+):(\d+)@', $jsdate, $matches)==1){
		$ret = mktime($matches[4], $matches[5], 0, $matches[1], $matches[2], $matches[3]);
		//echo $matches[4] ."-". $matches[5] ."-". 0  ."-". $matches[1] ."-". $matches[2] ."-". $matches[3];
	}else if(preg_match('@(\d+)/(\d+)/(\d+)@', $jsdate, $matches)==1){
		$ret = mktime(0, 0, 0, $matches[1], $matches[2], $matches[3]);
		//echo 0 ."-". 0 ."-". 0 ."-". $matches[1] ."-". $matches[2] ."-". $matches[3];
	}
	return $ret;
}

function php2JsTime($phpDate){
	//echo $phpDate;
	//return "/Date(" . $phpDate*1000 . ")/";
	return date("m/d/Y H:i", $phpDate);
}

function php2MySqlTime($phpDate){
	return date("Y-m-d H:i:s", $phpDate);
}

function mySql2PhpTime($sqlDate){
	$arr = date_parse($sqlDate);
	return mktime($arr["hour"],$arr["minute"],$arr["second"],$arr["month"],$arr["day"],$arr["year"]);

}


function sendGoogleCloudMessage($ids, $data, $url, $apiKey) {
	// $apiKey = 'abc';
	// $url = 'https://android.googleapis.com/gcm/send';
	$post = array (
			'registration_ids' => $ids,
			'data' => $data 
	);
	$headers = array (
			'Authorization: key=' . $apiKey,
			'Content-Type: application/json' 
	);
	
	$ch = curl_init();
	curl_setopt ($ch, CURLOPT_URL, $url);
	curl_setopt ($ch, CURLOPT_POST, true);
	curl_setopt ($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt ($ch, CURLOPT_POSTFIELDS, json_encode($post));
	$result = curl_exec($ch);
	if (curl_errno($ch)) {
		echo 'GCM error: '.curl_error($ch);
	}
	curl_close($ch);
	return $result;
}

$script_add = "";

/* creates a compressed zip file */
function create_zip($files = array(),$destination = '',$overwrite = false) {
	//if the zip file already exists and overwrite is false, return false
	if(file_exists($destination) && !$overwrite) { return false; }
	//vars
	$valid_files = array();
	//if files were passed in...
	if(is_array($files)) {
		//cycle through each file
		foreach($files as $file) {
			//make sure the file exists
			if(file_exists($file)) {
				$valid_files[] = $file;
			}
		}
	}
	//if we have good files...
	if(count($valid_files)) {
		//create the archive
		$zip = new ZipArchive();
		if($zip->open($destination,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
			return false;
		}
		//add the files
		foreach($valid_files as $file) {
			$localname = end( explode( "/", $file ) );
			$zip->addFile($file,$localname);
		}
		//debug
		//echo 'The zip archive contains ',$zip->numFiles,' files with a status of ',$zip->status;

		//close the zip -- done!
		$zip->close();

		//check to make sure the file exists
		return file_exists($destination);
	}
	else
	{
		return false;
	}
}

/**
 * Unaccent a string 
 *
 * An example string like ��e�?????? will be translated to AOeyIOzoBY. 
 * More complete than :
 *
 *  strtr(
 *      (string)$str,
 *      "�����������������������������������������������������",
 *      "aaaaaaaaaaaaooooooooooooeeeeeeeecciiiiiiiiuuuuuuuuynn"
 *  );
 *
 * @author http://www.evaisse.net/2008/php-translit-remove-accent-unaccent-21001
 * @param $str input string
 * @param $utf8 if null, function will detect input string encoding
 * @return string input string without accent
 */
function removeAccents($str, $utf8 = true) {
    $str = (string) $str;
    if (is_null($utf8)) {
        if (!function_exists('mb_detect_encoding')) {
            $utf8 = (strtolower(mb_detect_encoding($str)) == 'utf-8');
        } else {
            $length = strlen($str);
            $utf8 = true;
 
            for ($i = 0; $i < $length; $i++) {
                $c = ord($str[$i]);
 
                if ($c < 0x80) $n = 0; // 0bbbbbbb
                elseif (($c & 0xE0) == 0xC0) $n = 1; // 110bbbbb
                elseif (($c & 0xF0) == 0xE0) $n = 2; // 1110bbbb
                elseif (($c & 0xF8) == 0xF0) $n = 3; // 11110bbb
                elseif (($c & 0xFC) == 0xF8) $n = 4; // 111110bb
                elseif (($c & 0xFE) == 0xFC) $n = 5; // 1111110b
                else return false; // Does not match any model
 
                for ($j = 0; $j < $n; $j++) { // n bytes matching 10bbbbbb follow ?
                    if ((++$i == $length) || ((ord($str[$i]) & 0xC0) != 0x80)) {
                        $utf8 = false;
                        break;
                    }
                }
            }
        }
    }
 
    if (!$utf8) {
        $str = utf8_encode($str);
    }
 
    $transliteration = array(
        '?' => 'I', '�' => 'O', '�' => 'O', '�' => 'U', '�' => 'a', '�' => 'a',
        '?' => 'i', '�' => 'o', '�' => 'o', '�' => 'u', '�' => 's', '?' => 's',
        '�' => 'A', '�' => 'A', '�' => 'A', '�' => 'A', '�' => 'A', '�' => 'A',
        '�' => 'A', 'A' => 'A', 'A' => 'A', 'A' => 'A', '�' => 'C', 'C' => 'C',
        'C' => 'C', 'C' => 'C', 'C' => 'C', 'D' => 'D', '�' => 'D', '�' => 'E',
        '�' => 'E', '�' => 'E', '�' => 'E', 'E' => 'E', 'E' => 'E', 'E' => 'E',
        'E' => 'E', 'E' => 'E', 'G' => 'G', 'G' => 'G', 'G' => 'G', 'G' => 'G',
        'H' => 'H', 'H' => 'H', '�' => 'I', '�' => 'I', '�' => 'I', '�' => 'I',
        'I' => 'I', 'I' => 'I', 'I' => 'I', 'I' => 'I', 'I' => 'I', 'J' => 'J',
        'K' => 'K', 'L' => 'K', 'L' => 'K', 'L' => 'K', '?' => 'K', 'L' => 'L',
        '�' => 'N', 'N' => 'N', 'N' => 'N', 'N' => 'N', '?' => 'N', '�' => 'O',
        '�' => 'O', '�' => 'O', '�' => 'O', '�' => 'O', 'O' => 'O', 'O' => 'O',
        'O' => 'O', 'R' => 'R', 'R' => 'R', 'R' => 'R', 'S' => 'S', 'S' => 'S',
        'S' => 'S', '?' => 'S', '�' => 'S', 'T' => 'T', 'T' => 'T', 'T' => 'T',
        '?' => 'T', '�' => 'U', '�' => 'U', '�' => 'U', 'U' => 'U', 'U' => 'U',
        'U' => 'U', 'U' => 'U', 'U' => 'U', 'U' => 'U', 'W' => 'W', 'Y' => 'Y',
        '�' => 'Y', '�' => 'Y', 'Z' => 'Z', 'Z' => 'Z', '�' => 'Z', '�' => 'a',
        '�' => 'a', '�' => 'a', '�' => 'a', 'a' => 'a', 'a' => 'a', 'a' => 'a',
        '�' => 'a', '�' => 'c', 'c' => 'c', 'c' => 'c', 'c' => 'c', 'c' => 'c',
        'd' => 'd', 'd' => 'd', '�' => 'e', '�' => 'e', '�' => 'e', '�' => 'e',
        'e' => 'e', 'e' => 'e', 'e' => 'e', 'e' => 'e', 'e' => 'e', '�' => 'f',
        'g' => 'g', 'g' => 'g', 'g' => 'g', 'g' => 'g', 'h' => 'h', 'h' => 'h',
        '�' => 'i', '�' => 'i', '�' => 'i', '�' => 'i', 'i' => 'i', 'i' => 'i',
        'i' => 'i', 'i' => 'i', 'i' => 'i', 'j' => 'j', 'k' => 'k', '?' => 'k',
        'l' => 'l', 'l' => 'l', 'l' => 'l', 'l' => 'l', '?' => 'l', '�' => 'n',
        'n' => 'n', 'n' => 'n', 'n' => 'n', '?' => 'n', '?' => 'n', '�' => 'o',
        '�' => 'o', '�' => 'o', '�' => 'o', '�' => 'o', 'o' => 'o', 'o' => 'o',
        'o' => 'o', 'r' => 'r', 'r' => 'r', 'r' => 'r', 's' => 's', '�' => 's',
        't' => 't', '�' => 'u', '�' => 'u', '�' => 'u', 'u' => 'u', 'u' => 'u',
        'u' => 'u', 'u' => 'u', 'u' => 'u', 'u' => 'u', 'w' => 'w', '�' => 'y',
        '�' => 'y', 'y' => 'y', 'z' => 'z', 'z' => 'z', '�' => 'z', '?' => 'A',
        '?' => 'A', '?' => 'A', '?' => 'A', '?' => 'A', '?' => 'A', '?' => 'A',
        '?' => 'A', '?' => 'A', '?' => 'A', '?' => 'A', '?' => 'A', '?' => 'A',
        '?' => 'A', '?' => 'A', '?' => 'A', '?' => 'A', '?' => 'A', '?' => 'A',
        '?' => 'A', '?' => 'A', '?' => 'A', '?' => 'B', 'G' => 'G', '?' => 'D',
        '?' => 'E', '?' => 'E', '?' => 'E', '?' => 'E', '?' => 'E', '?' => 'E',
        '?' => 'E', '?' => 'E', '?' => 'E', '?' => 'Z', '?' => 'I', '?' => 'I',
        '?' => 'I', '?' => 'I', '?' => 'I', '?' => 'I', '?' => 'I', '?' => 'I',
        '?' => 'I', '?' => 'I', '?' => 'I', '?' => 'I', '?' => 'I', '?' => 'I',
        '?' => 'I', '?' => 'I', '?' => 'I', '?' => 'I', '?' => 'I', '?' => 'I',
        'T' => 'T', '?' => 'I', '?' => 'I', '?' => 'I', '?' => 'I', '?' => 'I',
        '?' => 'I', '?' => 'I', '?' => 'I', '?' => 'I', '?' => 'I', '?' => 'I',
        '?' => 'I', '?' => 'I', '?' => 'I', '?' => 'K', '?' => 'L', '?' => 'M',
        '?' => 'N', '?' => 'K', '?' => 'O', '?' => 'O', '?' => 'O', '?' => 'O',
        '?' => 'O', '?' => 'O', '?' => 'O', '?' => 'O', '?' => 'O', '?' => 'P',
        '?' => 'R', '?' => 'R', 'S' => 'S', '?' => 'T', '?' => 'Y', '?' => 'Y',
        '?' => 'Y', '?' => 'Y', '?' => 'Y', '?' => 'Y', '?' => 'Y', '?' => 'Y',
        '?' => 'Y', '?' => 'Y', 'F' => 'F', '?' => 'X', '?' => 'P', 'O' => 'O',
        '?' => 'O', '?' => 'O', '?' => 'O', '?' => 'O', '?' => 'O', '?' => 'O',
        '?' => 'O', '?' => 'O', '?' => 'O', '?' => 'O', '?' => 'O', '?' => 'O',
        '?' => 'O', '?' => 'O', '?' => 'O', '?' => 'O', '?' => 'O', '?' => 'O',
        '?' => 'O', 'a' => 'a', '?' => 'a', '?' => 'a', '?' => 'a', '?' => 'a',
        '?' => 'a', '?' => 'a', '?' => 'a', '?' => 'a', '?' => 'a', '?' => 'a',
        '?' => 'a', '?' => 'a', '?' => 'a', '?' => 'a', '?' => 'a', '?' => 'a',
        '?' => 'a', '?' => 'a', '?' => 'a', '?' => 'a', '?' => 'a', '?' => 'a',
        '?' => 'a', '?' => 'a', '?' => 'a', '�' => 'b', '?' => 'g', 'd' => 'd',
        'e' => 'e', '?' => 'e', '?' => 'e', '?' => 'e', '?' => 'e', '?' => 'e',
        '?' => 'e', '?' => 'e', '?' => 'e', '?' => 'z', '?' => 'i', '?' => 'i',
        '?' => 'i', '?' => 'i', '?' => 'i', '?' => 'i', '?' => 'i', '?' => 'i',
        '?' => 'i', '?' => 'i', '?' => 'i', '?' => 'i', '?' => 'i', '?' => 'i',
        '?' => 'i', '?' => 'i', '?' => 'i', '?' => 'i', '?' => 'i', '?' => 'i',
        '?' => 'i', '?' => 'i', '?' => 'i', '?' => 'i', '?' => 't', '?' => 'i',
        '?' => 'i', '?' => 'i', '?' => 'i', '?' => 'i', '?' => 'i', '?' => 'i',
        '?' => 'i', '?' => 'i', '?' => 'i', '?' => 'i', '?' => 'i', '?' => 'i',
        '?' => 'i', '?' => 'i', '?' => 'i', '?' => 'i', '?' => 'i', '?' => 'k',
        '?' => 'l', '�' => 'm', '?' => 'n', '?' => 'k', '?' => 'o', '?' => 'o',
        '?' => 'o', '?' => 'o', '?' => 'o', '?' => 'o', '?' => 'o', '?' => 'o',
        '?' => 'o', 'p' => 'p', '?' => 'r', '?' => 'r', '?' => 'r', 's' => 's',
        '?' => 's', 't' => 't', '?' => 'y', '?' => 'y', '?' => 'y', '?' => 'y',
        '?' => 'y', '?' => 'y', '?' => 'y', '?' => 'y', '?' => 'y', '?' => 'y',
        '?' => 'y', '?' => 'y', '?' => 'y', '?' => 'y', '?' => 'y', '?' => 'y',
        '?' => 'y', '?' => 'y', 'f' => 'f', '?' => 'x', '?' => 'p', '?' => 'o',
        '?' => 'o', '?' => 'o', '?' => 'o', '?' => 'o', '?' => 'o', '?' => 'o',
        '?' => 'o', '?' => 'o', '?' => 'o', '?' => 'o', '?' => 'o', '?' => 'o',
        '?' => 'o', '?' => 'o', '?' => 'o', '?' => 'o', '?' => 'o', '?' => 'o',
        '?' => 'o', '?' => 'o', '?' => 'o', '?' => 'o', '?' => 'o', '?' => 'A',
        '?' => 'B', '?' => 'V', '?' => 'G', '?' => 'D', '?' => 'E', '?' => 'E',
        '?' => 'Z', '?' => 'Z', '?' => 'I', '?' => 'I', '?' => 'K', '?' => 'L',
        '?' => 'M', '?' => 'N', '?' => 'O', '?' => 'P', '?' => 'R', '?' => 'S',
        '?' => 'T', '?' => 'U', '?' => 'F', '?' => 'K', '?' => 'T', '?' => 'C',
        '?' => 'S', '?' => 'S', '?' => 'Y', '?' => 'E', '?' => 'Y', '?' => 'Y',
        '?' => 'A', '?' => 'B', '?' => 'V', '?' => 'G', '?' => 'D', '?' => 'E',
        '?' => 'E', '?' => 'Z', '?' => 'Z', '?' => 'I', '?' => 'I', '?' => 'K',
        '?' => 'L', '?' => 'M', '?' => 'N', '?' => 'O', '?' => 'P', '?' => 'R',
        '?' => 'S', '?' => 'T', '?' => 'U', '?' => 'F', '?' => 'K', '?' => 'T',
        '?' => 'C', '?' => 'S', '?' => 'S', '?' => 'Y', '?' => 'E', '?' => 'Y',
        '?' => 'Y', '�' => 'd', '�' => 'D', '�' => 't', '�' => 'T', '?' => 'a',
        '?' => 'b', '?' => 'g', '?' => 'd', '?' => 'e', '?' => 'v', '?' => 'z',
        '?' => 't', '?' => 'i', '?' => 'k', '?' => 'l', '?' => 'm', '?' => 'n',
        '?' => 'o', '?' => 'p', '?' => 'z', '?' => 'r', '?' => 's', '?' => 't',
        '?' => 'u', '?' => 'p', '?' => 'k', '?' => 'g', '?' => 'q', '?' => 's',
        '?' => 'c', '?' => 't', '?' => 'd', '?' => 't', '?' => 'c', '?' => 'k',
        '?' => 'j', '?' => 'h',
    );
 
    return str_replace(array_keys($transliteration), array_values($transliteration), $str);
}
?>