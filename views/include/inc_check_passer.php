<script type="text/javascript">
</script>
<?
if(isset($edit_con)&&$edit_con==2){
	$can_edit = 'y';
}else{
	$can_edit = 'n';
}
$now_state = $_SERVER['REQUEST_URI'];
if(strpos($now_state,'select_design') !== false || strpos($now_state,'mobile_view') !== false){
	$can_edit = 'n';
}
$intro_url = $this->config->item('intro_url');
?>
<style type="text/css">
</style>
<h3 style="margin-bottom: 15px;">결과 조회</h3>
<?
if($check_apply=='n'){
    echo '결과 조회는 최종 접수가 완료된 사용자만 확인할 수 있습니다.';
}else{
    foreach ($check_passer_result as $check_passer_info) {
        $step = $check_passer_info['step'];
        $step_title = $check_passer_info['step_title'];
        $comment_selected = $check_passer_info['comment_selected'];
        $comment_drop = $check_passer_info['comment_drop'];
        $check_user_passer = $check_passer_info['check_user_passer'];


        echo '<h3>'.$step_title .'</h3>';
        
            if($check_user_passer=='yes'){
                echo $comment_selected;
            }else if($check_user_passer=='no'){
                echo $comment_drop;
            }else if($check_user_passer=='not yet'){
                echo '결과 발표 전입니다.';
            }
        
    }
}
?>


<hr/>
<!-- Other Contents Area start -->
<div id='other_info'>
	<?
		
        if(isset($contact)&& $contact !='0'&& $contact !=''){
            $contact_ex =explode(',' , $contact);
            echo '<h3 id="contact_info"><img src="/img/icon/icon_call.png" style="width: 15px; margin-right: 5px;" />문의하기</h3>';
            echo '<ul id="contact_info_ul">';

            foreach ($contact_ex as $contact_info) {
                //연락처가 메일인지, 웹사이트인지, 전화번호인지 파악하여 적절한 링크 추가하기

                $ex="/^[-_a-z0-9]+(\.[-_a-z0-9]+)*@[-a-z0-9]+(\.[-a-z0-9]+)+$/"; 
                
                $check_mail_type = preg_match($ex, $contact_info); 
                if($check_mail_type == 1){
                    //메일 형태임
                    echo '<li>메일 : <a href="javascript:post_mail_mail_addr(\''.$contact_info.'\');">'.$contact_info.'</a></li>';
                }else if(strpos($contact_info, 'www') !== false || strpos($contact_info, 'http://') !== false || strpos($contact_info, 'https://') !== false) {  
                    //url 형태  
                    echo '<li>홈페이지 : <a href="//'.$contact_info.'" target="_blank"> '.$contact_info.'</a></li>';
                }else{
                    //위 두개에 해당안된다면.. 아마도 전화번호?
                    echo '<li>'.$contact_info.'</li>';
                }
                # code...
            }
            echo '</ul>';


        }

	?>
	
	<!--kakao Story 링크 공유용-->
	<div id='page_descript' style='display:none;'><?echo $summary;?>'</div>
</div>
<?
	$user=$this->session->userdata('gwon_users');
	$now_url = '/'.$domain;
	$REQUEST_URI = $_SERVER['REQUEST_URI'];

	if($REQUEST_URI==''){
		$now_url = $now_url;
	}else{
		$now_url = $REQUEST_URI;
	}
	$intro_url = $this->config->item('intro_url');
	$title_enc = urlencode($title);
	//문자열 바꾸기
	$phrase  = $title;
	$origin_str = '\'';
	$change_str = '"';
	$title_replace = str_replace($origin_str, $change_str, $phrase);

