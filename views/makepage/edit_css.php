<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Strict//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<?$this->load->view('/include/head_info');?>
<!-- //easy css. -->
<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
<script type="text/javascript" src='/js/gonzales.js'></script>
<script type="text/javascript" src='//cdnjs.cloudflare.com/ajax/libs/underscore.js/1.6.0/underscore-min.js'></script>
<script type="text/javascript" src='/js/css_common.js'></script>
<script type='text/javascript' src='/js/editor/ace.js' charset='utf-8'></script>
<script type="text/javascript">
    var easy_css_url = "<?echo $easy_css_url;?>";
    var easy_css_img = "<?echo $easy_css_img;?>";
    var css_form_array;
    var css_form_obj_map;
</script>
<!-- easy css.// -->
<script type='text/javascript'>
    //jQuery 있는 상태
    window.onload=function(){
        //scroll 변화시 작동하기       
        code_resize();
    };
    $(document).ready(function() {
        //모바일 css 일경우, 부모창 리로드하기
        var now_code = '<?echo $code_type;?>';
        if(now_code==1){
            //opener.location.reload();
            window.opener.view_mode('desktop');
            opener.location.reload(true);
        }else if(now_code==2){
            //opener.location.reload();
            window.opener.view_mode('mobile');  
        }else{
            var check_view_mode =$('#container_iframe', opener.document).css('display');
            if(check_view_mode=='none'){
                //현재 부모창이 desktop 버전일경우 리로드해라
                window.opener.view_mode('desktop');
            opener.location.reload(true);
            }else{
                //현재 부모창이 mobile 버전 보기일경우 모바일보기에서 새로고침해라
                window.opener.view_mode('mobile');
            }
        }
        
        //초기값 출력하기
        editor_change();

        //project_information
        $('#edit_code_con').click(function(){
            var code_area = document.getElementById("code_area");
            var code_area_doc = code_area .contentWindow || code_area .contentDocument;
            code_area_doc.get_con();
        });

        $('#edit_code_con_mobile').click(function(){
            update_code();
        });

        //modal 관련
        $('#m_close').click(function(){
            $.modal.close();
            $modal_state ='off';
        });
        $modal_state ='off';
        $('body').click(function(){
            check_modal();
        });

        if ($.trim(easy_css_url)) {
            $.getJSON( easy_css_url, function( data ) {
                css_form_array = data;
                $('#tabs_label').show();
                $('#tabs-2').show();
                $(function() {
                    $( "#tabs" ).tabs({
                        beforeActivate: function( event, ui ) {
                            if (ui.newPanel.attr('id') == "tabs-2") {
                                update_form_code();
                            }
                        }
                    });
                });
            });
        }
    });

    $(window).resize(function(){ 
        code_resize();
    });

    function code_resize(){

        var win_h = $(window).height()-150;

        //$('#con_area').css('height',win_h);
        $('#code_area').css('height',win_h);
    }

    function update_code(){
        //실제 콘텐츠 수정 후 DB에 저장하기
        var file_name = $('#file_name').val();
        var css_con = $('#css_con').val();
         
        $.post('/makepage/update_css',{
                file_name: file_name,
                css_con: css_con
                },
            function(data){
                //alert(data);
                //입력값 초기화하기
                open_modal(data);
                $('#val_url').val('');
                $('#val_url_txt').val('');
                //location.replace('/makepage/edit_css');
                var now_code = '<?echo $code_type;?>';
                if(now_code==1){
                    //CSS - 데스크탑
                    //opener.location.reload();
                    window.opener.view_mode('desktop');
                    //opener.location.reload();
                    $("#con_iframe" , opener.document).get(0).contentDocument.location.reload(true);
                }else if(now_code==2){
                    //CSS - 모바일
                    //opener.location.reload();
                    window.opener.view_mode('mobile');
                    $("#con_iframe" , opener.document).get(0).contentDocument.location.reload(true);
                }else{
                    //자바스크립트 - 데스크탑/모바일은 상황에 따라..
                    var check_view_mode =$('#con_iframe', opener.document).css('width');
                    //alert(check_view_mode);
                    if(check_view_mode!='300px'){
                        //현재 부모창이 desktop 버전일경우 리로드해라
                        $("#con_iframe" , opener.document).get(0).contentDocument.location.reload(true);
                    }else{
                        //현재 부모창이 mobile 버전 보기일경우 모바일보기에서 새로고침해라
                        $("#con_iframe" , opener.document).get(0).contentDocument.location.reload(true);
                        //window.opener.view_mode('mobile');
                    }
                }
                //if(data =='등록이 완료되었습니다.'){}
        }); 
    }

    //CSS간편수정
    function update_source_code(con) {
        $('#css_con').val(con);
        var code_area = document.getElementById("code_area");
        var code_area_doc = code_area .contentWindow || code_area .contentDocument;
        code_area_doc.set_con();
    }

    //CSS간편수정
    function update_form_code() {
        //CSS 관련
        var code_area = document.getElementById("code_area");
        var code_area_doc = code_area .contentWindow || code_area .contentDocument;
        code_area_doc.refresh_con();
        var src = $('#css_con').val();
        window.ast = gonzales.srcToCSSP(src);
        console.log(gonzales.csspToTree(window.ast));
        var l_css_form_div = $('#tabs-2');
        l_css_form_div.html('');
        var l_guide_map_div = $("<div/>", {
            'id': 'guide_map_div',
            css: {
                'position': 'relative'
            }
        });
        //l_guide_map_div.appendTo(l_css_form_div);
        var l_guide_map = $("<img/>", {
            'id': 'guide_map',
            'src': easy_css_img,
            'alt': "Guide Map"
        });
        l_guide_map.appendTo(l_guide_map_div);

        var l_css_form_array = css_form_array ? css_form_array : new Array();
        css_form_obj_map = new Object();
        for (var i = 0; i < l_css_form_array.length; i++) {
            var l_css_form_type = l_css_form_array[i]['type'];
            if (l_css_form_type == 'obj') {
                var l_css_form_obj = l_css_form_array[i]['obj'];
                var l_css_form_opt = l_css_form_array[i]['opt'];
                var l_selectorKey = l_css_form_obj['selectorKey'];
                var l_propertyIdent = l_css_form_obj['propertyIdent'];
                var l_propertyType = l_css_form_obj['propertyType'];
                var l_propertyUnit = l_propertyType == 'percentage' ? l_propertyType : l_css_form_obj['propertyUnit'];
                var l_bodyIdent = l_css_form_obj['bodyIdent'];
                var sel = css_select(window.ast, l_selectorKey, l_propertyIdent);
                var par = css_parse_property_value(sel['obj']);
                console.log(l_selectorKey+','+l_propertyIdent);
                console.log(sel);
                console.log(par);
                var l_bodyValue = par['bodyValue'];
                if (!l_bodyValue) {
                    $("<label/>", {
                        text: l_propertyIdent,
                        css: {'text-decoration': 'line-through'}
                    }).appendTo(l_css_form_div);
                    //$("<br/>").appendTo(l_css_form_div);
                    continue;
                }

                var input_id = "css_form-" + i;

                $("<label/>", {
                    'for': input_id,
                    text: l_propertyIdent
                }).appendTo(l_css_form_div);

                css_form_obj_map[input_id] = {'selectorKey':l_selectorKey, 'propertyIdent':l_propertyIdent, 'propertyType':l_propertyType, 'propertyUnit':l_propertyUnit, 'bodyIdent':l_bodyIdent, 'bodyValue':l_bodyValue};

                var input_obj;
                switch (l_propertyType) {
                    case 'funktion':
                        input_obj = $("<input/>", {
                            'id': input_id,
                            'type': 'text'
                        });
                        input_obj.val( l_bodyValue );
                        input_obj.change(function() {
                            var css_form_obj = css_form_obj_map[this.id];
                            var selectorKey = css_form_obj['selectorKey'];
                            var propertyIdent = css_form_obj['propertyIdent'];
                            var propertyType = css_form_obj['propertyType'];
                            var propertyUnit = css_form_obj['propertyUnit'];
                            var bodyIdent = css_form_obj['bodyIdent'];
                            var selectorValue = $(this).val();
                            var propertyBodyValue = isNaN(selectorValue) ? ['string', selectorValue] : ['number', selectorValue];
                            var propertyBody = ['functionBody', ['ident', bodyIdent], ['operator', '='], propertyBodyValue];
                            var propertyValue = css_get_property_value(propertyType, propertyUnit, propertyBody);
                            var con = css_update(window.ast, selectorKey, propertyIdent, propertyValue);
                            update_source_code(con);
                        });
                        input_obj.appendTo(l_css_form_div);
                        break;
                    case 'dimension':
                    case 'percentage':
                        input_obj = $("<input/>", {
                            'id': input_id,
                            'type': 'number'
                        });
                        input_obj.val( l_bodyValue );
                        input_obj.change(function() {
                            var thisId = this.id;
                            var thisOpt = $( "input:radio[name="+thisId+"]:checked" );
                            var thisOptValue = thisOpt ? thisOpt.val() : null;
                            var css_form_obj = css_form_obj_map[thisId];
                            var selectorKey = css_form_obj['selectorKey'];
                            var propertyIdent = css_form_obj['propertyIdent'];
                            var propertyType = css_form_obj['propertyType'];
                            var propertyUnit = css_form_obj['propertyUnit'];
                            var selectorValue = $(this).val();
                            if (thisOptValue) {
                                propertyType = (thisOptValue == 'percentage') ? 'percentage' : 'dimension';
                                propertyUnit = thisOptValue;
                            }
                            var propertyBody = ['number', selectorValue];
                            var propertyValue = css_get_property_value(propertyType, propertyUnit, propertyBody);
                            var con = css_update(window.ast, selectorKey, propertyIdent, propertyValue);
                            update_source_code(con);
                        });
                        input_obj.appendTo(l_css_form_div);
                        if (l_css_form_opt) {
                            for (var input_opt_index in l_css_form_opt) {
                                var input_opt_value = l_css_form_opt[input_opt_index];
                                var input_opt_obj = $("<input/>", {
                                    'name': input_id,
                                    'type': 'radio',
                                    'value': input_opt_value
                                });
                                input_opt_obj.change(function() {
                                    var input_obj_id = '#'+this.name;
                                    $(input_obj_id).change();
                                });
                                l_css_form_div.append("<span>&nbsp;</span>");
                                input_opt_obj.appendTo(l_css_form_div);
                                l_css_form_div.append("<span>&nbsp;"+(input_opt_value == 'percentage' ? '%' : input_opt_value) + "</span>");
                                if (l_propertyUnit == input_opt_value) input_opt_obj.prop( "checked", true );
                            }
                            if (!$( "input:radio[name="+input_id+"]:checked" ).val()) {
                                var input_opt_obj = $("<input/>", {
                                    'name': input_id,
                                    'type': 'radio',
                                    'value': l_propertyUnit
                                });
                                input_opt_obj.change(function() {
                                    var input_obj_id = '#'+this.name;
                                    $(input_obj_id).change();
                                });
                                l_css_form_div.append("<span>&nbsp;</span>");
                                input_opt_obj.appendTo(l_css_form_div);
                                l_css_form_div.append("<span>&nbsp;"+(l_propertyUnit == 'percentage' ? '%' : l_propertyUnit) + "</span>");
                                input_opt_obj.prop( "checked", true );
                            }
                        } else {
                            var input_opt= $("<span/>", {
                                text: l_propertyUnit == 'percentage' ? '%' : l_propertyUnit
                            });
                            input_opt.appendTo(l_css_form_div);
                        }
                        break;
                    case 'ident':
                        if (l_css_form_opt) {
                            input_obj = $("<select/>", {
                                'id': input_id,
                                'type': 'text'
                            });
                            for (var input_opt_index in l_css_form_opt) {
                                var input_opt_value = l_css_form_opt[input_opt_index];
                                var input_opt_sel = (input_opt_value == l_bodyValue) ? {text: input_opt_value, 'selected': 'selected'} : {text: input_opt_value};
                                var input_opt_obj = $("<option/>", input_opt_sel);
                                input_opt_obj.appendTo(input_obj);
                            }
                            if (!input_obj.val()) {
                                var input_opt_obj = $("<option/>", {
                                    text: l_bodyValue
                                });
                                input_opt_obj.prependTo(input_obj);
                                input_opt_obj.select();
                            }
                        } else {
                            input_obj = $("<input/>", {
                                'id': input_id,
                                'type': 'text'
                            });
                            input_obj.val( l_bodyValue );
                        }
                        input_obj.change(function() {
                            var css_form_obj = css_form_obj_map[this.id];
                            var selectorKey = css_form_obj['selectorKey'];
                            var propertyIdent = css_form_obj['propertyIdent'];
                            var propertyType = css_form_obj['propertyType'];
                            var propertyUnit = css_form_obj['propertyUnit'];
                            var bodyIdent = css_form_obj['bodyIdent'];
                            var selectorValue = $(this).val();
                            var propertyBody = selectorValue;
                            var propertyValue = css_get_property_value(propertyType, propertyUnit, propertyBody);
                            var con = css_update(window.ast, selectorKey, propertyIdent, propertyValue);
                            update_source_code(con);
                        });
                        input_obj.appendTo(l_css_form_div);
                        break;
                    case 'vhash':
                        if (l_css_form_opt) {
                            input_obj = $("<select/>", {
                                'id': input_id,
                                'type': 'text'
                            });
                            for (var input_opt_index in l_css_form_opt) {
                                var input_opt_value = l_css_form_opt[input_opt_index];
                                var input_opt_obj = $("<option/>", {
                                    text: input_opt_value
                                });
                                input_opt_obj.appendTo(input_obj);
                                if (input_opt_value == l_bodyValue) input_opt_obj.select();
                            }
                            if (!input_obj.val()) {
                                var input_opt_obj = $("<option/>", {
                                    text: l_bodyValue
                                });
                                input_opt_obj.prependTo(input_obj);
                                input_opt_obj.select();
                            }
                        } else {
                            input_obj = $("<input/>", {
                                'id': input_id,
                                'type': 'text'
                            });
                            input_obj.val( l_bodyValue );
                        }
                        input_obj.change(function() {
                            var css_form_obj = css_form_obj_map[this.id];
                            var selectorKey = css_form_obj['selectorKey'];
                            var propertyIdent = css_form_obj['propertyIdent'];
                            var propertyType = css_form_obj['propertyType'];
                            var propertyUnit = css_form_obj['propertyUnit'];
                            var bodyIdent = css_form_obj['bodyIdent'];
                            var selectorValue = $(this).val();
                            var propertyBody = selectorValue;
                            var propertyValue = css_get_property_value(propertyType, propertyUnit, propertyBody);
                            var con = css_update(window.ast, selectorKey, propertyIdent, propertyValue);
                            update_source_code(con);
                        });
                        input_obj.appendTo(l_css_form_div);
                        break;
                    default:
                        input_obj = $("<span/>", {
                            'id': input_id,
                            text: 'Not Support Property.'
                        });
                }
                l_css_form_div.append("<br/>");
            } else if (l_css_form_type == 'title' && easy_css_img) {
                var l_guide_map_a = $("<a/>", {
                    'href': '#section-'+l_css_form_array[i]['section'],
                    css: {
                        'position': 'absolute',
                        'left': l_css_form_array[i]['guideLoc'][0],
                        'top': l_css_form_array[i]['guideLoc'][1]
                    }
                }).appendTo(l_guide_map_div);
                $("<button/>", {
                    text: l_css_form_array[i]['text'],
                    css: {
                        'text-align': 'center',
                        'backgroundColor': 'transparent',
                        'borderStyle': 'none',
                        'width': l_css_form_array[i]['guideLoc'][2],
                        'height': l_css_form_array[i]['guideLoc'][3]
                    }
                }).appendTo(l_guide_map_a);
                $("<br/>").appendTo(l_css_form_div);
                $("<a/>", {
                    'id': 'section-'+l_css_form_array[i]['section']
                }).appendTo(l_css_form_div);
                $("<h1/>", {
                    text: l_css_form_array[i]['text']
                }).appendTo(l_css_form_div);
                $("<br/>").appendTo(l_css_form_div);
                //l_css_form_div.append("<br/>");
            }
        }
    }

    function editor_change(view_val){
        /*
        모바일/데스크탑 체크하기.
        값에 따라 펼침메뉴 초기값 설정하기
        에디터 타입 설정하기
        */
        var mobileKeyWords;
        var useragent = 'desktop';
        var now_act;
        mobileKeyWords = new Array('iPhone', 'iPod','iPad','Android');

        for (var word in mobileKeyWords) {
           if (navigator.userAgent.match(mobileKeyWords[word]) != null) {
              useragent = navigator.userAgent.match(mobileKeyWords[word]);
              break;
           }
        }
        //$('#editor_mode').before( '<div>'+view_val+'</div');
        if(view_val){
            //view_val 값이 있을 경우 버튼에서 온 것으로 판단
            if(view_val == 2){
                now_act=2;        
            }else{
                now_act=1;
            }

        }else{
            //view_val 값이 없을 경우만 체크하기
            if(useragent != 'desktop'){
                now_act=2;        
            }else{
                now_act=1;
            }
        }

        if(now_act == 1){
            //모바일
             $("#editor_mode").val("1").attr("selected", "selected");
             $('#css_con').css('visibility','hidden');
             $('#css_con').css('height',0);
             $('#code_area').css('visibility','visible');
             $('#code_area').css('display','block');
             $('#code_area').css('height',400);
             $('#edit_code_con_mobile').css('display','none');
             $('#edit_code_con').css('display','block');
             //$('#editor_mode').before( '<div>test</div');
                    
        }else{
             //데스크탑
            $("#editor_mode").val("2").attr("selected", "selected");
            $('#css_con').css('visibility','visible');
            $('#css_con').css('height',400);
            $('#code_area').css('visibility','hiddne');
            $('#code_area').css('display','none');
            $('#code_area').css('height',0);
            $('#edit_code_con_mobile').css('display','block');
            $('#edit_code_con').css('display','none');
        }
        
    }

    function check_device_editor_type(){
        /*
        모바일/데스크탑 체크하기.
        값에 따라 펼침메뉴 초기값 설정하기
        에디터 타입 설정하기
        */
        var mobileKeyWords;
        var useragent = 'desktop';
        mobileKeyWords = new Array('iPhone', 'iPod','iPad','Android');

        for (var word in mobileKeyWords) {
           if (navigator.userAgent.match(mobileKeyWords[word]) != null) {
              useragent = navigator.userAgent.match(mobileKeyWords[word]);
              break;
           }
        }
        if(useragent != 'desktop'){
            //접근 디바이스가 아이폰, 안드로이드 쪽이라면.. 
            /*
            1. 펼침메뉴의 selected값을 선정해라.
            2. 에디터의 종류를 설정
            */ 
            $("#editor_mode").val("2").attr("selected", "selected");
            $('#css_con').css('visibility','visible');
            $('#css_con').css('height',400);
            $('#code_area').css('visibility','hidden');
            $('#code_area').css('height',0);
                    
        }else{
             $("#editor_mode").val("1").attr("selected", "selected");
             $('#css_con').css('visibility','hidden');
             $('#css_con').css('height',0);
             $('#code_area').css('visibility','visible');
             $('#code_area').css('height',400);
        }
    }
    function bgc_m_close(){
        self.close();
    }
