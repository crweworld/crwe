
<!-- Modal content --> 
<div id="md-cmt" class="md modal">
<div class="modal-dialog modal-lg"><div class="modal-content"></div></div>
</div> 
<script src='/assets/js/clipboard.min.js'></script>
<script>
	$(function() {
		$(".profileNav").click(function(){$(".profileNav").removeClass("activetab"),$(this).addClass("activetab")});		
		function cc(){		 
			 var con_chk= $('.converstation').html();
			 if(con_chk==''){$('.converstation').hide();}else{$('.converstation').show();}
		 }	
		cc();
				
		
		$('.searchit').keyup(function(e) {
			var tval = $(this).val();
			if (tval == '') {
				$("#list_sym2").hide();
			} else {
				$.ajax({
					type: "POST",
					url: "/subs/ajax.php",
					data: {
						searchitSymbol: tval
					},
					cache: false,
					success: function(data) {
						if (data != '') {
							$("#list_sym2").html(data).show();
						} else {
							$("#list_sym2").hide();
						}
					}
				});
			}
		});
		/*$(document).on('click','a.copy-url', function () {
		  var $temp = $("<input>");
		  $("body").append($temp);
		  $temp.val($(this).attr('data-href')).select();
		  document.execCommand("copy");
		  $temp.remove();$(".modal-content").html("Link copied to clipboard");
		$("#md-cmt").show();setTimeout(function(){$("#md-cmt").hide();}, 1000);	
		});*/
		var clipboard = new Clipboard('.copy-url', {
			text: function(trigger) {
			return trigger.getAttribute('data-href');}
		});
		clipboard.on('success', function (e) {
			$(".modal-content").html("Link copied to clipboard");
			$("#md-cmt").show();setTimeout(function(){$("#md-cmt").hide();}, 1000);	
			e.clearSelection();
		});
		//safari
		if (navigator.vendor.indexOf("Apple") == 0 && /\sSafari\//.test(navigator.userAgent)) {
			$('.copy-url').on('click', function () {
				var msg = window.prompt("Copy this link", $(this).attr('data-href'));

			});
		}
<?php if($nav!='symbol.php'){?>
		var getinfo= $('.category').attr("id"),
		info = getinfo.split("_"),	
		userTag = info[1],userId = info[2]; 
		var addinfo = '&user_id='+userId+'&user_tag='+userTag;
		function nullcmt(){ $('.comment').html('<a class="pretty-link" href="#"><s>@</s>'+userTag+'</a>&nbsp;');}
	<?php } 
		else{ ?>
		var symbol= document.location.pathname.match(/[^\/]+$/)[0], addinfo = '&symbol_tag='+symbol;
		function nullcmt(){$('.comment').html('<a class="pretty-link" href="#"><s>$</s>'+symbol+'</a>&nbsp;');}		
		$(window).load(function() {	
			function stock(){	
				$.getJSON('https://api.iextrading.com/1.0/stock/'+symbol+'/quote',function(data){	
					 var output='';
					$.each(data, function(field, value){
						if(field.indexOf('iex')==-1 && field!='latestSource' && field!='latestTime'){ 
							if(field.indexOf('Time')!=-1 && field!='latestTime' || field=='latestUpdate' ){value=new Date(value).toUTCString();}
							output+='<tr><td>'+field.replace(/([A-Z])/g, ' $1').trim()+'</td><td><strong>'+value+'</strong></td></tr>';
							if(field=='latestUpdate'){
							$('.date-created').html('UPDATED '+value);
							}if(field=='latestPrice'){
								$('.openval').html(value.toFixed(2));
							}if(field=='change'){ 
								if(0 < value){
									$('.change').html('<span class="text-success">+'+value+'</span>');}
								else{
								$('.change').html('<span class="text-danger">'+value+'</span>');
								}
							}
						}					
					}); 
				$('.stockTable').html(output);			
				});		
			}
			$.getJSON('https://api.iextrading.com/1.0/stock/'+symbol+'/quote',function(data){	
				$.each(data, function(field, value) {
					if (field=='calculationPrice') {
						if (value=='close') {stock()} else {setInterval(function(){stock()}, 2000); }
					}
				});		
			});
		}); 
		<?php } ?>
		
		$(document).on('click','.more_button', function () 					   
		{
			var getId = $(this).attr("id");
			if(getId)
			{
				$("#load_more").html('<img src="/assets/images/load.gif" class="loader-img"/>');  
				var dataString = 'commentId='+getId+addinfo; 
				$.ajax({
				type: "POST",
				url: "/subs/ajax.php",
				data:dataString,
				//data: {commentId: getId, user_id:userId, user_tag:userTag},
				cache: false,
				success: function(html){
					$(".converstation").append(html);
					$("#load_more").remove();
					}
				});
			}
			return false;
		}); 
		
		$(".ideasInfo").click(function() 
		{
			$(".converstation").html('<img src="/assets/images/load.gif" class="loader-img"/>').show(); 
			$.ajax({
			type: "POST",
			url: "/subs/ajax.php",
			data: {ideasInfo:true,user_id:userId, user_tag:userTag},
			cache: false,
			success: function(html){
				$(".converstation").html(html);	
				cc();
				}
			});			
		});
		
		$(".followingInfo").click(function() 
		{
			$(".converstation").html('<img src="/assets/images/load.gif" class="loader-img"/>').show();
			$.ajax({
			type: "POST",
			url: "/subs/ajax.php",
			data: {followingInfo: userId},
			cache: false,
			success: function(html){
				$(".converstation").html(html);	
				cc();
				}
			});			
		});
		$(".followersInfo").click(function() 
		{
			$(".converstation").html('<img src="/assets/images/load.gif" class="loader-img"/>').show();
			$.ajax({
			type: "POST",
			url: "/subs/ajax.php",
			data: {followersInfo: userId},
			cache: false,
			success: function(html){
				$(".converstation").html(html);	
				cc();
				}
			});		
		});
		$(".likedInfo").click(function() 
		{
			$(".converstation").html('<img src="/assets/images/load.gif" class="loader-img"/>').show();
			$.ajax({
			type: "POST",
			url: "/subs/ajax.php",
			data: {likedInfo: userId},
			cache: false,
			success: function(html){
				$(".converstation").html(html);	
				cc();
				}
			});			
		});
		$(".watchlistInfo").click(function() 
		{
			$(".converstation").html('<img src="/assets/images/load.gif" class="loader-img"/>').show();
			$.ajax({
			type: "POST",
			url: "/subs/ajax.php",
			data: {watchlistInfo: userId},
			cache: false,
			success: function(html){
				$(".converstation").html(html);	
				cc();
				}
			});			
		});
		
		<?php if(isset($_GET['msg_id']) ){ echo '$(".modal-content").load("/reply/'.$_GET['msg_id'].'",function(){$("#md-cmt").show();});';} ?>
		
		
		
	<?php if(isset($_SESSION['pub_id'])){?> 	
	 //plain text
	function insertTextAtCursor(e){var t,a;window.getSelection?(t=window.getSelection()).getRangeAt&&t.rangeCount&&((a=t.getRangeAt(0)).deleteContents(),a.insertNode(document.createTextNode(e))):document.selection&&document.selection.createRange&&(document.selection.createRange().text=e)}document.querySelector(".plaintext[contenteditable]").addEventListener("paste",function(e){if(e.preventDefault(),e.clipboardData&&e.clipboardData.getData){var t=e.clipboardData.getData("text/plain");document.execCommand("insertHTML",!1,t)}else if(window.clipboardData&&window.clipboardData.getData){insertTextAtCursor(t=window.clipboardData.getData("Text"))}});
	//url check	
	var urlRegex = /\(?(?:(http|https|ftp):\/\/)?(?:((?:[^\W\s]|\.|-|[:]{1})+)@{1})?((?:www.)?(?:[^\W\s]|\.|-)+[\.][^\W\s]{2,4}|localhost(?=\/)|\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3})(?::(\d*))?([\/]?[^\s\?]*[\/]{1})*(?:\/?([^\s\n\?\[\]\{\}\#]*(?:(?=\.)){1}|[^\s\n\?\[\]\{\}\.\#]*)?([\.]{1}[^\s\?\#]*)?)?(?:\?{1}([^\s\n\#\[\]]*))?([\#][^\s\n]*)?\)?/gi;		
	 // temp image
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$(".imgprv").html("<img src='"+e.target.result+"'> <a href='javascript:void(0);' class='del_img'><i class='fa fa-times text-danger'></i></a>");
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	 //remove temp image
	 function rmv_img(){$("#stock_image").val(""),$(".imgprv").html("")}
	 
	var start= /\$[^< ]+/ig; // $ Match
	var word=/\$(\w+)/ig; //$abc Match
	var start2= /\@[^< ]+/ig; // $ Match
	var word2=/\@(\w+)/ig; //$abc Match		
	 
	 $(document).on('click','a.md-more', function () {
			var dataURL = $(this).attr('data-href');	
			$('.modal-content').load(dataURL,function(){				
				$("#md-cmt").show();
			});
		}); 
	
	function remaining(){
		var tval = $('.comment').text(),	
			urltotal=0,
			linkval= tval.match(urlRegex); 		
		if (tval.match(urlRegex)) {
				for (var i = 0; i < linkval.length; i++) {
					 urltotal += linkval[i].length-23; 
				}
			}
		var remain = parseInt(140 - tval.length + urltotal);
		$('.rchars').html(remain);
		return remain;
	}
	remaining(); 		
		
	$('.comment').keyup(function(e) 
	{
		var tval = $(this).text(),
			txt = $(this).html(),
			go= txt.match(start), //Content Matching $
			go2= txt.match(start2), //Content Matching $
			dataString = 'searchsymbol='+go+'&searchuser='+go2,
			remain=remaining(); 
		
		if (remain <= 0 && e.which !== 0 && e.charCode !== 0) {
			$('.comment').html((tval).substring(0, tlength - 1));
		}  //console.log(go);
		if(go === null && go2 === null)
		{
			$("#list_sym").hide();				
		}
		else
		{
			$.ajax({
				type: "POST",
				url: "/subs/ajax.php", // Database name search 
				data: dataString,
				cache: false,
				success: function(data)
				{ 
					$("#list_sym").html(data).show();
				}
			});	
		}
	}); 
		 
	$(document).on('click','a.addsymbol', function () 
	{
		var username=$(this).attr('title'); 
		var old=$(".comment").html(); 
		var E='<a class="pretty-link" href="#"><s>$</s>'+username+'</a>&nbsp;'; 
		//var E='<a class="pretty-link" href="#" contenteditable="false"><s>$</s>'+username+'</a>&nbsp;'; 
		var content=old.replace(word,E);//replacing $abc to (" ") space
		$(".comment").html(content);
		$("#list_sym").hide();
	}); 
	$(document).on('click','a.adduser', function () 
	{
		var username=$(this).attr('title'); 
		var old=$(".comment").html(); 
		var E='<a class="pretty-link" href="#"><s>@</s>'+username+'</a>&nbsp;'; 
		var content=old.replace(word2,E);//replacing $abc to (" ") space
		$(".comment").html(content);
		$("#list_sym").hide();
	});	
	 
	 $('#stock_image').change(function () 
	 {			
		var err='';			
		if (this.files.length > 0) 
		{
			$.each(this.files, function (index, value) {
				var validExtensions = ['jpg','gif','png']; 
				var fileName = value.name;
				var fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1).toLowerCase();
				if(Math.round((value.size / 1024)) > 2048){ 
					err ='Image size should be less than 2mb';
				}					 
				else if ($.inArray(fileNameExt, validExtensions) == -1){
				   err ='Invalid file type, upload only jpg,gif,png';
				}

			});
		}
		if(err!=''){
			$(".err_cmt").show(),$(".err_msg").html(err),rmv_img;
		}else{
			readURL(this),$(".err_cmt").hide();
		} 
		});
	 
	 $(document).on('click','a.del_img',function(){rmv_img();}); 
	 function del(){if('<a href="javascript:void(0);">Make your first comment</a>'==$(".converstation").html()){$(".converstation").html('')}} 
		
	 $(document).on('submit', '.frmUpload', function(e) {
		e.preventDefault();
		var tval = $('.comment').text(),
			comment = $('.comment').html(),
			err = '',
			stock_image = $('#stock_image').val(),
		 	remain=remaining();
		 
		if (remain <= 0 && e.which !== 0 && e.charCode !== 0) {
			err = "Please enter less than 140 Character";
		} else if (tval == "" && stock_image == '') {
			err = "Please enter a message";
		}

		if (err != '') {
			$(".err_cmt").show();
			$('.err_msg').html(err);
		} else {
			$(".err_cmt").hide();
			var formData = new FormData($(this)[0]);
			formData.append('comment', comment);
			//formData.append('ref_id', symbol);
			$.ajax({
				type: "POST",
				url: "/subs/ajax.php",
				data: formData,
				contentType: false,
				processData: false,
				cache: false,
				success: function(html) {
					if(html=='copy'){
						 $(".err_msg").html('Duplicate comment found');
					   	$(".err_cmt").show().delay(3000).fadeOut();
					}else{
						   nullcmt(),
							<?php if($nav!='symbol.php'){ if($_SESSION['pub_id']==$user->id){ echo "$('.comment').html(''),";}}?>
							$('.rchars').text('140'),
							$("#list_sym").hide(),	
							rmv_img(),
							del(),	
							$(".converstation").prepend(html),
							cc(),	
							$(".success_cmt").show().delay(3000).fadeOut();						   
					   }
					
				}
			});
		}
	});	 
	 
	$(document).on('click','a.lik_it', function () 
	{
		var likId = $(this).attr("id"),
			Lval = $(".lik_count_"+likId).text(); if(Lval==''){Lval=0}
		$(".lik_cmt_"+likId).toggleClass("liked");
				if ( $(".lik_cmt_"+likId).hasClass("liked") ) 
					{ Lval=parseInt(Lval)+1; $(".lik_count_"+likId).text(Lval); } 
					else { Lval=parseInt(Lval)-1; if(Lval==0){Lval='';} $(".lik_count_"+likId).text(Lval); }
		
		$.ajax({
		type: "POST",
		url: "/subs/ajax.php",
		data: {likId: likId},
		cache: false,
		success: function(html){							
			}
		});
	});
		
	$("#follow").click(function() 
	{		
		$("#follow").toggleClass("liked");
		if ($("#follow").hasClass("liked")){
			$(".modal-content").html("You are now following @"+userTag);$("#follow").html("Following")}
		else{$(".modal-content").html("You are no longer following @"+userTag);$("#follow").html("Follow")}		
		$("#md-cmt").show();
		setTimeout(function(){$("#md-cmt").hide();}, 1000);		
		$.ajax({
		type: "POST",
		url: "/subs/ajax.php",
		data: {follow: userId},
		cache: false,
		success: function(html){
			//if(html!='1'){$(".modal-content").html(html);}			
			}
		});
	});
			
	$(document).on('click','a.watch', function () 				  
	{		
		$(this).toggleClass("liked");
		if ($(this).hasClass("liked")){
			$(".modal-content").html("Added to Watchlist");$(this).html("Watching")}
		else{$(".modal-content").html("Removed from Watchlist");$(this).html("Watch")}		
		$("#md-cmt").show();
		setTimeout(function(){$("#md-cmt").hide();}, 1000);	
		var symbol = $(this).attr('data-sym');
		$.ajax({
		type: "POST",
		url: "/subs/ajax.php",
		data: {watch: symbol},
		cache: false,
		success: function(html){
			//if(html!='1'){$(".modal-content").html(html);}			
			}
		});
	});	
						
	<?php } ?>	
	<?php if(isset($_SESSION['id'])){ ?>	
	$(document).on('click','a.del_cmt', function () 
	{
		var delId = $(this).attr("id"); 
		$.ajax({
		type: "POST",
		url: "/subs/ajax.php",
		data: {delId: delId},
		cache: false,
		success: function(html){
				//$(".converstation").append(html);
				$("#media_"+delId).html('<div class="success_cmt alert alert-success"><strong>Deleted</strong></div>')
				$("#media_"+delId).hide(3000, function() { $(this).remove(); cc()});
				 var md_chk= $('.modal-content').html();
		 		if(md_chk!=''){$("#md-cmt").hide();$('.modal-content').empty();}
			}
		});		
	});
   <?php } ?>
  });
</script>