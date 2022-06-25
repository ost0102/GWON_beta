<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?$this->load->view('/include/head_info');?>

<!--link href="css/screen_origin.css" type="text/css" rel="stylesheet" media="screen,projection" /-->
<script type="text/javascript">
	//jQuery 있는 상태
	window.onload=function(){
		//$('#sc2_2').hide();
		
		$(window).scroll(function(){ 
			var scr_now = $(document).scrollTop();
			//현재 스크롤
			//alert(scr_now);

			
		});
	};
	$(document).ready(function() {
	});

</script>
<style>
.con_area_div{
	float: left;
	width: 100%;
}
.con_area_div_info{
	float: left;
	width: 100%;
	border-bottom: 1px solid #cdcdcd;
	padding-top: 10px;
	padding-bottom: 10px;
	text-align: left;
}
.report_area{
	width: 100%;
}
</style>
</head>
<body>
<!-- 상단 영역 공통 끝 -->
<div class='report_area'>
    <!--콘텐츠 영역 -->
    <div id='content_area'>
        <div id='con_div'>
            <!-- Contents Area Start -->
            <div id='con_area'>
            	<script type="text/javascript">
			function apply_success(){
			    //alert('test');
			    var domain = '<?echo $domain?>';
			    location.href='/'+domain;
			}

		</script>
		<?
		$intro_url = $this->config->item('intro_url');
		?>
		<style type="text/css">

		</style>
		<div class='con_area_div' style='text-align: center; padding: 10px; '>
		  <h1 class='con_titles'>
		    신청 내용
		  </h1>
		   <?
		    $today_ymd = date("Ymd H:i");
		    $start_date_ymd = date("Ymd H:i", strtotime( $start_date.$start_time ));
		    $end_date_ymd = date("Ymd H:i", strtotime( $end_date.$end_time ));
		    if($today_ymd>$start_date_ymd&&$today_ymd<$end_date_ymd){
		        $check_apply = 'y';
		    }else{
		        $check_apply = 'n';
		    }
		    ?>
		    <?
		    ?>
		    <?
		    if($check_apply =='y'){
		    ?>
		    <div style='padding: 10px; background: #efefef; text-align: center;'>
		     신청서 작성 기간 중에는 공고사업의 홈페이지 내<br/> <a href='/apl/<?echo $domain?>?page_num=1' target='_blank'><b>지원하기</b></a> 메뉴를 통해 언제든 수정하실 수 있습니다.
		     </div>
		    <?
		    }
		    ?>

		 
		  <?
		    //div는 10개까지지만.. graph 출력위치가 11까지라서 11로..
		    if(isset($form_set_info)){
		          //print_r($form_set_info);
		          //echo '<br/>';
		           //input type 비교를 위해 배열로 구성
		          $input_type_array = array('text', 'textarea', 'page_branch', 'radio','select','checkbox','upload','date','agree');
		          foreach ($form_set_info as $form_set_infos)
		            {
		            //print_r($form_set_infos);
		            //echo '<br/>';
		            $w_num = $form_set_infos['w_num'];
		            $key = $form_set_infos['key'];
		            $item_id = $form_set_infos['item_id'];
		            $display_name = $form_set_infos['display_name'];
		            $field_type = $form_set_infos['field_type'];
		            $options = $form_set_infos['options'];
		            $use = $form_set_infos['use'];
		            $memo = $form_set_infos['memo'];
		            $date = $form_set_infos['date'];
		            $item_value = $form_set_infos['item_value'];

		            $options_preg = preg_replace('/\r\n|\r|\n/','#PH#',$options);
		            $config_option = explode('#PH#', $options_preg);
		            ?>
		            <!--설문 콘텐츠 출력 시작-->
		            <div id='con_con<?echo $key;?>' class='con_area_div_info'>
		                <h5 id='con<?echo $key;?>_title' style='float: left; width: 100%;'><b><?echo $display_name;?></b></h5>
		                <div id='con<?echo $key;?>_txt' style='float: left; width: 100%;'>
		                   <!--본문 내용 출력
		                   key : <?echo $key;?><br/>
		                   item_id : <?echo $item_id;?><br/>
		                   field_type : <?echo $field_type;?><br/>
		                   options : <?echo $options;?><br/>
		                   use : <?echo $use;?><br/>
		                   memo : <?echo $memo;?><br/>
		                   item_value : <?echo $item_value;?><br/>-->
		                   
		                   <input type="hidden" name="display_name[]" value="<?echo $display_name;?>"/>
		                   <input type="hidden" name="key[]" value="<?echo $key;?>"/>
		                   <input type="hidden" name="item_id[]" value="<?echo $item_id;?>"/>

		                   <?
		                   //기본 input type인지 체크, 아닌 경우 추가로 텍스트 출력 등 값을 받지 않는 항목으로 구성될 수 있도록..
		                   if(in_array($field_type, $input_type_array)) {
		                        if($field_type=="page_branch"){
		                   ?>
		                        <input type='hidden' name="item_value[]"  id="<?=$item_id;?>" value="" />
		                        <?if(isset($memo)&&$memo!=''){
		                           ?>
		                          <div style='width: 100%; float: left; padding-top: 0px;'>
		                            <?echo $memo;?>
		                          </div>
		                          <?
		                          }?>
		                        <?
		                        }else if($field_type=="text"){
		                         ?>
		                                <input type='text' name="item_value[]"  id="<?=$item_id;?>" value="<?=$item_value;?>" readonly tabindex='<?echo $key;?>' <?if($use==1){echo 'required';}?>/>
		                                <?if(isset($memo)&&$memo!=''){
		                                 ?>
		                                <div class='t_basic' style='width: 100%; float: left; padding-top: 0px;'>
		                                  <?echo $memo;?>
		                                </div>
		                                <?
		                                }?>
		                        <?
		                         }else if($field_type=="textarea"){
		                        ?>
		                                 <textarea name="item_value[]"  id="<?=$item_id;?>"  cols="10" rows="5"  readonly tabindex='<?echo $key;?>' <?if($use==1){echo 'required';}?>><?=$item_value;?></textarea>
		                                 <?if(isset($memo)&&$memo!=''){
		                                 ?>
		                                <div class='t_basic' style='width: 100%; float: left; padding-top: 0px;'>
		                                  <?echo $memo;?>
		                                </div>
		                                <?
		                                }?>
		                        <?
		                        }else if($field_type=="radio"){
		                        ?>
		                            <? 
		                                $i=1;
		                                foreach($config_option as $options_item){
		                                    if($options_item==$item_value){
		                                        $check_checked = 'checked';
		                                    }else{
		                                        $check_checked = '';
		                                    }
		                              ?>
		                               <input type="radio" name="item_value[]"  id="<?=$item_id.'_'.$i;?>" onclick="return(false);" value="<?=$options_item;?>" <?if($use==1){echo 'required';}?><?echo $check_checked;?> tabindex='<?echo $key;?>'/><label for='<?=$item_id.'_'.$i;?>'><?=$options_item;?></label> 
		                               <br/>
		                             <?
		                                $i++;
		                              }?>
		                              <?if(isset($memo)&&$memo!=''){
		                               ?>
		                              <div class='t_basic' style='width: 100%; float: left; padding-top: 0px;'>
		                                <?echo $memo;?>
		                              </div>
		                              <?
		                              }?>
		                        <?
		                        }else if($field_type=="select"){
		                        ?>
		                            <select name="item_value[]" id="<?=$item_id;?>" <?if($use==1){echo 'required';}?> tabindex='<?echo $key;?>' onFocus='this.initialSelect = this.selectedIndex;' readonly onChange='this.selectedIndex = this.initialSelect;' style='width: 100%;'>
		                                <option value="">선택해주세요 </option>
		                            <? 
		                                $i=1;
		                                foreach($config_option as $options_item){
		                                  if($options_item==$item_value){
		                                    $check_checked = 'selected';
		                                  }else{
		                                    $check_checked = '';
		                                  }
		                              ?>
		                               <option value="<?=$options_item;?>" <?echo $check_checked;?> ><?=$options_item;?></option>
		                             <?
		                                $i++;
		                              }?>
		                             </select>
		                             <?if(isset($memo)&&$memo!=''){
		                               ?>
		                              <div class='t_basic' style='width: 100%; float: left; padding-top: 0px;'>
		                                <?echo $memo;?>
		                              </div>
		                              <?
		                              }?>
		                        <?
		                        }else if($field_type=="checkbox"){
		                        ?>
		                            <? 
		                                $i=1;
		                                foreach($config_option as $options_item){
		                                    if($options_item==$item_value){
		                                        $check_checked = 'checked';
		                                    }else{
		                                        $check_checked = '';
		                                    }
		                              ?>
		                              <input type="checkbox" id="<?=$item_id.'_'.$i;?>" class="<?=$item_id;?>" onclick="return(false);" readonly <?if($use==1){echo 'required';}?> onclick='check_box_state("<?=$item_id;?>","<?=$item_id.'_'.$i;?>","<?=$options_item;?>");' name="checkbox_con" value="<?=$options_item;?>" tabindex='<?echo $key;?>' <?echo $check_checked;?>/><label for='<?=$item_id.'_'.$i;?>'><?=$options_item;?></label> 
		                              <br/>
		                             <?
		                                $i++;
		                              }?>
		                              <input type="hidden" id="<?=$item_id.'_result';?>" name="item_value[]" value="<?=$item_value;?>" />
		                              <?
		                                if($item_value!=''){
		                                ?>
		                                <script>
		                                //체크했던 정보 가져오기
		                                 var id_item_result = '#'+'<?echo $item_id;?>'+'_result';
		                                 var class_item_id = '.'+'<?echo $item_id;?>';

		                                 var check_box_class = '.'+'<?echo $item_id;?>';
		                                 var now_result = $(id_item_result).val();
		                                 var now_result_split = now_result.split('#PH#');

		                                 $(class_item_id).each(function() {
		                                    now_value_txt = $(this).attr('value');
		                                    now_checkbox_id= $(this).attr('id');

		                                    if($.inArray(now_value_txt, now_result_split) != -1){
		                                        $("input:checkbox[id='"+now_checkbox_id+"']").prop('checked', true);

		                                    }
		                                  });

		                                </script>
		                                <?
		                                }
		                              ?>
		                               <?if(isset($memo)&&$memo!=''){
		                               ?>
		                              <div class='t_basic' style='width: 100%; float: left; padding-top: 0px;'>
		                                <?echo $memo;?>
		                              </div>
		                              <?
		                              }?>

		                        <?
		                        }else if($field_type=="upload"){
		                        ?>
		                            <input id='<?=$item_id;?>' name="item_value[]"  type='hidden' placeholder='업로드할 파일을 선택해주세요.' <?if($use==1){echo 'required';}?> value='<?=$item_value;?>' readonly/>
		                            
		                            <?if(isset($item_value)&&$item_value!=''){
		                            ?>
		                            <div id='<?=$item_id;?>_down_area' style='width:100%; '>
		                            	<?
		                            	$download_url= "/mypage/download/".  my_simple_crypt($item_value);		                            	
		                            	?>
		                                <a href="<?echo $download_url;?>" target="_blank"><b>첨부 파일 보기</b></a>
		                            </div>
		                            <?
		                            }else{
		                            	echo '업로드한 파일이 없습니다.';
		                            }?>
		                        <?
		                        }else if($field_type=="date"){
		                        ?>
		                              <input id='<?=$item_id;?>' name="item_value[]" type='text' readonly placeholder='날짜를 선택해주세요.' <?if($use==1){echo 'required';}?> value='<?=$item_value;?>' tabindex='<?echo $key;?>' autocomplete="off" <?/*readonly*/?>/>
		                                 <?if(isset($memo)&&$memo!=''){
		                                 ?>
		                                <div class='t_basic' style='width: 100%; float: left; padding-top: 0px;'>
		                                  <?echo $memo;?>
		                                </div>
		                                <?
		                                }?>
		                        <?
		                        }else if($field_type=="agree"){
		                        ?>
		                            <div style="width: 100%; float: left;">
		                                 <?if(isset($memo)&&$memo!=''){
		                                 ?>
		                                <textarea style='width: 100%; float: left; padding-top: 0px;' readonly><?echo $memo;?></textarea>
		                                <?
		                                }?>
		                                <input type='checkbox' id="<?=$item_id;?>" <?if($item_value==true){echo "checked";}?> tabindex='<?echo $key;?>' <?if($use==1){echo 'required';}?> onclick='agree_box_state("<?=$item_id;?>");' /><label for='<?=$item_id;?>'>동의합니다.</label> 
		                                <input type="hidden" id="<?=$item_id.'_result';?>" name="item_value[]" value="<?=$item_value;?>" />
		                            </div>

		                        <?
		                        }else{
		                          echo '정해진 형식 없음';
		                        }
		                          
		                    }else{
		                        echo '<br/>해당없음 </br>';
		                    }
		                   ?>
		                <!--본문 콘텐츠 수정 버튼 출력-->
		                </div>
		            </div>
		            <!--설문 콘텐츠 출력 끝-->
		    <?
		       }
		    }
		    ?>
		      <!--signature 관련 시작 -->
		      <link href="/assets/signature_pad/assets/jquery.signaturepad.css" rel="stylesheet">
		      <!--[if lt IE 9]><script src="/assets/signature_pad/assets/flashcanvas.js"></script><![endif]-->
		      <!--signature 관련 끝-->
		    <div id='signature_area' style="width: 100%; padding-top: 15px; text-align: center; margin-bottom: 15px;">

		      <div style="padding-top: 15px; text-align: center; margin-bottom: 15px;">
		        제출내용은 공고사업 통합관리솔루션 Ⓖwon과<br/>
		        <?echo $title;?> 담당자에게 제공되어 활용될 수 있습니다.
		       </div>
		      <div class="sigPad">
		          서명
		          <div class="sig sigWrapper" >
		            <div class="typed"></div>
		            <canvas class="pad" width="198" height="55"></canvas>
		            <input type="hidden" name="sig_info" class="output">
		          </div>
		        </div>
		     </div>
		    <!--signature 관련 시작 -->
		    <script src="/assets/signature_pad/jquery.signaturepad.js"></script>
		      <script>
		        $(document).ready(function() {
		          
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


		</div>
	<div id='bt_area' class="con_area_div" style="text-align: center; margin-bottom: 10px; ">
	    <?
	    $today_ymd = date("Ymd H:i");
	    $start_date_ymd = date("Ymd H:i", strtotime( $start_date.$start_time ));
	    $end_date_ymd = date("Ymd H:i", strtotime( $end_date.$end_time ));
	    if($today_ymd>$start_date_ymd&&$today_ymd<$end_date_ymd){
	        $check_apply = 'y';
	    }else{
	        $check_apply = 'n';
	    }
	    ?>
	    <?
	    ?>
	    <?
	    if($check_apply =='y'){
	    ?>
	    <a href='/apl/<?echo $domain?>?page_num=1' target='_blank'>
		    <button id='post_project_info' type="button" onClick='goto_edit();' class='btn btn-default' >
		        수정하기
		    </button>
		</a>
	    <?
	    }else{
	    ?>
	    <?
	    }
	    ?>
	    
	 </div>
  
            </div>
         </div>
    </div>
</div>
</body>
</html>