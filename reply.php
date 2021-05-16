<?php session_start(); if(isset($_SESSION['pub_id'])){$pub_id=$_SESSION['pub_id'];$href='javascript:void(0);';}else{$pub_id=-1;$href='/dashboard/login';}
include('subs/connect_me.php'); include('subs/functions.php'); ?>

   
    <div class="modal-header"><a href="#" class="closeme"><span>×</span></a>
        <h4 class="modal-title">Message</h4></div>
    <div class="modal-body">
        <div class="converstation converstation-main" id="<?php echo $_GET['ref_id'];?>">
            <?php $query=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM `stock_comments` WHERE `id`='{$_GET['ref_id']}'")or die(mysqli_error($GLOBALS["___mysqli_ston"])); while($data=mysqli_fetch_array($query)) { $user = mysqli_fetch_object(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM `user` WHERE `id`='{$data['user_id']}' limit 1")) or die(mysqli_error($GLOBALS["___mysqli_ston"])); $stock_image='';if($data['stock_image']!= NULL and $data['stock_image']!=''){ $stock_image='<a data-featherlight="image" href="'.$data['stock_image'].'"><img class="img-responsive" style="margin: 10px 0px;" src="'. $data['stock_image'].'"></a>';} $stock_cmt='';if($data['comment']!= NULL and $data['comment']!=''){ $stock_cmt='<span>'.$data['comment'].'</span>';} ?>
                <div class="media" id="media_<?php echo $data['id'];?>">
                    <div class="media-left">
                        <a href="#"> <img class="media-object img-circle" onerror="this.src='/assets/images/avatar.png'" src="<?php echo $user->pic?>" alt="Avatar"> </a>
                    </div>
                    <div class="media-body">
                        <div class="clearfix">
                            <h4 class="media-heading pull-left"><?php echo $user->fname.' '.$user->lname; ?></h4> <span class="time pull-right"><?php echo date("jS M, y", strtotime($data['created_on']))?></span></div>
                        <?php echo $stock_cmt.$stock_image;?>
                            <ul class="nav nav-pills">
                                <?php echo '<li><a href="'.$href.'" class="lik_cmt_'.$data['id'].' '.classLiked($pub_id,$data['liked_by']).' lik_it2" id="'.$data['id'].'"><i class="fa fa-thumbs-o-up"></i> <span class="lik_count2_'.$data['id'].'">'.zero(count(array_filter((explode(",",$data['liked_by']))))).'</span></a></li>'; ?>
                            </ul>
                            <?php if($data['user_id']==$pub_id){ echo '<a href="'.$href.'" class="del_cmt remove" id='.$data['id'].'"><i class="fa fa-times"></i></a>'; }?>
                    </div>
                </div>
                <?php } ?>
        </div>
        <div style="padding-top: 10px;">
        <?php if(isset($_SESSION['pub_id'])){ ?>
			<div class="err_cmt-md alert alert-danger" style="display: none"> <strong>Error!</strong> <span class="err_msg-md"></span></div>
			<div class="success_cmt-md alert alert-success" style="display: none"> <strong>Success!</strong> <span>Posted</span></div>
			<form id="form-md" action="#" class="frmUpload-md" enctype="multipart/form-data">
				<div class="panel comment-box">
					<div class="panel-body">
						<div name="comment" id="comment-md" class="comment-md plaintext-md" contenteditable="true" spellcheck="true" role="textbox" aria-multiline="true" placeholder="Reply to this Message" dir="ltr"></div>
						<div id="list_sym-md" style="width: 100%"></div>
					</div>
					<div class="panel-footer clearfix">
						<ul class="nav nav-pills pull-left">
							<li role="presentation">
								<input id="stock_image-md" name="stock_image[]" type="file" accept="image/jpeg,image/x-png" multiple /><a href="#"><i class="fa fa-camera"></i></a></li>
							<div class="imgprv-md"></div>
						</ul>
						<button id="post_cmt-md" class="btn btn-primary pull-right">Post</button>
						<div class="pull-right" style="padding: 9px;"><span class="rchars-md">140</span></div>
					</div>
				</div>
			</form>
		<?php } ?>
		</div>
        <div class="converstation-md converstation">
            <?php $query=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM `stock_replies` WHERE `ref_id`='{$_GET['ref_id']}' order by `created_on` DESC limit 2")or die(mysqli_error($GLOBALS["___mysqli_ston"])); while($data=mysqli_fetch_array($query)) { $user = mysqli_fetch_object(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM `user` WHERE `id`='{$data['user_id']}' limit 1")) or die(mysqli_error($GLOBALS["___mysqli_ston"])); $stock_image='';if($data['stock_image']!= NULL and $data['stock_image']!=''){ $stock_image='<a data-featherlight="image" href="'.$data['stock_image'].'"><img class="img-responsive" style="margin: 10px 0px;" src="'. $data['stock_image'].'"></a>';} $stock_cmt='';if($data['comment']!= NULL and $data['comment']!=''){ $stock_cmt='<span>'.$data['comment'].'</span>';} ?>
                <div class="media" id="media-md_<?php echo $data['id'];?>">
                    <div class="media-left">
                        <a href="#"> <img class="media-object img-circle" onerror="this.src='/assets/images/avatar.png'" src="<?php echo $user->pic?>" alt="Avatar"> </a>
                    </div>
                    <div class="media-body">
                        <div class="clearfix">
                            <h4 class="media-heading pull-left"><?php echo $user->fname.' '.$user->lname; ?></h4> <span class="time pull-right"><?php echo date("jS M, y", strtotime($data['created_on']))?></span></div>
                        <?php echo $stock_cmt.$stock_image;?>
                            <ul class="nav nav-pills">
                                <?php echo '<li><a href="'.$href.'" class="lik_cmt-md_'.$data['id'].' '.classLiked($pub_id,$data['liked_by']).' lik_it-md" id="'.$data['id'].'"><i class="fa fa-thumbs-o-up"></i> <span class="lik_count-md_'.$data['id'].'">'.zero(count(array_filter((explode(",",$data['liked_by']))))).'</span></a></li>'; ?>
                            </ul>
                            <?php if($data['user_id']==$pub_id){ echo '<a href="'.$href.'" class="del_cmt-md remove" id="'.$data['id'].'"><i class="fa fa-times"></i></a>'; }?>
                    </div>
                </div>
                <?php $cmt_id=$data['id']; } if(isset($cmt_id) && $cmt_id!=''){ echo '<a href="#" id="load_more-md"><div id="'.$cmt_id.'" class="more_button-md btn" style="width:100%;margin-top: 2em;" >Load More</div></a>'; } ?></div>
    </div>

