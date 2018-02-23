<?php require("../common/config.php")?>
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
            <div class="wrapper wrapper-content">
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
                                        <h2 class="font-bold" style="font-size:90px"><?php echo $dao['metrics']->getMetricValuebyName("insect_flights_this_week")?></h2>
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
                                        <h2 class="font-bold" style="font-size:90px"><?php echo $dao['metrics']->getMetricValuebyName("qav_flights_this_week")?></h2>
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
                                    <h2 class="font-bold" style="font-size:90px"><?php echo $dao['metrics']->getMetricValuebyName("flights_last_week")?></h2>
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
                                    <h2 class="font-bold" style="font-size:90px"><?php echo round((time() - strtotime($dao['metrics']->getMetricValuebyName("last_crash")))/(60*60*24))?></h2>
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
                                    <h2 class="font-bold" style="font-size:90px"><?php echo round((time() - strtotime($dao['metrics']->getMetricValuebyName("last_interdiction")))/(60*60*24))?></h2>
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

        		<div class="row m-t-lg">
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
                                        <button type="button" class="btn btn-info m-r-sm"><?php echo $dao['metrics']->getMetricValuebyName("gs_msg_s")?></button>
                                        Detection reliability
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-success m-r-sm"><?php echo $dao['metrics']->getMetricValuebyName("vis_detection_%")?></button>
                                        Long range detection rate
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-success m-r-sm"><?php echo $dao['metrics']->getMetricValuebyName("vis_detection_%")?></button>
                                        Short range detection rate
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger m-r-sm"><?php echo $dao['metrics']->getMetricValuebyName("fly_dispatch_precision_%")?></button>
                                        GPS dispatch stability
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <button type="button" class="btn btn-warning m-r-sm"><?php echo $dao['metrics']->getMetricValuebyName("gs_detect_m")?></button>
                                        C2 link reliability
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-default m-r-sm"><?php echo $dao['metrics']->getMetricValuebyName("vis_tracking_%")?></button>
                                        Long range detection range
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-default m-r-sm"><?php echo $dao['metrics']->getMetricValuebyName("vis_tracking_%")?></button>
                                        Short range detection range
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-warning m-r-sm"><?php echo $dao['metrics']->getMetricValuebyName("fly_interdict_s")?></button>
                                        Interdiction success rate
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <button type="button" class="btn btn-success m-r-sm"><?php echo $dao['metrics']->getMetricValuebyName("gs_avg_pkt_ms")?></button>
                                        Control Reliability
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-info m-r-sm"><?php echo $dao['metrics']->getMetricValuebyName("vis_detection_m")?></button>
                                        Detection accuracy
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-info m-r-sm"><?php echo $dao['metrics']->getMetricValuebyName("vis_detection_m")?></button>
                                        Tracking consistency
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-default m-r-sm"><?php echo $dao['metrics']->getMetricValuebyName("fly_dispatch_spd_ms")?></button>
                                        Hardware
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="col-md-6">
    						<div class="ibox-content text-center">
                                <h3>Picture of the week</h3>
                                <div class="m-b-sm">
									<img alt="image" class="img-rounded" src="img/picture_week.jpg" style="max-height: 120px; max-width: 120px;">
                                </div>
                                <p class="font-bold"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
<!--                             <div class="ibox-content"> -->
                                <div>
                                    <div>
                                        <span>Dispatch speed</span>
                                        <small class="pull-right"><?php echo $dao['metrics']->getMetricValuebyName("fly_spd_ms")?> > <?php echo $dao['metrics']->getMetricIdealbyName("fly_spd_ms")?></small>
                                    </div>
                                    <div class="progress progress-small">
                                        <div style="width: 60%;" class="progress-bar"></div>
                                    </div>
    
                                    <div>
                                        <span>Interdiction closing speed</span>
                                        <small class="pull-right"><?php echo $dao['metrics']->getMetricValuebyName("fly_range_m")?> > <?php echo $dao['metrics']->getMetricIdealbyName("fly_range_m")?></small>
                                    </div>
                                    <div class="progress progress-small">
                                        <div style="width: 50%;" class="progress-bar"></div>
                                    </div>
    
                                    <div>
                                        <span>Max successful interdiction range</span>
                                        <small class="pull-right"><?php echo $dao['metrics']->getMetricValuebyName("interdict_s")?> > <?php echo $dao['metrics']->getMetricIdealbyName("interdict_s")?></small>
                                    </div>
                                    <div class="progress progress-small">
                                        <div style="width: 40%;" class="progress-bar"></div>
                                    </div>
    
                                    <div>
                                        <span>Highest interdiction difficulty rating</span>
                                        <small class="pull-right"><?php echo $dao['metrics']->getMetricValuebyName("punch_m")?> > <?php echo $dao['metrics']->getMetricIdealbyName("punch_m")?></small>
                                    </div>
                                    <div class="progress progress-small">
                                        <div style="width: 20%;" class="progress-bar progress-bar-danger"></div>
                                    </div>
                                </div>
