<?php

/**
 * [widget description]
 * @param  [type] $atts [description]
 * @return [type]       [description]
 */
function ws_widget($atts) {

    // FIXME

    global $wp_widget_factory;

    extract(shortcode_atts([
        'widget_name' => FALSE,
        'instance' => null,
    ], $atts));

    $widget_name = wp_specialchars($widget_name);

    if (! is_a($wp_widget_factory->widgets[$widget_name], 'WP_Widget')):
        $wp_class = 'WP_Widget_'. ucwords(strtolower($class));

        if (! is_a($wp_widget_factory->widgets[$wp_class], 'WP_Widget')):
            return '<p>'.sprintf(__("%s: Widget class not found. Make sure this widget exists and the class name is correct"),'<strong>'.$class.'</strong>').'</p>';
        else:
            $class = $wp_class;
        endif;
    endif;

    $instance = json_decode($instance);

    ob_start();
        the_widget($widget_name, $instance, [
            'widget_id'     => 'ws-widget-'.$id,
            'before_widget' => '',
            'after_widget'  => '',
            'before_title'  => '',
            'after_title'   => '',
        ]);

        $output = ob_get_contents();
    ob_end_clean();

    return $output;
}
add_shortcode('widget', 'ws_widget');
