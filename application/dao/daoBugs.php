<?php
/* Copyright (C) 2015 Foi.tech - All Rights Reserved
 * You may use, distribute and modify this code under the terms of
 * the FMS license, which unfortunately won't be written for another
 * century.
 *
 * You should have received a copy of the FMS license with
 * this file. If not, please write to: license@foi.tech, or
 * visit : http://foi.tech/license.pdf
 */

class Bugs extends Crud{
	public $creation = "CREATE TABLE `bugs` (
							`bug_id` int(9) unsigned NOT NULL AUTO_INCREMENT,
							`bug_severity` varchar(64) NOT NULL DEFAULT 'undef',
							`bug_status` varchar(64) NOT NULL DEFAULT 'undef',
							`creation_ts` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
							`delta_ts` datetime NOT NULL,
							`product_id` int(6)  NOT NULL DEFAULT 0,
							`resolution` varchar(64) NOT NULL DEFAULT 'undef',
							PRIMARY KEY (`bug_id`),
							KEY `bug_id` (`bug_id`)
						)";
	
	public $fields = array("bugs.bug_id", "bugs.bug_severity", "bugs.bug_status", "bugs.creation_ts", "bugs.delta_ts", "bugs.product_id", "bugs.resolution",
						"products.name");
	public $join = "LEFT JOIN products ON bugs.product_id = products.id";

	public function __construct($cred){
		parent::__construct($cred);
		$this->table = "bugs";
	}

	public function getOpenBugsCnt($date = "NOW()") {
	    $fields = array("COUNT(bugs.bug_status) AS cnt", "bugs.bug_status");
	    $where = "(DATE(bugs.creation_ts) <= \"$date\" AND DATE(bugs.delta_ts) >= \"$date\") OR (bugs.delta_ts = bugs.creation_ts AND DATE(bugs.creation_ts) < \"$date\")";//AND (bugs.bug_status NOT LIKE \"RESOLVED\" AND bugs.bug_status NOT LIKE \"VERIFIED\")"
// 	    $groupby = "bugs.bug_status";
	    $ret = $this->read($fields,$where,null,null,null,$this->join);
	    $cnt = $ret[0];
	    return $cnt['cnt'];
	}
	
	public function getBugsCreatedCntbyDay($date = "NOW()") {
	    $fields = array("COUNT(bugs.bug_status) AS cnt", "bugs.bug_status");
	    $where = "DATE(bugs.creation_ts) = \"$date\"";
	    // 	    $groupby = "bugs.bug_status";
	    $ret = $this->read($fields,$where,null,null,null,$this->join);
	    $cnt = $ret[0];
	    return $cnt['cnt'];
	}

	public function getBugsResolvedbyDay($date = "NOW()") {
	    $fields = array("COUNT(bugs.bug_status) AS cnt", "bugs.bug_status");
	    $where = "DATE(bugs.delta_ts) = \"$date\" AND (bugs.bug_status LIKE \"RESOLVED\" OR bugs.bug_status LIKE \"VERIFIED\")";
	    // 	    $groupby = "bugs.bug_status";
	    $ret = $this->read($fields,$where,null,null,null,$this->join);
	    $cnt = $ret[0];
	    return $cnt['cnt'];
	}
	
	public function getBugsCreatedCntInterval($start, $end) {
	    $fields = array("COUNT(bugs.bug_status) AS cnt", "bugs.bug_status");
	    $where = "(DATE(bugs.creation_ts) >= \"$start\" AND DATE(bugs.creation_ts) <= \"$end\")";
	    $ret = $this->read($fields,$where,null,null,null,$this->join);
	    $cnt = $ret[0];
	    return $cnt['cnt'];
	}
	public function getBugsResolvedCntInterval($start, $end) {
	    $fields = array("COUNT(bugs.bug_status) AS cnt", "bugs.bug_status");
	    $where = "(DATE(bugs.delta_ts) >= \"$start\" AND DATE(bugs.delta_ts) <= \"$end\") AND (bugs.bug_status LIKE \"RESOLVED\" OR bugs.bug_status LIKE \"VERIFIED\")";
	    $ret = $this->read($fields,$where,null,null,null,$this->join);
	    $cnt = $ret[0];
	    return $cnt['cnt'];
	}
}
?>