<!--                             </div> -->
                        </div>
					</div>
                </div>
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
					<div class="col-xs-12">
						<h4 class="font-bold">Flights this week</h4>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-2">
						<div class="ibox float-e-margins">
							<div class="ibox-title">
								<span class="label label-primary pull-right">Success</span>
								<h5>Monday</h5>
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
					<div class="col-lg-2">
						<div class="ibox float-e-margins">
							<div class="ibox-title">
								<span class="label label-danger pull-right">Crash</span>
								<h5>Tuesday</h5>
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
					<div class="col-lg-2">
						<div class="ibox float-e-margins">
							<div class="ibox-title">
								<span class="label label-warning pull-right">Partial</span>
								<h5>Wednesday</h5>
							</div>
							<div class="ibox-content">
								<h1 class="no-margins">DIUx</h1>
<!-- 								<div class="stat-percent font-bold text-success"> -->
<!-- 									98% <i class="fa fa-bolt"></i> -->
<!-- 								</div> -->
<!-- 								<small>Flights</small> -->
							</div>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="ibox float-e-margins">
							<div class="ibox-title">
								<span class="label label-danger pull-right">Fail</span>
								<h5>Thursday</h5>
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
					<div class="col-lg-2">
						<div class="ibox float-e-margins">
							<div class="ibox-title">
								<span class="label label-success pull-right">Scheduled</span>
								<h5>Friday</h5>
							</div>
							<div class="ibox-content">
								<h1 class="no-margins">Insect</h1>
<!-- 								<div class="stat-percent font-bold text-success"> -->
<!-- 									98% <i class="fa fa-bolt"></i> -->
<!-- 								</div> -->
<!-- 								<small>Flights</small> -->
							</div>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="ibox float-e-margins">
							<div class="ibox-title">
								<span class="label label-info pull-right">Cancelled</span>
								<h5>Next Monday</h5>
							</div>
							<div class="ibox-content">
								<h1 class="no-margins">GS</h1>
<!-- 								<div class="stat-percent font-bold text-success"> -->
<!-- 									98% <i class="fa fa-bolt"></i> -->
<!-- 								</div> -->
<!-- 								<small>Flights</small> -->
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-lg-7">
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
					<div class="col-lg-5">
						<div class="widget style1 white-bg">
                            <span>Math puzzle of the week</span>
<!--                             <h2 class="font-bold">Does the sum of all the squares of numbers from 1 to 2016 is prime? Explain!</h2> -->
                            <h2 class="font-bold">Can you re-order the integers 1 through 15, inclusive, such that the sum of each pair of adjacent numbers in this list is a perfect square?</h2>
							<h7 class="font-bold"><br>Last match winner: Trevor</h7>
						</div>
					</div>
<!-- 					<div class="col-lg-8"> -->

