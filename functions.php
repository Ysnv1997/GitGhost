<?php
/**********************************************************************
	 						注册菜单
**********************************************************************/
register_nav_menus(array(
    'top' => '顶部菜单'
));
/**********************************************************************
							特色图
**********************************************************************/
add_theme_support( "post-thumbnails" );
add_filter( 'add_image_size', create_function( '', 'return 1;' ) );
add_filter( 'create_fun_core', create_function( '', 'return 1;' ) );
/**********************************************************************
							去除多余代码
**********************************************************************/
add_filter('show_admin_bar', '__return_false');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'locale_stylesheet');
remove_action('wp_head', 'noindex', 1);
remove_action('wp_head', 'wp_print_head_scripts', 9);
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
remove_action('wp_head', 'wp_oembed_add_host_js');
remove_action('wp_head', 'wp_resource_hints', 2);
remove_action('wp_head', 'rest_output_link_wp_head', 10);
remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
remove_action('wp_footer', 'wp_print_footer_scripts');
remove_action('publish_future_post', 'check_and_publish_future_post', 10, 1);
remove_action('template_redirect', 'wp_shortlink_header', 11, 0);
remove_action('template_redirect', 'rest_output_link_header', 11, 0);
remove_action('rest_api_init', 'wp_oembed_register_route');
remove_filter('rest_pre_serve_request', '_oembed_rest_pre_serve_request', 10, 4);
remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);
remove_filter('oembed_response_data', 'get_oembed_response_data_rich', 10, 4);
add_filter('rest_enabled', '__return_false');
add_filter('rest_jsonp_enabled', '__return_false');
add_shortcode('reply', 'reply_to_read');
add_filter('pre_site_transient_update_core',create_function('$a',"return null;")); // 关闭核心提示
add_filter('pre_site_transient_update_plugins',create_function('$a',"return null;")); // 关闭插件提示
add_filter('pre_site_transient_update_themes',create_function('$a',"return null;")); // 关闭主题提示
remove_action('admin_init','_maybe_update_core');// 禁止 WordPress 检查更新
remove_action('admin_init','_maybe_update_plugins');// 禁止 WordPress 更新插件
remove_action('admin_init','_maybe_update_themes'); // 禁止 WordPress 更新主题

//禁用文章自动保存
add_action('wp_print_scripts','disable_autosave');
function disable_autosave(){
  	wp_deregister_script('autosave');
}
 
//禁用文章修订版本
add_filter( 'wp_revisions_to_keep', 'specs_wp_revisions_to_keep', 10, 2 );
function specs_wp_revisions_to_keep( $num, $post ) {
  	return 0;
}
// 阻止站内文章互相Pingback 
function theme_noself_ping( &$links ) {
    $home = get_theme_mod( 'home' );
    foreach ( $links as $l => $link )
        if ( 0 === strpos( $link, $home ) )
            unset($links[$l]);
}
add_action('pre_ping','theme_noself_ping');
/**********************************************************************
							禁用表情
**********************************************************************/
function disable_emojis() {
	remove_action('wp_head', 'print_emoji_detection_script', 7);
	remove_action('admin_print_scripts', 'print_emoji_detection_script');
	remove_action('wp_print_styles', 'print_emoji_styles');
	remove_action('admin_print_styles', 'print_emoji_styles');
	remove_filter('the_content_feed', 'wp_staticize_emoji');
	remove_filter('comment_text_rss', 'wp_staticize_emoji');
	remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
	add_filter('tiny_mce_plugins', 'disable_emojis_tinymce');
}
add_action('init', 'disable_emojis');
function disable_emojis_tinymce($plugins) {
	if (is_array($plugins)) {
		return array_diff($plugins, array(
			'wpemoji',
		));
	} else {
		return array();
	}
}

/**********************************************************************
							静态文件
**********************************************************************/

