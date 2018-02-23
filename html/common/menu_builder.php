<?php
class erpMenuElem {
	public $name;
	public $nameNoSpace;
	public $url;
	public $icon;
	public $father;
	public $child = array();

	function __construct($name, $url, $icon) {
		$this->name = $name;
		$this->nameNoSpace = str_replace("'", "", str_replace(" ", "", iconv('UTF-8', 'ASCII//TRANSLIT', $name)));//removeAccents(str_replace(" ", "", $name));
		$this->url = $url;
		$this->icon = $icon;
	}
	
	function getNumChild() {
		return count($this->child);
	}
	
	function getChild() {
		return $this->child;
	}
	
	function getHtml($actualPage) {
		if(($numChild = $this->getNumChild()) == 0) {
			$html = "<li ".($actualPage == $this->url?"class='active'":"")."><a href='$this->url'><i class='fa $this->icon'></i> <span class='nav-label'>$this->name</span></a></li>";
			return $html;
		}
		else {
			$html = "<li>";
			$html .= "	<a href='$this->url'><i class='fa $this->icon'></i> <span class='nav-label'>$this->name</span> <span class='fa arrow'></span></a>"; //<span class="label label-warning pull-right">16/24</span>
			$html .= "	<ul class='nav nav-second-level collapse'>";
			foreach($this->getChild() as $child) {
				$html .= $child->getHtml($actualPage);
			}
			$html .= "	</ul>";
			$html .= "</li>";
				
			return $html;		
		}
	}
	function hasChild($page) {
		foreach($this->child as $child) {
			if($child->url == $page) {
				return true;
			}
		}
		return false;
	}
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
				'?' => 'I', 'Ö' => 'O', 'Œ' => 'O', 'Ü' => 'U', 'ä' => 'a', 'æ' => 'a',
				'?' => 'i', 'ö' => 'o', 'œ' => 'o', 'ü' => 'u', 'ß' => 's', '?' => 's',
				'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A',
				'Æ' => 'A', 'A' => 'A', 'A' => 'A', 'A' => 'A', 'Ç' => 'C', 'C' => 'C',
				'C' => 'C', 'C' => 'C', 'C' => 'C', 'D' => 'D', 'Ð' => 'D', 'È' => 'E',
				'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'E' => 'E', 'E' => 'E', 'E' => 'E',
				'E' => 'E', 'E' => 'E', 'G' => 'G', 'G' => 'G', 'G' => 'G', 'G' => 'G',
				'H' => 'H', 'H' => 'H', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I',
				'I' => 'I', 'I' => 'I', 'I' => 'I', 'I' => 'I', 'I' => 'I', 'J' => 'J',
				'K' => 'K', 'L' => 'K', 'L' => 'K', 'L' => 'K', '?' => 'K', 'L' => 'L',
				'Ñ' => 'N', 'N' => 'N', 'N' => 'N', 'N' => 'N', '?' => 'N', 'Ò' => 'O',
				'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ø' => 'O', 'O' => 'O', 'O' => 'O',
				'O' => 'O', 'R' => 'R', 'R' => 'R', 'R' => 'R', 'S' => 'S', 'S' => 'S',
				'S' => 'S', '?' => 'S', 'Š' => 'S', 'T' => 'T', 'T' => 'T', 'T' => 'T',
				'?' => 'T', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'U' => 'U', 'U' => 'U',
				'U' => 'U', 'U' => 'U', 'U' => 'U', 'U' => 'U', 'W' => 'W', 'Y' => 'Y',
				'Ÿ' => 'Y', 'Ý' => 'Y', 'Z' => 'Z', 'Z' => 'Z', 'Ž' => 'Z', 'à' => 'a',
				'á' => 'a', 'â' => 'a', 'ã' => 'a', 'a' => 'a', 'a' => 'a', 'a' => 'a',
				'å' => 'a', 'ç' => 'c', 'c' => 'c', 'c' => 'c', 'c' => 'c', 'c' => 'c',
				'd' => 'd', 'd' => 'd', 'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e',
				'e' => 'e', 'e' => 'e', 'e' => 'e', 'e' => 'e', 'e' => 'e', 'ƒ' => 'f',
				'g' => 'g', 'g' => 'g', 'g' => 'g', 'g' => 'g', 'h' => 'h', 'h' => 'h',
				'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 'i' => 'i', 'i' => 'i',
				'i' => 'i', 'i' => 'i', 'i' => 'i', 'j' => 'j', 'k' => 'k', '?' => 'k',
				'l' => 'l', 'l' => 'l', 'l' => 'l', 'l' => 'l', '?' => 'l', 'ñ' => 'n',
				'n' => 'n', 'n' => 'n', 'n' => 'n', '?' => 'n', '?' => 'n', 'ò' => 'o',
				'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ø' => 'o', 'o' => 'o', 'o' => 'o',
				'o' => 'o', 'r' => 'r', 'r' => 'r', 'r' => 'r', 's' => 's', 'š' => 's',
				't' => 't', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'u' => 'u', 'u' => 'u',
				'u' => 'u', 'u' => 'u', 'u' => 'u', 'u' => 'u', 'w' => 'w', 'ÿ' => 'y',
				'ý' => 'y', 'y' => 'y', 'z' => 'z', 'z' => 'z', 'ž' => 'z', '?' => 'A',
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
				'?' => 'a', '?' => 'a', '?' => 'a', 'ß' => 'b', '?' => 'g', 'd' => 'd',
				'e' => 'e', '?' => 'e', '?' => 'e', '?' => 'e', '?' => 'e', '?' => 'e',
				'?' => 'e', '?' => 'e', '?' => 'e', '?' => 'z', '?' => 'i', '?' => 'i',
				'?' => 'i', '?' => 'i', '?' => 'i', '?' => 'i', '?' => 'i', '?' => 'i',
				'?' => 'i', '?' => 'i', '?' => 'i', '?' => 'i', '?' => 'i', '?' => 'i',
				'?' => 'i', '?' => 'i', '?' => 'i', '?' => 'i', '?' => 'i', '?' => 'i',
				'?' => 'i', '?' => 'i', '?' => 'i', '?' => 'i', '?' => 't', '?' => 'i',
				'?' => 'i', '?' => 'i', '?' => 'i', '?' => 'i', '?' => 'i', '?' => 'i',
				'?' => 'i', '?' => 'i', '?' => 'i', '?' => 'i', '?' => 'i', '?' => 'i',
				'?' => 'i', '?' => 'i', '?' => 'i', '?' => 'i', '?' => 'i', '?' => 'k',
				'?' => 'l', 'µ' => 'm', '?' => 'n', '?' => 'k', '?' => 'o', '?' => 'o',
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
				'?' => 'Y', 'ð' => 'd', 'Ð' => 'D', 'þ' => 't', 'Þ' => 'T', '?' => 'a',
				'?' => 'b', '?' => 'g', '?' => 'd', '?' => 'e', '?' => 'v', '?' => 'z',
				'?' => 't', '?' => 'i', '?' => 'k', '?' => 'l', '?' => 'm', '?' => 'n',
				'?' => 'o', '?' => 'p', '?' => 'z', '?' => 'r', '?' => 's', '?' => 't',
				'?' => 'u', '?' => 'p', '?' => 'k', '?' => 'g', '?' => 'q', '?' => 's',
				'?' => 'c', '?' => 't', '?' => 'd', '?' => 't', '?' => 'c', '?' => 'k',
				'?' => 'j', '?' => 'h',
		);
	
		return str_replace(array_keys($transliteration), array_values($transliteration), $str);
	}
}

