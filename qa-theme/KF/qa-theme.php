<?php
/*
	KF theme based on Snow Flat theme
	Copyright (C) 2016 Suomidigi based on 
	Copyright (C) 2014 Q2A Market <http://www.q2amarket.com>

	File:           qa-theme.php
	Version:        KF 1.4
	Description:    Q2A theme class

	This program is free software: you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation, either version 3 of the License, or
	(at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
	GNU General Public License for more details.
*/
   
/**
 * KF theme extends
 *
 * Extends the core theme class <code>qa_html_theme_base</code>
 *
 * @package qa_html_theme_base
 * @subpackage qa_html_theme
 * @category Theme
 * @since KF 1.0
 * @version 1.4
 * @author Suomidigi
 * @copyright (c) 2016 Suomidigi
 * @license http://www.gnu.org/copyleft/gpl.html
 */
class qa_html_theme extends qa_html_theme_base
{
	// use local font files instead of Google Fonts
	private $localfonts           = true;

	// theme subdirectories
	private $js_dir               = 'js';
	private $icon_url             = 'images/icons';

	private $fixed_topbar         = false;
	private $welcome_widget_class = 'wet-asphalt';
	private $ask_search_box_class = 'turquoise';

	// Size of the user avatar in the navigation bar
	private $nav_bar_avatar_size  = 52;


	/* -------------------------------------------------------------------------------------------------------------- */

	/**
	 * Overrides
	 */

	/**
	 * Return array of split HTML (prefix, data, suffix) to represent unix $timestamp, with the full date shown if it's
	   more than $fulldatedays ago
	 */
	function qa_when_to_html($timestamp, $fulldatedays)
	{

		if (qa_to_override(__FUNCTION__)) { $args=func_get_args(); return qa_call_override(__FUNCTION__, $args); }

		$interval=qa_opt('db_time')-$timestamp;

		if ( ($interval<0) || (isset($fulldatedays) && ($interval>(86400*$fulldatedays))) ) { // full style date
			$stampyear=date('Y', $timestamp);
			$thisyear=date('Y', qa_opt('db_time'));

			return array(
				'data' => qa_html(strtr(qa_lang(($stampyear==$thisyear) ? 'main/date_format_this_year' : 'main/date_format_other_years'), array(
					'^day' => date((qa_lang('main/date_day_min_digits')==2) ? 'd' : 'j', $timestamp),
					'^month' => qa_lang('main/date_month_'.date('n', $timestamp)),
					'^year' => date((qa_lang('main/date_year_digits')==2) ? 'y' : 'Y', $timestamp),
				))),
			);

		} else // ago-style date
			return qa_lang_html_sub_split('main/x_ago', qa_html(qa_time_to_string($interval)));
	}

	/* -------------------------------------------------------------------------------------------------------------- */

	/**
	 * Addition for Anna palautetta -category
	 * 
	 * @since KF 1.0
	 */
	public function doctype()
	{
		// Anna palautetta: choose <select> option category based on URL parameter
		if ($this->template === 'ask') {
			if ( (isset($_GET['i'])) && ($_GET['i']=='anna-palautetta') ) {
            foreach ($this->content['script'] as &$line) { 
                if ($line ==="	qa_category_select('category', '');") { 
                   	$line = '';
                    break; 
                } 
            } 
            array_push($this->content['script'], "<script>jQuery(document).ready(function( $ ) { jQuery('select').val(12); });</script>");
            }

		}
    	parent::doctype(); 
	}

	/**
	 * HTML
	 * 
	 * @since KF 1.0
	 */
	public function html()
	{
		$this->output('<html>');
		$this->head();
		$this->body();
		$this->output('</html>');
	}

