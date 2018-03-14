<?php require("../common/config.php")?>
<?php 
date_default_timezone_set('America/Los_Angeles');

$weatherData = file_get_contents("http://api.openweathermap.org/data/2.5/forecast?q=San%20Leandro,us&appid=ab04cc56804c8c913022bdff4984e69c");
$weatherJson = json_decode($weatherData);
$weatherList = $weatherJson->list;

$d = array();
$d[0] = array();
$d[1] = array();
$d[2] = array();

$dayToday = date("d");
$dayTomorrow = date("d", strtotime("+1 day"));
$dayAfter = date("d", strtotime("+2 day"));
$now = time();

foreach($weatherList as $weather) {
    $dt = $weather->dt;
    $day = date("d", $dt);
    $daydiff = (int)(abs(($now - $dt)/(60*60*24)));
    $hour = date("G", $dt);
    if($hour > 9 && $hour <= 18) {
        if($day == $dayToday) {
            $d[0][$hour] = $weather->weather[0]->description;
        } else if($day == $dayTomorrow) {
            $d[1][$hour] = $weather->weather[0]->description;
        } else if($day == $dayAfter) {
            $d[2][$hour] = $weather->weather[0]->description;
        }
    }
}
// print_r($d);
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="refresh" content="60">
<?php include("part_head.php");?>
</head>
<body>
	<div id="wrapper">
		<!--         <nav class="navbar-default navbar-static-side" role="navigation"> -->
		<!--             <div class="sidebar-collapse"> -->
<?php //include("part_sidebar.php");?>
<!--             </div> -->
		<!--         </nav> -->

		<div id="page-wrapper" class="gray-bg" style="margin-left: 0px;">
<?php //include("part_topbar.php")?>          
<!--             <div class="wrapper wrapper-content"> -->
<?php include("part_msghandling.php")?>
<?php include("part_scripts.php")?>
<!-- 				<div class="row"> -->
<!-- 					<div class="col-md-12"> -->
<!-- 						<div class="widget style1 white-bg"> -->
<!--                             <span>Math puzzle of the month</span> -->
<!--                             <h2 class="font-bold">Does the sum of all the squares of numbers from 1 to 2016 is prime? Explain!</h2> -->
<!-- 						</div> -->
<!-- 					</div> -->
<!-- 				</div> -->
				
				<div class="row">
                    <div class="col-lg-2">
                        <div class="widget style1 <?php echo $dao['metrics']->getMetricColorbyName("insect_flights_this_week")?>">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <span>&nbsp</span>
                                        <i class="fa fa-fighter-jet fa-8x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <span>Insect flights this week</span>
                                        <h2 class="font-bold" style="font-size:90px"><?php echo $dao['metrics']->getMetricValuebyName("insect_flights_this_week", 0)?></h2>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="widget style1 <?php echo $dao['metrics']->getMetricColorbyName("qav_flights_this_week")?>">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <span>&nbsp</span>
                                        <i class="fa fa-plane fa-8x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <span>QAV flights this week</span>
                                        <h2 class="font-bold" style="font-size:90px"><?php echo $dao['metrics']->getMetricValuebyName("qav_flights_this_week", 0)?></h2>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="widget style1 <?php echo $dao['metrics']->getMetricColorbyName("flights_last_week")?>">
                            <div class="row">
                                <div class="col-xs-3">
                                    <span>&nbsp</span>
                                    <i class="fa fa-cloud fa-8x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <span>Total flights last week</span>
                                    <h2 class="font-bold" style="font-size:90px"><?php echo $dao['metrics']->getMetricValuebyName("flights_last_week", 0)?></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="widget style1 <?php echo $dao['metrics']->getMetricColorbyName("last_crash")?>">
                            <div class="row">
                                <div class="col-xs-3">
                                    <span>&nbsp</span>
                                    <i class="fa fa-warning fa-8x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <span>Days without crash</span>
                                    <h2 class="font-bold" style="font-size:90px"><?php echo round((time() - strtotime($dao['metrics']->getMetricValuebyName("last_crash", "2018-02-20")))/(60*60*24))?></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                         <div class="widget style1 <?php echo $dao['metrics']->getMetricColorbyName("open_bugs")?>">
                            <div class="row">
                                <div class="col-xs-3">
                                    <span>&nbsp</span>
                                    <i class="fa fa-bug fa-8x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <span>Open Bugs</span>
                                    <h2 class="font-bold" style="font-size:90px"><?php echo $dao['bugs']->getOpenBugsCnt()?></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="widget style1 <?php echo $dao['metrics']->getMetricColorbyName("last_interdiction")?>">
                            <div class="row">
                                <div class="col-xs-3">
                                    <span>&nbsp</span>
                                    <i class="fa fa-thumbs-up fa-8x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <span>Days since last interdiction</span>
                                    <h2 class="font-bold" style="font-size:90px"><?php echo round((time() - strtotime($dao['metrics']->getMetricValuebyName("last_interdiction", "2018-02-20")))/(60*60*24))?></h2>
                                </div>
                            </div>
                        </div>
                    </div>                    
                    
