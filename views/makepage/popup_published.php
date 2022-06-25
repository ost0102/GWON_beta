<style>
	#modal_content{
		display:none;
		margin:50 auto;
		width:280px;
		height:200px;
		/*background:#fff;*/
		background: #ffffff;
	}
	#modal_txt{
		float:left;
		font-size: 15px;
		font-weight: bold;
		width: 100%;
		margin-top: 30px;
		margin-bottom: 30px;
		height: 90px;
		text-align: center;

	}
	.cate_div{
		float: left; 
		margin-right: 10px; 
		margin-bottom: 5px; 
		padding: 5px; 
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
		font-size: 11px;
	}
	#con_html a{
		font-size: 11px;
		word-wrap: break-word;
	}

	#sns_area{
		border-top: 1px solid #cdcdcd;
		width: 100%;
		margin-top: 10px;
		padding-top: 10px;
		text-align: center;
	}
	.img2{
		width: 20px;
	}
</style>
<!-- make step bar area include -->
<?
	//page 암호화 코드가 있다면... 임시활성화
	if(isset($page_secur)){
?>
<div id="con_html">
	<h3 style='font-size: 15px;'>페이지가 임시 활성화되었습니다.</h3><br/>
	<a href='<?=$this->config->item('base_url');?>/tpub/page/<?echo $page_secur;?>' target='_blank'>
		<b><?=$this->config->item('base_url');?>/tpub/page/<?echo $page_secur;?></b><img src='/img/icon/icon_popup.png' style='width:16px; margin-left: 5px;' valign='middle'></a>
</div>
<?
	}else{
?>
<div id="con_html">
	<?
	if($site_new_update==1){
		$now_title = '페이지가 업데이트 되었습니다.';
	}else{
		$now_title = '페이지가 생성되었습니다.';
	}
	?>

	<h3 style='font-size: 15px;'><? echo $now_title; ?></h3><br/>
	<a href='<?=$this->config->item('base_url');?>/<?echo $domain;?>' target='_blank'>
		<b><?=$this->config->item('base_url');?>/<?echo $domain;?></b>
		<img src='/img/icon/icon_popup.png' style='width:16px; margin-left: 5px;' valign='middle'>
	</a><br/>
	<div id='sns_area'>
		Share on : 
		<script type="text/javascript" src="/js/kakao.link.js"></script>
		<a href='javascript:up_fb();'><img src='/img/bt_fb.png' class='img2'/></a>
		<a href='javascript:up_twt();'><img src='/img/bt_twt.png' class='img2'/></a>
		<a href='javascript:up_kakao();'><img src='/img/bt_kakao.png' class='img2'/></a>
		
		<SCRIPT TYPE='text/javascript'>
			//update to twt
			function up_twt(){
				var title = '<?echo $title_enc;?>';
				var now_url = '/'+'<?echo $domain;?>';
				var p_num = '<?if(isset($p_num)){echo $p_num;}?>';
				var now_user = '<?if(isset($user)){echo $user;}?>';
				 $.post('/openpage/up_sns',{
						p_num: p_num,
						now_user: now_user,
						sns_type : 'twt'
					},
				   function(data){
					 //alert(now_user);
					 /*if(data == '페이지 추천하였습니다.'){
					 	$('#rec_img').attr('src','/img/icon/icon_recommend.png');
					 }else{
					 	$('#rec_img').attr('src','/img/icon/icon_recommend_not.png');
					 }*/
				   }); 
				window.open('https://twitter.com/intent/tweet?text='+title+' by Gwon <?=$this->config->item("base_url");?>'+now_url,'','width=535, height=420');
			}
			function up_fb(){
				var title = '<?echo $title_enc;?>';
				var now_url = '/'+'<?echo $domain;?>';
				var p_num = '<?if(isset($p_num)){echo $p_num;}?>';
				var now_user = '<?if(isset($user)){echo $user;}?>';
				 $.post('/openpage/up_sns',{
						p_num: p_num,
						now_user: now_user,
						sns_type : 'fb'
					},
				   function(data){
					// alert(data);
					 /*if(data == '페이지 추천하였습니다.'){
					 	$('#rec_img').attr('src','/img/icon/icon_recommend.png');
					 }else{
					 	$('#rec_img').attr('src','/img/icon/icon_recommend_not.png');
					 }*/
				   }); 
				var url_str = 'https://www.facebook.com/dialog/feed?app_id=285372929316494&display=popup&caption='+title+'&link=<?=$this->config->item("base_url");?>'+now_url+'&redirect_uri=<?=$this->config->item("base_url");?>'+now_url;
				window.open(url_str,'','width=535, height=420');
			}
			function up_kakao(){
				var title = '<?echo $title_replace;?>';
				var now_url = '<?=$this->config->item("base_url");?>/'+'<?echo $domain;?>';
				var p_num = '<?if(isset($p_num)){echo $p_num;}?>';
				var now_user = '<?if(isset($user)){echo $user;}?>';

				var con_title = '<?echo $title_replace;?>';
				var con_script = '<?echo $summary;?>';
				var now_url = '<?=$this->config->item("base_url");?>/'+'<?echo $domain;?>';
				var p_num = '<?if(isset($p_num)){echo $p_num;}?>';
				var now_user = '<?if(isset($user)){echo $user;}?>';
				var con_img = '<?=$this->config->item("base_url");?>/'+'<? echo $project_img; ?>';
				var con_img_check = con_img.indexOf('.net//');
				if(con_img_check > -1){
					var con_img = '<?=$this->config->item("base_url");?>/'+'<? echo $project_img; ?>';
				}  

			    $.post('/openpage/up_sns',{
					p_num: p_num,
					now_user: now_user,
					sns_type : 'kakao'
				},
				   function(data){
					//카카오톡 링크 보내기
					Kakao.Link.sendDefault({
						objectType: 'feed',
						content: {
						title: con_title+':::Gwon',
						description: con_script,
						imageUrl: con_img,
						  link: {
						  mobileWebUrl: now_url,
						  webUrl: now_url
						  }
						},
						buttons: [
						  {
						    title: '웹으로 보기',
						    link: {
						    mobileWebUrl: now_url,
						    webUrl: now_url
						    }
						  }
						]
					});
			  	 });
			}

			

		</script>
	</div>
</div>
<?
	}
?>