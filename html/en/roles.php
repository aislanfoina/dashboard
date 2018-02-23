<?php require("../common/config.php")?>
<?php 
$roles = $dao['roles']->getRoles(); 
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
<?php include("part_topbar.php");?>   
        
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Data Tables</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="main.php">Home</a>
                        </li>
                        <li class="active">
                            <strong>Regras</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Regras</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="#">Config option 1</a>
                                </li>
                                <li><a href="#">Config option 2</a>
                                </li>
                            </ul>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
			 			<table class="table table-striped table-bordered table-hover" id="mainTableRoles" >
				            <thead>
					            <tr>
					                <th>Nome</th>
					                <th>Status</th>
<?php foreach ($menu->menu->getChild() as $submenu) { ?>	                
					                <th><?php echo $submenu->nameNoSpace?></th>
<?php } ?>	                
					                <th>&nbsp;</th>
					            </tr>
				            </thead>
				            <tbody>
<?php foreach ($roles as $role) { ?>
					            <tr id="<?php echo $role['id']?>">
					                <td><?php echo $role['role']?></td>
					                <td><?php echo $role['status']?></td>
<?php foreach ($menu->menu->getChild() as $submenu) { ?>	   	                
					                <td><?php echo ($role[$submenu->nameNoSpace]==1?"Total":($role[$submenu->nameNoSpace]==-1?"Oculto":"Ver"))?></td>
<?php } ?>	                
					                <td><i class="fa fa-times"></i></td>
					            </tr>
<?php } ?>	            
				            </tbody>
				        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
            <div class="footer">
<?php include("part_footer.php")?>
            </div>
        </div>
    </div>
</body>
<?php include("part_scripts.php")?>
<script>
var oTableRoles = $('#mainTableRoles').dataTable({
	"bPaginate": false,
    "oLanguage": {
    	"sLengthMenu": "Display _MENU_ records per page",
        "sZeroRecords": "Nada encontrado - desculpe",
        "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
        "sInfoEmpty": "Mostrando de 0 até 0 de 0 registros",
        "sInfoFiltered": "(filtrado de _MAX_ registos totais)",
        "sSearch": "Buscar: "
	}

}).makeEditable({
	"aoColumns": [
		null,
		null,
<?php
foreach ($menu->menu->getChild() as $submenu) {
?>			
		{
			indicator: 'Salvando Permissão...',
			tooltip: 'Click duplo para editar permissão',
			loadtext: 'carregando...',
			type: 'select',
			onblur: 'submit',
			data: "{'1':'Total', '0':'Ver', '-1':'Oculto'}",
			sUpdateURL: 'tool_ajax_datatables.php'
		},
<?php 
}
?>			
		null
	]
});
</script>
</html>