add_action( 'wp_enqueue_scripts', 'SuStatic' );
function SuStatic() {
	wp_register_script( 'jquery3', get_template_directory_uri() . '/static/js/jquery-3.2.1.min.js', array(), true );
	wp_register_script( 'fancybox', get_template_directory_uri() . '/static/js/jquery.fancybox.min.js', array(), true );
	wp_register_script( 'fitvids', get_template_directory_uri() . '/static/js/jquery.fitvids.js', array(), true );
	wp_register_script( 'input', get_template_directory_uri() . '/static/js/input.min.js', array(), true );
	wp_register_script( 'main', get_template_directory_uri() . '/static/js/main.js', array(), true );
	wp_register_script( 'highlight', get_template_directory_uri() . '/static/js/highlight.js', array(), true );
    


    if ( !is_admin() ) {
        wp_enqueue_style( 'screen' );
        wp_enqueue_style( 'fancybox' );
        wp_enqueue_style( 'iconfont' );
        wp_enqueue_style( 'default' );

		wp_enqueue_script( 'jquery3' );
        wp_enqueue_script( 'fancybox' );
		wp_enqueue_script( 'fitvids' );
		wp_enqueue_script( 'highlight' );
		wp_enqueue_script( 'input' );
		wp_enqueue_script( 'main' );
	}
    wp_enqueue_style( 'default', get_template_directory_uri() . '/static/css/default.css');

    wp_enqueue_style( 'iconfont', get_template_directory_uri() . '/static/css/iconfont.css');
    wp_enqueue_style( 'screen', get_template_directory_uri() . '/static/css/screen.css');
    wp_enqueue_style( 'fancybox', get_template_directory_uri() . '/static/css/jquery.fancybox.min.css');

    wp_enqueue_style( 'style', get_stylesheet_uri());
    // wp_localize_script( 'ajax-comment', 'stayma_url',
    //     array(
    //         "url_ajax" => admin_url("admin-ajax.php")
    //     )
    // );
    wp_localize_script( 'main', 'stayma_url',
        array(
            "url_ajax" => admin_url("admin-ajax.php")
        )
    );

}

/**********************************************************************
							引入后台框架
**********************************************************************/
define('OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/');
require_once dirname(__FILE__) . '/inc/options-framework.php';
$optionsfile = locate_template('options.php');
load_template($optionsfile);
add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');
function optionsframework_custom_scripts() { ?>
<script type="text/javascript">
jQuery(document).ready(function() {
    jQuery('#example_showhidden').click(function() {
        jQuery('#section-example_text_hidden').fadeToggle(400);
    });
    if (jQuery('#example_showhidden:checked').val() !== undefined) {
        jQuery('#section-example_text_hidden').show();
    }
});
</script>
<?php
}
/**********************************************************************
							引入熊掌号
**********************************************************************/
include 'xzh.func.php';
/**********************************************************************
							禁用谷歌字体
**********************************************************************/
add_filter( 'gettext_with_context', 'wpdx_disable_open_sans', 888, 4 );
function wpdx_disable_open_sans( $translations, $text, $context, $domain ) {
  if ( 'Open Sans font: on or off' == $context && 'on' == $text ) {
    $translations = 'off';
  }
  return $translations;
}
/**********************************************************************
							获取文章第一张图片
**********************************************************************/
function post_thumbnail_src(){
    global $post;
    if( has_post_thumbnail() ){    //如果有特色缩略图，则输出缩略图地址
        $thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');
        $post_thumbnail_src = $thumbnail_src [0];
    } else {
        $post_thumbnail_src = '';
        ob_start();
        ob_end_clean();
        $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
        if(!empty($matches[1][0])){
            $post_thumbnail_src = $matches[1][0];   //获取该图片 src
        }else{  //如果日志中没有图片，则显示随机图片
			$random = mt_rand(0, 4);
			$arrImgSm = ['5bc2e48af3a04','5bc2e48b1f7fe','5bc2e48b1d789','5bc2e48b28f4f','5bc2e48b4cbc9'];
            $post_thumbnail_src ='https://i.loli.net/2018/10/14/'.$arrImgSm[$random].'.jpg';
        }
    };
    echo $post_thumbnail_src;
}
/**********************************************************************
							菜单类
**********************************************************************/
class description_walker extends Walker_Nav_Menu
{
	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
	{
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
 
		$class_names = $value = '';
 
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
 
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
 
		$output .= $indent . '<li class="nav-item" id="menu-item-'. $item->ID . '">';
 
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
 
		$description  = ! empty( $item->description ) ? '<img src="'.esc_attr( $item->description ).'">' : '';
 
		if($depth != 0) $description = "";
 
		$item_output = $args->before;
		$item_output .= '<a class="nav-link ajax-link"'. $attributes .'>';
		$item_output .= $args->link_before .apply_filters( 'the_title', $item->title, $item->ID );
		$item_output .= $description.$args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;
 
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args, $id );
	}
}
/**********************************************************************
							文章阅读次数
**********************************************************************/
function post_views($before = '', $after = '', $echo = 1)  
{  
  global $post;  
  $post_ID = $post->ID;  
  $views = (int)get_post_meta($post_ID, 'views', true);  
  if ($echo) echo $before, number_format($views), $after;  
  else return $views;  
}  
function record_visitors()  
{  
    if (is_singular()) {  
      global $post;  
      $post_ID = $post->ID;  
      if($post_ID) {  
          $post_views = (int)get_post_meta($post_ID, 'views', true);  
          if(!update_post_meta($post_ID, 'views', ($post_views+1))) {  
            add_post_meta($post_ID, 'views', 1, true);  
          }  
      }  
    }  
}  
add_action('wp_head', 'record_visitors');  
/**********************************************************************
							SEO 标题设置
**********************************************************************/
function yct_seo_title( $title ){
	global $post;
	//静态首页SEO标题
	if( (is_front_page()) ) {
		//获取静态页面的SEO标题，第一个为标题，第二个为关键字
		$seo_meta =explode('||',get_post_meta($post->ID,'seo_info',true));
		//如果标题存在
		if ($seo_meta[0]){
			//如果存在首页标题描述则取消
			if(isset( $title['tagline'] )) {unset( $title['tagline'] );}
			//设置首页的SEO标题
			$title['title']=strip_tags($seo_meta[0]);
		}
	}elseif( (is_single() || is_page()) ) {
 
		//获取页面、文章的SEO标题，第一个为标题，第二个为关键字
		$seo_meta =explode('||',get_post_meta($post->ID,'seo_info',true));
		//如果标题存在
		if ($seo_meta[0]){
			//设置页面、文章的SEO标题
			$title['title']=strip_tags($seo_meta[0]);
		}
	}elseif( (is_tag() || is_category()) ) {
			//获取标签、分类的SEO标题，第一个为普通描述，第二个为SEO标题
			$seo_meta =explode('||',get_the_archive_description());
			//如果标题存在
			if ($seo_meta[1]){
				//设置页面、文章的SEO标题
				$title['title']=strip_tags($seo_meta[1]);
		}
	}
	//返回标题
	return $title;
}
add_filter( 'document_title_parts', 'yct_seo_title' );

