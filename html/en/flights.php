<?php require("../common/config.php")?>
<?php 
$aliases = $dao['flightlogs']->get();
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
                    	<h2>Flight Logs</h2>
                    	<div class="add_delete_toolbar" />
			 			<table class="table table-striped table-bordered table-hover" id="flightlogs">
				            <thead>
					            <tr>
					                <th>id_drone</th>
					                <th>begin</th>
					                <th>end</th>
					                <th>summary</th>
					                <th>subjects</th>
					                <th>blocks</th>
					                <th>keywords</th>
					                <th>versions</th>
					                <th>participants</th>
					            </tr>
				            </thead>
				            <tbody>
<?php foreach ($aliases as $alias) { ?>
<?php 	
	$idColumn = "id";
	$id = $alias['id'];

?>
					            <tr id="<?php echo "$idColumn|$id"?>">
					                <td> <?php echo $alias['id_drone']?></td>
					                <td><?php echo $alias['begin']?></td>
					                <td><?php echo $alias['end']?></td>
					                <td><?php echo $alias['summary']?></td>
					                <td><?php echo $alias['subjects']?></td>
					                <td><?php echo $alias['blocks']?></td>
					                <td><?php echo $alias['keywords']?></td>
					                <td><?php echo $alias['versions']?></td>
					                <td><?php echo $alias['participants']?></td>
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
var editor_flightlogs;
$(document).ready(function() {

     
     editor_flightlogs = new $.fn.dataTable.Editor( {
    	ajax: "tool_ajax_datatables_editor.php",
     	table: "#flightlogs",
     	fields: [ {
	            label: "id_drone:",
	            name: "flightlogs.id_drone",
		        type: "select",
		        options: [
					{ label: "Buzz", value: "1" },
					{ label: "Chuck", value: "2" },
					{ label: "Doolitle", value: "5" },
					{ label: "QAV1", value: "3" },
					{ label: "QAV2", value: "4" },
		  		]
		    }, {
        	    label: "begin:",
            	name: "flightlogs.begin",
            	type: "datetime",
                def:       function () { return new Date(); },
                format:    'YYYY-MM-DD H:mm'
	        }, {
	            label: "end:",
	            name: "flightlogs.end",
	            type: "datetime",
                def:       function () { return new Date(); },
                format:    'YYYY-MM-DD H:mm'
		    }, {
        	    label: "summary:",
            	name: "flightlogs.summary"
		    }, {
        	    label: "subjects:",
            	name: "flightlogs.subjects"
		    }, {
        	    label: "blocks:",
            	name: "flightlogs.blocks"
		    }, {
        	    label: "keywords:",
            	name: "flightlogs.keywords"
		    }, {
        	    label: "versions:",
            	name: "flightlogs.versions"
		    }, {
        	    label: "participants:",
            	name: "flightlogs.participants"
	        }
	    ]
     });
     // Activate an inline edit on click of a table cell
//      $('#alias').on( 'click', 'tbody td', function (e) {
//     	 editor_domain.inline( this );
//      } );
     $('#flightlogs').DataTable( {
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
    		{ extend: 'create', editor: editor_flightlogs },
			{ extend: 'edit',   editor: editor_flightlogs },
			{ extend: 'remove', editor: editor_flightlogs }
		],
  		columns: [
   	    	{ data: 'flightlogs.id_drone' },
   	    	{ data: 'flightlogs.begin' },
   	    	{ data: 'flightlogs.end' },
   	    	{ data: 'flightlogs.summary' },
   	    	{ data: 'flightlogs.subjects' },
   	    	{ data: 'flightlogs.blocks' },
   	    	{ data: 'flightlogs.keywords' },
   	    	{ data: 'flightlogs.versions' },
   	        { data: 'flightlogs.participants' }
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
