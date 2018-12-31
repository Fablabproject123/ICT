<?php
/**
 * Widget Product 1
 *
 *
 * @package 8Store Lite
 */
if (is_woocommerce_available()):
    add_action('widgets_init', 'eightstore_lite_register_product_widget');

    function eightstore_lite_register_product_widget()
    {
        register_widget('eightstore_lite_product');
    }

    class eightstore_lite_product extends WP_Widget
    {
        /**
         * Register Widget with Wordpress
         *
         */
        public function __construct()
        {
            parent::__construct(
                'eightstore_lite_product', 'ES: WC Product Category', array(
                    'description' => __('Category with woocommerce products', 'eightstore-lite')
                )
            );
        }

        /**
         * Helper function that holds widget fields
         * Array is used in update and form functions
         */
        private function widget_fields()
        {

            $prod_type = array(
                'category' => __('Category', 'eightstore-lite'),
                'latest_product' => __('Latest Product', 'eightstore-lite'),
                'upsell_product' => __('UpSell Product', 'eightstore-lite'),
                'feature_product' => __('Feature Product', 'eightstore-lite'),
                'on_sale' => __('On Sale Product', 'eightstore-lite'),
            );
            $taxonomy = 'product_cat';
            $empty = 1;
            $orderby = 'name';
            $show_count = 0;      // 1 for yes, 0 for no
            $pad_counts = 0;      // 1 for yes, 0 for no
            $hierarchical = 1;      // 1 for yes, 0 for no
            $title = '';
            $empty = 0;
            $args = array(
                'taxonomy' => $taxonomy,
                'orderby' => $orderby,
                'show_count' => $show_count,
                'pad_counts' => $pad_counts,
                'hierarchical' => $hierarchical,
                'title_li' => $title,
                'hide_empty' => $empty

            );
            $woocommerce_categories = array();
            $woocommerce_categories_obj = get_categories($args);
            $woocommerce_categories[''] = 'Select Product Category:';
            foreach ($woocommerce_categories_obj as $category) {
                $woocommerce_categories[$category->term_id] = $category->name;
            }

            $fields = array(
                'product_title' => array(
                    'eightstore_lite_widgets_name' => 'product_title',
                    'eightstore_lite_widgets_title' => __('Title', 'eightstore-lite'),
                    'eightstore_lite_widgets_field_type' => 'text',

                ),
                'product_list_desc' => array(
                    'eightstore_lite_widgets_name' => 'product_list_desc',
                    'eightstore_lite_widgets_title' => __('Description', 'eightstore-lite'),
                    'eightstore_lite_widgets_field_type' => 'text',

                ),
                'product_type' => array(
                    'eightstore_lite_widgets_name' => 'product_type',
                    'eightstore_lite_widgets_title' => __('Select Product Type', 'eightstore-lite'),
                    'eightstore_lite_widgets_field_type' => 'select',
                    'eightstore_lite_widgets_field_options' => $prod_type

                ),
                'product_category' => array(
                    'eightstore_lite_widgets_name' => 'product_category',
                    'eightstore_lite_widgets_title' => __('Select Product Category', 'eightstore-lite'),
                    'eightstore_lite_widgets_field_type' => 'select',
                    'eightstore_lite_widgets_field_options' => $woocommerce_categories

                ),

                'product_number' => array(
                    'eightstore_lite_widgets_name' => 'number_of_prod',
                    'eightstore_lite_widgets_title' => __('Select the number of Product to show', 'eightstore-lite'),
                    'eightstore_lite_widgets_field_type' => 'number',
                ),


            );
            return $fields;
        }

        public function widget($args, $instance)
        {
            extract($args);
            if ($instance) {
                $product_title = $instance['product_title'];
                if (isset($instance['product_list_desc'])) {
                    $product_list_desc = $instance['product_list_desc'];
                } else {
                    $product_list_desc = "";
                }
                $product_type = $instance['product_type'];
                $product_category = $instance['product_category'];
                $product_number = $instance['number_of_prod'];
                $product_args = '';
                $manufacturer_images = array();
                if ($product_type == 'category') {
                    $product_args = array(
                        'post_type' => 'product',
                        'tax_query' => array(array('taxonomy' => 'product_cat',
                            'field' => 'id',
                            'terms' => $product_category
                        )),
                        'posts_per_page' => $product_number
                    );
                    //
                    $manufacturer_images = get_field("image", "category_" . $product_category);
                    // print_r(get_term($product_category));


                } elseif ($product_type == 'latest_product') {
                    $product_args = array(
                        'post_type' => 'product',
                        'posts_per_page' => $product_number
                    );
                } elseif ($product_type == 'upsell_product') {
                    $product_args = array(
                        'post_type' => 'product',
                        'posts_per_page' => 10,
                        'meta_key' => 'total_sales',
                        'orderby' => 'meta_value_num',
                        'posts_per_page' => $product_number
                    );
                } elseif ($product_type == 'feature_product') {
                    $product_visibility_term_ids = wc_get_product_visibility_term_ids();
                    $product_args = array(
                        'post_type' => 'product',
                        'posts_per_page' => $product_number,
                        'meta_query' => array(),
                        'tax_query' => array(
                            'relation' => 'AND',
                        ),
                    );
                    $product_args['tax_query'][] = array(
                        'taxonomy' => 'product_visibility',
                        'field' => 'term_taxonomy_id',
                        'terms' => $product_visibility_term_ids['featured'],
                    );
                } elseif ($product_type == 'on_sale') {
                    $product_args = array(
                        'post_type' => 'product',
                        'meta_query' => array(
                            'relation' => 'OR',
                            array( // Simple products type
                                'key' => '_sale_price',
                                'value' => 0,
                                'compare' => '>',
                                'type' => 'numeric'
                            ),
                            array( // Variable products type
                                'key' => '_min_variation_sale_price',
                                'value' => 0,
                                'compare' => '>',
                                'type' => 'numeric'
                            )
                        )
                    );
                }


                $product_loop = new WP_Query($product_args);
                if ($product_loop->have_posts()) {
                    ?>
                    <?php echo $before_widget; ?>
                    <section class="widget-product">
                        <div class="container">
                            <div class="wrap-header-product">
                                <div class="row align-content-center align-items-center">
                                    <div class="col-2">
                                        <h1 class="prod-title">
                                            <?php echo esc_attr($product_title); ?>
                                        </h1>
                                    </div>
                                    <div class="col-10">
                                        <div class="wrap-manufacturer_images">
                                            <?php
                                            if ($manufacturer_images) {
                                                foreach ($manufacturer_images as $key => $value) {
                                                    ?>
                                                    <div class="item"><img src="<?php echo($value['item']); ?>"
                                                                           width="150px" style="margin: auto"></div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php $name = $instance['product_type'] . $instance['product_category']; ?>
                            <div class="products wrapper<?php echo $name ?>">
                                <div class="row">
                                    <?php
                                    while ($product_loop->have_posts()) : $product_loop->the_post();
                                        wc_get_template_part('content', 'product');
                                    endwhile; ?>
                                    <?php wp_reset_query(); ?>
                                </div>
                            </div>
                            <?php if ($product_loop->found_posts > $product_number): ?>
                                <div class="load-more <?php echo $name; ?>">
                                    XEM THÊM SẢN PHẨM
                                </div>
                            <?php endif ?>
                            

                        </div>
                    </section>
                    <script type="text/javascript">
                        $(document).ready(function () {
                            var page<?php echo $name; ?> = 2;
                            var total<?php echo $name; ?> = <?php echo $product_loop->found_posts ?>;
                            var post_per_page<?php echo $name; ?> =  <?php echo $product_number ?>;
                            $(".<?php echo $name; ?>").click(function () {
                                $.ajax({
                                    type: "post",
                                    dataType: "json",
                                    url: '<?php echo admin_url('admin-ajax.php');?>',
                                    data: {
                                        action: "loadingMoreProduct",
                                        instance: <?php echo json_encode($instance); ?>,
                                        page: page<?php echo $name; ?>
                                    },
                                    context: this,
                                    beforeSend: function () {
                                        $(".<?php echo $name; ?>").button('loading')
                                    },
                                    afterSend: function () {
                                        $(".<?php echo $name; ?>").button('reset')
                                    },
                                    success: function (response) {

                                        if (response.success) {
                                            let json = response.data;
                                            let html = "";

                                            for (let product of json) {
                                                let price_html = "";
                                                if(product.is_price_number) {
                                                    price_html = `<div class="text">${product.price}</div>`
                                                } else {
                                                    price_html = `<div class="text">Liên hệ</div>`
                                                }
                                                html += `<div class="col-md-3 product post-678 product type-product status-publish product_cat-autonics first instock shipping-taxable product-type-simple">

                                                            <div class="collection_combine item-img">

                                                                <img src="${product.image_url}" alt="" class="w-100">
                                                                    </div>
                                                            <div class="collection_desc clearfix">
                                                                <div class="title-cart">
                                                                    <a href="${product.url}" class="collection_title">
                                                                        <h3 class="name">${product.title}</h3>
                                                                    </a>

                                                                </div>
                                                                <div class="price-desc">
                                                                    ${price_html}
                                                                </div>
                                                            </div>
                                                        </div>`;
                                            }
                                            $('.wrapper<?php echo $name; ?> .row').append(html)


                                            if(page<?php echo $name; ?> * post_per_page<?php echo $name; ?> >= total<?php echo $name; ?>) {
                                                $(".<?php echo $name; ?>").css('display', 'none')
                                            }
                                        }
                                        else {
                                            alert('Đã có lỗi xảy ra');
                                        }
                                    },
                                    error: function (jqXHR, textStatus, errorThrown) {
                                        console.log('The following error occured: ' + textStatus, errorThrown);
                                    }
                                })
                                return false;
                            })
                            $('.wrap-manufacturer_images').slick({
                                slidesToShow: 6,
                                arrows: true,
                                dots: false,
                                slidesToScroll: 1,
                                responsive: [
                                    {
                                        breakpoint: 992,
                                        settings: {
                                            slidesToShow: 3,
                                            slidesToScroll: 3,
                                            infinite: true,
                                            dots: true,
                                            adaptiveHeight: true
                                        }
                                    },
                                    {
                                        breakpoint: 768,
                                        settings: {
                                            slidesToShow: 1,
                                            slidesToScroll: 1,
                                            infinite: true,
                                            dots: true,
                                            adaptiveHeight: true
                                        }
                                    }
                                ]
                            });
                            $('html, body').animate({
                                scrollTop: $(".fa-envelope").offset().top
                            }, 0);
                        })
                    </script>
                    <?php echo $after_widget; ?>
                    <?php
                } else {
                    //echo "No Products";
                }
            }
        }

        /**
         * Sanitize widget form values as they are saved.
         *
         * @see     WP_Widget::update()
         *
         * @param    array $new_instance Values just sent to be saved.
         * @param    array $old_instance Previously saved values from database.
         *
         * @uses    eightstore_lite_widgets_updated_field_value()        defined in widget-fields.php
         *
         * @return    array Updated safe values to be saved.
         */
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
            $widget_fields = $this->widget_fields();

// Loop through fields
            foreach ($widget_fields as $widget_field) {

// Make array elements available as variables
                extract($widget_field);
                $eightstore_lite_widgets_field_value = !empty($instance[$eightstore_lite_widgets_name]) ? esc_attr($instance[$eightstore_lite_widgets_name]) : '';
                eightstore_lite_widgets_show_widget_field($this, $widget_field, $eightstore_lite_widgets_field_value);
            }
        }
    }
endif;