	/**
	 * Head
	 * 
	 * @since KF 1.0
	 */
	public function head()
	{
		$this->output(
			'<head>',
			'<meta charset="'.$this->content['charset'].'"/>'
		);

		$this->head_title();
		$this->head_metas();
		$this->output('<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">');
		$this->output('<meta http-equiv="x-ua-compatible" content="ie=edge;" />');
		$this->head_css();
		$this->head_links();
		$this->head_lines();
		$this->head_script();
		$this->head_custom();

		// Show only if Q2A used within Wordpress 
		if (defined('USE_QA_WITH_WORDPRESS')) {
			define('WP_USE_THEMES', false);
			define('WP_USED_WITH_Q2A',true);
			require('../wp-blog-header.php');
			
			// Output WP head
			wp_head();
		}

		$this->output('</head>');

	}

	/**
	 * Body header overridden
	 * 
	 * @since KF 1.0
	 */
	public function body_header()
	{

	}

	/**
	 * Body
	 * 
	 * @since KF 1.0
	 */
	public function body()
	{
		$this->output('<body');
		$this->body_tags();
		$this->output('>');

		$this->body_script();

		// Show only if Q2A used within Wordpress 
		if (defined('USE_QA_WITH_WORDPRESS')) {
			// Output WP Body
			get_header(); 
		}

		$this->body_header();
		$this->body_content();
		$this->body_footer();
		$this->body_hidden();

		$this->output('</body>');
	}

	/**
	 * Footer
	 * 
	 * @since KF 1.0
	 */
	public function footer()
	{
		// Show only if Q2A used within Wordpress 
		if (defined('USE_QA_WITH_WORDPRESS')) {

			// From WP
			get_footer(); 

		}
	}

	/**
	 * Adding additional meta for responsive design
	 *
	 * @since Snow 1.4
	 */
	public function head_metas()
	{
		$this->output('<meta name="viewport" content="width=device-width, initial-scale=1"/>');
		parent::head_metas();
	}

	/**
	 * Adding theme stylesheets
	 *
	 * @since Snow 1.4
	 */
	public function head_css()
	{
		// add RTL CSS file
		if ($this->isRTL)
			$this->content['css_src'][] = $this->rooturl . 'qa-styles-rtl.css?' . QA_VERSION;

		// add Ubuntu font CSS file from Google Fonts
		if ($this->localfonts)
			$this->content['css_src'][] = $this->rooturl . 'fonts/ubuntu.css?' . QA_VERSION;
		else
			$this->content['css_src'][] = '//fonts.googleapis.com/css?family=Ubuntu:400,700,400italic,700italic';

		parent::head_css();

		// output some dynamic CSS inline
		$this->head_inline_css();
	}

	/**
	 * Adding theme javascripts
	 *
	 * @since Snow 1.4
	 */
	public function head_script()
	{
		$jsUrl = $this->rooturl . $this->js_dir . '/kf-core.js?' . QA_VERSION;
		$this->content['script'][] = '<script src="' . $jsUrl . '"></script>';

		parent::head_script();
	}

	/**
	 * Adding point count for logged in user
	 *
	 * @since Snow 1.4
	 */
	public function logged_in()
	{
		parent::logged_in();
		if (qa_is_logged_in()) {
			$userpoints = qa_get_logged_in_points();
			$pointshtml = $userpoints == 1
				? qa_lang_html_sub('main/1_point', '1', '1')
				: qa_html(number_format($userpoints))
			;
			$this->output('<div class="qam-logged-in-points">' . $pointshtml . '</div>');
		}
	}

	/**
	 * Adding body class dynamically. Override needed to add class on admin/approve-users page
	 *
	 * @since Snow 1.4
	 */
	public function body_tags()
	{
		$class = 'qa-template-' . qa_html($this->template);

		if (isset($this->content['categoryids'])) {
			foreach ($this->content['categoryids'] as $categoryid)
				$class .= ' qa-category-' . qa_html($categoryid);
		}

		// add class if admin/appovoe-users page
		if ($this->template === 'admin' && qa_request_part(1) === 'approve')
			$class .= ' qam-approve-users';

		if ($this->fixed_topbar)
			$class .= ' qam-body-fixed';

		$this->output('class="' . $class . ' qa-body-js-off"');
	}