/**********************************************************************
							评论模板
**********************************************************************/
include 'ajax-comment/do.php';
function wpmee_comment($comment, $args, $depth) {
    global $post;
    $commentcountText='';
    $GLOBALS['comment'] = $comment;

?>
<li <?php comment_class($GLOBALS['wow_comments']); ?>  id="li-comment-<?php comment_ID() ?>">
    <div id="comment-<?php comment_ID() ?>">

        <div class="comment-avatar"><?php echo get_avatar( $comment ); ?></div>
        <div class="comment-body">
            <div class="comment_author">
				<span class="name"><?php comment_author_link() ?></span><?php if($comment->user_id == 1) echo "<span class='comment_admin'>官方</span>"; ?>
                <em><?php echo get_comment_time('Y-m-d H:i') ?></em>
				<div class="name-ua">
					<?php echo user_agent($comment->comment_agent);?>
				</div>
            </div>

            <div class="comment-text">
            	<?php comment_text() ?>
				<?php if ( $comment->comment_approved == '0' ) : ?>
				<font style="color:#C00; font-style:inherit">您的评论正在等待审核中...</font>
            	<?php endif; ?>
            </div>
            <div class="comment_reply">
                <span class="comment_reply_but">
                    <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => "回复"))) ?>
                </span>
            </div>
        </div>
    </div>
<?php }
function wpmee_end_comment() {
    echo '</li>';
};