<!--                     <div class="col-lg-2">
                        <div class="widget style1 <?php echo $dao['metrics']->getMetricColorbyName("system_score")?>">
                            <div class="row">
                                <div class="col-xs-3">
                                    <span>&nbsp</span>
                                    <i class="fa fa-thumbs-up fa-8x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <span>Overall Score</span>
                                    <h2 class="font-bold" style="font-size:90px"><?php echo $dao['metrics']->getMetricValuebyName("system_score")?></h2>
                                </div>
                            </div>
                        </div>
                    </div>-->                    
                </div>

        		<div class="row">
                    <div class="col-lg-6">
                        <div>
                            <table class="table">
                                <tbody>
                                <tr>
                                    <td>
                                        <h3>Groundspace/Detection</h3>
                                    </td>
                                    <td>
                                        <h3>Vision</h3>
                                    </td>
                                    <td>
                                        <h3>Vision</h3>
                                    </td>
                                    <td>
                                       	<h3>Flight</h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <button type="button" class="btn btn-info m-r-sm"><?php echo $dao['metrics']->getMetricValuebyName("detect_reliability_pc", 0)?></button>
                                        Detection reliability
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-success m-r-sm"><?php echo $dao['metrics']->getMetricValuebyName("vis_lr_detection_pc", 0)?></button>
                                        Long range detection rate
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-success m-r-sm"><?php echo $dao['metrics']->getMetricValuebyName("vis_sr_detection_pc", 0)?></button>
                                        Short range detection rate
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger m-r-sm"><?php echo $dao['metrics']->getMetricValuebyName("fly_dispatch_precision_pc", 0)?></button>
                                        GPS dispatch stability
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <button type="button" class="btn btn-warning m-r-sm"><?php echo $dao['metrics']->getMetricValuebyName("gs_c2_reliability_pc", 0)?></button>
                                        C2 link reliability
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-default m-r-sm"><?php echo $dao['metrics']->getMetricValuebyName("vis_lr_detection_m", 0)?></button>
                                        Long range detection range
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-default m-r-sm"><?php echo $dao['metrics']->getMetricValuebyName("vis_sr_detection_m", 0)?></button>
                                        Short range detection range
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-warning m-r-sm"><?php echo $dao['metrics']->getMetricValuebyName("fly_interdict_pc", 0)?></button>
                                        Interdiction success rate
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <button type="button" class="btn btn-success m-r-sm"><?php echo $dao['metrics']->getMetricValuebyName("gs_control_reliability_pc", 0)?></button>
                                        Control Reliability
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-info m-r-sm"><?php echo $dao['metrics']->getMetricValuebyName("vis_detection_pc", 0)?></button>
                                        Detection accuracy
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-info m-r-sm"><?php echo $dao['metrics']->getMetricValuebyName("vis_tracking_pc", 0)?></button>
                                        Tracking consistency
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-default m-r-sm"><?php echo $dao['metrics']->getMetricValuebyName("fly_hardware_idx", 0)?></button>
                                        Hardware
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-3">
						<div class="ibox float-e-margins">
							<div class="ibox-title">
								<h5>Messages</h5>
								<div class="ibox-tools">
									<a class="collapse-link"> <i class="fa fa-chevron-up"></i>
									</a> <a class="close-link"> <i class="fa fa-times"></i>
									</a>
								</div>
							</div>
<!-- 							<div class="ibox-content ibox-heading"> -->
<!-- 								<h3> -->
<!-- 									<i class="fa fa-envelope-o"></i> New messages -->
<!-- 								</h3> -->
<!-- 								<small><i class="fa fa-tim"></i> You have 22 new messages and 16 -->
<!-- 									waiting in draft folder.</small> -->
<!-- 							</div> -->
							<div class="ibox-content">
								<div class="feed-activity-list">

									<div class="feed-element">
										<div>
											<small class="pull-right text-navy">1m ago</small> <strong>Monica
												Smith</strong>
											<div>Demo investory XYZ</div>
											<small class="text-muted">Today 3:00 pm - 12.06.2018</small>
										</div>
									</div>

									<div class="feed-element">
										<div>
											<small class="pull-right">2m ago</small> <strong>Jogn Angel</strong>
											<div>Barbeque day on the field</div>
											<small class="text-muted">in 3 weeks 2:23 pm - 14.04.2018</small>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

                        <div class="col-md-3">
