<?php
/**
 * Created by PhpStorm.
 * User: SeoJiyun
 * Date: 2018-07-12
 * Time: 오후 2:13
 */
?>

<div class="content-wrap">
    <main id="content" class="content" role="main">
        <h1 class="page-title"><small>어제 (<?php echo $oamt->date;?>) 매출 총 금액</small> (<?php echo number_format($oamt->saleamt);?>원)</h1>

        <?php $chart_data = json_decode($chart1);

        foreach ($chart_data as $depth1):
            foreach ($depth1 as $key => $value):
                //echo "{$key} => {$value}<br/>";
            endforeach;
            //echo "<br/>";
        endforeach;

        $chartcode = json_decode($chart2);
        foreach ($chartcode as $depth2):
            foreach ($depth2 as $key => $value):
            endforeach;
        endforeach;

        $barchart = json_decode($chart3);
        foreach ($barchart as $depth3):
            foreach ($depth3 as $key => $value):
            endforeach;
        endforeach;

        $piechart = json_decode($chart4);
        foreach ($piechart as $depth4):
            foreach ($depth4 as $key => $value):
            endforeach;
        endforeach;

        $pieCchart = json_decode($chart5);
        foreach ($pieCchart as $depth5):
            foreach ($depth5 as $key => $value):
            endforeach;
        endforeach;
        ?>

        <div class="row">
            <div class="col-md-12">
                <div class="row progress-stats">
                    <div class="col-sm-11">
                        <h4 class="name">목표 매출 <span class="fw-semi-bold"><?=number_format($tryAmt)?></span></h4>
                        <p class="description deemphasize"><?=$chart->lastyear?>년 <?=number_format($chart->lastyear_amt)?>원</p>
                        <?php
                        $lastrate = number_format(($chart->lastyear_amt / $tryAmt)*100,0);
                        $thisrate = number_format(($chart->thisyear_amt / $tryAmt)*100,0);
                        ?>
                        <div class="progress progress-sm js-progress-animate bg-white">
                            <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" data-width="<?=$lastrate?>%" aria-valuemax="100" style="width: <?=$lastrate?>%;">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1 text-align-center">
                        <span class="status rounded rounded-lg bg-body-light">
                            <small><span id="percent-1"><?=$lastrate?></span>%</small>
                        </span>
                    </div>
                </div>
                <div class="row progress-stats">
                    <div class="col-md-11">
                        <p class="description deemphasize"><?=$chart->thisyear?>년 <?=number_format($chart->thisyear_amt)?>원</p>
                        <div class="progress progress-sm js-progress-animate bg-white">
                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="<?=$thisrate?>" data-width="<?=$thisrate?>%" aria-valuemin="0" aria-valuemax="100" style="width: <?=$thisrate?>%;">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1 text-align-center">
                        <span class="status rounded rounded-lg bg-body-light">
                            <small><span id="percent-2"><?=$thisrate?></span>%</small>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="alert alert-danger alert-sm">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            판매채널 사용연동 실패 확인 <span class="fw-semi-bold"> (환불 대기: <?php echo $totalrefund?>건)</span>
<!--            <a class="btn btn-default btn-xs pull-right mr" href="#">Ignore</a>-->
            <a class="btn btn-danger btn-xs pull-right mr-xs shortcut_btn" href="#">바로가기</a>
        </div>
        <br>

        <div class="row">
            <div class="col-md-12">
                <section class="widget">
                    <header>
                        <div class="widget-controls">
                            <a data-widgster="expand" title="Expand" href="#"><i class="glyphicon glyphicon-chevron-up"></i></a>
                            <a data-widgster="collapse" title="Collapse" href="#"><i class="glyphicon glyphicon-chevron-down"></i></a>
                            <a data-widgster="close" title="Close" href="#"><i class="glyphicon glyphicon-remove"></i></a>
                        </div>
                    </header>
                    <div class="widget-body">
                        <div>
                            <h4>판매금액 비교</h4>

                            <div id="chartdiv" style="width:100%; height:500px;">

                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <br>

        <div class="row">
            <div class="col-md-12">
                <section class="widget">
                    <header>
                        <div class="widget-controls">
                            <a data-widgster="expand" title="Expand" href="#"><i class="glyphicon glyphicon-chevron-up"></i></a>
                            <a data-widgster="collapse" title="Collapse" href="#"><i class="glyphicon glyphicon-chevron-down"></i></a>
                            <a data-widgster="close" title="Close" href="#"><i class="glyphicon glyphicon-remove"></i></a>
                        </div>
                    </header>
                    <div class="widget-body">
                        <div>
                            <h4>2018년 판매금액, 사용금액</h4>
                            <div id="chartdiv2" style="width: 100%; height: 500px;"></div>
                        </div>
                    </div>
                </section>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <section class="widget">
                    <header>
                        <div class="widget-controls">
                            <a data-widgster="expand" title="Expand" href="#"><i class="glyphicon glyphicon-chevron-up"></i></a>
                            <a data-widgster="collapse" title="Collapse" href="#"><i class="glyphicon glyphicon-chevron-down"></i></a>
                            <a data-widgster="close" title="Close" href="#"><i class="glyphicon glyphicon-remove"></i></a>
                        </div>
                    </header>
                    <div class="widget-body">
                        <div>
                            <h4>시설별 매출 현황</h4>
                            <div id="chartdiv4" style="width: 100%; height: 500px; font-size: 11px;"></div>
                        </div>
                    </div>
                </section>
            </div>

            <div class="col-md-6">
                <section class="widget">
                    <header>
                        <div class="widget-controls">
                            <a data-widgster="expand" title="Expand" href="#"><i class="glyphicon glyphicon-chevron-up"></i></a>
                            <a data-widgster="collapse" title="Collapse" href="#"><i class="glyphicon glyphicon-chevron-down"></i></a>
                            <a data-widgster="close" title="Close" href="#"><i class="glyphicon glyphicon-remove"></i></a>
                        </div>
                    </header>
                    <div class="widget-body">
                        <div>
                            <h4>채널별 매출 현황</h4>
                            <div id="chartdiv5" style="width: 100%; height: 500px; font-size: 11px;"></div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </main>