/**********************************************************************
							用户信息
**********************************************************************/
function user_agent($ua){
	//开始解析操作系统   
	$os = null;
	if(preg_match('/Windows 95/i',$ua) || preg_match('/Win95/',$ua)){
			$os="Windows 95";}
		elseif(preg_match('/Windows NT 5.0/i',$ua) || preg_match('/Windows 2000/i', $ua)){
			$os="Windows 2000";}
		elseif(preg_match('/Win 9x 4.90/i',$ua) || preg_match('/Windows ME/i', $ua)){
			$os="Windows ME";}
		elseif(preg_match('/Windows.98/i',$ua) || preg_match('/Win98/i', $ua)){
			$os = "Windows 98";}
		elseif(preg_match('/Windows NT 6.0/i',$ua)){
			$os="Windows Vista";}
		elseif(preg_match('/Windows NT 6.1/i',$ua)){
			$os="Windows 7";}
		elseif(preg_match('/Windows NT 5.1/i',$ua)){
			$os = "Windows XP";}
		elseif(preg_match('/Windows NT 5.2/i',$ua) && preg_match('/Win64/i',$ua)){
			$os="Windows XP 64 bit";}
		elseif(preg_match('/Windows NT 5.2/i',$ua)){
			$os="Windows Server 2003";}
		elseif(preg_match('/Mac_PowerPC/i',$ua)){
			$os="Mac OS";}
		elseif(preg_match('/Windows Phone/i',$ua)){
			$os="Windows Phone7";}
		elseif (preg_match('/Windows NT 6.2/i', $ua)){
			$os="Windows 8";}
		elseif(preg_match('/Windows NT 4.0/i',$ua) || preg_match('/WinNT4.0/i',$ua)){
			$os="Windows NT 4.0";}
		elseif(preg_match('/Windows NT/i',$ua) || preg_match('/WinNT/i',$ua)){
			$os="Windows NT";}
		elseif(preg_match('/Windows CE/i',$ua)){
			$os="Windows CE";}
		elseif(preg_match('/ipad/i',$ua)){
			$os="iPad";}
		elseif(preg_match('/Touch/i',$ua)){
			$os="Touchw";}
		elseif(preg_match('/Symbian/i',$ua) || preg_match('/SymbOS/i',$ua)){
			$os="Symbian OS";}
		elseif (preg_match('/iPhone/i', $ua)) {
			$os="iPhone";}
		elseif(preg_match('/PalmOS/i',$ua)){
			$os="Palm OS";}
		elseif(preg_match('/QtEmbedded/i',$ua)){
			$os="Qtopia";}
		elseif(preg_match('/Ubuntu/i',$ua)){
			$os="Ubuntu Linux";}
		elseif(preg_match('/Gentoo/i',$ua)){
			$os="Gentoo Linux";}
		elseif(preg_match('/Fedora/i',$ua)){
			$os="Fedora Linux";}
		elseif(preg_match('/FreeBSD/i',$ua)){
			$os="FreeBSD";}
		elseif(preg_match('/NetBSD/i',$ua)){
			$os="NetBSD";}
		elseif(preg_match('/OpenBSD/i',$ua)){
			$os="OpenBSD";}
		elseif(preg_match('/SunOS/i',$ua)){
			$os="SunOS";}
		elseif(preg_match('/Linux/i',$ua)){
			$os="Linux";}
		elseif(preg_match('/Mac OS X/i',$ua)){
			$os="Mac OS X";}
		elseif(preg_match('/Macintosh/i',$ua)){
			$os="Mac OS";}
		elseif(preg_match('/Unix/i',$ua)){
			$os="Unix";}
		elseif(preg_match('#Nokia([a-zA-Z0-9.]+)#i',$ua,$matches)){
			$os="Nokia".$matches[1];}
		elseif(preg_match('/Mac OS X/i',$ua)){
			$os="Mac OS X";}
		else{
			$os='未知操作系统';
	}
	//开始解析浏览器   
	if(preg_match('#(Camino|Chimera)[ /]([a-zA-Z0-9.]+)#i',$ua,$matches)){
			$browser = 'Camino '.$matches[2];}
		elseif(preg_match('#SE 2([a-zA-Z0-9.]+)#i',$ua,$matches)){
			$browser='搜狗浏览器 2'.$matches[1];}
		elseif(preg_match('#360([a-zA-Z0-9.]+)#i',$ua,$matches)){
			$browser='360浏览器 '.$matches[1];}
		elseif (preg_match('#Maxthon( |\/)([a-zA-Z0-9.]+)#i',$ua,$matches)){
			$browser='Maxthon '.$matches[2];}
		elseif (preg_match('#Chrome/([a-zA-Z0-9.]+)#i',$ua,$matches)){
			$browser='Chrome '.$matches[1];}
		elseif (preg_match('#Safari/([a-zA-Z0-9.]+)#i',$ua,$matches)){
			$browser='Safari '.$matches[1];}
		elseif(preg_match('#opera mini#i', $ua)) {
			$browser='Opera Mini '.$matches[1];}
		elseif(preg_match('#Opera.([a-zA-Z0-9.]+)#i',$ua,$matches)){
			$browser='Opera '.$matches[1];}
		elseif(preg_match('#(j2me|midp)#i', $ua)) {
			$browser="J2ME/MIDP Browser";}
		elseif(preg_match('/GreenBrowser/i', $ua)){
			$browser='GreenBrowser';}
		elseif (preg_match('#TencentTraveler ([a-zA-Z0-9.]+)#i',$ua,$matches)){
			$browser='腾讯TT浏览器 '.$matches[1];}
		elseif(preg_match('#UCWEB([a-zA-Z0-9.]+)#i',$ua,$matches)){
			$browser='UCWEB '.$matches[1];}
		elseif(preg_match('#MSIE ([a-zA-Z0-9.]+)#i',$ua,$matches)){
			$browser='Internet Explorer '.$matches[1];}
		elseif(preg_match('#avantbrowser.com#i',$ua)){
			$browser='Avant Browser';}
		elseif(preg_match('#PHP#', $ua, $matches)){
			$browser='PHP';}
		elseif(preg_match('#danger hiptop#i',$ua,$matches)){
			$browser='Danger HipTop';}
		elseif(preg_match('#Shiira[/]([a-zA-Z0-9.]+)#i',$ua,$matches)){
			$browser='Shiira '.$matches[1];}
		elseif(preg_match('#Dillo[ /]([a-zA-Z0-9.]+)#i',$ua,$matches)){
			$browser='Dillo '.$matches[1];}
		elseif(preg_match('#Epiphany/([a-zA-Z0-9.]+)#i',$ua,$matches)){
			$browser='Epiphany '.$matches[1];}
		elseif(preg_match('#UP.Browser/([a-zA-Z0-9.]+)#i',$ua,$matches)){
			$browser='Openwave UP.Browser '.$matches[1];}
		elseif(preg_match('#DoCoMo/([a-zA-Z0-9.]+)#i',$ua,$matches)){
			$browser='DoCoMo '.$matches[1];}
		elseif(preg_match('#(Firefox|Phoenix|Firebird|BonEcho|GranParadiso|Minefield|Iceweasel)/([a-zA-Z0-9.]+)#i',$ua,$matches)){
			$browser='Firefox '.$matches[2];}
		elseif(preg_match('#(SeaMonkey)/([a-zA-Z0-9.]+)#i',$ua,$matches)){
			$browser='Mozilla SeaMonkey '.$matches[2];}
		elseif(preg_match('#Kazehakase/([a-zA-Z0-9.]+)#i',$ua,$matches)){
			$browser='Kazehakase '.$matches[1];}
		else{$browser='未知浏览器';
	}
	return $os." | ".$browser;
	}
