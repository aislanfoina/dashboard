<?php require("../common/config.php")?>
<?php 
$aliases = $dao['metrics']->get();
?>
<!DOCTYPE html>
<html>
<head>
<?php include("part_head.php");?>
</head>
<body>
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse"></div>
        </nav>

        <div id="page-wrapper" class="gray-bg dashbard-1">
<?php include("part_topbar.php");?>   
        
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Metrics</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="main.php">Home</a>
                        </li>
                        <li class="active">
                            <strong>Metrics</strong>
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
                        <h5>Metrics</h5>
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
                    	<h2>Metrics</h2>
                    	<div class="add_delete_toolbar" />
			 			<table class="table table-striped table-bordered table-hover" id="metrics">
				            <thead>
					            <tr>
					                <th>name</th>
					                <th>desc</th>
					                <th>unit</th>
					                <th>value</th>
					                <th>ideal_value</th>
					            </tr>
				            </thead>
				            <tbody>
<?php foreach ($aliases as $alias) { ?>
<?php 	
	$idColumn = "id";
	$id = $alias['id'];
	$name = $alias['name'];
	$description = $alias['description'];
	$unit = $alias['unit'];
	$value = $alias['value'];
	$ideal_value = $alias['ideal_value'];
?>
					            <tr id="<?php echo "$idColumn|$id"?>">
					                <td> <?php echo $name?></td>
					                <td><?php echo $description?></td>
					                <td><?php echo $unit?></td>
					                <td><?php echo $value?></td>
					                <td><?php echo $ideal_value?></td>
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
var editor_metrics;
$(document).ready(function() {

     
     editor_metrics = new $.fn.dataTable.Editor( {
    	ajax: "tool_ajax_datatables_editor.php",
     	table: "#metrics",
     	fields: [ {
	            label: "Name:",
	            name: "metrics.name"
		    }, {
        	    label: "Description:",
            	name: "metrics.description"
	        }, {
	            label: "Unit:",
	            name: "metrics.unit"
		    }, {
        	    label: "Value:",
            	name: "metrics.value"
		    }, {
        	    label: "Ideal Value:",
            	name: "metrics.ideal_value"
	        }
	    ]
     });
     // Activate an inline edit on click of a table cell
//      $('#alias').on( 'click', 'tbody td', function (e) {
//     	 editor_domain.inline( this );
//      } );
     $('#metrics').DataTable( {
 		"bPaginate": false,
 	    "oLanguage": {
 	    	"sLengthMenu": "Display _MENU_ records per page",
 	        "sZeroRecords": "Nada encontrado - desculpe",
 	        "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
 	        "sInfoEmpty": "Mostrando de 0 até 0 de 0 registros",
 	        "sInfoFiltered": "(filtrado de _MAX_ registos totais)",
 	        "sSearch": "Buscar: "
 		},
 		dom: 'Bfrtip',
    	select: true,
    	buttons: [
    		{ extend: 'create', editor: editor_metrics },
			{ extend: 'edit',   editor: editor_metrics },
			{ extend: 'remove', editor: editor_metrics }
		],
  		columns: [
   	    	{ data: 'metrics.name' },
   	    	{ data: 'metrics.description' },
   	    	{ data: 'metrics.unit' },
   	    	{ data: 'metrics.value' },
   	        { data: 'metrics.ideal_value' }
		]
     });

/*
    $('.datatable-edit-old').dataTable({
    	"bPaginate": false,
    	dom: '<"html5buttons"B>lTfgitp',
	    buttons: [
		     { extend: 'copy'},
		     {extend: 'csv'},
		     {extend: 'excel', title: 'Excel'},
		     {extend: 'pdf', title: 'PDF'},
		
		     {extend: 'print',
		      customize: function (win){
		             $(win.document.body).addClass('white-bg');
		             $(win.document.body).css('font-size', '10px');
		
		             $(win.document.body).find('table')
		                     .addClass('compact')
		                     .css('font-size', 'inherit');
		     }
		     }
		],
        "oLanguage": {
        	"sLengthMenu": "Display _MENU_ records per page",
            "sZeroRecords": "Nada encontrado - desculpe",
            "sInfo": "Mostrando de _START_ at� _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando de 0 at� 0 de 0 registros",
            "sInfoFiltered": "(filtrado de _MAX_ registos totais)",
            "sSearch": "Buscar: "
		}
    }).makeEditable({
		sUpdateURL: 'tool_ajax_datatables_general.php',
		sAddURL: 'tool_ajax_datatables_general.php'
    });
*/
});

</script>
</html>