class erpMenu {
	public $menu;
	public $actualPage;

	function __construct() {
		$this->menu = new erpMenuElem("root", "index.php", "");
		
		$currentURL = $_SERVER["PHP_SELF"];
		$partsURL = Explode('/', $currentURL);
		$this->actualPage = $partsURL[count($partsURL) - 1];
		$this->createMenuArr();
	}
	
	function createMenuArr() {
		$i = 0;
		$j = 0;
		
		if($this->menu->getNumChild() == 0) {
			$this->menu->child[$i] = new erpMenuElem("Dashboard", "main.php", "fa-th-large");
			$i++; $j=0;
				
			$this->menu->child[$i] = new erpMenuElem("Dashboards", "", "fa-th-large"); 
			$this->menu->child[$i]->child[$j] = new erpMenuElem("Controle", "main.php?type=controller", ""); $j++;
			$this->menu->child[$i]->child[$j] = new erpMenuElem("Diretoria", "main.php?type=board", ""); $j++;
			$this->menu->child[$i]->child[$j] = new erpMenuElem("Advogados", "main.php?type=lawyer", ""); $j++;
			$this->menu->child[$i]->child[$j] = new erpMenuElem("Sindicalizados", "main.php?type=customer", ""); $j++;
			$i++; $j=0;

			$this->menu->child[$i] = new erpMenuElem("Usuarios", "users.php", "fa-users");
			$i++; $j=0;
			
			$this->menu->child[$i] = new erpMenuElem("Clientes", "customers.php", "fa-users");
			$i++; $j=0;
			
			$this->menu->child[$i] = new erpMenuElem("Projetos", "projects.php", "fa-legal");
			$i++; $j=0;
				
			$this->menu->child[$i] = new erpMenuElem("Faturas", "invoices.php", "fa-money");
			$i++; $j=0;
				
			$this->menu->child[$i] = new erpMenuElem("Tarefas", "tasks.php", "fa-check");
			$i++; $j=0;

			$this->menu->child[$i] = new erpMenuElem("Mensagens", "mailbox.php", "fa-envelope");
// 			$this->menu->child[$i]->child[$j] = new erpMenuElem("Inbox", "#", ""); $j++;
// 			$this->menu->child[$i]->child[$j] = new erpMenuElem("Ver Email", "#", ""); $j++;
// 			$this->menu->child[$i]->child[$j] = new erpMenuElem("Compor Email", "#", ""); $j++;
			$i++; $j=0;
				
			$this->menu->child[$i] = new erpMenuElem("Metricas", "statistics.php", "fa-pie-chart");
			$i++; $j=0;
				
			$this->menu->child[$i] = new erpMenuElem("Relatorios", "#", "fa-file");
			$this->menu->child[$i]->child[$j] = new erpMenuElem("Relatório 1", "report.php", ""); $j++;
			$this->menu->child[$i]->child[$j] = new erpMenuElem("Relatório 2", "report.php", ""); $j++;
			$i++; $j=0;
			
			$this->menu->child[$i] = new erpMenuElem("Administrativo", "#", "fa-cogs");
			$this->menu->child[$i]->child[$j] = new erpMenuElem("MailDB", "maildb.php", "fa-envelope"); $j++;
			$this->menu->child[$i]->child[$j] = new erpMenuElem("Regras", "roles.php", ""); $j++;
			$i++; $j=0;
		}	
	} 
	function createMenu($daoRoles) {

		$_SESSION['role'] = $daoRoles;
		$role = $daoRoles->getRoleCurrentCred();
		
		$return = false;
		
		if($this->menu->getNumChild() == 0) {
			$this->createMenuArr();
		}
		
		foreach($this->menu->getChild() as $submenu) {
			if(!isset($role[$submenu->nameNoSpace])) {
				$daoRoles->addRoleColumn($submenu->nameNoSpace);
			}
			
			$perm = isset($role[$submenu->nameNoSpace])?$role[$this->getChildNoSpace($submenu->nameNoSpace)]:-1;
			
			if ($perm >= 0) {
				echo $submenu->getHtml($this->actualPage);
			}
			if($submenu->url == $this->actualPage || $submenu->hasChild($this->actualPage)) {
				switch($perm) {
					case 1:
						$return = true;
						break;
					case 0:
						$return = false;
						break;
					case -1:
					default:
						$_SESSION['msgError'] = "Permissão inválida para acesso á página solicitada!";
						header("location: login.php?msgError=".$_SESSION['msgError']);
						break;
				}
			}
		}
	}
	function getChildNoSpace($child) {
		$noSpaceChild = str_replace(" ", "", $child);
		return $noSpaceChild;
	}
	
	function getMenuArr() {
		$arr = array();
		foreach($this->menu->getChild() as $child) {
			$noSpaceChild = $this->getChildNoSpace($child->nameNoSpace);
			$arr[$noSpaceChild] = "-1";
		}
		return $arr;
	}
}

$menu = new erpMenu();
$menu->createMenu($dao['roles']);
?>