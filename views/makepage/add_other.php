<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?$this->load->view('/include/head_info');?>

    <!--link href="css/screen_origin.css" type="text/css" rel="stylesheet" media="screen,projection" /-->
    <script type="text/javascript">
        //jQuery 있는 상태
        window.onload=function(){
	//$('#sc2_2').hide();
	check_domain_atch('<?echo $w_num;?>');

            $(window).scroll(function(){
                var scr_now = $(document).scrollTop();
                var win_h = $(window).height();
                var doc_h = $(document).height();
                var bottom_area = $("#bt_area").offset().top;

                //$("#bt_area_on").html("<span style='color: #000;'>scr_now : "+scr_now+" win_h : "+win_h+" doc_h : "+doc_h+" bottom_area : "+bottom_area+"</span>");

                /**/
                if(scr_now+win_h>=bottom_area){
                     $("#bt_area_on").fadeOut();
                     $("#bt_area").css("visibility","visible");
                }else{
                     $("#bt_area_on").fadeIn();
                     $("#bt_area").css("visibility","hidden");
                }
            });
        };
        $(document).ready(function(){
	//팀원정보, 팀정보 로드하기
	check_teammate();
	check_team();
	check_link();
	check_tags();

	//하단 버튼 영역 고정
	var bt_con = $("#bt_area").html();
	$("#bottom_area").append("<div id='bt_area_on'>"+bt_con+"</div>");
	$("#bt_area").css("visibility","hidden");


	//퍼블리싱 여부 체크하기 : 퍼블리싱 된 정보일 경우, 추가정보 입력하기 영역 펼쳐보이게
	var check_publish = '<?echo $publish;?>';
	if(check_publish !== '0000-00-00'){
		//버튼 가리고, 내용 보이게
		$('#bt_add_other').hide();
		$('#add_other_info').slideDown();
	}
	/**/
	//url 중복 체크
	//보유 도메인 URL 입력 검사
	$('#input_domain_attach').keyup(function(e){
	    var input_domain = $('#input_domain_attach').val();
	    if(input_domain.indexOf('http://')>-1 || input_domain.indexOf('https://')>-1){
	    	//alert('test');
	        var input_domain_check = input_domain.replace('http://', '');
	        var input_domain_check2 = input_domain_check.replace('https://', '');
	        alert('http:// 혹은 https:// 는 제외하고 입력됩니다.');
	   		$('#input_domain_attach').val(input_domain_check2);
	   		input_domain = input_domain_check2;
	    }
	    var input_w_num = $('#w_num').val();
	    var lastChar = input_domain.charAt(input_domain.length-1);
	    if(lastChar == "/"){
	    	//마지막 문자열에 /가 들어가있으면, 빼고 저장하기
	    	var input_domain = input_domain.slice(0,-1); //문자
	    }
	    //그래도 / 가 있다면 도메인이 아니라 상세 주소 정보가 온 것임. 그럼 빼기
	    if(input_domain.indexOf("/") !== -1){
	    	//도메인 형식임. 저장 실행하기
	    	//alert(input_domain);
		$('#origin_url_state').show();
	    	$('#origin_url_state').html('도메인의 형식이 잘못되었습니다. 확인해주세요.');
	    }else{
		    $.post('/makepage/check_domain2',{
		            input_domain: input_domain,
		            input_w_num: input_w_num
		        },
		        function(data){
		            //alert(data);
		            //입력값 초기화하기
		            //open_modal(data);
		            $('#origin_url_state').show();
		            if(data==1){
		                $('#origin_url_state').html('등록 가능한 도메인입니다. (<a href="javascript:add_domain_atch(\''+input_domain+'\');">등록하기</a>)');
		                //$('#input_origin_url').val(input_domain_check2);
		            }else if(data==2){
		                $('#origin_url_state').html('해당 도메인은 현재 본 프로젝트의 도메인으로 설정되어 있습니다.');
		                //$('#input_origin_url').val(input_domain_check2);
		            }else if(data==3){
		                $('#origin_url_state').html('보유 중이신 도메인명을 입력하세요.');
		            }else{
		            	alert(data);
		                $('#origin_url_state').html(data);
		                $('#input_domain_attach').val('');
		            }
		        });
	    }
	});


	//공모 홈페이지 URL 형식 검사
	$('#input_origin_url').keyup(function(e){
	    var input_domain = $('#input_origin_url').val();
	    if(input_domain.indexOf('http://')>-1 || input_domain.indexOf('https://')>-1){
	    }else{
	    	var add_http = "http://"+input_domain;
	    	var input_domain = $('#input_origin_url').val(add_http);
	    	alert("공모 홈페이지 URL은 http:// 혹은 https://가 필수입니다. 확인후 정확한 정보를 입력해주세요.");
	    	//$('#origin_url_scription').html("공모 홈페이지 URL은 http:// 혹은 https://가 필수입니다.");
	    }
	    
	});

	$('#linked_url').keyup(function(e){
	    var input_domain = $('#linked_url').val();
	    if(input_domain.indexOf('http://')>-1 || input_domain.indexOf('https://')>-1){
	    }else{
	    	var add_http = "http://"+input_domain;
	    	var input_domain = $('#linked_url').val(add_http);
	    	alert("URL은 http:// 혹은 https://가 필수입니다. 확인후 정확한 정보를 입력해주세요.");
	    	//$('#origin_url_scription').html("공모 홈페이지 URL은 http:// 혹은 https://가 필수입니다.");
	    }
	    
	});
	
	
	//카테고리의 input변수가 있을 경우, 해당 input box의 style 변경하기
	if($('#input_cate').val()){
		var cate_id = $('#input_cate').val();
		var cate_div = '#cate_div_'+cate_id;
		$('.cate_div').each(function() {
			//background_일괄 초기화
			$(this).css('border','1px solid #cdcdcd;');
			$(this).css('background','#ffffff');
		});
		//선택한 div만 색변경하기
		$(cate_div).css('background','#c1dddd');
		$('#input_cate').val(cate_id);
	}
	//project img 의 input변수가 있을 경우, 해당 input box의 style 변경하기
	if($('#input_img').val()!=""){
		var img_id = $('#input_img').val();
		var select_img = '#select_img_'+img_id;
		$('.img_div').each(function() {
			//background_일괄 초기화
			$(this).css('border','1px solid #cdcdcd;');
			var now_img_id = $(this).attr('id')+" img";
			var now_img = $("#"+now_img_id).attr('src');
			if(now_img==img_id){
				//선택한 div만 색변경하기
				$(this).css('background','#c1dddd');
			}else{
				$(this).css('background','#ffffff');
			}
		});
	}
	
	//origin 정보가 있을 경우 style 변경하기
	if($('#input_origin_url').val()){
		//기존 스타일 없애기
		$('#input_origin_url').removeClass();
		$('#input_origin_url').addClass('focus_area');
	}
	
	//project_information
	$("#post_linked_url").click(function(){
	  var w_num = $('#w_num').val();
	  var linked_url = $('#linked_url').val();
	  var linked_url_title = $('#linked_url_title').val();
	  var linked_url_txt = $('#linked_url_txt').val();
	  if(linked_url==''){
		 alert('관련 링크의 URL주소를 입력해주세요.');
	  }else  if(linked_url_title==''){
		 alert('관련 링크의 제목을 입력해주세요.');
	  }else  if(linked_url_txt==''){
		 alert('관련 링크에 대해 한줄로 설명을 입력해주세요.');
	  }else{     
		   $.post("/makepage/input_linked_url",{
			w_num: w_num,
			linked_url: linked_url,
			linked_url_title: linked_url_title,
			linked_url_txt: linked_url_txt
			},
		   function(data){
			//alert(data);
			//입력값 초기화하기
			open_modal(data);
			fadeout_modal();
			$('#linked_url').val('');
			$('#linked_url_title').val('');
			$('#linked_url_txt').val('');
			//if(data =="등록이 완료되었습니다."){}
			check_link();
		   }); 
		  }
	});
	
	//연관정보 수정버튼 클릭시 동작하는 영역
	$("#post_linked_url_edit").click(function(){
	  var w_num = $('#linked_pnum_edit').val();
	  var linked_url = $('#linked_url_edit').val();
	  var linked_url_title = $('#linked_url_title_edit').val();
	  var linked_url_txt = $('#linked_url_txt_edit').val();
	  if(linked_url==''){
		 alert('관련 링크의 URL주소를 입력해주세요.');
	  }else  if(linked_url_title==''){
		 alert('관련 링크의 제목을 입력해주세요.');
	  }else  if(linked_url_txt==''){
		 alert('관련 링크에 대해 한줄로 설명을 입력해주세요.');
	  }else{     
		   $.post("/makepage/input_linked_url_edit",{
			w_num: w_num,
			linked_url: linked_url,
			linked_url_title: linked_url_title,
			linked_url_txt: linked_url_txt
			},
		   function(data){
			//alert(data);
			//입력값 초기화하기
			open_modal(data);
			fadeout_modal();
			$('#linked_url_edit').val('');
			$('#linked_url_title_edit').val('');
			$('#linked_url_txt_edit').val('');
			//if(data =="등록이 완료되었습니다."){}
			$('#linked_url_add').slideUp("slow");
	   		$('#linked_url_edit_area').slideUp('slow');
			check_link();
		   }); 
		  }
	});
	//Search team mate
	/*팀검색 구 코드
	$("#search_teammate").click(function(){
	  var input_team_mate = $('#input_team_mate').val();
	   $.get("/team/search_project_mate/"+input_team_mate,function(data,status){
			//alert("Data: " + data + "\nStatus: " + status);
			$('#search_result_team_mate').html(data);
			$('#search_result_team_mate').show();
			//사용자 정보를 받은 후, 프로젝트 팀원으로 등록하는 기능 개발하기
	   });
	});
	*/
	//Search team info
	$("#search_team_name").click(function(){
	  var input_team = $('#input_team_name').val();
	  var where = 'add_other';
	   $.post("/team/search_team/"+input_team,{
			where: where
			},
		   function(data){
			 //alert(data);
			 //open_modal(data);
			 $('#search_result_team_info').html(data);
			$('#search_result_team_info').show();
			 //if(data =="등록이 완료되었습니다."){}
	   }); 
	});

	$("#goto_con_txt").click(function(){
		//alert('추가 정보 입력페이지로 이동합니다.');
		location.href='/makepage/add_con_txt/<?echo $w_num;?>';
	});
	$(".make_site").click(function(){
		//alert('추가 정보 입력페이지로 이동합니다.');
		open_modal("<img src='/img/loading_img.gif' style='width: 50%;'><br/>공고사업 홈페이지를 생성중입니다.<br/>잠시만 기다려주세요.");
		var w_num = $('#w_num').val();
		var input_cate = $('#input_cate').val();
		var input_origin_url = $('#input_origin_url').val();
		var input_img = $('#input_img').val();
		var tp_check = $('#tp_check').is(':checked');
		//tp_check : true, false로 값이 전달됨
		if(input_img==''){
			open_modal('대표 이미지가 있다면 선택해주세요.<br/>페이스북, 카카오톡에<br/>최적화된 모습으로 공유됩니다.');
			$('.make_site').show();
			$('.bt_making').remove();
			fadeout_modal();
		}

		if(tp_check===true){
			tp_check = 1;
		}else{
			tp_check = 0;
		}
		if(w_num==''){
			open_modal('프로젝트의 인식 id를 확인할 수 없습니다. 새로고침 해주세요.');
			fadeout_modal();
		}else if(input_cate==''){
			open_modal('프로젝트의 카테고리를 선택해주세요.');
			$('.make_site').show();
			$('.bt_making').remove();
			fadeout_modal();
		}else if(tp_check==1){
			//open_modal('임시활성화 모드!');
			//fadeout_modal();
			$('.make_site').hide();
			//신규(클릭시 비동작 버튼) 버튼 출력 - 중복 클릭 방지
			$('.make_site').after('<button id="bt_making" class="bt_making btn btn-success"><img src="/img/icon/icon_sandglass.png" style="width:16px; margin-right: 5px;" valign="middle">생성중입니다</button>');
			
			
			$.post("/makepage/t_publishng",{
				w_num: w_num,
				input_cate: input_cate,
				input_origin_url: input_origin_url,
				input_img: input_img,
				tp_check: tp_check
			},
			function(data){
				if(data ==1){
					//alert('사이트 생성을 시작합니다.');
					$('.make_site').show();
					$('.bt_making').remove();
					$.get("/makepage/popup_t_published/"+w_num,function(data,status){
						//alert("Data: " + data + "\nStatus: " + status);
						//open_modal(data);
						open_modal();
						$('#modal_txt').html(data);
						//$('#login_close').hide();
				   });
				}else{
					$('#modal_txt').html(data);
					$('.make_site').show();
					$('.bt_making').remove();
					fadeout_modal();
				}
			}); 
		}else{
			//기존 버튼 안보이도록 처리
			$('.make_site').hide();
			//신규(클릭시 비동작 버튼) 버튼 출력 - 중복 클릭 방지
			$('.make_site').after('<button id="bt_making" class="bt_making btn btn-success"><img src="/img/icon/icon_sandglass.png" style="width:16px; margin-right: 5px;" valign="middle">생성중입니다</button>');
			//입력데이터 저장하기
			$.post("/makepage/save_cate",{
				w_num: w_num,
				input_cate: input_cate,
				input_origin_url: input_origin_url,
				input_img: input_img,
				tp_check: tp_check
			},
			function(data){
				/*
				alert(data);*/
				if(data==1){
					//alert('사이트 생성을 시작합니다.');
					$.get("/makepage/page_activate/<?echo $w_num;?>",function(data,status){
						//alert("Data: " + data + "\nStatus: " + status);
						//open_modal(data);
						if(data==1 || data==2){
							$('.make_site').show();
							$('.bt_making').remove();
							$.get("/makepage/popup_published/<?echo $w_num;?>",function(data,status){
								//alert("Data: " + data + "\nStatus: " + status);
								//open_modal(data);
								open_modal();
								$('#modal_txt').html(data);
								//$('#login_close').hide();
						   });
						}else{
							alert(data);
							open_modal('활성화에 실패했습니다.<br/>다시 시도해 주세요.');
							$('.make_site').show();
							$('.bt_making').remove();
							//$('#login_close').show();
						}
				   });
				}else{
					open_modal('카테고리를 선택해주세요.');
					$('#modal_txt').val('카테고리 설정을 해주세요.');
					$('.make_site').show();
					$('.bt_making').remove();
					//fadeout_modal();
				}
				
			}); 
		}
		//location.href='/makepage/select_design/<?echo $w_num;?>';
	});

	
	
	//modal 관련
	$("#m_close").click(function(){
		$.modal.close();
		$modal_state ='off';
		});
		$modal_state ='off';
	});


	//도메인 추가하기
	function add_domain_atch(domain_url){
		if(domain_url.indexOf('http://')>-1 || domain_url.indexOf('https://')>-1){
			//alert('test');
		    var domain_url = domain_url.replace('http://', '');
		    var domain_url = domain_url.replace('https://', '');
		    alert('http:// 혹은 https:// 는 제외하고 입력해주세요.');
		}
		var input_w_num = $('#w_num').val();
		/**/
		$.post('/makepage/add_domain_attch',{
		    input_domain: domain_url,
		    input_w_num: input_w_num
		},
		function(data){
		    //alert(data);
		    //입력값 초기화하기
		    //open_modal(data);
		    if(data==1){
		        alert('등록되었습니다.');
		        $('#origin_url_state').html('');
		        $('#input_domain_attach').val('');
		        //$('#input_origin_url').val(input_domain_check2);
		    }else if(data==2){
		        alert('해당 도메인은 현재 본 프로젝트의 도메인으로 설정되어 있습니다.');
		        $('#origin_url_state').html('');
		        $('#input_domain_attach').val('');
		        //$('#input_origin_url').val(input_domain_check2);
		    }else if(data==3){
		    	alert('도메인을 찾을 수 없습니다. 다시 시도해주세요.');
		        $('#origin_url_state').html('');
		        $('#input_domain_attach').val('');
		    }else{
		    	alert(data);
		        $('#origin_url_state').html('');
		        $('#input_domain_attach').val('');
		    }
		    check_domain_atch(input_w_num);
		    $('#origin_url_state').hide();
		});
	}

	//연결했던 도메인 삭제
	function delete_domain_attch(domain_url){
		var input_w_num = $('#w_num').val();
		/**/
		$.post('/makepage/delete_domain_attch',{
		    input_domain: domain_url,
		    input_w_num: input_w_num
		},
		function(data){
		    //alert(data);
		    //입력값 초기화하기
		    //open_modal(data);
		    //alert(data);
		    check_domain_atch(input_w_num);
		});
	}
	function check_domain_atch(w_num){
		var w_num = $('#w_num').val();
		//alert(w_num);
		/**/
		$.post('/makepage/check_domain_atch',{
		    w_num: w_num
		},
		function(data){
		    //alert(w_num+data);
		    //입력값 초기화하기
		    //open_modal(data);
		    if(data!=''){
		    	$('#domain_attch_area').show();
		    	$('#domain_attch_area').html(data);
		    }else{
		    	$('#domain_attch_area').show();
		    }
		});
	}

	//팀메이트 추가하기
	function add_project_mate (at_val){
		//alert(at_val);
		$.get("/team/add_project_mate/"+at_val,function(data,status){
			//alert("Data: " + data + "\nStatus: " + status);
			if(data == '등록이 완료되었습니다.'){
				$('#search_result_team_mate').html(data);
				check_teammate();
			}else{
				open_modal(data);
				fadeout_modal();
				$('#co_authors_query_result').html('');
		 		$('#co_authors').val('');
			}
			//$('#search_result_team_mate').html(data);
			//$('#search_result_team_mate').show();
			//사용자 정보를 받은 후, 프로젝트 팀원으로 등록하는 기능 개발하기
		});
	}
	//팀원정보 설정하기
	function set_project_member(val){
		//alert(val);		
		$.get("/team/set_project_member/"+val,function(data,status){
			open_modal();
			$('#modal_txt').html(data);
			check_team_info();
		});
	}
	//팀메이트 삭제하기
	function del_project_mate(at_val){
		$.get("/team/del_project_mate/"+at_val,function(data,status){
			//alert("Data: " + data + "\nStatus: " + status);
			if(data == '삭제되었습니다'){
				$('#search_result_team_mate').html(data);
				check_teammate();
			}else{
				open_modal(data);
				fadeout_modal();
				check_teammate();
			}
			//$('#search_result_team_mate').html(data);
			//$('#search_result_team_mate').show();
			//사용자 정보를 받은 후, 프로젝트 팀원으로 등록하는 기능 개발하기
		});
	}
	//팀원정보 리로드
	function check_teammate(){
		//alert(at_val);
		//var w_num = <?if (isset($w_num)){echo $w_num;}?>;
		var w_num = '<?echo $w_num;?>';
		
		$.get("/team/check_teammate/"+w_num,function(data,status){
			//alert("Data: " + data + "\nStatus: " + status);
			$('#team_mate_state').html(data);
			if(data!=''){
				$('#team_mate_state').fadeIn();
			}
			//alert(data);
		});
	}
	//팀정보 리로드
	function check_team(){
		var w_num = '<?echo $w_num;?>';
		$.get("/team/check_team/"+w_num+'_1',function(data,status){
			//alert("Data: " + data + "\nStatus: " + status);
			$('#team_state').html(data);
			$('#team_state').html(data);

			if(data!=''){
				$('#team_state').fadeIn();
			}
	 	});
	}
	//팀원정보 설정하기
	function set_team(val){
		//alert(val);		
		$.get("/team/set_team/"+val,function(data,status){
			open_modal();
			$('#modal_txt').html(data);
			//check_team_info();
		});
	}
	//팀메이트 삭제하기
	function del_team(at_val){
		$.get("/team/del_team/"+at_val,function(data,status){
			//alert("Data: " + data + "\nStatus: " + status);
			if(data == '삭제되었습니다.'){
				$('#team_state').html(data);
				open_modal(data);
				fadeout_modal();
				check_team();
			}else{
				open_modal(data);
				fadeout_modal();
				check_team();
			}
			//$('#search_result_team_mate').html(data);
			//$('#search_result_team_mate').show();
			//사용자 정보를 받은 후, 프로젝트 팀원으로 등록하는 기능 개발하기
		});
	}
	function check_link(){
		var w_num = '<?echo $w_num;?>';
		$.get("/makepage/check_link/"+w_num,function(data,status){
			//alert("Data: " + data + "\nStatus: " + status);
			$('#linked_url_now').html(data);
			//$('#linked_url').show();
	   });
	}
	
	function del_link(link_val){
		$.post("/makepage/del_link/",{
			l_info: link_val
		},
		function(data){
			 //open_modal(data);
	   		//$w_num.'_value_'.$link_title.'_value_'.$link_url.'_value_'.$link_txt;
	   		//alert("Data: " + data + "\nStatus: " + status);
			if(data == '삭제되었습니다.'){
				open_modal(data);
				fadeout_modal();
				check_link();
			}else{
				open_modal(data);
				//fadeout_modal();
				check_link();
			}
		}); 
			//$('#search_result_team_mate').html(data);
			//$('#search_result_team_mate').show();
			//사용자 정보를 받은 후, 프로젝트 팀원으로 등록하는 기능 개발하기
	}
	//링크 비활성화
	function ex_link(link_val){
		$.get("/makepage/ex_link/"+link_val,function(data,status){
			//alert("Data: " + data + "\nStatus: " + status);
			if(data == '비활성화 되었습니다.'){
				open_modal(data);
				fadeout_modal();
				check_link();
			}else{
				open_modal(data);
				fadeout_modal();
				check_link();
			}
			//$('#search_result_team_mate').html(data);
			//$('#search_result_team_mate').show();
			//사용자 정보를 받은 후, 프로젝트 팀원으로 등록하는 기능 개발하기
	   });
	}
	//링크 수정
	function edit_link_call(link_val){
   		var link_val_s = link_val.split('#');
   		var w_num = link_val_s[0];
   		var link_url = link_val_s[1];
   		
		var where = 'add_other';
		$.post("/makepage/road_link_info/",{
			w_num: w_num,
			link_url: link_url
		},
		function(data){
			 //open_modal(data);
	   		//$w_num.'_value_'.$link_title.'_value_'.$link_url.'_value_'.$link_txt;
	   		var link_val_s = data.split('_value_');
	   		var w_num = link_val_s[0];
	   		var link_title = link_val_s[1];
	   		var link_url = link_val_s[2];
	   		var link_txt = link_val_s[3];
	   		$('#linked_pnum_edit').val(w_num);
   			$('#linked_url_edit').val(link_url);
	   		$('#linked_url_title_edit').val(link_title);
	   		$('#linked_url_txt_edit').val(link_txt);
	   		$('#linked_pnum_edit').removeClass();
	   		$('#linked_url_edit').removeClass();
	   		$('#linked_url_title_edit').removeClass();
	   		$('#linked_url_txt_edit').removeClass();
	   		$('#linked_pnum_edit').addClass('focus_area');
	   		$('#linked_url_edit').addClass('focus_area');
	   		$('#linked_url_title_edit').addClass('focus_area');
	   		$('#linked_url_txt_edit').addClass('focus_area');
	   		$('#linked_url_add').slideUp("slow");
	   		$('#linked_url_edit_area').slideDown('slow');
		}); 		
	}
	//slide Down and up	   
	function showHide(state){
		if(state==0){
			$('#bt_add_other').hide();
			var now_div = document.getElementById('add_other_info');
		}else if(state==1){
			$('#co_authors_scription').hide();
			var now_div = document.getElementById('team_mate_add');
		}else if(state==2){
			var now_div = document.getElementById('team_add');
		}else if(state==3){
			var now_div = document.getElementById('linked_url_add');
			$('#linked_url_edit_area').slideUp("slow");
		}else if(state==4){
			var now_div = document.getElementById('graph_add');
			$('#post_graph_edit').hide();
	   		$('#post_graph_add').show();
		}else if(state==5){
			var now_div = document.getElementById('emlist_add');
			$('#post_emlist_edit').hide();
	   		$('#post_emlist_add').show();
		}
		
		if(!now_div) return;
		//alert(now_div);
		if($(now_div).css('display')=="none"){
			$(now_div).slideDown('slow');
		}else{
			$(now_div).slideUp("slow");
		}
	}

    </script>
    <style>
    	#modal_content{
		height: 270px;
    	}
	#modal_txt {
		font-size: 15px;
		font-weight: bold;
		width: 100%;
		margin-top: 10px;
		height: 210px;
		float: left;
		text-align: center;
	}
    </style>
