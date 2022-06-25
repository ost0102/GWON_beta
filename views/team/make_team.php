<style>
	#modal_content{
		display:none;
		margin:50 auto;
		width:400px;
		height:380px;
		/*background:#fff;*/
		background:#ffffff;
	}
	#modal_txt{
		float:left;
		font-size: 15px;
		font-weight: bold;
		width: 100%;
		margin-top: 30px;
		margin-bottom: 30px;
		height: 270px;
		text-align: center;

	}
	.cate_div{
		float: left; 
		margin-right: 20px; 
		margin-bottom: 5px; 
		padding: 10px; 
		background-color: #cdcdcd; 
		cursor: pointer;
	}
	#login_close{
		clear: both;
		height: 30px;
		margin-top: 10px;
		margin-bottom: 10px;
		width: 100%;
		text-align: center;
	}
	#con_html{
		float:left; 
		width: 90%;
		padding-left: 5%;
		padding-right: 5%;
		text-align:center;
	}
</style>
<script>

	//등록하기
	$("#make_team_info").click(function(){
		url=location.href;
		if(url.indexOf('add_other')!=-1){
			var where = 'add_other';
		}else if(url.indexOf('my_team')!=-1){
			var where = 'my_team';
		}else if(url.indexOf('team_info')!=-1){
			var where = 'team_info';
		}else{
			var where = '';
		}
		//alert(where);
		
		var t_id = $('#t_id').val();
		var t_name = $('#t_name').val();
		var t_script = $('#t_script').val();

		$.post("/team/make_team_info",{
			t_id: t_id,
			where: where,
			t_name: t_name,
			t_script: t_script
		},
		function(data){
		 //alert(data);
		 //입력값 초기화하기
		 if( where == 'add_other'){
			 open_modal(data);
			 $('#modal_txt').html(data);
			 check_team(t_id);
			 //if(data =="등록이 완료되었습니다."){}
		 }else if( where == 'my_team'){
			 open_modal(data);
			 alert(data);
			 location.reload();
			 //if(data =="등록이 완료되었습니다."){}
		 }else if( where == 'team_info'){
			 alert(data);
			 check_team_info();
			 //if(data =="등록이 완료되었습니다."){}
		 }else{
			 open_modal(data);
			 $('#modal_txt').html(data);
		 }
		}); 
	});
</script>
<!-- make step bar area include -->
<div id="con_html">
	<?
	if(!isset($t_id)){
		$t_id = '';
	}
	if(!isset($team_name)){
		$team_name = '';
	}
	if(!isset($t_script)){
		$t_script = '';
	}
	if($t_id==''){
		echo '팀 만들기';
	}else{
		echo '팀 정보 수정하기';
	}?>
	
	<hr/>
	<input type='hidden' name='t_id' id='t_id' style='width: 100%' value='<?echo $t_id;?>'/><br/>
	<table style="width: 95%">
		<tr>
			<td style="width: 90px;">팀명
			</td>
			<td><input type='text' name='t_name' id='t_name' style='width: 100%' value='<?echo $team_name;?>'/>
			</td>
		</tr>
		<tr>
			<td colspan="2" style='height: 10px;'>
			</td>
		</tr>
		<tr>
			<td>팀 소개글
			</td>
			<td><textarea name='t_script' id='t_script' style='width: 100%; height: 120px;'><?echo $t_script;?></textarea><br/>
			</td>
		</tr>
	</table>
	<button id='make_team_info'>등록하기</button>
</div>