<?php require("../common/config.php")?>
<?php header('Access-Control-Allow-Origin: *');?>
<?php 
$start = (_any('start')?_any('start'):date("Y-m-d", strtotime("-1 months")));
$end = (_any('end')?_any('end'):date("Y-m-d"));
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
                    <h2>Métricas</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="main.php">Home</a>
                        </li>
                        <li class="active">
                            <strong>Métricas</strong>
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
		                	<div class="ibox-content">
		                    	<form role="form" class="form-inline">
									<div class="form-group" id="data_5">
		                                <label class="font-noraml">Intervalo de tempo</label>
		                                <div class="input-daterange input-group" id="datepicker">
		                                    <input type="text" class="input-sm form-control" name="start" value="<?php echo $start?>"/>
		                                    <span class="input-group-addon">to</span>
		                                    <input type="text" class="input-sm form-control" name="end" value="<?php echo $end?>" />
		                                </div>
										<button class="btn btn-white input-sm" type="submit">Generate</button> 
		                            </div>
		                        </form>
		                    </div>
                		</div>
					</div>
				</div>
                <div class="row">
                    <div class="col-lg-3">
                        <div class="ibox">
                            <div class="ibox-content">
                                <h5 class="m-b-md">Average week work hours</h5>
                                <h2 class="text-navy">
                                    <i class="fa fa-play fa-rotate-270"></i> <span id="avgWeekWorkHour"></span>
                                </h2>
                                <small></small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="ibox">
                            <div class="ibox-content">
                                <h5 class="m-b-md">Average Airspace week work hours</h5>
                                <h2 class="text-danger">
                                    <i class="fa fa-play fa-rotate-90"></i> <span id="avgWorkHoursWeekDl"></span>
                                </h2>
                                <small></small>
                            </div>
                        </div>
                    </div>
                      <div class="col-lg-3">
                        <div class="ibox">
                            <div class="ibox-content">
                                <h5>Percentage of Airspace time coding</h5>
                                <h2><span id="percentCodingWorkHoursDl"></span></h2>
                                <div class="progress progress-mini">
                                    <div style="width: 0%;" class="progress-bar" id="percentCodingWorkHoursDlBar"></div>
                                </div>

                                <div class="m-t-sm small"></div>
                            </div>
                        </div>
                    </div>
