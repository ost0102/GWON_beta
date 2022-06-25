<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Strict//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<?$this->load->view('/include/head_info');?>
<!-- //easy css. -->
<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
<script type='text/javascript'>
    //jQuery 있는 상태
    window.onload=function(){
        //scroll 변화시 작동하기       
        
    };
    $(document).ready(function() {
        //콘텐츠 영역별 기본 정보 가져오기
        update_topcon();
        //modal 관련
        $('#m_close').click(function(){
            $.modal.close();
            $modal_state ='off';
        });
        $modal_state ='off';
        $('body').click(function(){
        });

    });

    function update_topcon(){
        //alert(img_state);
        var w_num = $("#w_num").val();
        var top_img_state = $(':radio[name="top_img_state"]:checked').val();
        var top_title_state = $(':radio[name="top_title_state"]:checked').val();
        var top_date_state = $(':radio[name="top_date_state"]:checked').val();
        //alert(top_img_state);
        //alert(top_title_state);
        //alert(top_date_state);
        if(top_img_state=="show"){
            $("#top_img").show();
        }else{
            $("#top_img").hide();
        }
        if(top_title_state=="show"){
            $("#top_title").show();
        }else{
            $("#top_title").hide();
        }
        if(top_date_state=="show"){
            $("#top_date").show();
        }else{
            $("#top_date").hide();
        }

        /**/$.post('/makepage/update_topcon',{
            w_num: w_num,
            top_img_state: top_img_state,
            top_title_state: top_title_state,
            top_date_state: top_date_state
        },
        function(data){
            //입력값 초기화하기
            open_modal("적용되었습니다.");
            fadeout_modal();
            opener.location.reload(true);
            //window.open('/upload/up1/5','upload_img','width=500,height=430,left=0,top=0,scrollbars=no');
        });
        
    }

</script>
<style>
    body{
        background: #fff;
    }
    #container{
        float: left;
        width: 100%;
        margin-top: 0px;
    }
    #con{
        float: left;
        width: 100%;
        padding: 0px;
        background: #fff;
    }
    #con_area{
        float: left;
        width: 100%;
        text-align: center;
    }
    #tc_con_area{
        float: left;
        width: 100%;
        padding-top: 10px;
        padding-bottom: 30px;
        border-bottom: 1px solid #cdcdcd;
    }
    .topcon_set_area{
        width: 100%;
        padding-top: 10px;
        padding-bottom: 10px;
        border-top: 1px solid #cdcdcd;
        font-family: 'Nanum Gothic';
        text-align: center;
    }
    .topcon_state_bt_area{
        width: 100%;
        float: left;
        text-align: center;
    }
    #bgc_bottom{
        display: none;
    }
    #tcs_top_area{
        float: left;
        width: 100%;
    }
    #tcs_top_area img{
        max-width: 50%;
    }
    #tcs_top_con{
        float: left;
        width: 100%;
        text-align: center;
    }
    .topcon_state{
        width: 100%;
        padding-top:10px;
        padding-bottom:10px;
        font-family: 'Nanum Gothic';
        text-align: center;
    }
    .con_area_div{
        width: 100%;
        padding-top: 20px;
        padding-bottom: 10px;
    }

    .cate_div{
        float: left; 
        margin-right: 5px; 
        margin-bottom: 5px; 
        padding: 10px; 
        border: 1px solid #cdcdcd;
        cursor: pointer;
        text-align: center;
    }
    .img_div{
        float: left; 
        margin-right: 5px; 
        margin-bottom: 5px; 
        padding: 5px; 
        border: 1px solid #cdcdcd;
        cursor: pointer;
        text-align: center;
    }
