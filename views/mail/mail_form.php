<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Strict//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<?$this->load->view('/include/head_info');?>
<!--document 영역 style -->
<link href='/css/doc_style.css' rel='stylesheet' />
<script type='text/javascript'>
//jQuery 있는 상태
window.onload=function(){
    check_con_div();
    check_w_mode();
};

$(document).ready(function() {
    //문의하기로 선택한 데이터값 넘기기
    $('#sendmail').click(function(){
        //alert('문의하기 - 되는줄 알았지 :)');
        //변수 설정
        var mail_title = $('#mail_title').val();
        var mail_name = $('#mail_name').val();
        var mail_addr = $('#mail_addr').val();
        var mail_con = $('#mail_con').val();
        var u_id = $('#mail_con').val();

        if(mail_title=='' || mail_name=='' || mail_addr==''){
            alert('기본 정보를 입력해주세요.')
        }else{
            $.post('/mail/send_mail',{
                mail_title: mail_title,
                mail_name: mail_name,
                mail_addr: mail_addr,
                mail_con: mail_con
            },
            function(data){
                alert('접수되었습니다.');
                //입력값 초기화하기
                //open_modal(data);
                //fadeout_modal();
                //alert('페이지의 콘텐츠 입력단계로 이동합니다.');
                if(u_id !==''){
                    location.href = '/mypage#!5';
                }else{
                    location.href = '/mail/mail_form';
                }
            });
        }
      //location.replace('/makepage/outline/');
    });
    
});

</script>
</head>
<body>
<div id='right_top_shape'>
    <a href='http://<?=$this->config->item('intro_url');?>/page'><img src='/img/land/right_top_shape.png' class='logo_shape' alt='easymenu_logo_shape' /></a>
</div>
<div id='container'>
    <div class='menu_left'>
        <div id='menu_area'>
            <!-- sub_top area include -->
            <?$this->load->view('/include/sub_top');?>
            <!-- menu area 시작 -->
            <?$this->load->view('/include/left_menu');?>
            <!-- menu area 끝 -->
        </div>
        <div class='bt_sub'>
        </div>
    </div>
</div>
<div class='contents'>
    <!--상단영역 -->
    <?$this->load->view('/include/top_area');?>
    <!--상단영역 끝-->
    <!--콘텐츠 영역 -->
    <div id='content_area'>
        <div id='con_div'>
            <!-- Contents Area Start -->
            <div id='con_area'>
                <h1 style="margin-top:10px; padding-bottom:10px; margin-bottom:10px; border-bottom: 1px solid #cdcdcd;">
                    문의하기
                </h1>
                <div id='con_main'>
                    <div class='script'>
                        help@treeple.net 로 문의 사항이 접수되며, 메일을 통해 답변을 드립니다.
                    </div>
                    <hr style="margin-top: 10px; margin-bottom: 10px;"/>
                    <div id='mail_area'>
                        <style type="text/css">
                            #price_table input, #price_table textarea{
                                width: 95%;
                            }
                            .price_td_t{
                                width: 80px;
                            }
                        </style>
                        <?
                            $username=$this->session->userdata('username');
                            $email=$this->session->userdata('email');
                            $user=$this->session->userdata('ez_users');
                        ?>
                        <input type='hidden' id='u_id' value='<?if(isset($user)){echo $user;}?>' />
                        <table id='price_table'>
                            <tr>
                                <td class='price_td_t'>이름</td>
                                <td>
                                    <input type='text' id='mail_name' value='<?if(isset($username)){echo $username;}?>' />
                                </td>
                            </tr>
                            <tr>
                                <td class='price_td_t'>이메일</td>
                                <td>
                                    <input type='email' id='mail_addr' value='<?if(isset($email)){echo $email;}?>' />
                                </td>
                            </tr>
                            <tr>
                                <td class='price_td_t'>제목</td>
                                <td>
                                    <input type='text' id='mail_title' />
                                </td>
                            </tr>
                            <tr>
                                <td class='price_td_t'>내용</td>
                                <td>
                                    <textarea id='mail_con'></textarea>
                                </td>
                            </tr>
                        </table>
                        <div class='bt_start'>
                            <button id="sendmail" class="btn btn-success" alt="가격 계산기 출력하기">문의하기</button>
                        </div>
                    </div>
                    <!-- 연락처 정보 시작 -->
                    <?$this->load->view('/include/call_info');?>
                    <!-- copyright area 시작 -->
                    <?$this->load->view('/include/bottom');?>
                    <!-- copyright area 끝 -->
                </div>
            </div>
            <!-- Contents Area finish -->
        </div>
    </div>
    <!--콘텐츠 영역 끝 -->
</div>

<div id='modal_content'>
    <div id='modal_txt'>
        <!--내용 출력부분 시작-->
        이곳에 내용 출력
    </div>
    <div id='login_close'>
        <a onclick='modal_off()'><img src='/img/land/bt_close.png' alt='' /></a>
    </div>
</div>
<!--모달창 출력부분 끝 -->
<!--modal창 관련 -->
<script type='text/javascript' src='/js/jquery.simplemodal.js'></script>
</body>
</html>