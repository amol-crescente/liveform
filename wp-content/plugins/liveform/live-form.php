<?php
/**
* Plugin Name: Live Form
* Plugin URI: http://crescente.in/
* Description: live form with fields
* Version: 1.0
* Author: crescente
**/
?>

<?php
// Register the Custom Music Review Post Type
 

function liveform_init() {
	add_menu_page( 'Live Form Menu', 'Live Form', 'manage_options', 'liveform', 'live_form_init', 'dashicons-exerpt-view', 6  );
}
add_action( 'admin_menu', 'liveform_init' );

/*function admin_register_head() {
    $siteurl = get_option('siteurl');
    $cssurl = $siteurl . '/wp-content/plugins/' . basename(dirname(__FILE__)) . '/css/style.css';
    $angurl = $siteurl . '/wp-content/plugins/' . basename(dirname(__FILE__)) . '/js/angular.min.js';
    $appjsurl = $siteurl . '/wp-content/plugins/' . basename(dirname(__FILE__)) . '/js/app.js';
    echo "<link rel='stylesheet' type='text/css' href='$cssurl' />\n";

    echo "<script type='text/javascript' src='$angurl'></script>\n";
    echo "<script type='text/javascript' src='$appjsurl'></script>\n";
}

add_action('admin_head', 'admin_register_head');*/

function load_liveform_files() {
		$pluginURL = get_option('siteurl'). '/wp-content/plugins/' . basename(dirname(__FILE__));

        wp_enqueue_style( 'liveform_style', $pluginURL . '/css/style.css', false, '1.0.0' );

        $handle = 'angular.min.js';
	    $list = 'queue';
	    if (wp_script_is( $handle, $list )) {
	       wp_enqueue_script( 'liveform_app_script', $pluginURL . '/js/app.js' );	
	       return;
	    } else {
	       wp_enqueue_script( 'angular.min.js', $pluginURL . '/js/angular.min.js' );
	       wp_enqueue_script( 'liveform_app_script', $pluginURL . '/js/app.js' );
	    }
        
}
add_action( 'admin_enqueue_scripts', 'load_liveform_files' );



