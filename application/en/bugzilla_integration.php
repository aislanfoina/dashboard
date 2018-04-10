<?php require("../common/config.php")?>
<?php
$url = "http://foi.tech/airspace/dashboard/common/api.php";

$fixedArr = "[";
$pendingArr = "[";
$newArr = "[";

for($i = 30; $i >= 0; $i--) {
    $date = date('Y-m-d', strtotime("today - $i days"));
    $fixed = $dao['bugs']->getBugsResolvedbyDay($date);
    $pending = $dao['bugs']->getOpenBugsCnt($date);
    $new = $dao['bugs']->getBugsCreatedCntbyDay($date);
    $gdDate = "gd(".str_replace("-", ",", $date).")";
    
    $fixedArr .= "[$gdDate, -$fixed]";
    $pendingArr .= "[$gdDate, $pending]";
    $newArr .= "[$gdDate, $new]";
    if($i > 0) {
        $fixedArr .= ",";
        $pendingArr .= ",";
        $newArr .= ",";
    }
}

$fixedArr .= "];";
$pendingArr .= "];";
$newArr .= "];";

$json = array();
$json['action'] = "bugzilla";
$json['fixed_arr'] = $fixedArr;
$json['pending_arr'] = $pendingArr;
$json['new_arr'] = $newArr;

$content = json_encode($json);

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER,
    array("Content-type: application/json"));
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $content);

$json_response = curl_exec($curl);

$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

if ( $status != 200 ) {
    die("Error: call to URL $url failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
}

echo $json_response."\n";

curl_close($curl);
?>