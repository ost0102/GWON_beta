<style>
	#modal_content{
		display:none;
		margin:50 auto;
		width:600px;
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
		width: 100%;
		padding-left: 3%;
		padding-right: 3%;
		text-align:center;
		font-weight: normal;
	}
</style>
<!-- mail contents 보기 -->
<div id='con_html'>
	<h3 style='font-size: 15px; margin-bottom: 10px;'>문의 내용</h3>
	<div style='float: left; width: 48%; margin-right: 2%;'>
		<div style='width:100%; color: #cdcdcd; margin-bottom: 10px;'>
			To : <?echo $p_username.'('.$p_email.')';?><br/>
			from : <?echo $visitor_mail;?>
		</div>
		<b>내용</b><br/>
		<div style='padding-left: 10px; padding-right: 10px; height:150px; border: 1px solid #cdcdcd; margin-top: 10px; margin-bottom: 10px; overflow-y: scroll;'>
			<?echo nl2br($email_con);?>
		</div>
		날짜 : <?echo $date;?>
	</div>
	<div style='float: left; width:50%;'>
		<div style='width:100%; color: #cdcdcd; margin-bottom: 10px;'>
			To : 
			<?
			if($visitor_name!=''){
				echo $visitor_name.'('.$email.')';
			}else{
				echo $visitor_mail;
			}
			if($feedback_mail!=""){
				//기존 답변이 있다면..
				$login_user_mail = $feedback_mail;
				$login_user_name = $feedback_name;
				$feedback_email_con = $feedback_email_con;
			}else{
				//기존답변이 없다면...
				$login_user_mail = $this->session->userdata('email');
				$login_user_name = $this->session->userdata('username');
				$feedback_email_con = "";
			}
			?>
		</div>
		<b>Email</b><br/> <input type='text' tabindex='1' id='admin_mail' name='admin_mail' style='width: 95%; margin-bottom: 10px;' value='<?echo $login_user_mail;?>' placeholder="답변하는 분의 이메일 주소를 입력해주세요." /><br/>
		<input type='hidden' tabindex='1' id='admin_name' name='admin_name' style='width: 95%; margin-bottom: 10px;' value='<?echo $login_user_name;?>' placeholder="답변하는 분의 이메일 주소를 입력해주세요." />
		<b>문의내용</b><br/>
		<textarea tabindex='2' id='mail_con' name='mail_con' style='width: 95%; height: 120px; margin-bottom: 10px;' placeholder="답변 내용을 입력해주세요." ><?echo $feedback_email_con;?></textarea>
		<div style='width: 100%; text-align: center; margin-bottom: 10px;'>
			<?if($feedback_mail==""){
			?>
			<button onclick="send_mail_feedback();" class="btn btn-success">
				        보내기
			</button>
			<?
			}else{
				echo "발송날짜 : ".$feedback_date;
			}
			?>
		</div>
	</div>
</div>
<SCRIPT TYPE='text/javascript'>
function send_mail_feedback(admin_user){
	//링크 카운트 하기
	var p_num = '<?if(isset($p_num)){echo $p_num;}?>';
	var m_id = '<?if(isset($m_id)){echo $m_id;}?>';
	var visitor_mail = '<?if(isset($visitor_mail)){echo $visitor_mail;}?>';
	var admin_mail = $('#admin_mail').val();
	var admin_name = $('#admin_name').val();
	var mail_con = $('#mail_con').val();
	open_modal();
	$('#modal_txt').html('<img src="/img/loading.gif" width="50px">');
	$('#login_close').hide();
	//alert(v_mail);
	if(visitor_mail != '' && mail_con !='' || visitor_mail != 'undefined' || mail_con !='undefined'){
		//alert('내용있음');
		$.post('/mypage/send_mail_feedback',{
			m_id: m_id,
			p_num: p_num,
			visitor_mail: visitor_mail,
			admin_mail: admin_mail,
			admin_name: admin_name,
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