<!--                     <div class="col-lg-3"> -->
<!--                         <div class="ibox"> -->
<!--                             <div class="ibox-content"> -->
<!--                                 <h5>Pagamentos</h5> -->
<!--                                 <h1 class="no-margins">886,200</h1> -->
<!--                                 <div class="stat-percent font-bold text-navy">98% <i class="fa fa-bolt"></i></div> -->
<!--                                 <small></small> -->
<!--                             </div> -->
<!--                         </div> -->
<!--                     </div> -->
<!--                 </div> -->
<!--                 <div class="row"> -->
<!--                     <div class="col-lg-4"> -->
<!--                         <div class="ibox"> -->
<!--                             <div class="ibox-content"> -->
<!--                                 <h5>Índice de Satisfação dos Sindicalizados</h5> -->
<!--                                 <h2>250 avaliações</h2> -->
<!--                                 <div id="sparkline1"></div> -->
<!--                             </div> -->
<!--                         </div> -->
<!--                     </div> -->
<!--                     <div class="col-lg-4"> -->
<!--                         <div class="ibox"> -->
<!--                             <div class="ibox-content"> -->
<!--                                 <h5>Número de Processos Ajuizados no ano</h5> -->
<!--                                 <h2>165</h2> -->
<!--                                 <div id="sparkline2"></div> -->
<!--                             </div> -->
<!--                         </div> -->
<!--                     </div> -->
                    <div class="col-lg-3">
                        <div class="ibox">
                            <div class="ibox-content">
                                <h5>Total Airspace time</h5>
                                <h2><span id="totalWorkHoursDl"></span></h2>
                                <div id="dlHour"></div>
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
	var lineData = {};
	var doughnutData = [];
	var totalPerDay = [];
	lineData.labels = [];// Array();//[];
	lineData.datasets = [];
	var dataPoints = {};
	var dataLabels = [];
	var sumLabels = [];
	var seriesData = [];


	var start = "<?php echo $start?>";
	var end = "<?php echo $end?>";
	var totalWorkHours = 0;
	var totalWorkHoursDl = 0;
	var totalCodingWorkHoursDl = 0;
	var avgWorkHoursWeek = 0;
	var avgWorkHoursWeekDl = 0;
	var percentCodingWorkHoursDl = 0;
	var dlOther = 0;
	var dlIff = 0;
	var dlGs = 0;
	var dlPx4 = 0;
	var dlLidar = 0;

	Date.daysBetween = function( date1, date2 ) {   //Get 1 day in milliseconds   
		var one_day=1000*60*60*24;    // Convert both dates to milliseconds
		var date1_ms = date1.getTime();   
		var date2_ms = date2.getTime();    // Calculate the difference in milliseconds  
		var difference_ms = date2_ms - date1_ms;        // Convert back to days and return   
		return Math.round(difference_ms/one_day); 
	} 

	Date.parseDate = function (input, format) {
		format = format || 'yyyy-mm-dd'; // default format
		var parts = input.match(/(\d+)/g), 
		i = 0, fmt = {};
		// extract date-part indexes from the format
		format.replace(/(yyyy|dd|mm)/g, function(part) { fmt[part] = i++; });
	
		return new Date(parts[fmt['yyyy']], parts[fmt['mm']]-1, parts[fmt['dd']]);
	}
	 
    var lineOptions = {
            scaleShowGridLines: true,
            scaleGridLineColor: "rgba(0,0,0,.05)",
            scaleGridLineWidth: 1,
            bezierCurve: true,
            bezierCurveTension: 0.4,
            pointDot: true,
            pointDotRadius: 4,
            pointDotStrokeWidth: 1,
            pointHitDetectionRadius: 20,
            datasetStroke: true,
            datasetStrokeWidth: 2,
            datasetFill: true,
            responsive: true,
            legendTemplate : "<% for (var i=0; i<datasets.length; i++){%><span style=\"background-color:<%=datasets[i].strokeColor%>\">&#9723;</span> <%if(datasets[i].label){%><%=datasets[i].label%><%}%>  <%}%>"
        };
    
    $.ajax({
		url: "http://ws1.iflylo.com/json2.php",
		type: "GET",
		data: { action: 'getdronesreport', start:'<?php echo $start?>', end:'<?php echo $end?>', id_user: 23},
		dataType: 'json',
		success: function(response) {
			console.log(response);
			var arr = $.map(response, function(el) { return el });
			for(var record in response.report) {
				var obj = response.report[record];
				var date = obj.dt_start.split(" ")[0].substring(5);
				var nick = obj.nick;
				var time = obj.total_time;
				if(lineData.labels.indexOf(date) == -1) {
					lineData.labels.push(date);
					dataPoints[date] = [];
				}
				if(dataPoints[date].indexOf(nick) == -1) {
					dataPoints[date][nick] = 0;
				}
				dataPoints[date][nick] += parseInt(time);
				if(dataLabels.indexOf(nick) == -1) {
					dataLabels.push(nick);
					sumLabels[nick] = 0;
				}
				
				totalWorkHours += parseFloat(time);
				if(nick=="Jazz") {
					dlOther += parseFloat(time);
					totalWorkHoursDl += parseFloat(time);
				}
				if(nick=="DL Iff") {
					dlIff += parseFloat(time);
					totalWorkHoursDl += parseFloat(time);
					totalCodingWorkHoursDl += parseFloat(time);
				}
				if(nick=="DL Lidar") {
					dlLidar += parseFloat(time);
					totalWorkHoursDl += parseFloat(time);
					totalCodingWorkHoursDl += parseFloat(time);
				}
				if(nick=="DL GS") {
					dlGs += parseFloat(time);
					totalWorkHoursDl += parseFloat(time);
					totalCodingWorkHoursDl += parseFloat(time);
				}
				if(nick=="DL Px4") {
					dlPx4 += parseFloat(time);
					totalWorkHoursDl += parseFloat(time);
					totalCodingWorkHoursDl += parseFloat(time);
				}
					
			}

			totalWorkHours = Math.round(totalWorkHours/60);
			console.log(totalWorkHours);
			totalWorkHoursDl = Math.round(totalWorkHoursDl/60);
			console.log(totalWorkHoursDl);
			totalCodingWorkHoursDl = Math.round(totalCodingWorkHoursDl/60);
			console.log(totalCodingWorkHoursDl);
			var startDate = new Date(start.replace(/-/g, "/"));
			var endDate = new Date(end.replace(/-/g, "/"));
			var totalTime = Date.daysBetween(startDate,endDate);
			console.log(totalTime);
			avgWorkHoursWeek = Math.round((totalWorkHours/totalTime)*7);
			avgWorkHoursWeekDl = Math.round((totalWorkHoursDl/totalTime)*7);
			percentCodingWorkHoursDl = Math.round((totalCodingWorkHoursDl/totalWorkHoursDl)*100);

			$('#avgWeekWorkHour').text(avgWorkHoursWeek+" hours");
			$('#avgWorkHoursWeekDl').text(avgWorkHoursWeekDl+" hours");
			$('#percentCodingWorkHoursDl').text(percentCodingWorkHoursDl+"%");
			$('#percentCodingWorkHoursDlBar').width(percentCodingWorkHoursDl+"%");
			$('#totalWorkHoursDl').text(totalWorkHoursDl+" hours");
			

		    $("#dlHour").sparkline([Math.round(dlOther/60), Math.round(dlIff/60), Math.round(dlLidar/60), Math.round(dlGs/60), Math.round(dlPx4/60)], {
		        type: 'pie',
		        sliceColors: ['#1ab394', '#b3b3b3', '#e4f0fb', '#1ab394', '#b3b3b3']});
		},
		error: function (xhr, ajaxOptions, thrownError) {
			console.log(xhr.responseText);
	//			location.reload();
		}
	});


</script>

</html>
