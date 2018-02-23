
    <!-- Mainly scripts -->
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!--  Datatables -->
    <script src="js/plugins/jeditable/jquery.jeditable.js"></script>
    <script src="js/plugins/dataTables/datatables.min.js"></script>
<!--     <script src="js/plugins/dataTables/jquery.dataTables.editable.js"></script> -->
    <script src="js/plugins/dataTables/dataTables.editor.js"></script>
    <script src="js/plugins/dataTables/dataTables.buttons.min.js"></script>
    <script src="js/plugins/dataTables/dataTables.select.min.js"></script>
    <!--  Datatables -->
	<link href="css/plugins/dataTables/datatables.min.css" rel="stylesheet">
	<link href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css" rel="stylesheet">
	<link href="https://cdn.datatables.net/select/1.2.1/css/select.dataTables.min.css" rel="stylesheet">
	<link href="https://editor.datatables.net/extensions/Editor/css/editor.dataTables.min.css" rel="stylesheet">
	
    <!-- Flot -->
    <script src="js/plugins/flot/jquery.flot.js"></script>
    <script src="js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="js/plugins/flot/jquery.flot.spline.js"></script>
    <script src="js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="js/plugins/flot/jquery.flot.pie.js"></script>
    <script src="js/plugins/flot/jquery.flot.symbol.js"></script>
    <script src="js/plugins/flot/jquery.flot.time.js"></script>

    <!-- Peity -->
    <script src="js/plugins/peity/jquery.peity.min.js"></script>
    <script src="js/demo/peity-demo.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

    <!-- jQuery UI -->
    <script src="js/plugins/jquery-ui/jquery-ui.min.js"></script>

    <!-- Jvectormap -->
    <script src="js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

    <!-- EayPIE -->
    <script src="js/plugins/easypiechart/jquery.easypiechart.js"></script>

    <!-- Sparkline -->
    <script src="js/plugins/sparkline/jquery.sparkline.min.js"></script>

    <!-- Sparkline demo data  -->
    <script src="js/demo/sparkline-demo.js"></script>

    <script>
        $(document).ready(function() {
            $('.chart').easyPieChart({
                barColor: '#f8ac59',
//                scaleColor: false,
                scaleLength: 5,
                lineWidth: 4,
                size: 80
            });

            $('.chart2').easyPieChart({
                barColor: '#1c84c6',
//                scaleColor: false,
                scaleLength: 5,
                lineWidth: 4,
                size: 80
            });

            <?php
            
            $fixedArr = "[";
            $pendingArr = "[";
            $newArr = "[";
            
            for($i = 30; $i >= 0; $i--) {
                $date = date('Y-m-d', strtotime("today - $i days"));
                $fixed = $dao['bugs']->getBugsResolvedbyDay($date);
                $pending = $dao['bugs']->getOpenBugsCnt($date);
                $new = $dao['bugs']->getBugsCreatedCntbyDay($date);
                $gdDate = "gd(".str_replace("-", ",", $date).")";
                
                $fixedArr .= "[$gdDate, -$fixed]";
                $pendingArr .= "[$gdDate, $pending]";
                $newArr .= "[$gdDate, $new]";
                if($i > 0) {
                    $fixedArr .= ",";
                    $pendingArr .= ",";
                    $newArr .= ",";
                }
            }

            $fixedArr .= "];";
            $pendingArr .= "];";
            $newArr .= "];";
            
            ?>
            var data1 = <?php echo $fixedArr;?>
            var data2 = <?php echo $pendingArr;?>
            var data3 = <?php echo $newArr;?>

//             var data1 = [
//                 [gd(2012, 1, 1), -7], [gd(2012, 1, 2), -6], [gd(2012, 1, 3), 4], [gd(2012, 1, 4), 8],
//                 [gd(2012, 1, 5), -9], [gd(2012, 1, 6), -7], [gd(2012, 1, 7), 5], [gd(2012, 1, 8), 4],
//                 [gd(2012, 1, 9), -7], [gd(2012, 1, 10), -8], [gd(2012, 1, 11), 9], [gd(2012, 1, 12), 6],
//                 [gd(2012, 1, 13), -4], [gd(2012, 1, 14), -5], [gd(2012, 1, 15), 11], [gd(2012, 1, 16), 8],
//                 [gd(2012, 1, 17), -8], [gd(2012, 1, 18), -11], [gd(2012, 1, 19), 11], [gd(2012, 1, 20), 6],
//                 [gd(2012, 1, 21), -6], [gd(2012, 1, 22), -8], [gd(2012, 1, 23), 11], [gd(2012, 1, 24), 13],
//                 [gd(2012, 1, 25), -7], [gd(2012, 1, 26), -9], [gd(2012, 1, 27), 9], [gd(2012, 1, 28), 8],
//                 [gd(2012, 1, 29), -5], [gd(2012, 1, 30), -8], [gd(2012, 1, 31), 25]
//             ];
            
//             var data2 = [
//                 [gd(2012, 1, 1), 7], [gd(2012, 1, 2), 6], [gd(2012, 1, 3), 4], [gd(2012, 1, 4), 8],
//                 [gd(2012, 1, 5), 9], [gd(2012, 1, 6), 7], [gd(2012, 1, 7), 5], [gd(2012, 1, 8), 4],
//                 [gd(2012, 1, 9), 7], [gd(2012, 1, 10), 8], [gd(2012, 1, 11), 9], [gd(2012, 1, 12), 6],
//                 [gd(2012, 1, 13), 4], [gd(2012, 1, 14), 5], [gd(2012, 1, 15), 11], [gd(2012, 1, 16), 8],
//                 [gd(2012, 1, 17), 8], [gd(2012, 1, 18), 11], [gd(2012, 1, 19), 11], [gd(2012, 1, 20), 6],
//                 [gd(2012, 1, 21), 6], [gd(2012, 1, 22), 8], [gd(2012, 1, 23), 11], [gd(2012, 1, 24), 13],
//                 [gd(2012, 1, 25), 7], [gd(2012, 1, 26), 9], [gd(2012, 1, 27), 9], [gd(2012, 1, 28), 8],
//                 [gd(2012, 1, 29), 5], [gd(2012, 1, 30), 8], [gd(2012, 1, 31), 25]
//             ];

//             var data3 = [
//                 [gd(2012, 1, 1), 8], [gd(2012, 1, 2), 5], [gd(2012, 1, 3), 6], [gd(2012, 1, 4), 7],
//                 [gd(2012, 1, 5), 5], [gd(2012, 1, 6), 4], [gd(2012, 1, 7), 8], [gd(2012, 1, 8), 5],
//                 [gd(2012, 1, 9), 4], [gd(2012, 1, 10), 8], [gd(2012, 1, 11), 6], [gd(2012, 1, 12), 7],
//                 [gd(2012, 1, 13), 5], [gd(2012, 1, 14), 6], [gd(2012, 1, 15), 7], [gd(2012, 1, 16), 7],
//                 [gd(2012, 1, 17), 3], [gd(2012, 1, 18), 8], [gd(2012, 1, 19), 8], [gd(2012, 1, 20), 8],
//                 [gd(2012, 1, 21), 9], [gd(2012, 1, 22), 4], [gd(2012, 1, 23), 9], [gd(2012, 1, 24), 5],
//                 [gd(2012, 1, 25), 7], [gd(2012, 1, 26), 6], [gd(2012, 1, 27), 8], [gd(2012, 1, 28), 9],
//                 [gd(2012, 1, 29), 1], [gd(2012, 1, 30), 5], [gd(2012, 1, 31), 9]
//             ];


            var dataset = [
                {
                    label: "Fixed bugs",
                    data: data1,
                    color: "#b31a94",
                    bars: {
                        show: true,
                        align: "left",
                        barWidth: 12 * 60 * 60 * 600,
                        lineWidth:0
                    }

                },
                {
                    label: "New bugs",
                    data: data3,
                    color: "#1ab394",
                    bars: {
                        show: true,
                        align: "right",
                        barWidth: 12 * 60 * 60 * 600,
                        lineWidth:0
                    }

                }, {
                    label: "Existing bugs",
                    data: data2,
                    yaxis: 2,
                    color: "#1C84C6",
                    lines: {
                        lineWidth:1,
                            show: true,
                            fill: true,
                        fillColor: {
                            colors: [{
                                opacity: 0
                            }, {
                                opacity: 0.2
                            }]
                        }
                    },
                    splines: {
                        show: false,
                        tension: 0.6,
                        lineWidth: 1,
                        fill: 0.1
                    },
                }
            ];


            var options = {
                xaxis: {
                    mode: "time",
                    tickSize: [3, "day"],
                    tickLength: 0,
                    axisLabel: "Date",
                    axisLabelUseCanvas: true,
                    axisLabelFontSizePixels: 12,
                    axisLabelFontFamily: 'Arial',
                    axisLabelPadding: 10,
                    color: "#d5d5d5"
                },
                yaxes: [{
                    position: "left",
                    color: "#d5d5d5",
                    max: 40,
                    min: -30,
                    axisLabelUseCanvas: true,
                    axisLabelFontSizePixels: 12,
                    axisLabelFontFamily: 'Arial',
                    axisLabelPadding: 3
                }, {
                    position: "left",
                    clolor: "#d5d5d5",
                    max: 100,
                    min: -75,
                    axisLabelUseCanvas: true,
                    axisLabelFontSizePixels: 12,
                    axisLabelFontFamily: ' Arial',
                    axisLabelPadding: 67
                }
                ],
                legend: {
                    noColumns: 1,
                    labelBoxBorderColor: "#000000",
                    position: "nw"
                },
                grid: {
                    hoverable: false,
                    borderWidth: 0
                }
            };

            function gd(year, month, day) {
                return new Date(year, month - 1, day).getTime();
            }

            var previousPoint = null, previousLabel = null;

            $.plot($("#flot-dashboard-chart"), dataset, options);

            var mapData = {
                "US": 298,
                "SA": 200,
                "DE": 220,
                "FR": 540,
                "CN": 120,
                "AU": 760,
                "BR": 550,
                "IN": 200,
                "GB": 120,
            };

            $('#world-map').vectorMap({
                map: 'world_mill_en',
                backgroundColor: "transparent",
                regionStyle: {
                    initial: {
                        fill: '#e4e4e4',
                        "fill-opacity": 0.9,
                        stroke: 'none',
                        "stroke-width": 0,
                        "stroke-opacity": 0
                    }
                },

                series: {
                    regions: [{
                        values: mapData,
                        scale: ["#1ab394", "#22d6b1"],
                        normalizeFunction: 'polynomial'
                    }]
                },
            });
        });
    </script>