<!--                             <div class="ibox-content"> -->
                                <div>
                                    <div>
                                        <span>Dispatch speed</span>
                                        <small class="pull-right"><?php echo $dao['metrics']->getMetricValuebyName("fly_dispatch_ms", 10)?> > <?php echo $dao['metrics']->getMetricIdealbyName("fly_dispatch_ms")?></small>
                                    </div>
                                    <div class="progress progress-small">
                                        <div style="width: 60%;" class="progress-bar"></div>
                                    </div>
    
                                    <div>
                                        <span>Interdiction closing speed</span>
                                        <small class="pull-right"><?php echo $dao['metrics']->getMetricValuebyName("fly_closing_speed_ms", 5)?> > <?php echo $dao['metrics']->getMetricIdealbyName("fly_closing_speed_ms")?></small>
                                    </div>
                                    <div class="progress progress-small">
                                        <div style="width: 50%;" class="progress-bar"></div>
                                    </div>
    
                                    <div>
                                        <span>Max successful interdiction range</span>
                                        <small class="pull-right"><?php echo $dao['metrics']->getMetricValuebyName("interdiction_range_m", 20)?> > <?php echo $dao['metrics']->getMetricIdealbyName("interdiction_range_m")?></small>
                                    </div>
                                    <div class="progress progress-small">
                                        <div style="width: 40%;" class="progress-bar"></div>
                                    </div>
    
                                    <div>
                                        <span>Highest interdiction difficulty rating</span>
                                        <small class="pull-right"><?php echo $dao['metrics']->getMetricValuebyName("punch_idx", 3)?> > <?php echo $dao['metrics']->getMetricIdealbyName("punch_idx")?></small>
                                    </div>
                                    <div class="progress progress-small">
                                        <div style="width: 20%;" class="progress-bar progress-bar-danger"></div>
                                    </div>
                                </div>
<!--                             </div> -->
                        </div>
					</div>
<!--                 </div> -->
<!--         				
        		<div class="row">
					<div class="col-lg-3">
						<div class="ibox float-e-margins">
							<div class="ibox-title">
								<span class="label label-success pull-right"></span>
								<h5>Flights this week</h5>
							</div>
							<div class="ibox-content">
								<h1 class="no-margins"><?php echo $dao['metrics']->getMetricValuebyName("flights_this_week")?></h1>
								<div class="stat-percent font-bold text-success">
									98% <i class="fa fa-bolt"></i>
								</div>
								<small>Flights</small>
							</div>
						</div>
					</div>
					<div class="col-lg-3">
						<div class="ibox float-e-margins">
							<div class="ibox-title">
								<span class="label label-info pull-right"></span>
								<h5>Flights last week</h5>
							</div>
							<div class="ibox-content">
								<h1 class="no-margins"><?php echo $dao['metrics']->getMetricValuebyName("flights_last_week")?></h1>
								<div class="stat-percent font-bold text-info">
									20% <i class="fa fa-level-up"></i>
								</div>
								<small>Flights</small>
							</div>
						</div>
					</div>
					<div class="col-lg-3">
						<div class="ibox float-e-margins">
							<div class="ibox-title">
								<span class="label label-primary pull-right"></span>
								<h5>Days without crash</h5>
							</div>
							<div class="ibox-content">
								<h1 class="no-margins"><?php echo round((time() - strtotime($dao['metrics']->getMetricValuebyName("last_crash")))/(60*60*24))?></h1>
								<div class="stat-percent font-bold text-navy">
									44% <i class="fa fa-level-up"></i>
								</div>
								<small>Days</small>
							</div>
						</div>
					</div>
					<div class="col-lg-3">
						<div class="ibox float-e-margins">
							<div class="ibox-title">
								<span class="label label-danger pull-right"></span>
								<h5>Overall system score</h5>
							</div>
							<div class="ibox-content">
								<h1 class="no-margins"><?php echo $dao['metrics']->getMetricValuebyName("system_score")?></h1>
								<div class="stat-percent font-bold text-danger">
									38% <i class="fa fa-level-down"></i>
								</div>
								<small>Points</small>
							</div>
						</div>
					</div>
				</div>