?>
<script src="https://www.youtube.com/iframe_api"></script>
<script src="//f.vimeocdn.com/js/froogaloop2.min.js"></script>
<SCRIPT TYPE='text/javascript'>
        //업로드 파일
        function upload_file(w_num,item_id){
            var url = '/upload/up1/6?w_num='+w_num+'&item_id='+item_id;
            window.open(url,'upload_img','width=500,height=430,left=0,top=0,scrollbars=no');
        }

        //체크박스 실행
        function check_box_state(item_id, item_id_num, options_item){
            var id_item_result = '#'+item_id+'_result';
            var id_item_id_num = '#'+item_id_num;
            var class_item_id = '.'+item_id;
            var value_txt = '';
            var now_value_txt = '';

            $(class_item_id).each(function() {
              var now_checked = $(this).is(':checked');
              if(now_checked==true){
                now_value_txt = $(this).attr('value');
                if(value_txt==''){
                    value_txt = now_value_txt;
                }else{
                    value_txt = value_txt+'#PH#'+now_value_txt;
                }
              }
            });
            $(id_item_result).val(value_txt);

        }

        //로고 삭제
        function delete_file(w_num,item_id){

            var file_url = $('#'+item_id).val();
            //alert(file_url);

            $.post('/upload/delete_file',{
                    w_num: w_num,
                    item_id: item_id,
                    file_url: file_url
                },
                function(data){
                    //alert(data);
                    //입력값 초기화하기
                    if(data==1){
                        $('#'+item_id).val('');
                        $('#'+item_id+'_down_area').hide();
                        $('#'+item_id+'_img_upload').show();
                        $('#'+item_id+'_bt_file_delete').hide();
                    }else{
                        alert(data);
                    }
                    //추가 해야할 사항 로고 업로드시 변동 부분, 그리고 실제 하단 코드 부분에 버튼 추가하고 보이도록 설정
                });
        }


	//user_id를 알 수 있는 상황에서 user_id로 이메일 팝업 열기
	function post_mail(admin_user){
		//링크 카운트 하기
		var p_num = '<?if(isset($p_num)){echo $p_num;}?>';
		var admin_user = admin_user;
		//alert(admin_user);
		
		$.post('/openpage/send_mail_form',{
			p_num: p_num,
			admin_user: admin_user
		},
		function(data){
			open_modal(data);
			$('#modal_txt').html(data);
			//alert(data);
			 //window.open(linked_url,'','');
		}); 
	}

	//이메일 주소만 아는 상황에서 이메일 팝업 열기
	function post_mail_mail_addr(mail_addr){
		//링크 카운트 하기
		var p_num = '<?if(isset($p_num)){echo $p_num;}?>';
		var mail_addr = mail_addr;
		//alert(admin_user);
		
		$.post('/openpage/send_mail_form_with_addr',{
			p_num: p_num,
			mail_addr: mail_addr
		},
		function(data){
			open_modal(data);
			$('#modal_txt').html(data);
			//alert(data);
			 //window.open(linked_url,'','');
		}); 
	}
	//콘텐츠 수정 모달창 열기
	function edit_con(con_num){
		var p_num = '<?if(isset($p_num)){echo $p_num;}?>';
		var can_edit = '<?if(isset($can_edit)){echo $can_edit;}?>';
		
		$.post('/openpage/show_edit_modal/',{
			con_num: con_num,
			p_num: p_num,
			can_edit: can_edit
		},
		function(data){
			//open_modal();
			//$('#modal_txt').html(data);
			$("#right_top_shape").after(data);
			$('#openpage_con_edit').slideDown();
			$( window ).scrollTop(0);
			//alert(data);
			 //window.open(linked_url,'','');
		}); 
	}


</SCRIPT>

<!--signature 관련 시작 -->
<script src="/assets/signature_pad/jquery.signaturepad.js"></script>
  <script>
    $(document).ready(function() {
      //서명 영역 불러오기
      $('.sigPad').signaturePad({drawOnly:true});
      //기존 서명정보 불러오기 (있을 경우만)
      <?
      if(isset($signature)){
      ?>
        $('.sigPad').signaturePad({displayOnly:true}).regenerate(<?echo $signature;?>);
      <?
      }?>
    });
  </script>
  <script src="/assets/signature_pad/assets/json2.min.js"></script>
<!--signature 관련 끝-->