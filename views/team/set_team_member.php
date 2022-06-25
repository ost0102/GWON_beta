<style>
	#modal_content{
		display:none;
		margin:50 auto;
		width:400px;
		height:380px;
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
	$("#bt_set_team_member").click(function(){		
		var t_id = $('#t_id').val();
		var add_user = $('#add_user').val();
		var u_position = $('#u_position').val();
		var state = $('#state').val();
	   
	   $.post("/team/add_team_member",{
			t_id: t_id,
			add_user: add_user,
			u_position: u_position,
			state: state,
		},
	   function(data){
		 //alert(data);
		 //입력값 초기화하기
		 //open_modal(data);
		 $('#modal_txt').html(data);
		 fadeout_modal();
		 check_team_member();//location.reload();
	   }); 
	});
</script>
<!-- make step bar area include -->
<div id="con_html">
	<h3>팀정보 입력하기</h3>
	<hr/>
	<style>
		#set_tmember td{
			padding-top:10px; 
			padding-bottom: 10px; 
			border-top:1px solid #d5d0ca;
		}
	</style>
	<table id="set_tmember" style="width: 100%">
		<tr>
			<td>
				Team id
			</td>
			<td style="width: 80%"><?echo $t_name;?><br/>
			<input type='hidden' name='t_id' id='t_id' style='width: 100%' value='<?echo $t_id;?>'/>
			</td>
		</tr>
		<tr>
			<td>
				user
			</td>
			<td><?echo $username;?><br/>
			<input type='hidden' name='add_user' id='add_user' style='width: 100%' value='<?echo $add_user;?>'/>
			</td>
		</tr>
		<tr>
			<td>
				u_position
			</td>
			<td>
				<select id='u_position' name='u_position'>
					<option value=1 <?if($u_position==1){echo "selected='true'";}?>>팔로워</option>
					<option value=2 <?if($u_position==2){echo "selected='true'";}?>>팀원</option>
					<option value=3 <?if($u_position==3){echo "selected='true'";}?>>관리자</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				state
			</td>
			<td>
				<select id='state' name='state'>
					<option value=1 <?if($state==1){echo "selected='true'";}?>>대기</option>
					<option value=2 <?if($state==2){echo "selected='true'";}?>>승인</option>
					<option value=3 <?if($state==3){echo "selected='true'";}?>>거절</option>
				</select>
			</td>
		</tr>
	</table>
	<button id='bt_set_team_member'>등록하기</button>
</div>