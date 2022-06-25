<style>
	

	@media all and (max-width:600px){
		/* 태블릿 및 노트북 CSS 작성 */
		#modal_content{
			display:none;
			margin:20 auto;
			width:300px;
			height:400px;
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
	}

	@media all and (min-width:601px){
		/* 데스크탑 CSS 작성 */
		#modal_content{
			display:none;
			margin:50 auto;
			width:400px;
			height:400px;
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
		font-weight: normal;
	}
</style>
<!-- 문의 메일 보내기 -->
<div id='con_html'>
	<h3 style='font-size: 15px;'>문의하기</h3>
	<div style='width:100%'>
		<div style='width:100%; color: #cdcdcd; margin-bottom: 10px;'>
			To : 
			<?
			if($username!=''){
				echo $username.'('.$email.')';
			}else{
				echo $email;
			}
			
			?>
		</div>
		<b>Email</b><br/> <input type='text' tabindex='1' id='v_mail' name='v_mail' style='width: 95%; margin-bottom: 10px;' value='<?echo $visitor_mail;?>' placeholder="답변을 받으실 본인의 이메일 주소를 입력해주세요." /><br/>
		<b>문의내용</b><br/>
		<textarea tabindex='2' id='mail_con' name='mail_con' style='width: 95%; height: 80px; margin-bottom: 10px;' placeholder="문의 내용을 입력해주세요." ></textarea>
		<div style='width: 100%; text-align: center; margin-bottom: 10px;'>
			<button onclick="send_mail();" class="btn btn-success">
				        보내기
			</button>
		</div>
	</div>
</div>
<SCRIPT TYPE='text/javascript'>
function send_mail(admin_user){
	//링크 카운트 하기
	
	var p_num = '<?if(isset($p_num)){echo $p_num;}?>';
	var admin_id = '<?if(isset($admin_id)){echo $admin_id;}?>';
	var admin_email = '<?if(isset($email)){echo $email;}?>';
	var v_mail = $('#v_mail').val();
	var mail_con = $('#mail_con').val();
	open_modal();
	$('#modal_txt').html('<img src="/img/loading.gif" width="50px">');
	$('#login_close').hide();
	//alert(v_mail);
	if(v_mail != '' && mail_con !='' || v_mail != 'undefined' || mail_con !='undefined'){
		//alert('내용있음');
		$.post('/openpage/send_mail',{
			p_num: p_num,
			admin_id: admin_id,
			admin_email: admin_email,
			v_mail: v_mail,
			mail_con: mail_con
		},
		function(data){
			open_modal(data);
			$('#modal_txt').html(data);
			$('#login_close').show();
			//alert(data);
			 //window.open(linked_url,'','');
		}); 
	}else{
		alert('이메일 주소, 문의내용을 입력해주세요.');
	}
}
</SCRIPT>