	/**
	 * Login form for user dropdown menu.
	 *
	 * @since Snow 1.4
	 */
	public function nav_user_search()
	{
		// outputs login form if user is not logged in
		$this->output('<div class="qam-account-items-wrapper">');

		$this->qam_user_account();

		$this->output('<div class="qam-account-items clearfix">');

		if (!qa_is_logged_in()) {
			if (isset($this->content['navigation']['user']['login']) && !QA_FINAL_EXTERNAL_USERS) {
				$login = $this->content['navigation']['user']['login'];
				$this->output(
					'<form action="' . $login['url'] . '" method="post">',
						'<input type="text" name="emailhandle" dir="auto" placeholder="' . trim(qa_lang_html(qa_opt('allow_login_email_only') ? 'users/email_label' : 'users/email_handle_label'), ':') . '"/>',
						'<input type="password" name="password" dir="auto" placeholder="' . trim(qa_lang_html('users/password_label'), ':') . '"/>',
						'<div><input type="checkbox" name="remember" id="qam-rememberme" value="1"/>',
						'<label for="qam-rememberme">' . qa_lang_html('users/remember') . '</label></div>',
						'<input type="hidden" name="code" value="' . qa_html(qa_get_form_security_code('login')) . '"/>',
						'<input type="submit" value="' . $login['label'] . '" class="qa-form-tall-button qa-form-tall-button-login" name="dologin"/>',
					'</form>'
				);

				// remove regular navigation link to log in page
				unset($this->content['navigation']['user']['login']);
			}
		}

		$this->nav('user');
		$this->output('</div> <!-- END qam-account-items -->');
		$this->output('</div> <!-- END qam-account-items-wrapper -->');
	}

	/**
	 * Remove the '-' from the note for the category page (notes).
	 *
	 * @since Snow 1.4
	 * @param type $navlink
	 * @param type $class
	 */
	public function nav_link($navlink, $class)
	{
		if (isset($navlink['note']) && !empty($navlink['note'])) {
			$search = array(' - <', '> - ');
			$replace = array(' <', '> ');
			$navlink['note'] = str_replace($search, $replace, $navlink['note']);
		}
		parent::nav_link($navlink, $class);
	}

	/**
	 * Rearranges the layout:
	 * - Swaps the <tt>main()</tt> and <tt>sidepanel()</tt> functions
	 * - Moves the header and footer functions outside qa-body-wrapper
	 * - Keeps top/high and low/bottom widgets separated
	 *
	 * @since Snow 1.4
	 */
	public function body_content()
	{
		$this->body_prefix();
		$this->notices();
		$this->widgets('full', 'top');
		$this->header();
		$this->output('<div class="qa-body-wrapper">', '');
		$this->widgets('full', 'high');
		$this->output('<div class="qa-main-wrapper">', '');
		$this->main();
		$this->sidepanel();
		$this->output('</div> <!-- END main-wrapper -->');
		$this->widgets('full', 'low');
		$this->output('</div> <!-- END body-wrapper -->');
		$this->footer();
		$this->body_suffix();
	}

	/**
	 * Additions from WP
	 *
	 * @since KF 1.0
	 */
	public function header()
	{
		// Show only if Q2A used within Wordpress 
		if (defined('USE_QA_WITH_WORDPRESS')) {
			require( get_template_directory() . '/parts/hero/suomidigi-tophero.php' );
			// require( get_template_directory() . '/parts/suomidigi-anna-palautetta-floater.php' );
		}
	}

