<div id="hot-topics" class="section-category">
    <div class="section-name">
        <div class="pull-left"><a href="<?php echo $topic_url?>"><?php echo $topic?></a></div>
        <div class="pull-right"></div>
        <div class="clearfix"></div>
    </div>
    <div class="section-content">
        <div class="row">
        <?php $rmv_id=array() ?>
			<?php $loop=1; while($loop<=2){  ?>
            <div class="col-md-6 col-sm-6">
                <div class="hot-topics-list">
					<?php $bd = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM posts WHERE post_status='publish' and post_id NOT IN ('" . implode("','",$rmv_id) . "') $topic_sql ORDER BY `post_doc` DESC, `post_id` DESC limit 2") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
					while($info = mysqli_fetch_array( $bd )) 
					{ $rmv_id[]=$info['post_id'];
					 	$cat= mysqli_fetch_object(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM category where cat_status='publish' and `cat_id`='{$info['cat_id']}' limit 1")) or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
					?>
                    <div class="media">
                        <div class="media-body">
                            <div class="media-heading"><a title="<?php echo $info['post_title']?>" href="<?php echo $info['post_url']?>" class="title"><?php echo $info['post_title']?></a></div>
                            <div class="info"><span class="category"><?php echo $cat->cat_name?></span><span class="fa fa-circle"></span><span class="date-created"><?php echo $info['post_doc']?></span></div>
                        </div>
                    </div>
                    <?php }?>
                </div>
            </div>
            <?php $loop++;}?>
        </div>
    </div>
</div>
