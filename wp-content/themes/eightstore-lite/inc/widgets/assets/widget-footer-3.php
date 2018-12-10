<?php
/**
 * Widget Product 1
 *
 *
 * @package 8Store Lite
 */
if(is_woocommerce_available()):
    add_action('widgets_init', 'eightstore_lite_register_footer_3_widget');

    function eightstore_lite_register_footer_2_widget(){ //functions start from here
        register_widget('Eightstore_lite_footer_3');
    }

    class Eightstore_lite_footer_3 extends WP_Widget {
        /**
         * Register Widget with Wordpress
         *
         */
        public function __construct() {
            parent::__construct(
                'eightstore_lite_cat_product', 'ES: Footer 3', array(
                    'description' => __('Footer 3', 'eightstore-lite')
                )
            );
        }

        /**
         * Helper function that holds widget fields
         * Array is used in update and form functions
         */
        private function widget_fields() {
            return;
        }

        public function widget($args, $instance){

        }

        /**
         * Sanitize widget form values as they are saved.
         *
         * @see WP_Widget::update()
         *
         * @param	array	$new_instance	Values just sent to be saved.
         * @param	array	$old_instance	Previously saved values from database.
         *
         * @uses	eightstore_lite_widgets_updated_field_value()		defined in widget-fields.php
         *
         * @return	array Updated safe values to be saved.
         */
        public function update($new_instance, $old_instance) {
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
         * @see WP_Widget::form()
         *
         * @param	array $instance Previously saved values from database.
         *
         * @uses	eightstore_lite_widgets_show_widget_field()		defined in widget-fields.php
         */
        public function form($instance) {

        }
    }
endif;