	/**
	 * Main content in .qa-main
	 * 
	 * @since KF 1.0
	 */
	public function main()
	{
		$content = $this->content;

		$this->output('<div class="qa-main'.(@$this->content['hidden'] ? ' qa-main-hidden' : '').'">');

		if ((qa_request()!='questions')	&& ((qa_request()!='tag')) ) { 
			$this->output('<div class="qa-page-title-error">');
			$this->page_title_error();
			$this->output('</div>');
		}

		$this->widgets('main', 'top');
		$this->widgets('main', 'high');

		// Tabs
		$this->nav('sub');

		// Second row of tabs
		$sub_navi_second = isset($content['sub-navi-second']) ? : '';		
		if ($sub_navi_second) {
			$this->output($sub_navi_second);
		}
		
		$this->main_parts($content);
		$this->widgets('main', 'low');
		$this->page_links();
		$this->suggest_next();
		$this->widgets('main', 'bottom');
		$this->output('</div> <!-- END qa-main -->', '');
	}

	/**
	 * Post_avatar_meta
	 * 
	 * @since KF 1.0
	 */
	public function post_avatar_meta($post, $class, $avatarprefix=null, $metaprefix=null, $metaseparator='<br/>')
	{

		$this->output('<span class="'.$class.'-avatar-meta">');
		$this->avatar($post, $class, $avatarprefix);
	}

	/**
	 * Avatar
	 *
	 * @since KF 1.0
	 */
	public function avatar($item, $class, $prefix=null)
	{
		if (isset($item['avatar'])) {
			if (isset($prefix))
				$this->output($prefix);

			$this->output(
				'<span class="'.$class.'-avatar">',
				$item['avatar'],
				'</span>'
			);
		} else {
			// Show default avatar
			$this->output(
				'<span class="'.$class.'-avatar default-avatar">',
				'<img src="'.qa_opt('site_url').'/qa-theme/KF/images/avatar.gif">',
				'</span>'
			);
		}
	}

	/**
	 * Sidepanel: show categories
	 * overridden to customize layout and styling
	 *
	 * @since KF 1.0
	 */
	public function sidepanel()
	{
		$this->output('<div id="qam-sidepanel-toggle"><i class="icon-left-open-big"></i></div>');
		$this->output('<div class="qa-sidepanel" id="qam-sidepanel-mobile">');
		$this->widgets('side', 'top');
		$this->sidebar();
		$this->widgets('side', 'high');

		// Show categories in the sidebar of all pages 
		$this->output('<div class="qa-side-box">');
		$this->output('<h2 class="side-header-categories">'.qa_lang_html('main/side_categories').'</h2>');

		// Find out current active category
		$active_category=null;
		if (isset($this->content['navigation']['cat'])) {
			foreach ($this->content['navigation']['cat'] as $cats) {
				if ($cats['selected']===true) {
					$active_category = $cats['categoryid'];
				}
			}
		}

		// Add categories to all pages
		$categories = qa_db_single_select(qa_db_category_nav_selectspec(null, true)); 

		// 2-level cats
		if (!$active_category) { // SP0
			$this->content['navigation']['cat'] = qa_category_navigation($categories, ( $active_category ? $active_category : null ) ); 
		}
		foreach ($this->content['navigation']['cat'] as $k=>$v) {
			$original_url = $this->content['navigation']['cat'][$k]['url'];
			$original_category_name = end((explode('/', rtrim($original_url, '/'))));
		} 

		// Output category sidebar
		$this->nav('cat', 1);
		$this->output('</div>'); // qa-side-box

		
		// Show only if Q2A used within Wordpress 
		if (defined('USE_QA_WITH_WORDPRESS')) {
			// WP: sidebar content
			require( get_template_directory() . '/parts/suomidigi-sidebar.php' );
		}

		if ($this->widgets('side', 'low')) {
			$this->output('<div class="qa-side-box qa-side-tagcloud">');
			$this->widgets('side', 'low');
			$this->output('</div>'); 
		}

		if (isset($this->content['sidepanel']))
			$this->output_raw($this->content['sidepanel']);
		$this->widgets('side', 'bottom');
		$this->output('</div>', '');
	}