/**********************************************************************
							评论作者链接新窗口打开
**********************************************************************/
function specs_comment_author_link() {
    $url    = get_comment_author_url();
    $author = get_comment_author();
    if ( empty( $url ) || 'http://' == $url )
        return $author;
    else
        return "<a target='_blank' href='$url' rel='external nofollow' class='url'>$author</a>";
}
add_filter('get_comment_author_link', 'specs_comment_author_link');
/**********************************************************************
				修复 WordPress 找回密码提示“抱歉，该key似乎无效”
**********************************************************************/

function reset_password_message( $message, $key ) {
	if ( strpos($_POST['user_login'], '@') ) {
	$user_data = get_user_by('email', trim($_POST['user_login']));
	} else {
	$login = trim($_POST['user_login']);
	$user_data = get_user_by('login', $login);
	}
	$user_login = $user_data->user_login;
	$msg = __('有人要求重设如下帐号的密码：'). "\r\n\r\n";
	$msg .= network_site_url() . "\r\n\r\n";
	$msg .= sprintf(__('用户名：%s'), $user_login) . "\r\n\r\n";
	$msg .= __('若这不是您本人要求的，请忽略本邮件，一切如常。') . "\r\n\r\n";
	$msg .= __('要重置您的密码，请打开下面的链接：'). "\r\n\r\n";
	$msg .= network_site_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode($user_login), 'login') ;
	return $msg;
   }
   add_filter('retrieve_password_message', 'reset_password_message', null, 2);

