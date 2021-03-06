<?php
/**
 * Widget Product 1
 *
 *
 * @package 8Store Lite
 */
if (is_woocommerce_available()):
    add_action('widgets_init', 'eightstore_lite_register_post_header_widget');

    function eightstore_lite_register_post_header_widget()
    { //functions start from here
        register_widget('Eightstore_lite_post_header');
    }

    class Eightstore_lite_post_header extends WP_Widget
    {
        /**
         * Register Widget with Wordpress
         *
         */
        public function __construct()
        {
            parent::__construct(
                'eightstore_lite_post_header', 'ES: Header link', array(
                'description' => __('Header Links', 'eightstore-lite')
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
            <div class="col-6 col-md-3 header-link mb-3 mb-md-0">
                <div class="d-flex">
                    <div class="mr-2">
                        <span class="icon"><?php the_field('icon', 'widget_' . $args['widget_id']); ?></span>
                    </div>
                    <div>
                        <div class="title mb-1">
                            <a href="<?php the_field('link', 'widget_' . $args['widget_id']) ?>"><?php the_field('title', 'widget_' . $args['widget_id']); ?></a>
                        </div>
                        <div class="description">
                            <?php the_field('description', 'widget_' . $args['widget_id']); ?>
                        </div>
                    </div>
                </div>

            </div>
            <?php
        }

        public function update($new_instance, $old_instance)
        {}


        public function form($instance)
        {

        }
    }
endif;