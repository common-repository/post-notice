<?php
/* 
Plugin Name: Post-Notice
Version: 1.2
Plugin URI: http://hcsem.com/post_notice/
Description: 文章编辑页公告设置
Author: 黄聪
Author URI: http://hcsem.com/huangcong/
*/


add_action('admin_menu','Post_Notice_addmenu');
add_action('admin_footer','Post_Notice_AddNotice');

function Post_Notice_AddNotice() {
	if (str_replace("post-new.php","",$_SERVER['REQUEST_URI'])!=$_SERVER['REQUEST_URI']||str_replace("post.php","",$_SERVER['REQUEST_URI'])!=$_SERVER['REQUEST_URI']) {
		
	$Post_Notice_Option = wpautop(get_option("Post_Notice_Option"));
    $Post_Notice_Option = preg_replace("/\s/", '',$Post_Notice_Option) ;
    $Post_Notice_Enable = get_option("Post_Notice_Enable");
    
    if($Post_Notice_Enable)
    {
	?>
		<script type="text/javascript"> 
document.getElementById("titlediv").innerHTML = document.getElementById("titlediv").innerHTML + 
"<div style=\"margin-top:15px;\" class=\"postbox \" id=\"postimagediv\"><div title=\"点击以切换\" class=\handlediv\" style=\"cursor: pointer;float: right;height: 30px;padding-top:10px;margin-right:10px;\"><a target='_blank' href='http://hcsem.com/post_notice/'>提建议</a></div><h3 class=\"hndle\"><span>公告</span></h3> <div class=\"inside\"><p class=\"hide-if-no-js\"><?php echo $Post_Notice_Option;?></p></div></div> ";
		</script>
	<?php
	}
	}	
}


//添加后台菜单
function Post_Notice_addmenu() {
	add_options_page('Post_Notice', '文章编辑页公告设置', 8, __FILE__,'Post_Notice_Setoption');
}

//设置页面
function Post_Notice_Setoption(){
		if (!empty($_POST['Post_Notice_Update'])) 
		{
			$Post_Notice_Content = wpautop($_POST['Post_Notice_Content']);
			$Post_Notice_Enable = $_POST['Post_Notice_Enable'];
			update_option("Post_Notice_Option",$Post_Notice_Content);
			update_option("Post_Notice_Enable",$Post_Notice_Enable);
			echo '<div class="updated"><strong><p>保存成功</p></strong></div>';
			
		}
	?>
		<div class=wrap>
        	<h2>文章编辑页公告设置</h2>
		  <form method="post">
			<?php
                $Post_Notice_Option = wpautop(get_option("Post_Notice_Option"));
                $Post_Notice_Enable = get_option("Post_Notice_Enable");
                
            ?>
            
            <table class="form-table">
                    <tr valign="middle">
                        <td><label for="Notice">是否启用：</label></td>
                        <td>
                <?php if($Post_Notice_Enable){?> 
                <input id="Post_Notice_Enable" type="checkbox" checked="" name="Post_Notice_Enable">
                <?php } else{?>
                <input id="Post_Notice_Enable" type="checkbox"  name="Post_Notice_Enable">
                <?php } ?> 
                </td>
                    </tr>
                    <tr valign="middle">
                        <td><label for="Notice">公告内容：</label></td>
                        <td><?php wp_editor(str_replace('\"','"',$Post_Notice_Option), 'Post_Notice_Content', $settings = array(quicktags=>1,
                    tinymce=>1,
                    media_buttons=>0,
                    textarea_rows=>4,   
                    editor_class=>"textareastyle") ); ?></td>
                    </tr>
            </table>	
			<p class="submit"><input type="submit" name="Post_Notice_Update" value=" 保存 " /></p>
			</form>
			
			<?php
			/** Show others information **/
			Post_Notice_foot_text();
			?>
		</div>
<?php
}


function Post_Notice_foot_text(){
	?>
	<h3>PS:</h3>
	<p>提醒：该插件必须是Wordpress3.3版本以上才可以使用。对该插件有何建议，请大家到<a href="http://hcsem.com/post_notice/" target="_block">插件首页</a>进行回复。</p>
	<?php
}
?>