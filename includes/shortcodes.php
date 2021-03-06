<?php
/**
 * Outputs a custom shop list.
 */
if (! function_exists('products_custom_shop')) {
    // Add Shortcode
    function products_custom_shop($atts)
    {
        wp_enqueue_style('custom_product-car_rental-main', get_stylesheet_directory_uri() . '/css/shortcodes/custom_product_shop/main.css', false, '1.1', 'all');
        wp_enqueue_style('custom_product-car_rental-popout_modal', get_stylesheet_directory_uri() . '/css/shortcodes/custom_product_shop/popup-modal.css', false, '1.1', 'all');

        $atts = shortcode_atts(
            array(
                'columns'   => '4',
                'limit'     => '20',
                'start'     => current_time('Ymd'),
                'end'       => current_time('Ymd'),
            ),
            $atts,
            'products_custom_shop'
        );
        $order_inv_p = 'asc';
        $order_inv_d = 'asc';
        if (isset($_GET['ch_orderby'])) {
            $orderby = sanitize_text_field($_GET['ch_orderby']);
        } else {
            $orderby = 'date';
        }
        if (isset($_GET['ch_order'])) {
            $order = sanitize_text_field($_GET['ch_order']);
        } else {
            $order = 'asc';
        }
        if(!isset($orderby) && !isset($order)){
            $products = wc_get_products(array(
                'category' => array('Cars'),
                'post_status' => 'published',
                'bookable' => 'yes',
                'order' => 'asc',
            ));
        }else{
            if ($orderby == 'price') {
                $current_sort_page = 'Price';
                $products = wc_get_products(array(
                    'category' => array('Cars'),
                    'post_status' => 'published',
                    'bookable' => 'yes',
                    'orderby'   => 'meta_value_num',
                    'meta_key'  => '_price',
                    'order' => $order,
                ));
                if ($order == 'asc') {
                    $order_inv_p = 'desc';
                }
                if ($order == 'desc') {
                    $order_inv_p = 'asc';
                }
            }
            if ($orderby == 'date') {
                $current_sort_page = 'Date';
                $products = wc_get_products(array(
                    'category' => array('Cars'),
                    'post_status' => 'published',
                    'bookable' => 'yes',
                    'orderby' => 'date',
                    'order' => $order,
                ));
                if ($order == 'asc') {
                    $order_inv_d = 'desc';
                }
                if ($order == 'desc') {
                    $order_inv_d = 'asc';
                }
            }
        }
        if (!empty($products[0])) {
            $products[0]->get_name();
            $products[0]->get_image();
            $easy_booking_settings = get_option('easy_booking_settings');
            $duration = $easy_booking_settings['easy_booking_duration'];
            if ($duration==="days") {
                $duration = "day";
            } ?>
        <script>
            window.carInfo = [];
        </script>
        <div class="products-by-category">
            <p>Order cars by: <br>
                <a style="font-weight: <?php if($orderby == 'date') echo 1000; else echo 400;?>; font-size: 25px;" href="<?php echo site_url(); ?>?ch_orderby=date&ch_order=<?php echo $order_inv_d; ?>">Date</a><span style="font-size: 25px; font-weight: 750;"> - </span>
                <a style="font-weight: <?php if($orderby == 'price') echo 1000; else echo 400;?>; font-size: 25px;" href="<?php echo site_url(); ?>?ch_orderby=price&ch_order=<?php echo $order_inv_p; ?>">Price</a>
            </p>
            <hr style="height:5px; margin-bottom: 15px; margin-top: 15px;">
            <ul>
            <?php
            $image='';
            for ($i=0; $i < count($products); $i++) :
                $customProductAttr = [];
            $product = $products[$i];
            $productInfo = get_post_meta($product->get_id(), 'productInfo', true);
            $image = wp_get_attachment_image_src(get_post_thumbnail_id($product->get_id()), 'single-post-thumbnail');
            if (!$image) {
                $image[0] = wc_placeholder_img_src('woocommerce_single');
            }
            $link = get_permalink($product->get_id());
            $product_attributes = $product->get_attributes();
            foreach ($product_attributes as $taxonomy => $attribute_obj) {
                if (!$attribute_obj['data']['visible']) {
                    continue;
                }

                $attribute_label_name = wc_attribute_label($taxonomy);
                $terms = $attribute_obj->get_terms($taxonomy);

                // Display attribute labe name
                if (!empty($terms) && !is_wp_error($terms)) {
                    for ($j=0; $j < count($terms); $j++) {
                        $termsOut = $terms[$j]->name;
                    }

                    $customProductAttr[] = [
                    'name' => $attribute_label_name,
                    'value' => $termsOut
                    ];
                }
            } ?>
            <li data-order="<?php echo $i; ?>">
                <a>
                    <div class="image">
                        <?php echo $products[$i]->get_image(); ?>
                    </div>
                    <div class="info">
                        <div class="title">
                        <?php echo $products[$i]->get_name(); ?>
                        </div>
                        <div class="price">
                        <?php echo $products[$i]->get_price().get_woocommerce_currency_symbol(); ?>/<?php echo $duration; ?>
                        </div>
                    </div>
                </a>
                <script>
                    var add = {};
                    add.data = {};
                    add.data = <?php echo json_encode($customProductAttr); ?>;
                    add.title = '<?php echo $products[$i]->get_name(); ?>';
                    add.image = '<?php echo $image[0]; ?>';
                    add.itemLink = '<?php echo $link; ?>';
                    add.price = '<?php echo $products[$i]->get_price().get_woocommerce_currency_symbol(); ?>/<?php echo $duration; ?>';
                    carInfo.push(add);
                </script>
            </li>
            <?php endfor; ?>
            </ul>
        </div>
        <?php
        wc_get_template_part('car-info-popup');
        }
    }
    add_shortcode('products_custom_shop', 'products_custom_shop');
}
