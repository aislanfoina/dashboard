<?php
class Template extends Crud{
	public $creation = "CREATE TABLE `template` (
							`id` int(3) unsigned NOT NULL AUTO_INCREMENT,
							`template` varchar(100) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
							PRIMARY KEY (`id`),
							KEY `id` (`id`)
						)";
	
	public $fields = array("template.id", "template.template");

	public function __construct($cred){
		parent::__construct($cred);
		$this->table = "template";
		if(!$this->checkTable()) {
			$data['template'] = "Ativo";
			$this->insertTemplate($data);
		}		
	}
	
	/// Selects
	
	/// Inserts
	
	public function insertTemplate($data) {
		return $this->insert($data);
	}
	
	/// Updates
	
	/// Deletes
	
	/// Misc
	
	
}
?>
