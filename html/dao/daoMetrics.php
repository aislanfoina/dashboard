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

class Metrics extends Crud{
	public $creation = "CREATE TABLE `metrics` (
							`id` int(9) unsigned NOT NULL AUTO_INCREMENT,
							`name` varchar(50) NOT NULL DEFAULT 'undef',
							`description` text,
							`unit` varchar(20) NOT NULL DEFAULT 'undef',
							`value` varchar(10) NOT NULL DEFAULT 'undef',
							`ideal_value` varchar(10) NOT NULL DEFAULT 'undef',
							`tendency` varchar(10) NOT NULL DEFAULT 'undef',
							`score_formula` varchar(10) NOT NULL DEFAULT 'undef',
                            `id_status` int(3) unsigned DEFAULT 0,
							`creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
							PRIMARY KEY (`id`),
							KEY `id` (`id`)
						)";
	
	public $fields = array("metrics.id", "metrics.name", "metrics.description", "metrics.unit", "metrics.value", "metrics.ideal_value", "metrics.creation_date",
						"status.status");
	public $join = "LEFT JOIN status ON metrics.id_status = status.id";

	public function __construct($cred){
		parent::__construct($cred);
		$this->table = "metrics";
		if(!$this->checkTable()) {
		    $data['name'] = "qav_flights_this_week";
		    $data['value'] = "0";
		    $this->insert($data);
		    $data['name'] = "insect_flights_this_week";
		    $data['value'] = "0";
		    $this->insert($data);
		    $data['name'] = "flights_last_week";
		    $data['value'] = "2";
		    $this->insert($data);
		    $data['name'] = "last_crash";
		    $data['value'] = "2018-02-15";
		    $this->insert($data);
		    $data['name'] = "last_interdiction";
		    $data['value'] = "2018-02-10";
		    $this->insert($data);
		    $data['name'] = "system_score";
		    $data['value'] = "0.12";
		    $this->insert($data);
		    $data['name'] = "open_bugs";
		    $data['value'] = "45";
		    $this->insert($data);
		    $data['name'] = "gs_msg_s";
		    $data['value'] = "200";
		    $this->insert($data);
		    $data['name'] = "gs_detect_m";
		    $data['unit'] = "m";
		    $data['value'] = "315";
		    $this->insert($data);
		    $data['name'] = "gs_avg_pkt_ms";
		    $data['unit'] = "ms";
		    $data['value'] = "8";
		    $this->insert($data);
		    $data['name'] = "vis_detection_%";
		    $data['unit'] = "%";
		    $data['value'] = "40";
		    $this->insert($data);
		    $data['name'] = "vis_tracking_%";
		    $data['unit'] = "%";
		    $data['value'] = "40";
		    $this->insert($data);
		    $data['name'] = "vis_detection_m";
		    $data['unit'] = "m";
		    $data['value'] = "35";
		    $this->insert($data);
		    $data['name'] = "fly_dispatch_spd_ms";
		    $data['unit'] = "m/s";
		    $data['value'] = "35";
		    $this->insert($data);
		    $data['name'] = "fly_interdict_s";
		    $data['unit'] = "s";
		    $data['value'] = "30";
		    $this->insert($data);
		    $data['name'] = "fly_dispatch_precision_%";
		    $data['unit'] = "%";
		    $data['value'] = "55";
		    $this->insert($data);
		    $data['name'] = "fly_spd_ms";
		    $data['unit'] = "m/s";
		    $data['ideal_value'] = "50";
		    $data['value'] = "15";
		    $this->insert($data);
		    $data['name'] = "fly_range_m";
		    $data['unit'] = "m";
		    $data['ideal_value'] = "1000";
		    $data['value'] = "200";
		    $this->insert($data);
		    $data['name'] = "interdict_s";
		    $data['unit'] = "s";
		    $data['ideal_value'] = "10";
		    $data['value'] = "43";
		    $this->insert($data);
		    $data['name'] = "punch_m";
		    $data['unit'] = "m";
		    $data['ideal_value'] = "10";
		    $data['value'] = "4";
		    $this->insert($data);
		    
		}
	}

	public function getMetricbyName($name) {
	    $where = "metrics.name LIKE '$name'";
	    $order = "metrics.id DESC";
	    $ret = $this->read($this->fields,$where,null,null,$order,$this->join);
	    if(count($ret)>0)
	        return $ret[0];
	    else {
	        $data['name'] = $name;
	        $this->insert($data);
	        return false;
	    }
	}

	public function getMetricValuebyName($name, $value = false) {
	    $where = "metrics.name LIKE '$name'";
	    $order = "metrics.id DESC";
	    $ret = $this->read($this->fields,$where,null,null,$order,$this->join);
	    if(count($ret)>0) {
            $row = $ret[0];
            return $row['value'].($row['unit']!="undef"?$row['unit']:"");
	    }
	    else {
	        if($value !== false) {
    	        $data['name'] = $name;
    	        $data['value'] = $value;
    	        $this->insert($data);
    	        return $this->getMetricValuebyName($name);
	        }
	        else return false;
	    }
	}
	
	public function getMetricColorbyName($name) {
	    $where = "metrics.name LIKE '$name'";
	    $order = "metrics.id DESC";
	    $ret = $this->read($this->fields,$where,null,null,$order,$this->join);
	    if(count($ret)>0) {
	        $row = $ret[0];
	        switch ($name) {
	            case "insect_flights_this_week":
	            case "qav_flights_this_week":
	            case "flights_last_week":
	                switch ($row['value']) {
	                    case 0:
	                        return "red-bg";
	                        break;
	                    case 1:
	                    case 2:
	                        return "yellow-bg";
	                        break;
	                    default:
	                        return "navy-bg";
	                        break;
	                }
	                break;
	            case "open_bugs":
	                return "blue-bg";
	                break;
	            default:
	                return "lazur-bg";
	                break;
	        }
	    }
	    else
	        return "grey-bg";
	}
	
	public function getMetricIdealbyName($name) {
	    $where = "metrics.name LIKE '$name'";
	    $order = "metrics.id DESC";
	    $ret = $this->read($this->fields,$where,null,null,$order,$this->join);
	    if(count($ret)>0) {
	        $row = $ret[0];
	        return $row['ideal_value'].($row['unit']!="undef"?$row['unit']:"");
	    }
	    else {
	        $data['name'] = $name;
	        $this->insert($data);
	        return false;
	    }
	}
	
	public function getMetrics($where = null, $order = null) {
		return $this->read($this->fields,$where,null,null,$order,$this->join);
	}
}
?>