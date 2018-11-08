<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */
function optionsframework_option_name() {
	// This gets the theme name from the stylesheet
	$themename = wp_get_theme();
	$themename = preg_replace("/\W/", "_", strtolower($themename) );
	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'options_framework_theme'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */
function optionsframework_options() {

// 将所有页面（pages）加入数组
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = '选择页面：';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}
	// Pull all the cateries into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}

    $options_links = array();
    $options_links_obj = get_terms( 'link_category' );
    foreach ($options_links_obj as $link) {
        $options_links[$link->term_id] = $link->name;
    }

	$imagepath =  get_template_directory_uri() . '/img/themestyle/';

	$options = array();

	/*****基本设置*****/
	$options[] = array(
		'name' => __('基本设置'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('网站标题'),
		'desc' => __('网站标题'),
		'id' => 'stayma_info_title',
		'type' => 'text');

	$options[] = array(
		'name' => __('描述一句话'),
		'desc' => __('一句话描述网站'),
		'id' => 'stayma_info_text',
		'type' => 'text');

	$options[] = array(
		'name' => __('网站左侧表述语'),
		'desc' => __('请勿太长，否则丑爆！'),
		'id' => 'stayma_left_text',
		'type' => 'text');


	$options[] = array(
		'name' => __('网站关键字'),
		'desc' => __('请设置关键字，建议6-10个，请用英文逗号,隔开！'),
		'id' => 'stayma_info_keywords',
		'type' => 'text');


	$options[] = array(
		'name' => __('网站描述信息'),
		'desc' => __('请设置描述信息，建议80-100字。'),
		'id' => 'stayma_info_description',
		'type' => 'text');

	$options[] = array(
		'name' => __('首页大图'),
		'desc' => __('请上传信息展示区背景图片'),
		'id' => 'stayma_index_img',
		'type' => 'upload');

	$options[] = array(
		'name' => __('备案号'),
		'desc' => __('请设置首页首屏较小文字信息。'),
		'id' => 'stayma_index_icp',
		'class' => 'mini',
		'type' => 'text');


	$options[] = array(
		'name' => __('建站时间'),
		'desc' => __('请设置建站日期，格式为：2018-5-2'),
		'id' => 'stayma_info_time',
		'class' => 'mini',
		'type' => 'text');



	$options[] = array(
		'name' => __('页尾设置'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('微博地址'),
		'desc' => __('请输入你的微博地址（请不要忘记http）'),
		'id' => 'social_weibo',
		'type' => 'text');

	$options[] = array(
		'name' => __('github'),
		'desc' => __('请输入你的github地址（请不要忘记http）'),
		'id' => 'social_github',
		'type' => 'text');

	$options[] = array(
		'name' => __('twitter'),
		'desc' => __('请输入你的twitter地址（请不要忘记http）'),
		'id' => 'social_twitter',
		'type' => 'text');
	$options[] = array(
		'name' => __('尾部自定义JavaScript区域'),
		'desc' => __('该内容请填写JavaScript代码，请带上script标签，建议放统计代码等等'),
		'id' => 'footer_diy',
		'type' => 'textarea');

		
	$options[] = array(
		'name' => __('百度熊掌号', 'haoui'),
		'type' => 'heading' );

	$options[] = array(
		'name' => __('百度熊掌号', 'haoui'),
		'id' => 'xzh_on',
		'std' => false,
		'desc' => ' 开启',
		'type' => 'checkbox');

	$options[] = array(
		'name' => '百度熊掌号 Appid',
		'id' => 'xzh_appid',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => '百度熊掌号 推送密钥 token',
		'id' => 'xzh_post_token',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('粉丝关注', 'haoui'),
		'id' => 'xzh_render_head',
		'std' => false,
		'desc' => ' 吸顶bar',
		'type' => 'checkbox');

	$options[] = array(
		'class' => 'op-multicheck',
		'id' => 'xzh_render_body',
		'std' => true,
		'desc' => ' 文章段落间bar',
		'type' => 'checkbox');

	$options[] = array(
		'class' => 'op-multicheck',
		'id' => 'xzh_render_tail',
		'std' => true,
		'desc' => ' 底部bar',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('添加JSON_LD数据', 'haoui'),
		'id' => 'xzh_jsonld_single',
		'std' => true,
		'desc' => ' 文章页',
		'type' => 'checkbox');

	$options[] = array(
		'class' => 'op-multicheck',
		'id' => 'xzh_jsonld_page',
		'std' => false,
		'desc' => ' 页面',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('添加JSON_LD数据 - 不添加图片', 'haoui'),
		'id' => 'xzh_jsonld_img',
		'std' => false,
		'desc' => ' 开启',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('新增文章实时推送', 'haoui'),
		'id' => 'xzh_post_on',
		'std' => false,
		'desc' => ' 开启 （使用此功能，你还需要开启本页中的 百度熊掌号 和 Appid以及token的设置）',
		'type' => 'checkbox');

	return $options;
}