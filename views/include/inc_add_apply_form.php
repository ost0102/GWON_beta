 <script type="text/javascript">
  
  //접수현황 검색
  function search_add_apply_user(){
    var w_num = $("#w_num").val();
    var name = $("#name").val();
    var email = $("#email").val();
    //alert(w_num+","+name+","+email);
    $("#search_add_apply_user").hide();
    $("#login_close").hide();
    open_modal("<img src='/img/loading.gif' style='width: 30px;'><br/>추가 중입니다.");

    if(name==""){
      //alert('test');
        alert('이름을 입력해주세요.');
        $("#name").focus();
    }else if(email==""){
      //alert('test');
        alert('이메일 입력해주세요.');
        $("#email").focus();
    }else{
      $.post('/mypage/search_add_apply_user',{
          w_num: w_num,
          name: name,
          email: email
      },
      function(data){
          //alert(data);
          //입력값 초기화하기 dev@treeple.net
          $("#login_close").show();
          $("#modal_txt").html(data);
          $('#name').val('');
          $('#email').val('');
          $("#search_add_apply_user").show();
          //접수항목 업데이트
          check_response_list('all')
          /*
          if(data==1){
              alert('등록되었습니다.');
              $('#origin_url_state').html('');
              $('#input_domain_attach').val('');
              //$('#input_origin_url').val(input_domain_check2);
          }
          */
      });

    }
    /**/
    
  }
 </script>
<div id="inc_responses_con_area">
    <div class="inc_resp_con">
      <h3>
        접수자 추가
      </h3>
      추가할 접수자의 이름과 이메일을 입력해주세요.
      <input type="hidden" id="w_num" name="w_num" class="form-control" value="<?echo $w_num;?>" />
      <table border="0px" width="100%" class='inno_table'>
        <tr>
          <td>
            이름<br/>
            <input type="text" tabindex="1" id="name" name="name" class="form-control" placeholder="이름을 입력해주세요." style="ime-mode:inactive;" />
          </td>         
        </tr>
        <tr>
          <td>
            이메일<br/>
            <input type="text" tabindex="2" id="email" name="email" class="form-control"  placeholder="email@gwon.com"/>
              <!-- <input style="width: 90%; " type="email" name="email_address" value="<?php echo $email;?>" />  -->
          </td>   
        </tr>
      </table>
      <div style="width: 100%; text-align: right; margin-top: 10px;">
        <button id="search_add_apply_user" onclick="search_add_apply_user();"class="btn btn-inverse">
          추가하기
        </button>
      </div>
    </div>
</div>