</div>

<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/serial.js"></script>
<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<script src="https://www.amcharts.com/lib/3/pie.js"></script>
<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />

<!--판매금액 비교 그래프-->
<script>
    var chartData = generateChartData();

    var chart = AmCharts.makeChart("chartdiv", {
        "type": "serial",
        "theme": "light",
        "legend": {
            "useGraphSettings": true
        },
        "dataProvider": chartData,
        "synchronizeGrid":true,
        "valueAxes": [{
            "id":"v1",
            "axisColor": "#FCD202",
            "axisThickness": 2,
            "axisAlpha": 1,
            "position": "left"
        }, {
            "id":"v2",
            "axisColor": "#FF6600",
            "axisThickness": 2,
            "axisAlpha": 1,
            "position": "right"
        }],
        "graphs": [{
            "valueAxis": "v1",
            "lineColor": "#FCD202",
            "bullet": "round",
            "bulletBorderThickness": 1,
            "hideBulletsCount": 30,
            "title": "2017년 판매",
            "valueField": "lastyear",
            "fillAlphas": 0
        }, {
            "valueAxis": "v1",
            "lineColor": "#FF6600",
            "bullet": "square",
            "bulletBorderThickness": 1,
            "hideBulletsCount": 30,
            "title": "2018년 판매",
            "valueField": "thisyear",
            "fillAlphas": 0
        }],
        "chartScrollbar": {},
        "chartCursor": {
            "cursorPosition": "mouse"
        },
        "categoryField": "date",
        "categoryAxis": {
            "parseDates": true,
            "axisColor": "#DADADA",
            "minorGridEnabled": true
        },
        "export": {
            "enabled": true,
            "position": "bottom-right"
        }
    });

    chart.addListener("dataUpdated", zoomChart);
    zoomChart();

    function zoomChart() {

    }


    function generateChartData() {
        var chartData = [];

        var chart1 = '<?=$chart1?>';
        var jsonData = $.parseJSON(chart1);

        jsonData.forEach(function(object) {

            var newDate = new Date(object.date);
            //newDate.setDate(newDate.getDate() + i);
            //i++;

            chartData.push({
                date: newDate,
                lastyear: object.lastyear,
                thisyear: object.thisyear
            });
        });

        return chartData;
    }

</script>

<!-- 2018년 판매금액, 사용금액 그래프 -->
<script>
    var chartCode = monthtomonthAmount();
    var charta = AmCharts.makeChart("chartdiv2", {
        "theme": "light",
        "type": "serial",
        "dataProvider": chartCode,
        "valueAxes": [{
            "stackType": "3d",
            "unit": "원",
            "position": "left",
            "title": "2018년 판매금액, 사용금액",
        }],
        "startDuration": 1,
        "graphs": [{
            "balloonText": "[[category]] (사용금액): <b>[[value]]</b>",
            "fillAlphas": 0.9,
            "lineAlpha": 0.2,
            "title": "사용금액",
            "type": "column",
            "valueField": "useAmount"
        }, {
            "balloonText": "[[category]] (판매금액): <b>[[value]]</b>",
            "fillAlphas": 0.9,
            "lineAlpha": 0.2,
            "title": "판매금액",
            "type": "column",
            "valueField": "saleAmount"
        }],
        "plotAreaFillAlphas": 0.1,
        "depth3D": 60,
        "angle": 30,
        "categoryField": "month",
        "categoryAxis": {
            "gridPosition": "start",
        },
        "export": {
            "enabled": true
        }
    });

    function monthtomonthAmount(){
        var chartCode = [];

        var chart2 = '<?=$chart2?>';
        var jsonData2 = $.parseJSON(chart2);

        jsonData2.forEach(function(object2) {

            // var newDate = new Date(object2.date);
            // var newDate = (newDate.getMonth()+1);

            chartCode.push({
                month: object2.month,
                useAmount: object2.useAmount,
                saleAmount: object2.saleAmount
            });
        });
        return chartCode;
    }
</script>