<!-- 						<div class="row"> -->
<!-- 							<div class="col-lg-6"> -->
<!-- 								<div class="ibox float-e-margins"> -->
<!-- 									<div class="ibox-title"> -->
<!-- 										<h5>User project list</h5> -->
<!-- 										<div class="ibox-tools"> -->
<!-- 											<a class="collapse-link"> <i class="fa fa-chevron-up"></i> -->
<!-- 											</a> <a class="close-link"> <i class="fa fa-times"></i> -->
<!-- 											</a> -->
<!-- 										</div> -->
<!-- 									</div> -->
<!-- 									<div class="ibox-content"> -->
<!-- 										<table class="table table-hover no-margins"> -->
<!-- 											<thead> -->
<!-- 												<tr> -->
<!-- 													<th>Status</th> -->
<!-- 													<th>Date</th> -->
<!-- 													<th>User</th> -->
<!-- 													<th>Value</th> -->
<!-- 												</tr> -->
<!-- 											</thead> -->
<!-- 											<tbody> -->
<!-- 												<tr> -->
<!-- 													<td><small>Pending...</small></td> -->
<!-- 													<td><i class="fa fa-clock-o"></i> 11:20pm</td> -->
<!-- 													<td>Samantha</td> -->
<!-- 													<td class="text-navy"><i class="fa fa-level-up"></i> 24%</td> -->
<!-- 												</tr> -->
<!-- 												<tr> -->
<!-- 													<td><span class="label label-warning">Canceled</span></td> -->
<!-- 													<td><i class="fa fa-clock-o"></i> 10:40am</td> -->
<!-- 													<td>Monica</td> -->
<!-- 													<td class="text-navy"><i class="fa fa-level-up"></i> 66%</td> -->
<!-- 												</tr> -->
<!-- 												<tr> -->
<!-- 													<td><small>Pending...</small></td> -->
<!-- 													<td><i class="fa fa-clock-o"></i> 01:30pm</td> -->
<!-- 													<td>John</td> -->
<!-- 													<td class="text-navy"><i class="fa fa-level-up"></i> 54%</td> -->
<!-- 												</tr> -->
<!-- 												<tr> -->
<!-- 													<td><small>Pending...</small></td> -->
<!-- 													<td><i class="fa fa-clock-o"></i> 02:20pm</td> -->
<!-- 													<td>Agnes</td> -->
<!-- 													<td class="text-navy"><i class="fa fa-level-up"></i> 12%</td> -->
<!-- 												</tr> -->
<!-- 												<tr> -->
<!-- 													<td><small>Pending...</small></td> -->
<!-- 													<td><i class="fa fa-clock-o"></i> 09:40pm</td> -->
<!-- 													<td>Janet</td> -->
<!-- 													<td class="text-navy"><i class="fa fa-level-up"></i> 22%</td> -->
<!-- 												</tr> -->
<!-- 												<tr> -->
<!-- 													<td><span class="label label-primary">Completed</span></td> -->
<!-- 													<td><i class="fa fa-clock-o"></i> 04:10am</td> -->
<!-- 													<td>Amelia</td> -->
<!-- 													<td class="text-navy"><i class="fa fa-level-up"></i> 66%</td> -->
<!-- 												</tr> -->
<!-- 												<tr> -->
<!-- 													<td><small>Pending...</small></td> -->
<!-- 													<td><i class="fa fa-clock-o"></i> 12:08am</td> -->
<!-- 													<td>Damian</td> -->
<!-- 													<td class="text-navy"><i class="fa fa-level-up"></i> 23%</td> -->
<!-- 												</tr> -->
<!-- 											</tbody> -->
<!-- 										</table> -->
<!-- 									</div> -->
<!-- 								</div> -->
<!-- 							</div> -->
<!-- 							<div class="col-lg-6"> -->
<!-- 								<div class="ibox float-e-margins"> -->
<!-- 									<div class="ibox-title"> -->
<!-- 										<h5>Small todo list</h5> -->
<!-- 										<div class="ibox-tools"> -->
<!-- 											<a class="collapse-link"> <i class="fa fa-chevron-up"></i> -->
<!-- 											</a> <a class="close-link"> <i class="fa fa-times"></i> -->
<!-- 											</a> -->
<!-- 										</div> -->
<!-- 									</div> -->
<!-- 									<div class="ibox-content"> -->
<!-- 										<ul class="todo-list m-t small-list"> -->
<!-- 											<li><a href="#" class="check-link"><i -->
<!-- 													class="fa fa-check-square"></i> </a> <span -->
<!-- 												class="m-l-xs todo-completed">Buy a milk</span></li> -->
<!-- 											<li><a href="#" class="check-link"><i class="fa fa-square-o"></i> -->
<!-- 											</a> <span class="m-l-xs">Go to shop and find some products.</span> -->