/**********************************************************************
							评论可见
**********************************************************************/
function reply_to_read($atts, $content = null) {
    extract(shortcode_atts(array(
        "notice" => '<blockquote><center><p class="reply-to-read"">注意：本段内容须成功“<a href="' . get_permalink() . '#respond" title="回复本文">回复本文</a>”后“<a href="javascript:window.location.reload();" title="刷新本页">刷新本页</a>”方可查看！</p></center></blockquote>'
    ) , $atts));
    $email = null;
    $user_ID = (int)wp_get_current_user()->ID;
    if ($user_ID > 0) {
        $email = get_userdata($user_ID)->user_email;
        //对博主直接显示内容
        $admin_email = 'ysnv1997@163.com'; //博主Email
        if ($email == $admin_email) {
            return $content;
        }
    } else if (isset($_COOKIE['comment_author_email_' . COOKIEHASH])) {
        $email = str_replace('%40', '@', $_COOKIE['comment_author_email_' . COOKIEHASH]);
    } else {
        return $notice;
    }
    if (empty($email)) {
        return $notice;
    }
    global $wpdb;
    $post_id = get_the_ID();
    $query = "SELECT `comment_ID` FROM {$wpdb->comments} WHERE `comment_post_ID`={$post_id} and `comment_approved`='1' and `comment_author_email`='{$email}' LIMIT 1";
    if ($wpdb->get_results($query)) {
        return do_shortcode($content);
    } else {
        return $notice;
    }
}
add_shortcode('reply', 'reply_to_read');

