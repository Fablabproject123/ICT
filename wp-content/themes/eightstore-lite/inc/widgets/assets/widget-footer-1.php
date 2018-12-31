<?php
/**
 * Widget Product 1
 *
 *
 * @package 8Store Lite
 */
if (is_woocommerce_available()):
    add_action('widgets_init', 'eightstore_lite_register_footer_1_widget');

    function eightstore_lite_register_footer_1_widget()
    { //functions start from here
        register_widget('Eightstore_lite_footer_1');
    }

    class Eightstore_lite_footer_1 extends WP_Widget
    {
        /**
         * Register Widget with Wordpress
         *
         */
        public function __construct()
        {
            parent::__construct(
                'eightstore_lite_footer_1', 'ES: Footer 1', array(
                    'description' => __('Footer 1', 'eightstore-lite')
                )
            );
        }

        /**
         * Helper function that holds widget fields
         * Array is used in update and form functions
         */
        private function widget_fields()
        {
            return;
        }

        public function widget($args, $instance)
        {
            ?>
            <div class="col-12">
                <div class="d-flex justify-content-between align-content-center align-items-center">
                    <img src="<?php echo get_field('logo_footer', 'widget_' . $args['widget_id'])['url']; ?>">
                    <?php do_action('eightstore_lite_social_links'); ?>
                </div>

            </div>
            <div class="col-md-3 footer-1">
                <div class="d-flex"><span class="mr-2"><i class="fa fa-envelope"></i></span><?php the_field('email', 'widget_' . $args['widget_id']); ?></div>
                <div class="d-flex"><span class="mr-2"><i class="fa fa-map-marker"></i></span><?php the_field('address', 'widget_' . $args['widget_id']); ?></div>
                <div class="d-flex"><span class="mr-2"><i class="fa fa-phone-square"></i></span><?php the_field('phone', 'widget_' . $args['widget_id']); ?></div>
            </div>
            <?php
        }

        public function update($new_instance, $old_instance)
        {
            $instance = $old_instance;

            $widget_fields = $this->widget_fields();

            // Loop through fields
            foreach ($widget_fields as $widget_field) {

                extract($widget_field);

                // Use helper function to get updated field values
                $instance[$eightstore_lite_widgets_name] = eightstore_lite_widgets_updated_field_value($widget_field, $new_instance[$eightstore_lite_widgets_name]);
            }

            return $instance;
        }

        /**
         * Back-end widget form.
         *
         * @see     WP_Widget::form()
         *
         * @param    array $instance Previously saved values from database.
         *
         * @uses    eightstore_lite_widgets_show_widget_field()        defined in widget-fields.php
         */
        public function form($instance)
        {

        }
    }
endif;