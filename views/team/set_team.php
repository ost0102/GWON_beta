<style>
	#modal_content{
		display:none;
		margin:50 auto;
		width:400px;
		height:350px;
		/*background:#fff;*/
		background:#ffffff url(/img/land/bg_modal.jpg) no-repeat right top;
	}
	#modal_txt{
		float:left;
		font-size: 15px;
		font-weight: bold;
		width: 100%;
		margin-top: 30px;
		margin-bottom: 30px;
		height: 240px;
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
	$("#set_team").click(function(){		
		var p_num = $('#p_num').val();
		var t_id = $('#t_id').val();
		var position = $('#position').val();
		var state = $('#state').val();
	   
	   $.post("/team/add_team",{
			p_num: p_num,
			t_id: t_id,
			position: position,
			state: state,
		},
	   function(data){
		 //alert(data);
		 //입력값 초기화하기
		 open_modal(data);
		 $('#modal_txt').html(data);
		 fadeout_modal();
		 check_team();//location.reload();
	   }); 
	});
</script>
<!-- make step bar area include -->
<div id="con_html">
	<h3>팀정보 입력하기</h3>
	<hr/>
	<style>
		td{
			padding-top:10px; 
			padding-bottom: 10px; 
			border-top:1px solid #d5d0ca;
		}
	</style>
	<input type='hidden' name='p_num' id='p_num' style='width: 100%' value='<?echo $p_num;?>'/>
	<input type='hidden' name='t_id' id='t_id' style='width: 100%' value='<?echo $t_id;?>'/>
	<input type='hidden' name='state' id='state' style='width: 100%' value='2'/>
	<table style="width: 100%">
		<tr>
			<td>
				Team name
			</td>
			<td><?echo $t_name;?><br/>
			<input type='hidden' name='t_name' id='t_name' style='width: 100%' value='<?echo $t_name;?>'/>
			</td>
		</tr>
		<tr>
			<td>
				프로젝트와의 관계
			</td>
			<td>
			<input type='text' name='position' id='position' style='width: 95%' value='<?echo $position;?>'/>
			</td>
		</tr>
	</table>
	<button id='set_team'>등록하기</button>
</div>