/**********************************************************************
							邮件通知
**********************************************************************/
function sirius_comment_approved($comment) {
    if(is_email($comment->comment_author_email)) {
        $wp_email = 'no-reply@' . preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME']));
        $to = trim($comment->comment_author_email);
        $post_link = get_permalink($comment->comment_post_ID);
        $subject = '[通知]您在[STAYMA博客]的留言已经通过审核';
        $message = '
            <div style="background:#ececec;width: 100%;padding: 50px 0;text-align:center;">
            <div style="background:#fff;width:750px;text-align:left;position:relative;margin:0 auto;font-size:14px;line-height:1.5;">
                    <div style="zoom:1;padding:25px 40px;background:#518bcb; border-bottom:1px solid #467ec3;">
                        <h1 style="color:#fff; font-size:25px;line-height:30px; margin:0;"><a href="' . get_option('home') . '" style="text-decoration: none;color: #FFF;">' . htmlspecialchars_decode(get_option('blogname'), ENT_QUOTES) . '</a></h1>
                    </div>
                <div style="padding:35px 40px 30px;">
                    <h2 style="font-size:18px;margin:5px 0;">Hi ' . trim($comment->comment_author) . ':</h2>
                    <p style="color:#313131;line-height:20px;font-size:15px;margin:20px 0;">您有一条留言通过了管理员的审核并显示在文章页面，摘要信息请见下表。</p>
                        <table cellspacing="0" style="font-size:14px;text-align:center;border:1px solid #ccc;table-layout:fixed;width:500px;">
                            <thead>
                                <tr>
                                    <th style="padding:5px 0;text-indent:8px;border:1px solid #eee;border-width:0 1px 1px 0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;font-weight:normal;color:#a0a0a0;background:#eee;border-color:#dfdfdf;" width="280px;">文章</th>
                                    <th style="padding:5px 0;text-indent:8px;border:1px solid #eee;border-width:0 1px 1px 0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;font-weight:normal;color:#a0a0a0;background:#eee;border-color:#dfdfdf;" width="270px;">内容</th>
                                    <th style="padding:5px 0;text-indent:8px;border:1px solid #eee;border-width:0 1px 1px 0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;font-weight:normal;color:#a0a0a0;background:#eee;border-color:#dfdfdf;" width="110px;" >操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="padding:5px 0;text-indent:8px;border:1px solid #eee;border-width:0 1px 1px 0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">《' . get_the_title($comment->comment_post_ID) . '》</td>
                                    <td style="padding:5px 0;text-indent:8px;border:1px solid #eee;border-width:0 1px 1px 0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">'. trim($comment->comment_content) . '</td>
                                    <td style="padding:5px 0;text-indent:8px;border:1px solid #eee;border-width:0 1px 1px 0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;"><a href="'.get_comment_link( $comment->comment_ID ).'" style="color:#1E5494;text-decoration:none;vertical-align:middle;" target="_blank">查看留言</a></td>
                                </tr>
                            </tbody>
                        </table>
                        <br>
                    <div style="font-size:13px;color:#a0a0a0;padding-top:10px">该邮件由系统自动发出，如果不是您本人操作，请忽略此邮件。</div>
                    <div class="qmSysSign" style="padding-top:20px;font-size:12px;color:#a0a0a0;">
                        <p style="color:#a0a0a0;line-height:18px;font-size:12px;margin:5px 0;">' . htmlspecialchars_decode(get_option('blogname'), ENT_QUOTES) . '</p>
                        <p style="color:#a0a0a0;line-height:18px;font-size:12px;margin:5px 0;"><span style="border-bottom:1px dashed #ccc;" t="5" times="">' . date("Y年m月d日",time()) . '</span></p>
                    </div>
                </div>
            </div>
        </div>';
        $from = "From: \"" . htmlspecialchars_decode(get_option('blogname'), ENT_QUOTES) . "\" <$wp_email>";
        $headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";
        wp_mail( $to, $subject, $message, $headers );
    }
}
function comment_mail_notify($comment_id) {
    $comment = get_comment($comment_id);
    $parent_id = $comment->comment_parent ? $comment->comment_parent : '';
    $spam_confirmed = $comment->comment_approved;
    if (($parent_id != '') && ($spam_confirmed != 'spam')) {
        $wp_email = 'no-reply@' . preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME']));
        $to = trim(get_comment($parent_id)->comment_author_email);
        $subject = '[通知]您[STAYMA博客]的留言有了新的回复';
        $message = '
            <div style="background:#ececec;width: 100%;padding: 50px 0;text-align:center;">
            <div style="background:#fff;width:750px;text-align:left;position:relative;margin:0 auto;font-size:14px;line-height:1.5;">
                    <div style="zoom:1;padding:25px 40px;background:#518bcb; border-bottom:1px solid #467ec3;">
                        <h1 style="color:#fff; font-size:25px;line-height:30px; margin:0;"><a href="' . get_option('home') . '" style="text-decoration: none;color: #FFF;">' . htmlspecialchars_decode(get_option('blogname'), ENT_QUOTES) . '</a></h1>
                    </div>
                <div style="padding:35px 40px 30px;">
                    <h2 style="font-size:18px;margin:5px 0;">Hi ' . trim(get_comment($parent_id)->comment_author) . ':</h2>
                    <p style="color:#313131;line-height:20px;font-size:15px;margin:20px 0;">您有一条留言有了新的回复，摘要信息请见下表。</p>
                        <table cellspacing="0" style="font-size:14px;text-align:center;border:1px solid #ccc;table-layout:fixed;width:500px;">
                            <thead>
                                <tr>
                                    <th style="padding:5px 0;text-indent:8px;border:1px solid #eee;border-width:0 1px 1px 0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;font-weight:normal;color:#a0a0a0;background:#eee;border-color:#dfdfdf;" width="235px;">原文</th>
                                    <th style="padding:5px 0;text-indent:8px;border:1px solid #eee;border-width:0 1px 1px 0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;font-weight:normal;color:#a0a0a0;background:#eee;border-color:#dfdfdf;" width="235px;">回复</th>
                                    <th style="padding:5px 0;text-indent:8px;border:1px solid #eee;border-width:0 1px 1px 0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;font-weight:normal;color:#a0a0a0;background:#eee;border-color:#dfdfdf;" width="100px;">作者</th>
                                    <th style="padding:5px 0;text-indent:8px;border:1px solid #eee;border-width:0 1px 1px 0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;font-weight:normal;color:#a0a0a0;background:#eee;border-color:#dfdfdf;" width="90px;" >操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="padding:5px 0;text-indent:8px;border:1px solid #eee;border-width:0 1px 1px 0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">' . trim(get_comment($parent_id)->comment_content) . '</td>
                                    <td style="padding:5px 0;text-indent:8px;border:1px solid #eee;border-width:0 1px 1px 0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">'. trim($comment->comment_content) . '</td>
                                    <td style="padding:5px 0;text-indent:8px;border:1px solid #eee;border-width:0 1px 1px 0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">' . trim($comment->comment_author) . '</td>
                                    <td style="padding:5px 0;text-indent:8px;border:1px solid #eee;border-width:0 1px 1px 0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;"><a href="'.get_comment_link( $comment->comment_ID ).'" style="color:#1E5494;text-decoration:none;vertical-align:middle;" target="_blank">查看回复</a></td>
                                </tr>
                            </tbody>
                        </table>
                        <br>
                    <div style="font-size:13px;color:#a0a0a0;padding-top:10px">该邮件由系统自动发出，如果不是您本人操作，请忽略此邮件。</div>
                    <div class="qmSysSign" style="padding-top:20px;font-size:12px;color:#a0a0a0;">
                        <p style="color:#a0a0a0;line-height:18px;font-size:12px;margin:5px 0;">' . htmlspecialchars_decode(get_option('blogname'), ENT_QUOTES) . '</p>
                        <p style="color:#a0a0a0;line-height:18px;font-size:12px;margin:5px 0;"><span style="border-bottom:1px dashed #ccc;" t="5" times="">' . date("Y年m月d日",time()) . '</span></p>
                    </div>
                </div>
            </div>
        </div>';
        $from = "From: \"" . htmlspecialchars_decode(get_option('blogname'), ENT_QUOTES) . "\" <$wp_email>";
        $headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";
        wp_mail( $to, $subject, $message, $headers );
    }
}
add_action('comment_post', 'comment_mail_notify');


