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
    var css_form_array;
    var css_form_obj_map;
</script>
<!-- easy css.// -->
<script type='text/javascript'>
    //jQuery 있는 상태
    window.onload=function(){
        //scroll 변화시 작동하기

    };
    $(document).ready(function() {
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
                opener.location.reload();
                //if(data =='등록이 완료되었습니다.'){}
            });
    }

    function update_source_code(con) {
        $('#css_con').val(con);
        var code_area = document.getElementById("code_area");
        var code_area_doc = code_area .contentWindow || code_area .contentDocument;
        code_area_doc.set_con();
    }

    function update_form_code() {
        //CSS 관련
        var code_area = document.getElementById("code_area");
        var code_area_doc = code_area .contentWindow || code_area .contentDocument;
        code_area_doc.refresh_con();
        var src = $('#css_con').val();
        console.log(src);
        window.ast = gonzales.srcToCSSP(src);
        var l_css_form_div = $('#tabs-2');
        l_css_form_div.html('');
        var l_guide_map_div = $("<div/>", {
            'id': 'guide_map_div',
            css: {
                'position': 'relative'
            }
        });
        l_guide_map_div.appendTo(l_css_form_div);
        var l_guide_map = $("<img/>", {
            'id': 'guide_map',
            'src': "<?php echo $easy_css_img; ?>",
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
                var l_bodyValue = par['bodyValue'];

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
                            console.log('value:'+selectorValue+","+propertyIdent+","+this.id);
                            var propertyBodyValue = isNaN(selectorValue) ? ['string', selectorValue] : ['number', selectorValue];
                            var propertyBody = ['functionBody', ['ident', bodyIdent], ['operator', '='], propertyBodyValue];
                            var propertyValue = css_get_property_value(propertyType, propertyUnit, propertyBody);
                            var con = css_update(window.ast, selectorKey, propertyIdent, propertyValue);
                            //console.log('RET:'+con);
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
                            console.log('value:'+selectorValue+","+propertyIdent+","+this.id);
                            var propertyBody = ['number', selectorValue];
                            var propertyValue = css_get_property_value(propertyType, propertyUnit, propertyBody);
                            var con = css_update(window.ast, selectorKey, propertyIdent, propertyValue);
                            //console.log('RET:'+con);
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
                            console.log('value:'+selectorValue+","+propertyIdent+","+this.id);
                            var propertyBody = selectorValue;
                            var propertyValue = css_get_property_value(propertyType, propertyUnit, propertyBody);
                            var con = css_update(window.ast, selectorKey, propertyIdent, propertyValue);
                            //console.log('RET:'+con);
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
                console.log(input_id + "," + l_selectorKey + "," + l_propertyIdent);
                l_css_form_div.append("<br/>");
            } else if (l_css_form_type == 'title') {
                console.log(l_css_form_array[i]);
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
</script>
</head>
<body>
<div id=right_top_shape>
    <a href='http://<?=$this->config->item('intro_url');?>/page'><img src='/img/land/right_top_shape.png' class='logo_shape'></a>
</div>
<div id=container>
    <div id=con>
        <div id=con_area>
            <div style='font-weight: bold; margin-top: 10px; padding-left: 10px;'>
                <?//iframe으로 변수 전달 시 세션 유지(ie6이상, 보안 문제로 세션 손실)
                header('P3P: CP="NOI CURa ADMa DEVa TAIa OUR DELa BUS IND PHY ONL UNI COM NAV INT DEM PRE"');?>
                <a href='/makepage/edit_code/1' target='_self'>데스크탑 버전 CSS</a>
                <a href='/makepage/edit_code/2' target='_self'>모바일 버전 CSS</a>
                <a href='/makepage/edit_code/3' target='_self'>데스크탑 버전 js</a>
                <a href='/makepage/edit_code/4' target='_self'>모바일 버전 js</a>
            </div>
            <div id=code_state>[데스크탑 버전] 현재 파일 주소 : <?echo $filename_code;?></div>
            <div id=code_state_m>[모바일 버전] 현재 파일 주소 : <?echo $filename_code;?></div>
            <input id ='file_name' name ='file_name' type='hidden' value='<?echo $filename_code;?>'/>
            <input id ='code_type' name ='code_type' type='hidden' value='<?echo $code_type;?>'/>
            <div id="tabs">
                <ul id="tabs_label" style="display: none;">
                    <li><a href="#tabs-1">소스코드</a></li>
                    <li><a href="#tabs-2">간편변경</a></li>
                </ul>
                <div id="tabs-1">
                    <textarea id='css_con' name='css_con' style='margin-top: 10px; width:95%; '><?echo $read_css;?></textarea><br/>
                    <iframe src='/makepage/code_area' width='95%' height='400px' id='code_area' marginwidth='0' marginheight='0'></iframe>
                </div>
                <div id="tabs-2" style="display: none;">
                </div>
            </div>
            <button id='edit_code_con_mobile'>코드 적용하기</button>
            <button id='edit_code_con'>코드 적용하기</button>
        </div>
    </div>
</div>
<!--모달창 출력부분 시작-->
<div id='modal_content'>
    <div id='modal_txt'>
        가상 팝업 내용 출력부분!
    </div>
    <div id=login_close>
        <a onClick='modal_off()'><img src='/img/land/bt_close.png'></a>
    </div>
</div>
<pre id='editor'>
     //welcome to the gwon!
</pre>
<!--모달창 출력부분 끝 -->
<!--modal창 관련 -->
<script type='text/javascript' src='/js/jquery.simplemodal.js'></script>
</body>
</html>