	/**
	 * Allow alternate sidebar color.
	 *
	 * @since Snow 1.4
	 */
	public function sidebar()
	{
		if (isset($this->content['sidebar'])) {
			$sidebar = $this->content['sidebar'];
			if (!empty($sidebar)) {
				$this->output('<div class="qa-sidebar ' . $this->welcome_widget_class . '">');
				$this->output_raw($sidebar);
				$this->output('</div>', '');
			}
		}
	}

	/**
	 * Search override
	 * 
	 * @since KF 1.0
	 */
	public function search()
	{
		$search = $this->content['search'];

		$this->output(
			'<div class="qa-search">',
			'<form '.$search['form_tags'].'>',
			@$search['form_extra']
		);

		$this->search_field($search);
		$this->search_button($search);

		$this->output(
			'</form>',
			'</div>'
		);
	}

	public function search_field($search)
	{
		$this->output('<input placeholder="Haku" type="text" '.$search['field_tags'].' value="'.@$search['value'].'" class="qa-search-field"/>');
	}

	public function search_button($search)
	{
		$this->output('<input type="submit" value="'.$search['button_label'].'" class="button search-submit"/>');
	}

	/**
	 * Post_meta_who override
	 *
	 * @since KF 1.0
	 * @param $post   The post
	 * @param $class  The class
	 */

	public function post_meta_who($post, $class)
	{
		if (isset($post['who'])) {
			$this->output('<span class="'.$class.'-who">');

			if (strlen(@$post['who']['prefix']))
				$this->output('<span class="'.$class.'-who-pad">'.$post['who']['prefix'].'</span>');

			if (isset($post['who']['data']))
				$this->output('<span class="'.$class.'-who-data">'.$post['who']['data'].'</span>');

			if (isset($post['who']['title']))
				$this->output('<span class="'.$class.'-who-title">'.$post['who']['title'].'</span>');

			if (strlen(@$post['who']['suffix']))
				$this->output('<span class="'.$class.'-who-pad">'.$post['who']['suffix'].'</span>');

			$this->output('</span>');
		}
	}

	/**
	 * Questions item list
	 * q_item_main override
	 *
	 * @since KF 1.0
	 * @param $q_item  
	 */
	public function q_item_main($q_item)
	{	
		$avatarprefix='';
		$this->output('<div class="qa-q-item-main">');

		$this->output('<span class="'.'qa-q-item'.'-avatar-meta">');
		$this->avatar($q_item, 'qa-q-item', $avatarprefix);
		$this->output('</span>');
		
		$this->view_count($q_item);


		$this->output('<span class="qa-item-text-row">');

		$this->q_item_title($q_item);
		$this->q_item_content($q_item);
		$this->post_tags($q_item, 'qa-q-item');

		$this->output('<span class="qa-meta-row">');
		$this->post_meta_who($q_item, 'qa-q-item');
		$this->post_meta_what($q_item, 'qa-q-item');
		$this->post_meta_when($q_item, 'qa-q-item');
		$this->output('</span>');

		$this->output('</span>');


		$this->q_item_buttons($q_item);
		$this->output('</div>');
	}

	/**
	 * Add close icon
	 *
	 * @since Snow 1.4
	 * @param array $q_item
	 */
	public function q_item_title($q_item)
	{
		$closedText = qa_lang('main/closed');
		$imgHtml = empty($q_item['closed'])
			? ''
			: '<img src="' . $this->rooturl . $this->icon_url . '/closed-q-list.png" class="qam-q-list-close-icon" alt="' . $closedText . '" title="' . $closedText . '"/>';

		$this->output(
			'<div class="qa-q-item-title">',
			// add closed note in title
			$imgHtml,
			'<a href="' . $q_item['url'] . '">' . $q_item['title'] . '</a>',
			'</div>'
		);
	}

