<?php
/**
 * Plugin Name:   Veeltebeleven.nl
 * Plugin URI:    https://veeltebeleven.nl
 * Description:   Veeltebeleven.nl widget plugin
 * Version:       1.0
 * Author:        Stèphan Eizinga
 * Author URI:    https://monkeysoft.nl
 */

class veeltebebleven_Widget extends WP_Widget
{
    // Set up the widget name and description.
    public function __construct()
    {
        $widget_options = ['classname' => 'veeltebeleven_widget', 'description' => 'This is an Example Widget'];
        parent::__construct('veeltebeleven_widget', 'Veeltebeleven', $widget_options);
    }

    // Create the widget output with veeltebeleven widget
    public function widget($args, $instance)
    {
        $title = apply_filters('title', $instance['title']);
        $widget_id = apply_filters('widget_id', $instance['widget_id']);

        echo $args['before_widget'] . $args['before_title'] . $title . $args['after_title']; ?>
        <div id="veeltebeleven-widget" data-widgetid="<?php echo $widget_id ?>" style="width: 100%;"></div>
        <script language="JavaScript" src="//static.veeltebeleven.nl/widget/widget.js"></script>
        <?php echo $args['after_widget'];
    }

    // Create the admin area widget settings form.
    public function form($instance)
    {
        $title = !empty($instance['title']) ? $instance['title'] : '';
        $widget_id = !empty($instance['widget_id']) ? $instance['widget_id'] : ''; ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
            <input type="text" id="<?php echo $this->get_field_id('title'); ?>"
                   name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr($title); ?>"/>
        </p>
        <p>
        <label for="<?php echo $this->get_field_id('widget_id'); ?>">Widget ID:</label>
        <input type="text" id="<?php echo $this->get_field_id('widget_id'); ?>"
               name="<?php echo $this->get_field_name('widget_id'); ?>" value="<?php echo esc_attr($widget_id); ?>"/>
        </p><?php
    }

    // Apply settings to the widget instance.
    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['widget_id'] = strip_tags($new_instance['widget_id']);

        return $instance;
    }
}

// Register the widget to wordpress application.
function veeltebleven_register_widget()
{
    register_widget('veeltebebleven_Widget');
}

add_action('widgets_init', 'veeltebleven_register_widget');

?>