<!-- 주별 판매, 사용금액 -->
<!--<script>
    var barchart = weeklyAmount();

    var chart = AmCharts.makeChart("chartdiv3", {
        "type": "serial",
        "theme": "light",
        "categoryField": "week",
        "rotate": true,
        "startDuration": 1,
        "categoryAxis": {
            "gridPosition": "start",
            "position": "left"
        },
        "trendLines": [],
        "graphs": [{
            "balloonText": "2017판매:[[value]]",
            "fillAlphas": 0.8,
            "id": "AmGraph-1",
            "lineAlpha": 0.2,
            "title": "2017판매",
            "type": "column",
            "valueField": "lastsale"
        },{
            "balloonText": "2018판매:[[value]]",
            "fillAlphas": 0.8,
            "id": "AmGraph-2",
            "lineAlpha": 0.2,
            "title": "2018판매",
            "type": "column",
            "valueField": "thissale"
        },{
            "balloonText": "2018사용:[[value]]",
            "fillAlphas": 0.8,
            "id": "AmGraph-3",
            "lineAlpha": 0.2,
            "title": "2018사용",
            "type": "column",
            "valueField": "thisuse"
        }],
        "guides": [],
        "valueAxes": [{
            "id": "ValueAxis-1",
            "position": "top",
            "axisAlpha": 0
        }],
        "allLabels": [],
        "balloon": {},
        "titles": [],
        "dataProvider": barchart,
        "export": {
            "enabled": true
        }
    });

    function weeklyAmount(){
        var barchart = [];

        var chart3 = '<?/*=$chart3*/?>';
        var jsonData3 = $.parseJSON(chart3);

        jsonData3.forEach(function(object3) {
            barchart.push({
                week: object3.week,
                lastsale: object3.lastsale,
                thissale: object3.thissale,
                thisuse: object3.thisuse
            });
        });
        return barchart;
    }
</script>-->

<!-- 시설별 매출 현황 -->
<script>
    var piechart = facility();

    var chart = AmCharts.makeChart("chartdiv4", {
        "type": "pie",
        "startDuration": 0,
        "theme": "light",
        "addClassNames": true,
        // "legend":{
        //     "position":"right",
        //     "marginRight":50,
        //     "autoMargins":false
        // },
        "innerRadius": "30%",
        "defs": {
            "filter": [{
                "id": "shadow",
                "width": "200%",
                "height": "200%",
                "feOffset": {
                    "result": "offOut",
                    "in": "SourceAlpha",
                    "dx": 0,
                    "dy": 0
                },
                "feGaussianBlur": {
                    "result": "blurOut",
                    "in": "offOut",
                    "stdDeviation": 5
                },
                "feBlend": {
                    "in": "SourceGraphic",
                    "in2": "blurOut",
                    "mode": "normal"
                }
            }]
        },
        "dataProvider": piechart,
        "valueField": "salessize",
        "titleField": "facility",
        "export": {
            "enabled": true
        }
    });

    chart.addListener("init", handleInit);

    chart.addListener("rollOverSlice", function(e) {
        handleRollOver(e);
    });



    function handleRollOver(e){
        var wedge = e.dataItem.wedge.node;
        wedge.parentNode.appendChild(wedge);
    }

    function facility() {
        var piechart = [];

        var chart4 = '<?=$chart4?>';
        var jsonData4 = $.parseJSON(chart4);

        jsonData4.forEach(function(object4) {
            piechart.push({
                facility: object4.facility,
                salessize: object4.salessize
            });
        });
        return piechart;
    }
</script>

<script>
    var pieCchart = channel();

    var chartb = AmCharts.makeChart("chartdiv5", {
        "type": "pie",
        "startDuration": 0,
        "theme": "light",
        "addClassNames": true,
        "innerRadius": "30%",
        "defs": {
            "filter": [{
                "id": "shadow",
                "width": "200%",
                "height": "200%",
                "feOffset": {
                    "result": "offOut",
                    "in": "SourceAlpha",
                    "dx": 0,
                    "dy": 0
                },
                "feGaussianBlur": {
                    "result": "blurOut",
                    "in": "offOut",
                    "stdDeviation": 5
                },
                "feBlend": {
                    "in": "SourceGraphic",
                    "in2": "blurOut",
                    "mode": "normal"
                }
            }]
        },
        "dataProvider": pieCchart,
        "valueField": "salesCsize",
        "titleField": "channel",
        "export": {
            "enabled": true
        }
    });

    chartb.addListener("init", handleInit);

    chartb.addListener("rollOverSlice", function(e) {
        handleRollOver(e);
    });

    function handleRollOver(e){
        var wedge = e.dataItem.wedge.node;
        wedge.parentNode.appendChild(wedge);
    }

    function channel() {

        var pieCchart = [];

        var chart5 = '<?=$chart5?>';
        var jsonData5 = $.parseJSON(chart5);

        jsonData5.forEach(function(object5) {
            pieCchart.push({
                channel: object5.channel,
                salesCsize: object5.salesCsize
            });
        });
        return pieCchart;

    }
</script>

<script>
    $(function(){
        $(".shortcut_btn").click(function() {
            $(location).attr('href','/refund/refundlist');
        });
    });
</script>