	/**
	 * Add RSS feeds icon and closed icon for closed questions
	 *
	 * @since Snow 1.4
	 */
	public function title()
	{
		$q_view = isset($this->content['q_view']) ? $this->content['q_view'] : null;

		// RSS feed link in title
		if (isset($this->content['feed']['url'])) {
			$feed = $this->content['feed'];
			$label = isset($feed['label']) ? $feed['label'] : '';
			$this->output('<a href="' . $feed['url'] . '" title="' . $label . '"><i class="icon-rss qam-title-rss"></i></a>');
		}

		// link title where appropriate
		$url = isset($q_view['url']) ? $q_view['url'] : false;

		// add closed image
		$closedText = qa_lang('main/closed');
		$imgHtml = empty($q_view['closed'])
			? ''
			: '<img src="' . $this->rooturl . $this->icon_url . '/closed-q-view.png" class="qam-q-view-close-icon" alt="' . $closedText . '" width="24" height="24" title="' . $closedText . '"/>';

		if (isset($this->content['title'])) {
			$this->output(
				$imgHtml,
				$url ? '<a href="' . $url . '">' : '',
				$this->content['title'],
				$url ? '</a>' : ''
			);
		}
	}

	/**
	 * Add view counter to question list
	 *
	 * @since KF 1.0
	 * @param array $q_item
	 */
	public function q_item_stats($q_item)
	{
		$this->output('<div class="qa-q-item-stats">');

		$this->voting($q_item);
		
		$this->output('<span class="qa-q-item-stats-acount">');
		$this->output(qa_lang_html('main/answers'));
		$this->output('<span class="qa-q-item-stats-acount-value">');
		$this->output($q_item['answers_raw']);
		$this->output('</span>');
		$this->output('</span>');

		parent::view_count($q_item);

		$this->output('</div>');
	}

	/**
	 * Voting_inner_html 
	 * Changed the order for vote_count and vote_buttons
	 * 
	 * @since KF 1.0
	 */
	public function voting_inner_html($post)
	{
		$this->vote_count($post);
		$this->vote_buttons($post);
		$this->vote_clear();
	}

	/**
	 * Prevent display view counter on usual place
	 *
	 * @since Snow 1.4
	 * @param type $q_item
	 */
	public function view_count($q_item) 
	{

	}

	/**
	 * Add view counter to question view
	 *
	 * @since Snow 1.4
	 * @param type $q_view
	 */
	public function q_view_stats($q_view)
	{
		$this->output('<div class="qa-q-view-stats">');

		$this->voting($q_view);
		$this->a_count($q_view);
		// parent::view_count($q_view);

		$this->output('</div>');
	}

	/**
	 * Create custom favorite button location for messages
	 * Based on function page_title_error()
	 * 
	 * @since KF 1.0
	 */
	public function kf_favorite() {
		$favorite = isset($this->content['favorite']) ? $this->content['favorite'] : null;

		if (isset($favorite))
			$this->output('<form ' . $favorite['form_tags'] . '>');
			
		$this->favorite();

		if (isset($favorite)) {
			$formhidden = isset($favorite['form_hidden']) ? $favorite['form_hidden'] : null;
			$this->form_hidden_elements($formhidden);
			$this->output('</form>');
		}

	}

	/**
	 * Page title error
	 * 
	 * @since KF 1.0
	 */
	public function page_title_error()
	{
		if (isset($this->content['title'])) {
			$favorite = isset($this->content['favorite']) ? $this->content['favorite'] : null;

			$this->output('<h1>');
			$this->title();
			$this->output('</h1>');
		}
		if (isset($this->content['error']))
			$this->error($this->content['error']);
	}

