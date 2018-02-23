<?php require("../common/config.php")?>
<?php 
if(!_any("type")) {
	$user = $dao['users']->getUserbyId($_SESSION[$cfgPrefix.'_userId']);
	$_GET['type'] = $user['role']; 
}

if(_any("action")) {
	switch (_any("action")) {
		case "save":
			$dao["notes"]->savebyPrefix("notes_", $_POST);
			$_SESSION["msgSuccess"] = "Comentário salvo com sucesso!";
			break;
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<?php include("part_head.php");?>
</head>
<body>
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
<?php include("part_sidebar.php");?>
            </div>
        </nav>

        <div id="page-wrapper" class="gray-bg dashbard-1">
<?php include("part_topbar.php")?>          
            <div class="row wrapper border-bottom white-bg dashboard-header">
<?php include("part_msghandling.php")?>
<?php include("part_scripts.php")?>
<?php 
switch(_any("type")) {
	case "controller":
	case "Controlador":
		include("part_mainControle.php");
		break;
	case "board":
	case "Diretor":
		include("part_mainBoard.php");
		break;
	case "lawyer":
	case "Advogado":
		include("part_mainLawyer.php");
		break;
	case "customer":
	case "Sindicalizado":
		include("part_mainCustomer.php");
		break;
	default:
		include("part_mainControle.php");
		break;
}
?>
            </div>
            
            <div class="footer">
<?php include("part_footer.php")?>
            </div>
        
        </div>

        <div id="right-sidebar">
<?php include("part_rightbar.php")?>            
        </div>
    </div>
</body>
<?php if(_any("first")) { ?>
<script type="text/javascript">        
$(document).ready(function() {
    setTimeout(function() {
        toastr.options = {
            closeButton: true,
            progressBar: true,
            showMethod: 'slideDown',
            timeOut: 4000
        };
        toastr.success('Sistema de gestão de projetos', 'Bem vindo ao ERP!');

    }, 1300);
});
</script>
<?php } ?>
</html>
