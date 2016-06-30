<?php
/**
* Plugin Name: Home Layout
* Plugin URI: http://crescente.in/
* Description: Settings For Home Layout within Senior Portal
* Version: 1.0
* Author: Crescente
**/
?>

<?php

function homelayout_init() {
	add_menu_page( 'Home Layout Menu', 'Home Layout', 'manage_options', 'homelayout', 'home_layout_init', 'dashicons-welcome-widgets-menus', 6  );
}
add_action( 'admin_menu', 'homelayout_init' );


/*function admin_register_head() {
    $siteurl = get_option('siteurl');
    $cssurl = $siteurl . '/wp-content/plugins/' . basename(dirname(__FILE__)) . '/css/style.css';
    $appjsurl = $siteurl . '/wp-content/plugins/' . basename(dirname(__FILE__)) . '/js/app.js';
    echo "<link rel='stylesheet' type='text/css' href='$cssurl' />\n";
    echo "<script type='text/javascript' src='$appjsurl'></script>\n";
}
add_action('admin_head', 'admin_register_head');*/

function load_homelayout_files() {
		$pluginURL = get_option('siteurl'). '/wp-content/plugins/' . basename(dirname(__FILE__));

        wp_enqueue_style( 'homelayout_style', $pluginURL . '/css/style.css', false, '1.0.0' );

        $handle = 'angular.min.js';
	    $list = 'queue';
	    if (wp_script_is( $handle, $list )) {
	       return;
	    } else {
	       wp_enqueue_script( 'angular.min.js', $pluginURL . '/js/angular.min.js' );
	    }
        wp_enqueue_script( 'homelayout_app_script', $pluginURL . '/js/app.js' );
}
add_action( 'admin_enqueue_scripts', 'load_homelayout_files' );


function home_layout_init(){
	$layout_img_url = get_option('siteurl'). '/wp-content/plugins/' . basename(dirname(__FILE__));
?>

	<div ng-app="appHomeLayout" ng-controller="HomeLayout_Ctrl" class="wrap" id="homelayout-wrap">
		<h2>Home Layout</h2>
		<br />


		<form id="homelayout-content">

			<div class="form-group">
				<label>1. Select Homepage Layout</label>
				<Select ng-model="hl_layout" ng-init="hl_layout='0'">
					<option value="0">Basic Layout A</option>
					<option value="1">Basic Layout B</option>
					<option value="2">Basic Layout C</option>
				</Select>
			</div>

			<img ng-show="hl_layout == '0'" class="layout-img" src="<?php echo $layout_img_url ?>/img/layout-a.png" />
			<img ng-show="hl_layout == '1'" class="layout-img" src="<?php echo $layout_img_url ?>/img/layout-b.png" />
			<img ng-show="hl_layout == '2'" class="layout-img" src="<?php echo $layout_img_url ?>/img/layout-c.png" />


			<!--<div id="layout-A">
				<div class="sec-a text-center">A</div>
				<div class="col-wrap">
					<div class="col3 text-center sec-b">B</div>
					<div class="col3 text-center sec-c">C</div>
					<div class="col3 text-center sec-d">D</div>
				</div>
			</div>-->


			<div class="form-group">
				<label>2. Select Hero A Content</label>
				<Select>
					<option>Static Photo</option>
					<option>Multiple Photos</option>
				</Select>
			</div><br />

			<div class="form-group">
				<label>3. Select Widget B Content</label>
				<Select>
					<option>Today's Weather</option>
					<option>Date And Time</option>
					<option>Announcement</option>
				</Select>
			</div><br />

			<div class="form-group">
				<label>4. Select Widget C Content</label>
				<Select>
					<option>Today's Weather</option>
					<option selected>Date And Time</option>
					<option>Announcement</option>
				</Select>
			</div><br />

			<div class="form-group">
				<label>5. Select Widget D Content</label>
				<Select>
					<option>Today's Weather</option>
					<option>Date And Time</option>
					<option selected>Announcement</option>
				</Select>
			</div><br />

			<hr /><br />

			<input class="button" type="sumbit" value="Save Settings" />

		</form>


	</div>

<?php
}