-->				
				<div class="row">
					<div class="col-lg-12">
						<div class="ibox float-e-margins">
							<div class="ibox-title">
								<h5>Bug History</h5>
							</div>
							<div class="ibox-content">
								<div class="row">
									<div class="col-lg-9">
										<div class="flot-chart">
											<div class="flot-chart-content" id="flot-dashboard-chart"></div>
										</div>
									</div>
									<div class="col-lg-3">
										<ul class="stat-list">
											<li>
												<h2 class="no-margins"><?php echo $dao['bugs']->getOpenBugsCnt()?></h2> <small>Total Bugs</small>
												<div class="stat-percent">
													<?php echo round((($dao['bugs']->getOpenBugsCnt()/$dao['bugs']->getOpenBugsCnt(date('Y-m-d', strtotime("today - 7 days")))-1))*100);?>%<i class="fa fa-level-up text-navy"></i>
												</div>
												<div class="progress progress-mini">
													<div style="width: 48%;" class="progress-bar"></div>
												</div>
											</li>
											<li>
												<h2 class="no-margins "><?php echo $dao['bugs']->getBugsCreatedCntInterval(date('Y-m-d', strtotime("today - 7 days")), date('Y-m-d'))?></h2> <small>New bugs last week</small>
												<div class="stat-percent">
													<?php echo round(((($dao['bugs']->getBugsCreatedCntInterval(date('Y-m-d', strtotime("today - 7 days")), date('Y-m-d'))+1)/($dao['bugs']->getBugsCreatedCntInterval(date('Y-m-d', strtotime("today - 7 days")), date('Y-m-d', strtotime("today - 14 days")))+1)-1))*100);?>%<i class="fa fa-level-down text-navy"></i>
												</div>
												<div class="progress progress-mini">
													<div style="width: 60%;" class="progress-bar"></div>
												</div>
											</li>
											<li>
												<h2 class="no-margins "><?php echo $dao['bugs']->getBugsResolvedCntInterval(date('Y-m-d', strtotime("today - 7 days")), date('Y-m-d'))?></h2> <small>Bugs fixed last week</small>
												<div class="stat-percent">
													<?php echo round(((($dao['bugs']->getBugsResolvedCntInterval(date('Y-m-d', strtotime("today - 7 days")), date('Y-m-d'))+1)/($dao['bugs']->getBugsResolvedCntInterval(date('Y-m-d', strtotime("today - 7 days")), date('Y-m-d', strtotime("today - 14 days")))+1)-1))*100);?>%<i class="fa fa-level-down text-navy"></i><i class="fa fa-bolt text-navy"></i>
												</div>
												<div class="progress progress-mini">
													<div style="width: 22%;" class="progress-bar"></div>
												</div>
											</li>
										</ul>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>


				<div class="row">
					<div class="col-lg-6">
						<div class="ibox-content text-center">
                            <h3>Picture of the week</h3>
                            <div class="m-b-sm">
								<img alt="image" class="img-rounded" src="img/picture_week.jpg" style="max-height: 480px; max-width: 480px;">
                            </div>
                            <p class="font-bold"></p>
                        </div>
                    </div>
					
					<div class="col-lg-6">
						<div class="row">
							<div class="col-xs-12">
								<h4 class="font-bold">Flights this week</h4>
							</div>
							<div class="row">
    							<div class="col-lg-4">
            						<div class="ibox float-e-margins">
            							<div class="ibox-title">
            								<span class="label label-primary pull-right">Success</span>
            								<h5>3d ago</h5>
            							</div>
            							<div class="ibox-content">
            								<h1 class="no-margins">Vision</h1>
            <!-- 								<div class="stat-percent font-bold text-success"> -->
            <!-- 									98% <i class="fa fa-bolt"></i> -->
            <!-- 								</div> -->
            <!-- 								<small>Flights</small> -->
            							</div>
            						</div>
            					</div>
            					<div class="col-lg-4">
            						<div class="ibox float-e-margins">
            							<div class="ibox-title">
            								<span class="label label-danger pull-right">Crash</span>
            								<h5>2d ago</h5>
            							</div>
            							<div class="ibox-content">
            								<h1 class="no-margins">Dispatch</h1>
            <!-- 								<div class="stat-percent font-bold text-success"> -->
            <!-- 									98% <i class="fa fa-bolt"></i> -->
            <!-- 								</div> -->
            <!-- 								<small>Flights</small> -->
            							</div>
            						</div>
            					</div>
            					<div class="col-lg-4">
            						<div class="ibox float-e-margins">
            							<div class="ibox-title">
            								<span class="label label-warning pull-right">Partial</span>
            								<h5>Yesterday</h5>
            							</div>
            							<div class="ibox-content">
            								<h1 class="no-margins">Dispatch</h1>
            <!-- 								<div class="stat-percent font-bold text-success"> -->
            <!-- 									98% <i class="fa fa-bolt"></i> -->
            <!-- 								</div> -->
            <!-- 								<small>Flights</small> -->
            							</div>
            						</div>
            					</div>
            				</div>
            				<div class="row">
            					<div class="col-lg-4">
            						<div class="ibox float-e-margins">
            							<div class="ibox-title">
            								<span class="label label-danger pull-right">Fail</span>
            								<h5>Today</h5>
            							</div>
            							<div class="ibox-content">
            								<div class="row">
                								<div class="col-xs-6">
                									<h1 class="no-margins">DIUx</h1>
                								</div>
                								<div class="col-xs-6">