<script>
$(function() {
	 var ref_id = $('.converstation-main').attr("id");
    function cc() {
        var con_chk = $('.converstation-md').html();
        if (con_chk == '') {
            $('.converstation-md').hide();
        } else {
            $('.converstation-md').show();
        }
    }
    cc();
	$('.converstation-md').on('click', '.more_button-md', function() {
        var getId = $(this).attr("id");
        if (getId) {
            $("#load_more-md").html('<img src="/assets/images/load.gif" class="loader-img"/>');
            $.ajax({
                type: "POST",
                url: "/subs/ajax.php",
                data: {
                    commentId_md: getId,
                    ref_id: ref_id
                },
                cache: false,
                success: function(html) {
                    $(".converstation-md").append(html);
                    $("#load_more-md").remove();
                }
            });
        }
        return false;
    });
	$(document).on('click','a.closeme', function () {	
		$("#md-cmt").hide();
		$('.modal-content').empty();
		});
<?php if(isset($_SESSION['pub_id'])){ ?>
	function insertTextAtCursor(e){var t,a;window.getSelection?(t=window.getSelection()).getRangeAt&&t.rangeCount&&((a=t.getRangeAt(0)).deleteContents(),a.insertNode(document.createTextNode(e))):document.selection&&document.selection.createRange&&(document.selection.createRange().text=e)}document.querySelector(".plaintext-md[contenteditable]").addEventListener("paste",function(e){if(e.preventDefault(),e.clipboardData&&e.clipboardData.getData){var t=e.clipboardData.getData("text/plain");document.execCommand("insertHTML",!1,t)}else if(window.clipboardData&&window.clipboardData.getData){insertTextAtCursor(t=window.clipboardData.getData("Text"))}});
    
	//url check	
	var urlRegex = /\(?(?:(http|https|ftp):\/\/)?(?:((?:[^\W\s]|\.|-|[:]{1})+)@{1})?((?:www.)?(?:[^\W\s]|\.|-)+[\.][^\W\s]{2,4}|localhost(?=\/)|\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3})(?::(\d*))?([\/]?[^\s\?]*[\/]{1})*(?:\/?([^\s\n\?\[\]\{\}\#]*(?:(?=\.)){1}|[^\s\n\?\[\]\{\}\.\#]*)?([\.]{1}[^\s\?\#]*)?)?(?:\?{1}([^\s\n\#\[\]]*))?([\#][^\s\n]*)?\)?/gi;

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $(".imgprv-md").html("<img src='" + e.target.result + "'> <a href='javascript:void(0);' class='del_img-md'><i class='fa fa-times text-danger'></i></a>");
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function rmv_img() {
        $("#stock_image-md").val(""), $(".imgprv-md").html("")
    }
    var start= /\$[^< ]+/ig; // $ Match
	var word=/\$(\w+)/ig; //$abc Match
	var start2= /\@[^< ]+/ig; // $ Match
	var word2=/\@(\w+)/ig; //$abc Match	
	function remaining(){
		var tval = $('.comment-md').text(),	
			urltotal=0,
			linkval= tval.match(urlRegex); 		
		if (tval.match(urlRegex)) {
				for (var i = 0; i < linkval.length; i++) {
					 urltotal += linkval[i].length-23; 
				}
			}
		var remain = parseInt(140 - tval.length + urltotal);
		$('.rchars-md').html(remain);
		return remain;
	}
	remaining();
	$('.comment-md').keyup(function(e) 
	{
		var tval = $(this).text(),
			txt = $(this).html(),
			go= txt.match(start), //Content Matching $
			go2= txt.match(start2), //Content Matching $
			dataString = 'searchsymbol='+go+'&searchuser='+go2,		
		    remain=remaining(); 
		
		if (remain <= 0 && e.which !== 0 && e.charCode !== 0) {
			$('.comment-md').html((tval).substring(0, tval.length - 1));
		}  
		if(go === null && go2 === null)
		{
			$("#list_sym-md").hide();				
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
					$("#list_sym-md").html(data).show();
					//$("#list_sym-md").clone().appendTo(data).show();
				}
			});	
		}
	}); 
    
    $(document).on('click', 'a.addsymbol', function() {
        var username = $(this).attr('title');
        var old = $(".comment-md").html();
        var E = '<a class="pretty-link" href="#"><s>$</s>' + username + '</a>&nbsp;';
        var content = old.replace(word, E);
        $(".comment-md").html(content);
        $("#list_sym-md").hide();
    });
    $(document).on('click', 'a.adduser', function() {
        var username = $(this).attr('title');
        var old = $(".comment-md").html(); 
        var E = '<a class="pretty-link" href="#"><s>@</s>' + username + '</a>&nbsp;';
        var content = old.replace(word2, E); 
        $(".comment-md").html(content);
        $("#list_sym-md").hide();
    });
    $('#stock_image-md').change(function() {
        var err = '';
        if (this.files.length > 0) {
            $.each(this.files, function(index, value) {
                var validExtensions = ['jpg', 'gif', 'png'];
                var fileName = value.name;
                var fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1).toLowerCase();
                if (Math.round((value.size / 1024)) > 2048) {
                    err = 'Image size should be less than 2mb';
                } else if ($.inArray(fileNameExt, validExtensions) == -1) {
                    err = 'Invalid file type, upload only jpg,gif,png';
                }
            });
        }
        if (err != '') {
            $(".err_cmt-md").show(), $(".err_msg-md").html(err),rmv_img;
        } else {
            readURL(this), $(".err_cmt-md").hide();
        }
    });
    $(document).on('click', 'a.del_img-md', function() {
        rmv_img();
    });
    $('#form-md').submit(function(e) {
        e.preventDefault();
        var tval = $('.comment-md').text(),
            comment = $('.comment-md').html(),            
			err = '',			
			stock_image = $('#stock_image-md').val(),		 	
			remain=remaining(); 
		
        if (remain <= 0 && e.which !== 0 && e.charCode !== 0) {
            err = "Please enter less than 140 Character";
        } else if (tval == "" && stock_image == '') {
            err = "Please enter a message";
        }
        if (err != '') {
            $(".err_cmt-md").show();
            $('.err_msg-md').html(err);
        } else {
            $(".err_cmt-md").hide();
            var formData = new FormData($(this)[0]);
            formData.append('comment_md', comment);
            formData.append('ref_id', ref_id);
            $.ajax({
                type: "POST",
                url: "/subs/ajax.php",
                data: formData,
                contentType: false,
                processData: false,
                cache: false,
                success: function(html) {
					if(html=='copy'){
						 $(".err_msg-md").html('Duplicate comment found');
					   	$(".err_cmt-md").show().delay(3000).fadeOut();
					}else{
                    $('.comment-md').text(''), $('.rchars-md').text('140'), $("#list_sym-md").hide(), rmv_img(), $(".converstation-md").prepend(html), cc(), $(".success_cmt-md").show().delay(3000).fadeOut();
					}
                }
            });
        }
    });
    $('.converstation-main').on('click','a.lik_it2', function () 
	{
		var likId = $(this).attr("id"),
			Lval = $(".lik_count2_"+likId).html(); if(Lval==''){Lval=0}
		$(".lik_cmt_"+likId).toggleClass("liked");
				if ( $(".lik_cmt_"+likId).hasClass("liked") ) 
					{ Lval=parseInt(Lval)+1; $(".lik_count_"+likId).html(Lval); $(".lik_count2_"+likId).html(Lval); } 
					else { Lval=parseInt(Lval)-1; if(Lval==0){Lval='';} $(".lik_count_"+likId).html(Lval); $(".lik_count2_"+likId).html(Lval); }
		
		$.ajax({
		type: "POST",
		url: "/subs/ajax.php",
		data: {likId: likId},
		cache: false,
		success: function(html){							
			}
		});
	});
    $('.converstation-md').on('click', 'a.lik_it-md', function() {
        var likId = $(this).attr("id"),
            Lval = $(".lik_count-md_" + likId).html(); if(Lval==''){Lval=0}
        $(".lik_cmt-md_" + likId).toggleClass("liked");
        if ($(".lik_cmt-md_" + likId).hasClass("liked")) {
            Lval = parseInt(Lval) + 1;
            $(".lik_count-md_" + likId).html(Lval);
        } else {
            Lval = parseInt(Lval) - 1;  if(Lval==0){Lval='';}
            $(".lik_count-md_" + likId).html(Lval);
        }
        $.ajax({
            type: "POST",
            url: "/subs/ajax.php",
            data: {
                likId_md: likId
            },
            cache: false,
            success: function(html) {}
        });
    });
    $('.converstation-md').on('click', 'a.del_cmt-md', function() {
        var delId = $(this).attr("id");
        $.ajax({
            type: "POST",
            url: "/subs/ajax.php",
            data: {
                delId_md: delId
            },
            cache: false,
            success: function(html) {
                if (html == 1) {
                    $("#media-md_" + delId).html('<div class="success_cmt-md alert alert-success"><strong>Deleted</strong></div>'),$("#media-md_" + delId).hide(3000, function() {
                        $(this).remove();
                        cc()
                    });
                }
            }
        });
    });
<?php } ?>	
});	
</script>
  