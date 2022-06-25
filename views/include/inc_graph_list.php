<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?$this->load->view('/include/head_info');?>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script src="/js/new_graph/raphael-min.js"></script>
    <script src="/js/new_graph/morris.js"></script>
    <script src="/js/new_graph/library/prettify.js"></script>
    <script src="/js/new_graph/library/example.js"></script>
    <link rel="stylesheet" href="/js/new_graph/library/example.css">
    <link rel="stylesheet" href="/js/new_graph/library/prettify.css">
    <link rel="stylesheet" href="/js/new_graph/morris.css">

	<style type="text/css">
	    .jqplot-target {
	        margin: 20px;
	        height: 300px;
	        width: 85%;
	        color: #dddddd;
	        font-size: 10px;
	    }

	    .ui-widget-content {
	    	padding-top: 5px;
	    	padding-bottom: 5px;
	        background: rgb(255,255,255);
	        font-size: 10px;
	    }

	    table.jqplot-table-legend {
	        border: 0px;
	        background-color: rgba(255,255,255, 0.9);
	        font-size: 10px;
	    }

	    .jqplot-highlighter-tooltip {
	        background-color: rgba(180,180,180, 0.9);
	        padding: 7px;
	        color: #dddddd;
	    }
        body{
            margin: 0px;
            padding: 0px;
        }

	</style>
<!-- graph 출력 관련 끝 -->
</head>
<body>
<div id='loading_img' style="width:100%; padding-top:100px; height:300px; text-align: center;"><img src="/img/loading.gif" style="width:50px;"></div>
<!--graph 출력! -->
<div id='graph_area' style='flaot: left; width:100%; '>
    <div id="graph"></div>
	<pre id="code" style='display: none;'>
    <?
    if($graph_type == 'time'){
       echo 'var day_data = [';
        foreach($time_visiter as $time){
            $shared = intval($time['shared']); 
            $count = intval($time['count']); 
            $apply = intval($time['apply']); 
            if(!isset($str_com)) $str_com ="";
            echo $str_visited =$str_com."{'Time': '".$time['date']."', 'Visited' : ".$count.", 'Shared' : ".$shared.", 'Apply' : ".$apply."}";
            $str_com =",";
            
        }
        echo '];';

         echo "Morris.Line({
              element: 'graph',
              data: day_data,
              xkey: 'Time',
              ykeys: ['Visited', 'Shared', 'Apply'],
              labels: ['Visited', 'Shared', 'Apply'],
              parseTime: false
            });";

       $title = 'Weekly report';


    }else{
        echo 'var day_data = [';
        foreach($weekly_visiter as $weekly){
            $shared = intval($weekly['shared']);  
            $count = intval($weekly['count']); 
            $apply = intval($weekly['apply']); 
            if(!isset($str_com)) $str_com ="";
            echo $str_visited =$str_com."{'period': '".$weekly['date']."', 'Visited' : ".$count.", 'Shared' : ".$shared.", 'Apply' : ".$apply."}";
            $str_com =",";
            
        }
        echo '];';

         echo "Morris.Line({
              element: 'graph',
              data: day_data,
              xkey: 'period',
              ykeys: ['Visited', 'Shared', 'Apply'],
              labels: ['Visited', 'Shared', 'Apply']
            });";

       $title = 'Weekly report';
    }
    ?>
    
    </pre>
</div>
<script type="text/javascript">

    $(document).ready(function () {
        //부모 창 높이 조정하기
        $('.grp_iframe', parent.document).height($('#graph').height()+20);
        //$('#grp_iframe', parent.document).height($(document).height()-60);
    });


</script>
<script type="text/javascript">
    $('#loading_img').slideUp();
    $('#graph_area').fadeIn();
    //$('#code').hide();
    
</script>
<!--graph 출력 끝! -->
</body>
</html>