<?php foreach ($d[0] as $hr=>$slot) { ?>
                									<h3><?php echo ($hr-3)."-".$hr." $slot"?></h3>
<?php } ?>
    											</div>           
											</div> 								
            							</div>
            						</div>
            					</div>
            					<div class="col-lg-4">
            						<div class="ibox float-e-margins">
            							<div class="ibox-title">
            								<span class="label label-success pull-right">Scheduled</span>
            								<h5>Tomorrow</h5>
            							</div>
            							<div class="ibox-content">
            								<div class="row">
                								<div class="col-xs-6">
                									<h1 class="no-margins">DIUx</h1>
                								</div>
                								<div class="col-xs-6">
<?php foreach ($d[1] as $hr=>$slot) { ?>
                									<h3><?php echo ($hr-3)."-".$hr." $slot"?></h3>
<?php } ?>
    											</div>           
											</div> 								
            							</div>
            						</div>
            					</div>
            					<div class="col-lg-4">
            						<div class="ibox float-e-margins">
            							<div class="ibox-title">
            								<span class="label label-info pull-right">Cancelled</span>
            								<h5>Day after</h5>
            							</div>
            							<div class="ibox-content">
            								<div class="row">
                								<div class="col-xs-6">
                									<h1 class="no-margins">DIUx</h1>
                								</div>
                								<div class="col-xs-6">
<?php foreach ($d[2] as $hr=>$slot) { ?>
               									<h3><?php echo ($hr-3)."-".$hr." $slot"?></h3>
<?php } ?>
    											</div>           
											</div> 								
            							</div>
            						</div>
            					</div>
            				</div>
							<div class="row">
            					<div class="col-lg-12">
            						<div class="widget style1 white-bg">
                                        <span>Math puzzle of the week</span>
            <?php 
            	$math = $dao['metrics']->getMetricbyName("math_puzzle");
            	$math_lines = explode("\n",$math['description']);
            	foreach ($math_lines as $line) {
            ?>
                                        <h2 class="font-bold"><?php echo $line?></h2>
            
            <?php 		
            	}
            	$math_last = $dao['metrics']->getMetricbyName("math_puzzle_last");
            ?>
            							<h7 class="font-bold"><br>Last match winner: <?php echo $math_last['value']?></h7>
            <?php 
            	$math_lines = explode("\n",$math_last['description']);
            	foreach ($math_lines as $line) {
            ?>
            							<h7 class="font-bold"><br><?php echo $line?></h7>
            <?php
            	}
            ?>                            
            <!--                             <h2 class="font-bold">Does the sum of all the squares of numbers from 1 to 2016 is prime? Explain!</h2> -->
            <!--                             <h2 class="font-bold">Can you re-order the integers 1 through 15, inclusive, such that the sum of each pair of adjacent numbers in this list is a perfect square?</h2> -->
            <!--  								<h7 class="font-bold"><br>Last match winner: Trevor</h7> -->
            						</div>
            					</div>
							
							</div>
						</div>
					</div>
			</div>

			<div class="footer">
<?php include("part_footer.php")?>
            </div>

		</div>

		<div id="right-sidebar">
<?php //include("part_rightbar.php")?>            
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
        toastr.success('Dashboard', 'Welcome to Dashboard!');

    }, 1300);
});
</script>
<?php } ?>
</html>