	/**
	 * Modify user whometa, move to top
	 *
	 * @since Snow 1.4
	 * @param type $q_view
	 */
	public function q_view_main($q_view)
	{
		$this->output('<div class="qa-q-view-main">');

		if (isset($q_view['main_form_tags']))
			$this->output('<form ' . $q_view['main_form_tags'] . '>'); // form for buttons on question

		$this->post_avatar_meta($q_view, 'qa-q-view');
		$this->q_view_content($q_view);
		$this->q_view_extra($q_view);
		$this->q_view_follows($q_view);
		$this->q_view_closed($q_view);
		$this->post_tags($q_view, 'qa-q-view');

		$this->output('<br/><br/><span class="qa-meta-row">');
		$this->post_meta_who($q_view, 'qa-q-view');
		$this->post_meta_what($q_view, 'qa-q-view');
		$this->post_meta_when($q_view, 'qa-q-view');
		
		
		$this->output('</span>');
	
		$this->output('</span>');

		$this->q_view_buttons($q_view);

		$this->c_list(isset($q_view['c_list']) ? $q_view['c_list'] : null, 'qa-q-view');

		if (isset($q_view['main_form_tags'])) {
			if (isset($q_view['buttons_form_hidden']))
				$this->form_hidden_elements($q_view['buttons_form_hidden']);
			$this->output('</form>');
		}

		$this->c_form(isset($q_view['c_form']) ? $q_view['c_form'] : null);

		$this->output('</div> <!-- END qa-q-view-main -->');
	}

	public function q_view_buttons($q_view)
	{
		if (!empty($q_view['form'])) {
			$this->output('<div class="qa-q-view-buttons">');
			$this->form($q_view['form']);
			$this->kf_favorite();

			$this->output('</div>');
		}
	}

	/**
	 * Move user whometa to top in answer
	 *
	 * @since KF 1.0
	 * @param type $a_item
	 */
	public function a_item_main($a_item)
	{
		$this->output('<div class="qa-a-item-main">');
		$this->post_avatar_meta($a_item, 'qa-a-item');

		if (isset($a_item['main_form_tags']))
			$this->output('<form ' . $a_item['main_form_tags'] . '>'); // form for buttons on answer

		if ($a_item['hidden'])
			$answerState = 'hidden';
		elseif ($a_item['selected'])
			$answerState = 'selected';
		else
			$answerState = null;

		if (isset($answerState))
			$this->output('<div class="qa-a-item-' . $answerState . '">');

		$this->a_selection($a_item);
		if (isset($a_item['error']))
			$this->error($a_item['error']);
		$this->a_item_content($a_item);

		if (isset($answerState))
			$this->output('</div>');

		$this->output('<span class="qa-meta-row">');
		$this->post_meta_who($a_item, 'qa-a-item');
		$this->post_meta_what($a_item, 'qa-a-item');
		$this->post_meta_when($a_item, 'qa-a-item');
		
		$this->output('</span>');

		$this->a_item_buttons($a_item);

		if (isset($a_item['c_list']))
			$this->c_list($a_item['c_list'], 'qa-a-item');

		if (isset($a_item['main_form_tags'])) {
			if (isset($a_item['buttons_form_hidden']))
				$this->form_hidden_elements($a_item['buttons_form_hidden']);
			$this->output('</form>');
		}

		$this->c_form(isset($a_item['c_form']) ? $a_item['c_form'] : null);

		$this->output('</div> <!-- END qa-a-item-main -->');
	}

	/**
	 * Move user whometa to top in comment
	 *
	 * @since Snow 1.4
	 * @param type $c_item
	 */
	public function c_item_main($c_item)
	{
		$this->post_avatar_meta($c_item, 'qa-c-item');

		if (isset($c_item['error']))
			$this->error($c_item['error']);

		if (isset($c_item['expand_tags']))
			$this->c_item_expand($c_item);
		elseif (isset($c_item['url']))
			$this->c_item_link($c_item);
		else
			$this->c_item_content($c_item);

		$this->output('<br/><span class="qa-meta-row">');
		$this->post_meta_who($c_item, 'qa-c-item');
		$this->post_meta_what($c_item, 'qa-c-item');
		$this->post_meta_when($c_item, 'qa-c-item');
		$this->output('</span>');

		$this->output('<div class="qa-c-item-footer">');
		$this->c_item_buttons($c_item);
		$this->output('</div>');
	}

	/**
	 * Attributions disabled
	 *
	 * @since KF 1.0
	 */
	public function attribution()
	{

	}

