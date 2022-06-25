<style>
	#modal_content{
		display:none;
		margin:50 auto;
		width:400px;
		height:400px;
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
		height: 290px;
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
	$(document).ready(function() {
		//등록하기
		$("#set_project_member").click(function(){		
			var p_num = $('#p_num').val();
			var add_user = $('#add_user').val();
			var position = $('#position').val();
			var edit_con = $('#edit_con').val();
			var edit_code = $('#edit_code').val();
			var state = $('#state').val();
		   
		   $.post("/team/add_project_mate",{
				p_num: p_num,
				add_user: add_user,
				edit_con: edit_con,
				edit_code: edit_code,
				position: position,
				state: state,
			},
		   function(data){
			 //alert(data);
			 //입력값 초기화하기
			 //open_modal(data);
			 $('#modal_txt').html(data);
			 fadeout_modal();
			 check_teammate();//location.reload();
		   }); 
		});
	});
</script>
<!-- make step bar area include -->
<div id="con_html">
	<h3>팀정보 입력하기</h3>
	<hr/>
	<style>
		#set_project_member_tb td{
			padding-top:10px; 
			padding-bottom: 10px; 
			border-top:1px solid #d5d0ca;
		}
	</style>
	<input type='hidden' name='p_num' id='p_num' style='width: 100%' value='<?echo $p_num;?>'/>
	<input type='hidden' name='state' id='state' style='width: 100%' value='2'/>
	<table id='set_project_member_tb' style="width: 100%">
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
				직책
			</td>
			<td>
			<input type='text' name='position' id='position' style='width: 95%' value='<?echo $position;?>'/>
			</td>
		</tr>
		<tr>
			<td>
				콘텐츠 수정권한
			</td>
			<td>
				<select id='edit_con' name='edit_con'>
					<option value=1 <?if($edit_con==1){echo "selected='true'";}?>>없음</option>
					<option value=2 <?if($edit_con==2){echo "selected='true'";}?>>승인</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				코드 수정권한
			</td>
			<td>
				<select id='edit_code' name='edit_code'>
					<option value=1 <?if($edit_code==1){echo "selected='true'";}?>>없음</option>
					<option value=2 <?if($edit_code==2){echo "selected='true'";}?>>승인</option>
				</select>
			</td>
		</tr>
	</table>
	<button id='set_project_member'>등록하기</button>
</div>