</script>
</head>
<body>
<div id='container' style='margin-top: 0px;'>
    <div id='con' style='padding: 0px;'>
        <div id='con_area'>
                <div style='font-weight: bold; padding: 10px; background: #efefef;margin-bottom: 10px; text-align: center;'>
                    <?//iframe으로 변수 전달 시 세션 유지(ie6이상, 보안 문제로 세션 손실)
                    header('P3P: CP="NOI CURa ADMa DEVa TAIa OUR DELa BUS IND PHY ONL UNI COM NAV INT DEM PRE"');?>
                    <?$this->load->view('/include/inc_design_popup_menu.php');?>
               </div>
               <div style='font-weight: bold; padding-left: 10px;'>
                    <?//iframe으로 변수 전달 시 세션 유지(ie6이상, 보안 문제로 세션 손실)
                    header('P3P: CP="NOI CURa ADMa DEVa TAIa OUR DELa BUS IND PHY ONL UNI COM NAV INT DEM PRE"');?>
                    CSS [ 
                    <a href='/makepage/edit_code/1' target='_self'>데스크탑</a> , 
                    <a href='/makepage/edit_code/2' target='_self'>모바일</a> ]
                    JS [ 
                    <a href='/makepage/edit_code/3' target='_self'>데스크탑</a> , 
                    <a href='/makepage/edit_code/4' target='_self'>모바일</a> ]
                </div>
                <div id='code_top_area'>
                    <table width='95%;'>
                        <tr>
                            <td width='70%;' align='left'>
                                <select name='editor_mode' id="editor_mode" onchange="editor_change(value);">
                                    <option value="1" id='editor_mode_desktop'>desktop용 editor</option>
                                    <option value="2" id='editor_mode_mobile'>모바일용 editor</option>
                                </select>
                            </td>
                            <td align='right'>
                                <button id='edit_code_con' class="btn btn-success" style='float: right; margin-right: 10px;'>코드 적용</button>
                                <button id='edit_code_con_mobile' class="btn btn-success" style='float: right; margin-right: 10px;'>코드 적용</button>
                            </td>
                        </tr>
                    </table>
                </div>
                <div id='code_state'>현재 파일 주소 : <?echo $filename_code;?></div>
                <input id ='file_name' name ='file_name' type='hidden' value='<?echo $filename_code;?>'/>
                <input id ='code_type' name ='code_type' type='hidden' value='<?echo $code_type;?>'/>
                <div id="tabs" style="margin-bottom: 0px;">
                    <ul id="tabs_label" style="display: none;">
                        <li><a href="#tabs-1">소스코드</a></li>
                        <li><a href="#tabs-2">간편변경</a></li>
                    </ul>
                    <div id="tabs-1">
                        <iframe src='/makepage/code_area' width='98%' height='400px' id='code_area' marginwidth='0' marginheight='0'></iframe>
                        <textarea id='css_con' name='css_con' style='width:95%; '><?echo $read_css;?></textarea><br/>
                    </div>
                    <div id="tabs-2" style="display: none;">
                    </div>
                </div>
        </div>
    </div>
</div>
<!--모달창 출력부분 시작-->
<div id='modal_content'>
     <div id='modal_txt'>
        가상 팝업 내용 출력부분!
    </div>
    <div id='login_close'>
        <a onClick='modal_off()'><img src='/img/basic/bt_close.png'></a>
    </div>
</div>
<!--모달창 출력부분 끝 -->
<!--modal창 관련 -->
<script type='text/javascript' src='/js/jquery.simplemodal.js'></script>
</body>
</html>