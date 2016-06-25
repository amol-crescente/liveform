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

function admin_register_head() {
    $siteurl = get_option('siteurl');
    $url = $siteurl . '/wp-content/plugins/' . basename(dirname(__FILE__)) . '/css/style.css';
    echo "<link rel='stylesheet' type='text/css' href='$url' />\n";
}
add_action('admin_head', 'admin_register_head');



function live_form_init(){
?>

	<div class="wrap" id="liveform-wrap">
		<h2>Welcome To My Plugin</h2>
		<br />
		

		<div id="dialog" title="Tab data">
		  <form>
		    <fieldset class="ui-helper-reset">
		      <label for="tab_title">Title</label>
		      <input type="text" name="tab_title" id="tab_title" value="Tab Title" class="ui-widget-content ui-corner-all">
		      <label for="tab_content">Content</label>
		      <textarea name="tab_content" id="tab_content" class="ui-widget-content ui-corner-all">Tab content</textarea>
		    </fieldset>
		  </form>
		</div>
		 
		
		 
		<div id="tabs">
		  <ul>
		    <li><a href="#tabs-1">Slide 1</a> <span class="ui-icon ui-icon-close" role="presentation">Remove Tab</span></li>
		    <li style="float:right;"><a id="add_tab" href="javscript:">Add New</a></li>
		  </ul>
		  <div id="tabs-1">
		    <p>
		    	<form action="#">
		    		<p>
			            <label for="lf-layout"><strong>1. Select Slide Layout</strong></label><br/>
			            <select style="with:500px;" class="lf-select" name="lf-layout" id="lf-layout">
					      <option>Basic Layout A</option>
					      <option>Basic Layout B</option>
					      <option>Basic Layout C</option>
					      <option>Basic Layout D</option>
					    </select>
			        </p>
			        <div id="lf-view">
			        		<div id="lf-view-sec-a">Section A -Title</div>
			        		<div id="lf-view-sec-b"><h2>Section B</h2></div>
			        		<div id="lf-view-sec-c"><h2>Section C</h2></div>
			        </div>
			        <p>
			            <label><strong>2. Select Slide Title - A</strong></label><br/>
			           	<input type="text" />
			        </p>
			        <p>
			            <label for="lf-content-b"><strong>3. Select Slide Content - B</strong></label><br/>
			            <select style="with:500px;" class="lf-select" name="lf-content-b" id="lf-content-b">
					      <option selected>Event Calendar</option>
					      <option>Text Paragraph</option>
					    </select>
			        </p>
			        <p>
			            <label for="lf-content-c"><strong>3. Select Slide Content - C</strong></label><br/>
			            <select style="with:500px;" class="lf-select" name="lf-content-c" id="lf-content-c">
					      <option>Event Calendar</option>
					      <option selected>Text Paragraph</option>
					    </select><br/>
					    <textarea rows="5" cols="50"></textarea>
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
			            <label><input type="checkbox" /> <strong>Custom Background Color</strong></label>
			        </p>
			        <br/>
			        <hr />
			        <p>
			        	<input class="button action" value="Submit" type="submit" />
			        </p>
		    	</form>
		    </p>
		  </div>
		</div>


	</div>

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<script>

jQuery.noConflict();
(function( $ ) {
  

$(function() {

	$( ".lf-select" ).selectmenu();

    var tabContent = $('#tabs-1').html(),
      	tabTemplate = "<li><a href='#{href}'>#{label}</a> <span class='ui-icon ui-icon-close' role='presentation'>Remove Tab</span></li>",
      	tabCounter = 2;
 
    var tabs = $( "#tabs" ).tabs();
 
    // modal dialog init: custom buttons and a "close" callback resetting the form inside
    var dialog = $( "#dialog" ).dialog({
      autoOpen: false,
      modal: true,
      buttons: {
        Add: function() {
          addTab();
          $( this ).dialog( "close" );
        },
        Cancel: function() {
          $( this ).dialog( "close" );
        }
      },
      close: function() {
        form[ 0 ].reset();
      }
    });
 
    // addTab form: calls addTab function on submit and closes the dialog
    var form = dialog.find( "form" ).submit(function( event ) {
      addTab();
      dialog.dialog( "close" );
      event.preventDefault();
    });
 
    // actual addTab function: adds new tab using the input from the form above
    function addTab() {
      var label = "Slide " + tabCounter,
        id = "tabs-" + tabCounter,
        li = $( tabTemplate.replace( /#\{href\}/g, "#" + id ).replace( /#\{label\}/g, label ) );
 
      tabs.find( ".ui-tabs-nav" ).append( li );
      tabs.append( "<div id='" + id + "'>" + tabContent + "</div>" );
      tabs.tabs( "refresh" );
      tabCounter++;
    }
 
    // addTab button: just opens the dialog
    $( "#add_tab" ).button().click(function() {
        //dialog.dialog( "open" );
        addTab();
    });
 
    // close icon: removing the tab on click
    tabs.delegate( "span.ui-icon-close", "click", function() {
      var panelId = $( this ).closest( "li" ).remove().attr( "aria-controls" );
      $( "#" + panelId ).remove();
      tabs.tabs( "refresh" );
    });
 
    tabs.bind( "keyup", function( event ) {
      if ( event.altKey && event.keyCode === $.ui.keyCode.BACKSPACE ) {
        var panelId = tabs.find( ".ui-tabs-active" ).remove().attr( "aria-controls" );
        $( "#" + panelId ).remove();
        tabs.tabs( "refresh" );
      }
    });
  });



})(jQuery);


  
  </script>

<?php
}
?>