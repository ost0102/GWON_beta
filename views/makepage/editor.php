<!DOCTYPE html>
<html lang='en'>
<head>
  <meta charset='UTF-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'>
  <title>Code Editor</title>
  <script type='text/javascript' src='/js/jquery.js'></script>
  <!--modal창 관련 -->
  <script type='text/javascript' src='/js/jquery.simplemodal.js'></script>
  <style type='text/css' media='screen'>
    body {
        overflow: hidden;
    }
    
    #editor { 
        margin: 0;
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
    }
  </style>
</head>
<body>

<pre id='editor'>
     //welcome to the gwon!
</pre>
<script src='https://cdn.jsdelivr.net/ace/1.2.6/min/ace.js' type='text/javascript' charset='utf-8'></script>

<script>
	window.onload=function(){
		include_value = 'no';
		$modal_state ='on';
		//변수를 넘겨받았는지 체크하기, 글을 불러오지 못했을경우, 다시 로드
		setTimeout(function(){
			check_value();
		},500);
		setTimeout(function(){
			if(include_value == 'no'){
				check_value();
			}
		},1000);
		setTimeout(function(){
			if(include_value == 'no'){
				check_value();
			}
		},1500);
		setTimeout(function(){
			if(include_value == 'no'){
				check_value();
			}
		},2000);
	};

	var code_type = $('#code_type',parent.document).val();
	if(code_type <3){
		//code type에 따라 코딩 모드 변경해서 호출하기
		var editor = ace.edit('editor');
		editor.setTheme('ace/theme/twilight');
		editor.getSession().setMode('ace/mode/css');
	}else{
		var editor = ace.edit('editor');
		editor.setTheme('ace/theme/twilight');
		editor.getSession().setMode('ace/mode/javascript');
	}

	function get_con(){
		var con = editor.getValue();
		//alert(con);
		$('#css_con',parent.document).val(con);
		parent.update_code();
		//alert(con);
	}

    function set_con(){
        var con = $('#css_con',parent.document).val();
        editor.setValue(con);
    }

    function refresh_con(){
        var con = editor.getValue();
        //alert(con);
        $('#css_con',parent.document).val(con);
    }

	//변수 보내기
	//초기 로딩 후 변수를 넘겨받았는지 체크하기
	function check_value(){
		//var edit_txt = $('#wsw_iframe').contents().find('#editor').html();
		
		//$('#input_txt1').html(edit_txt);
		var origin_value = $('#css_con',parent.document).val();
		editor.setValue(origin_value);
		var editor_value = editor.getValue();
		if(origin_value == editor_value){
			//변수가 넘어왔으면, 모달창 닫기
			modal_off();
			include_value = 'Yes';
		}
		//alert('저장이 완료되었습니다.');
	}
	function modal_off(){
		if($modal_state == 'on'){
			 $.modal.close();
			$modal_state = 'off';
		}
	}
</script>
<!--모달창 출력부분 시작-->
<div id='modal_content'>
	 <div id='modal_txt'>
		<img src='/img/loading.gif' style='width: 70px; '>
	</div>
</div>
<!--모달창 출력부분 끝 -->
</body>
</html>