	/**
	 * User account navigation item. This will return based on login information.
	 * If user is logged in, it will populate user avatar and account links.
	 * If user is guest, it will populate login form and registration link.
	 *
	 * @since Snow 1.4
	 */
	private function qam_user_account()
	{
		if (qa_is_logged_in()) {
			// get logged-in user avatar
			$handle = qa_get_logged_in_user_field('handle');
			$toggleClass = 'qam-logged-in';

			if (QA_FINAL_EXTERNAL_USERS)
				$tobar_avatar = qa_get_external_avatar_html(qa_get_logged_in_user_field('userid'), $this->nav_bar_avatar_size, true);
			else {
				$tobar_avatar = qa_get_user_avatar_html(
					qa_get_logged_in_user_field('flags'),
					qa_get_logged_in_user_field('email'),
					$handle,
					qa_get_logged_in_user_field('avatarblobid'),
					qa_get_logged_in_user_field('avatarwidth'),
					qa_get_logged_in_user_field('avatarheight'),
					$this->nav_bar_avatar_size,
					false
				);
			}

			$avatar = strip_tags($tobar_avatar, '<img>');
			if (!empty($avatar))
				$handle = '';
		}
		else {
			// display login icon and label
			$handle = $this->content['navigation']['user']['login']['label'];
			$toggleClass = 'qam-logged-out';
			$avatar = '<i class="icon-key qam-auth-key"></i>';
		}

		// finally output avatar with div tag
		$handleBlock = empty($handle) ? '' : '<div class="qam-account-handle">' . qa_html($handle) . '</div>';
		$this->output(
			'<div id="qam-account-toggle" class="' . $toggleClass . '">',
			$avatar,
			$handleBlock,
			'</div>'
		);
	}

	/**
	 * Add search-box wrapper with extra class for color scheme
	 *
	 * @since Snow 1.4
	 * @version 1.0
	 */
	private function qam_search($addon_class = null, $ids = null)
	{
		$id = isset($ids) ? ' id="' . $ids . '"' : '';

		$this->output('<div class="qam-search ' . $this->ask_search_box_class . ' ' . $addon_class . '"' . $id . '>');
		$this->search();
		$this->output('</div>');
	}

	/**
	 * Dynamic <code>CSS</code> based on options and other interaction with Q2A.
	 *
	 * @since Snow 1.4
	 * @version 1.0
	 * @return string The CSS code
	 */
	private function head_inline_css()
	{
		$css = array('<style>');

		if (!qa_is_logged_in())
			$css[] = '.qa-nav-user { margin: 0 !important; }';

		if (qa_request_part(1) !== qa_get_logged_in_handle()) {
			$css[] = '@media (max-width: 979px) {';
			$css[] = ' body.qa-template-user.fixed, body[class*="qa-template-user-"].fixed { padding-top: 118px !important; }';
			$css[] = ' body.qa-template-users.fixed { padding-top: 95px !important; }';
			$css[] = '}';
			$css[] = '@media (min-width: 980px) {';
			$css[] = ' body.qa-template-users.fixed { padding-top: 105px !important;}';
			$css[] = '}';
		}

		$css[] = '</style>';

		$this->output_array($css);
	}

	/**
	 * Custom ask button for medium and small screen
	 *
	 * @access private
	 * @since Snow 1.4
	 * @version 1.0
	 * @return string Ask button html markup
	 */
	private function ask_button()
	{
		return
			'<div class="qam-ask-search-box">' .
			'<div class="qam-ask-mobile">' .
			'<a href="' . qa_path('ask', null, qa_path_to_root()) . '" class="' . $this->ask_search_box_class . '">' .
			qa_lang_html('main/nav_ask') .
			'</a>' .
			'</div>' .
			'<div class="qam-search-mobile ' . $this->ask_search_box_class . '" id="qam-search-mobile">' .
			'</div>' .
			'</div>';
	}

	/**
	 * Post-output cleanup: do nothing
	 * 
	 * @since KF 1.0
	 */	
	public function finish()
	{

	}

}