/**********************************************************************
							编辑器增强
**********************************************************************/
function add_editor_buttons($buttons) {
	$buttons[] = 'fontselect';
	$buttons[] = 'fontsizeselect';
	$buttons[] = 'cleanup';
	$buttons[] = 'styleselect';
	$buttons[] = 'hr';
	$buttons[] = 'del';
	$buttons[] = 'sub';
	$buttons[] = 'sup';
	$buttons[] = 'copy';
	$buttons[] = 'paste';
	$buttons[] = 'cut';
	$buttons[] = 'undo';
	$buttons[] = 'image';
	$buttons[] = 'anchor';
	$buttons[] = 'backcolor';
	$buttons[] = 'wp_page';
	$buttons[] = 'charmap';
	$buttons[] = 'code';
	return $buttons;
}
add_filter("mce_buttons_3", "add_editor_buttons");
/**********************************************************************
							编辑器短代码
**********************************************************************/
add_action('after_wp_tiny_mce', 'add_button_mce');
function add_button_mce($mce_settings) {
?>
<script type="text/javascript">
	QTags.addButton( 'commLook', '评论后可见', "[reply]", "[/reply]\n" );
    QTags.addButton('代码高亮-HTML', '代码高亮-HTML', '<pre><code class="hljs html">\n', '\n</pre></code>\n');
    QTags.addButton('代码高亮-PHP', '代码高亮-PHP', '<pre><code class="hljs php">\n', '\n</pre></code>\n');
    QTags.addButton('代码高亮-JavaScript', '代码高亮-JavaScript', '<pre><code class="hljs javascript">\n', '\n</pre></code>\n');
    QTags.addButton('代码高亮-python', '代码高亮-python', '<pre><code class="hljs python">\n', '\n</pre></code>\n');
    QTags.addButton('v-notice', '绿框', '<div id="sc-notice">绿色提示框</div>\n');
    QTags.addButton('v-error', '红框', '<div id="sc-error">红色提示框</div>\n');
    QTags.addButton('v-warn', '黄框', '<div id="sc-warn">黄色提示框</div>\n');
    QTags.addButton('v-tips', '灰框', '<div id="sc-tips">灰色提示框</div>\n');
    QTags.addButton('v-blue', '蓝框', '<div id="sc-blue">蓝色提示框</div>\n');
    QTags.addButton('v-black', '黑框', '<div id="sc-black">黑色提示框</div>\n');
    QTags.addButton('普通按钮','普通按钮','[btn]普通按钮[/btn]\n');
    QTags.addButton('下载按钮','下载按钮','[btn-download]下载按钮[/btn-download]\n');
</script>
<?php }; ?>
<?php 
function button($atts, $content = null) {    // button
    extract(shortcode_atts(array("title" => ''), $atts));
    $output = '<button class="btn btn-default">'.$content.'</button>';
    return $output;
}
add_shortcode('btn', 'button');

function button_download($atts, $content = null) {    // download-button
    extract(shortcode_atts(array("title" => ''), $atts));
    $output = '<button class="btn btn-default"><i class="iconfont icon-cloud-download"></i> <a target="_blank" href="'.$content.'">立即下载</a></button>';
    return $output;
}
add_shortcode('btn-download', 'button_download');

// FancyBox
function lightbox_gall_replace ($content) {
    global $post;
    $pattern = "/<a(.*?)href=('|\")([A-Za-z0-9\/_\.\~\:-]*?)(\.bmp|\.gif|\.jpg|\.jpeg|\.png)('|\")([^\>]*?)>/i";
    $replacement = '<a$1href=$2$3$4$5$6 class="fancybox" data-fancybox-group="button">';
    $content = preg_replace($pattern, $replacement, $content);
    return $content;
}
add_filter('the_content', 'lightbox_gall_replace', 99);
