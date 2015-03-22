<?php
/*
Plugin Name: Terror Alert Level
Plugin URI: http://smartfan.pl/
Description: Widget that shows terror alert level based on news agencies.
Author: Piotr Pesta
Version: 1.0.0
Author URI: http://smartfan.pl/
License: GPL12
*/

include 'functions.php';

class terror_alert extends WP_Widget {

// konstruktor widgetu
function terror_alert() {

	$this->WP_Widget(false, $name = __('Terror Alert', 'wp_widget_plugin') );

}

function update($new_instance, $old_instance) {
$instance = $old_instance;
// Pola
$instance['title'] = strip_tags($new_instance['title']);
return $instance;
}

// tworzenie widgetu, back end (form)

function form($instance) {

// nadawanie i łączenie defaultowych wartości
	$defaults = array('title' => 'Terror Alert Level');
	$instance = wp_parse_args( (array) $instance, $defaults );
?>

<p>
	<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
	<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
</p>

<?php

}

// wyswietlanie widgetu, front end (widget)
function widget($args, $instance) {
extract( $args );

// these are the widget options
$title = apply_filters('widget_title', $instance['title']);
echo $before_widget;

// Check if title is set
if ( $title ) {
echo $before_title . $title . $after_title;
}

TerrorAlertFetch();

echo $after_widget;
}
}

// register widget
add_action('widgets_init', create_function('', 'return register_widget("terror_alert");'));

add_action('wp_enqueue_scripts', function () { 
        wp_enqueue_style( 'terror_alert', plugins_url('style-terror-alert.css', __FILE__));
    });

?>