function live_form_init(){
?>

	<div ng-app="appLiveForm" ng-controller="LiveForm_Ctrl" class="wrap" id="liveform-wrap">
		<h2>Live Slider Form</h2>
		<br />
		<a id="add_tab" ng-click="addlfSlide()" href="javscript:">Add New</a>
		<div id="tabs">
		  <ul>
		    <!--<li><a href="#tabs-1">Slide 1</a> <span class="ui-icon ui-icon-close" role="presentation">Remove Tab</span></li> -->		    
		    <li data-ng-repeat="(key,val) in lf_slides" role="tab">
		    	<a href="#tabs-{{key+1}}" class="ui-tabs-anchor" role="presentation">Slide {{key+1}}</a> <span class="ui-icon ui-icon-close" ng-click="removelfSlide(key)">Remove Tab</span>
		    </li>

		    
		  </ul>
		  <div data-ng-repeat="(key,val) in lf_slides" id="tabs-{{key+1}}"  >
		    <p>
		    	<form action="#">

		    		<p>
			            <label for="lf-layout"><strong>1. Select Slide Layout</strong></label><br/>
			            <select style="with:500px;" class="lf-select" name="lf-layout" ng-model="lf_layout[key]" ng-init="lf_layout[key] = 'layout_a'">
					      <option value="layout_a">Basic Layout A</option>
					      <option value="layout_b">Basic Layout B</option>
					      <option value="layout_c">Basic Layout C</option>
					    </select>
			        </p>
			        <div id="lf-view-a" class="lf-view" ng-show="lf_layout[key] == 'layout_a'">
		        		<div class="lf-view-sec-a"><span ng-hide="title_a[key]">Section A -Title</span><span ng-Show="title_a[key]">{{title_a[key]}}</span></div>
		        		<div class="lf-view-sec-b"><h2>Section B</h2> <span ng-show="lf_content_b[key] == '7'">{{lf_b_txt[key]}}</span></div>
		        		<div class="lf-view-sec-c"><h2>Section C</h2> <span ng-show="lf_content_c[key] == '7'">{{lf_c_txt[key]}}</span></div>
			        </div>

			        <div id="lf-view-b" class="lf-view" ng-show="lf_layout[key] == 'layout_b'">		        		
		        		<div class="lf-view-sec-b"><h2>Section B</h2> <span ng-show="lf_content_b[key] == '7'">{{lf_b_txt[key]}}</span></div>
		        		<div class="lf-view-sec-c"><h2>Section C</h2> <span ng-show="lf_content_c[key] == '7'">{{lf_c_txt[key]}}</span></div>
		        		<div class="lf-view-sec-a"><span ng-hide="title_a[key]">Section A -Title</span><span ng-Show="title_a[key]">{{title_a[key]}}</span></div>
			        </div>

			        <div id="lf-view-c" class="lf-view" ng-show="lf_layout[key] == 'layout_c'">
		        		<div class="lf-view-sec-a"><h2>Section A</h2><span ng-hide="title_a[key]">Title</span><span ng-Show="title_a[key]">{{title_a[key]}}</span></div>
		        		<div class="lf-view-sec-b"><h2>Section B</h2><span>&nbsp;</span><span ng-show="lf_content_b[key] == '7'">{{lf_b_txt[key]}}</span></div>
		        		<div class="lf-view-sec-c"><h2>Section C</h2><span>&nbsp;</span><span ng-show="lf_content_c[key] == '7'">{{lf_c_txt[key]}}</span></div>
			        </div>
			        <p>
			            <label><strong>2. Select Slide Title - A</strong></label><br/>
			           	<input type="text" ng-model="title_a[key]" />
			        </p>
			        <p>
			            <label for="lf-content-b"><strong>3. Select Slide Content - B</strong></label><br/>
			            <select style="with:500px;" class="lf-select" name="lf-content-b" ng-model="lf_content_b[key]" ng-init="lf_content_b[key] = '1'">
					      <option value="1">Event Calendar (today)</option>
					      <option value="2">Event Calendar (this week)</option>
					      <option value="3">Dining Menu (today, with photo)</option>
					      <option value="4">Dining Menu (today, no photo)</option>
					      <option value="5">Featured Resident (with photo)</option>
					      <option value="6">Large photo</option>
					      <option value="7">Paragraph Text</option>
					    </select><br/>
					    <input type="file" ng-show="lf_content_b[key] == '6'" />
					    <textarea ng-show="lf_content_b[key] == '7'" ng-model="lf_b_txt[key]" rows="5" cols="50"></textarea>
			        </p>
			        <p>
			            <label for="lf-content-c"><strong>4. Select Slide Content - C</strong></label><br/>
			            <select style="with:500px;" class="lf-select" name="lf-content-c" ng-model="lf_content_c[key]" ng-init="lf_content_c[key] = '7'">
					      <option value="1">Event Calendar (today)</option>
					      <option value="2">Event Calendar (this week)</option>
					      <option value="3">Dining Menu (today, with photo)</option>
					      <option value="4">Dining Menu (today, no photo)</option>
					      <option value="5">Featured Resident (with photo)</option>
					      <option value="6">Large photo</option>
					      <option value="7">Paragraph Text</option>
					    </select><br />
					    <input type="file" ng-show="lf_content_c[key] == '6'" />
					    <textarea ng-show="lf_content_c[key] == '7'" ng-model="lf_c_txt[key]" rows="5" cols="50"></textarea>
			        </p>
			        <p>
			            <label><strong>5. Set Scrolling Time</strong></label><br/>
			           	<input type="text" />
			        </p>
			        <p>
			            <label for="lf-animation"><strong>6. Set Animation</strong></label><br/>
			            <select style="with:500px;" class="lf-select" name="lf-animation" id="lf-animation">
					      <option selected>Fade Left</option>
					      <option>Fade Right</option>
					      <option>Fade Bottom</option>
					      <option>Fade Top</option>
					    </select>
			        </p>
			        <p>
			            <label><input type="checkbox" /> <strong>Show Community Logo</strong></label>
			        </p>
			        <p>
			            <label><input type="checkbox" ng-model="slide_bg_chk[key]" /> <strong>Custom Background Color</strong></label><br/>
			            <span ng-show="slide_bg_chk[key]">
				            <input type="text" ng-model="slide_bg[key]" />
				            <input type="color" ng-model="slide_bg[key]" />
			            </span>
			        </p>
			        <br/>
			        <hr />
			        <p>
			        	<input class="button action" value="Submit" type="submit" />
			        </p>
		    	</form>
		    </p>
		  </div>
		</div><!-- End : #tabs -->


		<script id="templates/from.html" type="text/ng-template">
	      
	    </script>


	</div>

<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<script>

jQuery.noConflict();
(function( $ ) {

$(function() {

	//$( ".lf-select" ).selectmenu();
	var tabs = $( "#tabs" ).tabs();
	$( "#add_tab" ).button();

	/*tabs.delegate( "span.ui-icon-close", "click", function() {
      var panelId = $( this ).closest( "li" ).remove().attr( "aria-controls" );
      $( "#" + panelId ).remove();
      tabs.tabs( "refresh" );
    });*/

});

})(jQuery);


function refreshtabs(){
	var nc = jQuery.noConflict();
	//nc( ".lf-select" ).selectmenu();
	nc("#tabs").tabs("refresh");
}
  
</script>

<?php
}