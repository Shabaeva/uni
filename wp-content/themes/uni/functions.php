<?php

require get_theme_file_path('/inc/search-route.php');

function uni_custom_rest(){
    register_rest_field('post', 'authorName', array(
        'get_callback' => function(){ return get_the_author();}
    ));
}
add_action('rest_api_init', 'uni_custom_rest');


function add_theme_scripts(){
  
    wp_enqueue_style('custom-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('style', get_stylesheet_uri(), NULL, microtime());
    wp_enqueue_script('script', get_theme_file_uri('/js/scripts-bundled.js'), NULL, microtime(), true);
   // wp_enqueue_script('script', get_theme_file_uri('/js/modules/search.js'), 
          //            array('jquery'), microtime(), true);
    wp_enqueue_script('googleMap', '//maps.googleapis.com/maps/api/js?key=AIzaSyDNiihr6FG45yH5MB0jeZ7uMJh3acl6Ev8', NULL, '1.0', true);
     wp_localize_script('script', 'uniData', array(
        'root_url' => get_site_url(),
		'nonce' => wp_create_nonce('wp_rest')
    ));
    
}
add_action('wp_enqueue_scripts', 'add_theme_scripts');

function university_features(){
    
    register_nav_menu('header_menu_location', 'Header Menu');
    register_nav_menu('footer_menu_location_one', 'Footer Menu One');
    register_nav_menu('footer_menu_location_two', 'Footer Menu Two');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_image_size('professorLandscape', 400, 260, true);
    add_image_size('professorPortrait', 480, 650, true);
    add_image_size('pageBanner', 1500, 350, true);
}
add_action('after_setup_theme', 'university_features');

add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);

function special_nav_class ($classes, $item) {
    if (in_array('current-menu-item', $classes)) {
        $classes[] = 'active ';
    }
    return $classes;
}

function uni_adjust_queries($query){
	
    if(!is_admin() && is_post_type_archive('campus') && $query->is_main_query()){
		
		$query->set('posts_per_page', -1);
		
	}
	if(!is_admin() && is_post_type_archive('program') && $query->is_main_query()){
		
		$query->set('orderby', 'title');
		$query->set('order', 'ASC');
		$query->set('posts_per_page', -1);
		
	}
    if(!is_admin() && is_post_type_archive('event') && $query->is_main_query()){     
         $today = date('Ymd');
		$query->set('meta_key', 'event_date');
		$query->set('orderby', 'meta_value_num');
		$query->set('order', 'ASC');
		$query->set('meta_query', array(
                    array(
                        'key' => 'event_date',
                        'compare' => '>=',
                        'value' => $today,
                        'type' => 'numeric'
                    )
                ));
}
}

add_action('pre_get_posts', 'uni_adjust_queries');

function pageBanner($args = NULL){

if(!$args['title']){

$args['title'] = get_the_title();

}

if(!$args['subtitle']){

$args['subtitle'] = get_field('page_banner_subtitle');
}

if(!$args['photo']){
if(get_field('page_banner_background_image')){
$args['photo'] = get_field('page_banner_background_image')['sizes']['pageBanner'];
}else{
$args['photo'] = get_theme_file_uri('/images/ocean.jpg');
}

}


?>
<div class="page-banner">
    <div class="page-banner__bg-image" style="background-image:  url(<?php echo $args['photo']; ?>);"></div>
    <div class="page-banner__content container container--narrow">
        <h1 class="page-banner__title">
            <?php echo $args['title']; ?>
        </h1>
        <div class="page-banner__intro">
            <p>
                <?php echo $args['subtitle']; ?>
            </p>
        </div>
    </div>
</div>

<?php }

//function universityMapKey($api) {
//
// $api['key'] = '';
// return $api;
//}
//
//add_filter('acf/fields/google_map/api', 'universityMapKey');

//Reditect subscriber accounts out of admin and onto homepage
add_action('admin_init', redirectSubs);
function redirectSubs(){
    $currentUser = wp_get_current_user();
    if(count($currentUser->roles) == 1 AND $currentUser->roles[0] == 'subscriber'){
        wp_redirect(site_url('/'));
        exit;
    }
}

add_action('wp_loaded', noSubsAdminBar);
function noSubsAdminBar(){
    $currentUser = wp_get_current_user();
    if(count($currentUser->roles) == 1 AND $currentUser->roles[0] == 'subscriber'){
       show_admin_bar(false);
    }
}

//cistomize login screen
add_filter('login_headerurl', 'ourHeader');

function ourHeader(){
    return esc_url(site_url('/'));
}

add_action('login_enqueue_scripts', 'ourLoginCSS');

function ourLoginCSS(){
    wp_enqueue_style('style', get_stylesheet_uri(), NULL, microtime());
    wp_enqueue_style('custom-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
}

add_filter('login_headertitle', 'ourLoginTitle');
function ourLoginTitle(){
    return get_bloginfo('name');
}