</head>
<body>
<!-- 상단 영역 공통 시작-->
<div id='top_area'>
    <div id='workspace_top_noti'>
            <div id='top_noti_con_txt'>
                <!-- noti_txt -->
                <?include_once $this->config->item('basic_url')."/include/inc_top_noti_txt.php";?>
            </div>
            <div id='top_menu_area'>
                <!-- sub_top area include -->
                <?include_once $this->config->item('basic_url')."/include/inc_top_menu_login.php";?>
            </div>
    </div>
    <div id='workspace_top_con'>
        <?include_once $this->config->item('basic_url')."/include/inc_top_menu_workspace.php";?>
    </div>
</div>
<!-- 상단 영역 공통 끝 -->
<div id='workspace_container'>
    <div id='workspace'>
        <!-- 왼쪽 콘텐츠 영역 시작 -->
        <!-- 오른쪽 콘텐츠 영역 시작 -->
        <div id='workspace_left' class='make_step'>
                <!--제작 단계 버튼-->
                <?$this->load->view('/include/inc_make_step');?>
        </div>
        <div id='workspace_center' class='wkarea1'>
            <div id='wp_center_con'>
                    <h1>
                      페이지 활성화
                    </h1>
                    <hr />
                    <h3>프로젝트 카테고리</h3>
		<div id='cate_div'>
		<?
			if(isset($project_cate)){
				echo '<select name="category" id="board_category" onchange="check_cate(value);">';
				foreach ($project_cate as $cate_name)
				{
					if(isset($cate_id)){
						if($cate_id == $cate_name['cate_id']){
							echo '<option value="'.$cate_name['cate_id'].'" selected="selected">'.$cate_name['field_name'].'('.$cate_name['field_txt'].')</option>';
						}else{
							echo '<option value="'.$cate_name['cate_id'].'">'.$cate_name['field_name'].'('.$cate_name['field_txt'].')</option>';
						}
					}else{
						echo '<option value="'.$cate_name['cate_id'].'">'.$cate_name['field_name'].'('.$cate_name['field_txt'].') </option>';
					}
				}
				echo '</select>';
			 }
			?>
			<!--
			<select name="category" id="board_category" onchange="window.open(value,'_self');">
				<option value="{getUrl('category','','page','')}">{$lang->total}</option>
				<option value=""></option>
			</select>
			-->

		</div>
		<input id="input_cate" name="input_cate" type="hidden" value="<?if(isset($cate_id)) echo $cate_id;?>"/>

                    <!--프로젝트 사이트가 있을 경우 입력하도록-->
		<h3>보유 도메인 URL(존재할 경우만)</h3>
		<input id="input_domain_attach" name="input_domain_attach" placeholder='이 홈페이지와 연결할 도메인이 있으신가요?' class='basic_ip' type="text" />
		<div id='origin_url_state' class='t_basic' style='display: none; width:100%;'></div>
		<div id='domain_attch_area' style='font-size: 12px;width:100%; display: none; margin-top: 10px; margin-bottom: 10px;'></div>
		<a href='http://intropage.tistory.com/entry/%EA%B8%B0%EB%8A%A5%EC%86%8C%EA%B0%9C-%EB%B3%B4%EC%9C%A0-%EB%8F%84%EB%A9%94%EC%9D%B8-%EC%97%B0%EA%B2%B0%ED%95%98%EA%B8%B0' target='_blank'>설명 보기</a>
		<br/>
		
		<h3>공모 홈페이지 URL</h3>
		<input id="input_origin_url" name="input_origin_url" placeholder='이 프로젝트의 대표 사이트가 있으신가요?' class='basic_ip' type="text" value="<? if(isset($origin_project)){echo $origin_project;}?>"/>
		<span id="origin_url_scription" class="t_basic" style="font-size: 11px; padding-top:0px;">
			본 공고사업의 대표 홈페이지를 별도로 가지고 있을 경우 주소를 입력해주세요. 예: http://abc.com
		</span>
		<!--대표이미지가 있으면 출력하도록 -->
		<?
			if(isset($insert_url)){
		?>
		<h3>대표이미지 선택하기</h3>
		<div id='project_img'>
		<?
				$i=0;
				foreach ($insert_url as $insert_url)
				{
					if($insert_url['file_url']!=''){
						$project_img_selected = $insert_url['file_url'];
						$project_img_selected2 = $insert_url['up_id']+1;
						echo '<div id="select_img_'.$insert_url['up_id'].'" class="img_div" onclick="select_img('.$insert_url['up_id'].');">
						<img src="'.$insert_url['file_url'].'" style="width:100px; height: 100px;"></div>';
					}

					$i++;
					if(!isset($project_img_selected)){
						$project_img_selected = "";
					}
					if($i==1 && $project_img_org==""){
						//이미지가 하나라면, 그것을 대표이미지로 설정하기
						if($project_img_org==""){
							$project_img_org = $project_img_selected;
						}
					}
				}
				
			?>
		</div>
		<? }?>
		<input id="input_img" name="input_img" type="hidden" value="<?if(isset($project_img_org)) echo $project_img_org;?>"/>
		<!--form 값 입력 -->
		<h3>팀원 정보</h3>
		<!--관련 팀정보가 있으면 출력하도록.. -->
		<div id="team_mate_state">
			<!--팀원정보 출력 부분, ajax로 호출-->
		</div>
		<div class='button_div'  onclick='showHide(1);'>
			<img src='/img/icon/icon_plus.png' style='width:16px; margin-right: 5px;' valign='middle' alt='' />팀원 추가하기
		</div>
		<div id="team_mate_add">
			<span class='t_basic'><b>팀원 추가하기</b></span>
			<script type="text/javascript">
				//멤버 추가하기
				function add_authors(u_id,name){
					alert('팀원 정보를 추가하고 있습니다. \n통신상태에 따라 조금 시간이 걸릴 수 있습니다.');
					var w_num = <?echo $w_num;?>;
					var page_user = "'"+w_num+'_'+u_id+"'";
					//alert(page_user);
					add_project_mate(w_num+'_'+u_id);
					//DB에 멤버 정보 입력하고, 쿼리때려서 공동 저자 리스트 가져오기
					//시리즈 생성 버튼 눌러야 공동 저자 정보 출력되도록 변경.멤버 테이블에 번호 저장하는 쿼리 날리기기
				}
			</script>
			<?$this->load->view('/include/search_mail');?>
		</div>
		<div id="search_result_team_mate" class="ajax_result"></div>
		<!--관련 팀정보가 있으면 출력하도록.. -->
		<h3>팀 추가</h3>
		<div id="team_state">
			<!--팀정보 출력 부분, ajax로 호출-->
		</div>
		<div class='button_div'  onclick='showHide(2);'>
			<img src='/img/icon/icon_plus.png' style='width:16px; margin-right: 5px;' valign='middle' alt='' />팀 추가하기
		</div>
		<div id="team_add">
			<span class='t_basic'>
				<b>추가하고자 하는 팀명을 입력해주세요.</b>
			</span>
			<table width='100%'>
				<tr>
					<td style="text-align: left;">
						<input id="input_team_name" name="input_team_name" placeholder="팀명을 입력한 후 검색 버튼을 클릭하세요." class="basic_ip" type="text"  />
					</td>
					<td valign='top' style="text-align: right; width: 100px;"><button id="search_team_name" class="btn btn-inverse"><img src='/img/icon/icon_search_w.png' style='width:16px; margin-right: 5px;' valign='middle' alt='' />검색</button></td>
				</tr>
			</table>
			<div id="search_result_team_info" class="ajax_result"></div>
		</div>
		<input id="w_num" name="w_num" class="focus_area" type="hidden" value="<?echo $w_num;?>"/>
		<h3>프로젝트와 연관된 온라인 정보</h3>
		<div id="linked_url_now">
			<!--링크정보 출력 부분, ajax로 호출-->
		</div>
		<div class='button_div'  onclick='showHide(3);'>
			<img src='/img/icon/icon_plus.png' style='width:16px; margin-right: 5px;' valign='middle' alt='' />
			관련 링크 추가하기
		</div>
		<div id="linked_url_add">
			<table width='100%'>
				<tr>
					<td style="text-align: left;">
						<input id="linked_url" name="linked_url"  placeholder="URL을 입력하세요." class="basic_ip" type="text" />
						<input id="linked_url_title" name="linked_url_title"  placeholder="정보의 제목을 입력하세요." class="basic_ip" type="text" />
						<input id="linked_url_txt" name="linked_url_txt"  placeholder="요약 내용을 입력하세요." class="basic_ip" type="text" />
					</td>
					<td style="text-align: right; width: 120px;">
						<button id="post_linked_url" class="btn btn-inverse" style='width: 110px; height: 100px; color: #fff;'>
							<img src='/img/icon/icon_plus_w.png' style='width:16px; margin-right: 5px;' valign='middle' alt='' />
							추가
						</button>
					</td>
				</tr>
			</table>
		</div>
		<div id="linked_url_edit_area">
			<table width='100%'>
				<tr>
					<td style="text-align: left;">
						<input id="linked_pnum_edit" name="linked_pnum_edit"  class="focus_area" type="hidden" value='p_num' readonly />
						<input id="linked_url_edit" name="linked_url_edit" class="url01" type="text" readonly/>
						<input id="linked_url_title_edit" name="linked_url_title_edit" class="title" type="text" onfocus="this.className='focus_area'" onblur="if (this.value.length==0) {this.className='title';}else {this.className='focus_area';}" />
						<input id="linked_url_txt_edit" name="linked_url_txt_edit" class="url_txt_01" type="text" onfocus="this.className='focus_area'" onblur="if (this.value.length==0) {this.className='url_txt_01';}else {this.className='focus_area';}" />
					</td>
					<td style="text-align: right; width: 120px;">
						<button id="post_linked_url_edit" class="btn btn-inverse">
							<img src='/img/icon/icon_plus_w.png' style='width:16px; margin-right: 5px;' valign='middle' alt='' />수정
						</button>
					</td>
				</tr>
			</table>
		</div>
		<script type="text/javascript">
			//멤버 추가하기
			function add_tag(tg_title){
				//page_num, tag_where 정보 받아서 기록하기
				/*
				제작 순서
				1. write_tag-태그 정보가 기존에 작성된건지, 아닌지 체크해서 아닌 경우 생성한 후, tag_id 가져오기
				2. tag와 page 연결하기
				전송할 변수 - tag-title(key word), page or domain id - 이 변수로 tag_where 가져올 수 있을듯.
				*/
				var w_num = "<? if(isset($w_num)){echo $w_num;} ?>";
				$.post('/tag/add_tag_gwon/',{
					tg_title: tg_title,
					w_num: w_num
					},
					function(data){
					//alert(data);
					//입력값 초기화하기
					open_modal(data);
					check_tags();
					$('#input_tag').val("");
					$('#tag_query_result').html("");
					$('#tag_query_result').hide();
					
					//$('#tag_query_result').html(data);
				});
			}
			function del_tag(tg_id){
				var w_num = "<? if(isset($w_num)){echo $w_num;} ?>";
				var tg_id = tg_id;
				$.post('/tag/del_tag/',{
					w_num: w_num,
					tg_id: tg_id
				},
				function(data){
					open_modal(data);
				  	check_tags();
				});
			}
			//태그 정보 확인
			function check_tags(){
				var w_num = "<? if(isset($w_num)){echo $w_num;} ?>";
				//alert(w_num);
				$.post('/tag/check_tags',{
					w_num: w_num
				},
				function(data){
					//alert(data);
					$("#tag_backup").show();
					$("#tag_backup").html(data);
				}); 
			}
		</script>
		<?
		//tag 인클루드
		include_once $this->config->item('basic_url')."/include/search_tag.php"; ?>
		<hr />
		<h3>임시활성화</h3>
		<div id="test_publishng" style='margin-top: 10px;'>
			<input type="checkbox" id="tp_check" />
			<label for="tp_check">임시 활성화 기능을 사용합니다.</label><br/><br/>
			* 임시 활성화 기능은 사이트를 공개 하기 전, 관계자들이 내부 기능 및 콘텐츠 동작의 유무를 확인해야할 경우 사용합니다.
		</div>

                    <hr />
                    <div id='bt_area'>
		<button id="make_site" class="make_site btn btn-success">
			<img src="/img/icon/icon_make_w.png" style="width:16px; margin-right: 5px;" valign="middle" alt='' />
			생성하기
		</button>					
                    </div>
            </div>
        </div>

        <div id='workspace_preview' class='preview_area'>
            <div>
                미리보기 영역
            </div>
        </div>
    </div>
    <?include_once $this->config->item('basic_url')."/include/inc_bottom_info.php";?>
</div>
</body>
</html>