</style>
</head>
<body>
<div id='container'>
    <div id='con'>
        <div id='con_area'>
                <div style='font-weight: bold; padding: 10px; background: #efefef;margin-bottom: 10px; text-align: center;'>
                    <?//iframe으로 변수 전달 시 세션 유지(ie6이상, 보안 문제로 세션 손실)
                    header('P3P: CP="NOI CURa ADMa DEVa TAIa OUR DELa BUS IND PHY ONL UNI COM NAV INT DEM PRE"');?>
                    <?$this->load->view('/include/inc_design_popup_menu.php');?>
               </div>
                홈페이지 상단의 대표이미지, 제목, 접수기간의 노출 여부를 설정할 수 있습니다.
                <div id='tc_con_area'>
                    <div class='topcon_set_area'> 
                        <input type="hidden" id="w_num" value="<?echo $w_num;?>"/>
                        <b>대표 이미지</b>
                        <label for="show_img"><input type="radio" id="show_img" name="top_img_state" value="show" onclick="update_topcon();" <?if($top_img_url=="show"){echo 'checked';}?>>보이기</label>
                        <label for="noshow_img"><input type="radio" id="noshow_img" name="top_img_state" value="noshow"  onclick="update_topcon();" <?if($top_img_url=="noshow"){echo 'checked';}?>>감추기</label>
                        <br/>
                        <b>제목</b>
                        <label for="show_title"><input type="radio" id="show_title" name="top_title_state" value="show"  onclick="update_topcon();" <?if($top_title=="show"){echo 'checked';}?>>보이기</label>
                        <label for="noshow_title"><input type="radio" id="noshow_title" name="top_title_state" value="noshow"  onclick="update_topcon();" <?if($top_title=="noshow"){echo 'checked';}?>>감추기</label>
                        <br/>
                        <b>접수기간</b>
                        <label for="show_date"><input type="radio" id="show_date" name="top_date_state" value="show"  onclick="update_topcon();" <?if($top_date=="show"){echo 'checked';}?>>보이기</label>
                        <label for="noshow_date"><input type="radio" id="noshow_date" name="top_date_state" value="noshow"  onclick="update_topcon();" <?if($top_date=="noshow"){echo 'checked';}?>>감추기</label>
                    </div>
                    <!--
                    <div class='topcon_state_bt_area'>    
                        <button id='bt_bgc_a' onclick='update_topcon();' class="btn btn-success">저장하기</button>
                     </div>
                    -->
                </div>
                <div id='tc_con_area'>
                     <div id='tcs_top_area'>
                        <div id='tcs_top_con'>
                            <?$now_url = $_SERVER['REQUEST_URI'];
                            $base_url = $this->config->item('base_url');

                            
                            if(isset($domain_url)){
                                $now_call=$this->input->get('now_call');
                                //이미 외부 도메인에서 iframe으로 호출한 거라면..
                                if($now_call=='other_domain'){
                                    $site_domain = $base_url.'/'.$domain;

                                }else{
                                    if($domain_url==''){
                                        //연결된 외부 도메인이 없을 경우 Gwon기본 도메인 사용
                                        $site_domain = $base_url.'/'.$domain;
                                    }else{
                                        $site_domain = 'http://'.$domain_url;
                                    }
                                }
                                
                            }else{
                                //domain_url정보가 없음. 그러면 그냥 기본 url로.. 잘못하면 iframe 수백개 생길수 있으니..
                                $site_domain = $base_url.'/'.$domain;
                            }
                            ?>
                            <?if($logo!='')echo '<img src="'.$logo.'" id="top_img" /><br/>';?>
                            <h2 id='top_title'><?echo $title;?></h2>
                            <span id='top_date'>
                                <b>접수 기간</b><br/>
                                <?echo date("Y년m월d일", strtotime( $start_date ));?>
                                <?echo date("H시i분", strtotime( $start_time ));?>
                                ~<br/>
                                <?echo date("Y년m월d일", strtotime( $end_date ));?>
                                <?echo date("H시i분", strtotime( $end_time ));?>
                            </span>
                        </div>
                    </div>
                </div>

                   
                <script type='text/javascript'>
                    
                </script> 
        </div>
        <div id='bgc_bottom'>
            <a onclick="bgc_m_close();">닫기</a>
        </div>
    </div>
</div>
<!--모달창 출력부분 시작-->
<div id='modal_content'>
     <div id='modal_txt'>
        가상 팝업 내용 출력부분!
    </div>
    <div id='login_close'>
        <a onClick='modal_off()'>닫기</a>
    </div>
</div>
<!--모달창 출력부분 끝 -->
<!--modal창 관련 -->
<script type='text/javascript' src='/js/jquery.simplemodal.js'></script>
</body>
</html>