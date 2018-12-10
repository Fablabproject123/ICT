<?php
/**
 * Widget Product 4
 *
 *
 * @package 8Store Lite
 */
if(is_woocommerce_available()):
    add_action('widgets_init', 'eightstore_lite_register_footer_4_widget');

    function eightstore_lite_register_footer_4_widget(){ //functions start from here
        register_widget('Eightstore_lite_footer_4');
    }

    class Eightstore_lite_footer_4 extends WP_Widget {

        public function __construct() {
            parent::__construct(
                'eightstore_lite_footer_4', 'ES: Footer 4', array(
                    'description' => __('Footer 4', 'eightstore-lite')
                )
            );
        }
        private function widget_fields() {
            return;
        }

        public function widget($args, $instance){
            ?>
            <div class="col-3">
                <?php the_field('facebook', 'widget_' . $args['widget_id']); ?>
            </div>
        <?php           
        }
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

        public function form($instance) {

        }
    }
endif;