<!-- 											</li> -->
<!-- 											<li><a href="#" class="check-link"><i class="fa fa-square-o"></i> -->
<!-- 											</a> <span class="m-l-xs">Send documents to Mike</span> <small -->
<!-- 												class="label label-primary"><i class="fa fa-clock-o"></i> 1 -->
<!-- 													mins</small></li> -->
<!-- 											<li><a href="#" class="check-link"><i class="fa fa-square-o"></i> -->
<!-- 											</a> <span class="m-l-xs">Go to the doctor dr Smith</span></li> -->
<!-- 											<li><a href="#" class="check-link"><i -->
<!-- 													class="fa fa-check-square"></i> </a> <span -->
<!-- 												class="m-l-xs todo-completed">Plan vacation</span></li> -->
<!-- 											<li><a href="#" class="check-link"><i class="fa fa-square-o"></i> -->
<!-- 											</a> <span class="m-l-xs">Create new stuff</span></li> -->
<!-- 											<li><a href="#" class="check-link"><i class="fa fa-square-o"></i> -->
<!-- 											</a> <span class="m-l-xs">Call to Anna for dinner</span></li> -->
<!-- 										</ul> -->
<!-- 									</div> -->
<!-- 								</div> -->
<!-- 							</div> -->
<!-- 						</div> -->
<!-- 						<div class="row"> -->
<!-- 							<div class="col-lg-12"> -->
<!-- 								<div class="ibox float-e-margins"> -->
<!-- 									<div class="ibox-title"> -->
<!-- 										<h5>Transactions worldwide</h5> -->
<!-- 										<div class="ibox-tools"> -->
<!-- 											<a class="collapse-link"> <i class="fa fa-chevron-up"></i> -->
<!-- 											</a> <a class="close-link"> <i class="fa fa-times"></i> -->
<!-- 											</a> -->
<!-- 										</div> -->
<!-- 									</div> -->
<!-- 									<div class="ibox-content"> -->

<!-- 										<div class="row"> -->
<!-- 											<div class="col-lg-6"> -->
<!-- 												<table class="table table-hover margin bottom"> -->
<!-- 													<thead> -->
<!-- 														<tr> -->
<!--															<th style="width: 1%" class="text-center">No.</th> -->
<!-- 															<th>Transaction</th> -->
<!-- 															<th class="text-center">Date</th> -->
<!-- 															<th class="text-center">Amount</th> -->
<!-- 														</tr> -->
<!-- 													</thead> -->
<!-- 													<tbody> -->
<!-- 														<tr> -->
<!-- 															<td class="text-center">1</td> -->
<!-- 															<td>Security doors</td> -->
<!-- 															<td class="text-center small">16 Jun 2014</td> -->
<!-- 															<td class="text-center"><span class="label label-primary">$483.00</span></td> -->

<!-- 														</tr> -->
<!-- 														<tr> -->
<!-- 															<td class="text-center">2</td> -->
<!-- 															<td>Wardrobes</td> -->
<!-- 															<td class="text-center small">10 Jun 2014</td> -->
<!-- 															<td class="text-center"><span class="label label-primary">$327.00</span></td> -->

<!-- 														</tr> -->
<!-- 														<tr> -->
<!-- 															<td class="text-center">3</td> -->
<!-- 															<td>Set of tools</td> -->
<!-- 															<td class="text-center small">12 Jun 2014</td> -->
<!-- 															<td class="text-center"><span class="label label-warning">$125.00</span></td> -->

<!-- 														</tr> -->
<!-- 														<tr> -->
<!-- 															<td class="text-center">4</td> -->
<!-- 															<td>Panoramic pictures</td> -->
<!-- 															<td class="text-center small">22 Jun 2013</td> -->
<!-- 															<td class="text-center"><span class="label label-primary">$344.00</span></td> -->
<!-- 														</tr> -->
<!-- 														<tr> -->
<!-- 															<td class="text-center">5</td> -->
<!-- 															<td>Phones</td> -->
<!-- 															<td class="text-center small">24 Jun 2013</td> -->
<!-- 															<td class="text-center"><span class="label label-primary">$235.00</span></td> -->
<!-- 														</tr> -->
<!-- 														<tr> -->
<!-- 															<td class="text-center">6</td> -->
<!-- 															<td>Monitors</td> -->
<!-- 															<td class="text-center small">26 Jun 2013</td> -->
<!-- 															<td class="text-center"><span class="label label-primary">$100.00</span></td> -->
<!-- 														</tr> -->
<!-- 													</tbody> -->
<!-- 												</table> -->
<!-- 											</div> -->
<!-- 											<div class="col-lg-6"> -->
<!-- 												<div id="world-map" style="height: 300px;"></div> -->
<!-- 											</div> -->
<!-- 										</div> -->
<!-- 									</div> -->
<!-- 								</div> -->
<!-- 							</div> -->
<!-- 						</div> -->

<!-- 					</div> -->


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
