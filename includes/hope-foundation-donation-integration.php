<?php
/**
 * Initialize Hope Foundation Donations
 */

add_action('init', 'hope_foundation_init_donations');
function hope_foundation_init_donations() {
    if (is_admin() && !wp_doing_ajax()) {
        return;
    }
    
    // Add donation field to checkout
    add_action('woocommerce_after_order_notes', 'hope_foundation_add_donation_field', '10');
    
    add_action('woocommerce_after_order_notes', 'tefl_checkout_trustpilot_slider', 20);

    // Process donation selection
    add_action('woocommerce_checkout_process', 'hope_foundation_process_donation');
    
    // Save donation data to order
    add_action('woocommerce_checkout_update_order_meta', 'hope_foundation_save_donation_data');
    
    // Add donation as fee to cart
    add_action('woocommerce_cart_calculate_fees', 'hope_foundation_add_donation_fee',20);
    
    // Display donation info in admin order details
    add_action('woocommerce_admin_order_data_after_billing_address', 'hope_foundation_display_admin_donation');
    
	add_action('woocommerce_checkout_update_order_review', 'hope_foundation_handle_checkout_update');

}

function tefl_checkout_trustpilot_slider() {
    ?>
    
    <div class="checkout-trustpilot-slider" style="margin-top:30px; width:100%;">

        <script
            type="text/javascript"
            src="https://widget.trustpilot.com/bootstrap/v5/tp.widget.bootstrap.min.js"
            async>
        </script>

        <div class="trustpilot-widget"
            data-locale="en-US"
            data-template-id="54ad5defc6454f065c28af8b"
            data-businessunit-id="61c0c19118c53fc28bcc355d"
            data-style-height="240px"
            data-style-width="100%"
            data-token="a6ac3be3-77a7-4df2-9f18-447910dd2aa1"
            data-stars="4,5"
            data-review-languages="en">

            <a href="https://www.trustpilot.com/review/teflinstitute.com"
               target="_blank"
               rel="noopener">
                Trustpilot
            </a>

        </div>

    </div>

    <?php
}

/**
 * Handle checkout update order review
 */
function hope_foundation_handle_checkout_update($post_data) {
    parse_str($post_data, $data);
    
    if (isset($data['hope_foundation_donation'])) {
        if (!empty($data['hope_foundation_donation'])) {
            $donation_eur = floatval($data['hope_foundation_donation']);
            WC()->session->set('hope_foundation_donation', $donation_eur);
        } else {
            WC()->session->__unset('hope_foundation_donation');
        }
    }
}

/**
 * Get donation amounts - base amounts in EUR
 */
function hope_foundation_get_donation_amounts() {
    return array(2, 5, 10, 20, 50);
}

/**
 * Convert currency using WCPBC exchange rates
 */
function hope_foundation_convert_currency($amount, $from_currency, $to_currency) {
    if ($from_currency === $to_currency) {
        return $amount;
    }

    if (class_exists('WCPBC_Update_Exchange_Rates')) {
        $converted_amount = WCPBC_Update_Exchange_Rates::convert(array(
            'amount' => $amount,
            'from'   => $from_currency,
            'to'     => $to_currency
        ));
        return $converted_amount;
    }
    
    return $amount;
}

/**
 * Get donation amounts converted to current currency
 */
function hope_foundation_get_donation_amounts_in_currency($current_currency) {
    $base_amounts = hope_foundation_get_donation_amounts();
    $amounts = array();
    
    foreach ($base_amounts as $eur_amount) {
        if ($current_currency === 'EUR') {
            $display_amount = $eur_amount;
            $formatted = wc_price($display_amount);
        } else {
            // Convert from EUR to current currency using WCPBC
            $converted_amount = hope_foundation_convert_currency($eur_amount, 'EUR', $current_currency);
            $display_amount = round($converted_amount, 2);
            $formatted = wc_price($display_amount);
        }
        
        $amounts[$eur_amount] = array(
            'amount' => $display_amount,
            'formatted' => $formatted
        );
    }
    
    return $amounts;
}

/**
 * Add donation field to checkout page
 */
function hope_foundation_add_donation_field() {
    $current_currency = get_woocommerce_currency();
    $donation_amounts_display = hope_foundation_get_donation_amounts_in_currency($current_currency);
    
    ?>
    <div id="hope-foundation-donation" class="woocommerce-additional-fields">
        <h3><?php _e('Support The Hope Foundation', 'hope-foundation-donations'); ?></h3>
        
        <div class="hope-foundation-info">
            <div class="hope-foundation-logo">
                <img src="/wp-content/uploads/2025/09/Amanda-Neri-to-perform-at-Hope-Foundation-Christmas-Concert-–-TheCork____.png" 
                     alt="Hope Foundation Logo" style="max-width: 100px; height: auto;">
            </div>
            <div class="hope-foundation-description">
                <p><?php _e('Please consider making an optional donation to our charity partner, The Hope Foundation. Your contribution will help provide vital education for vulnerable children in Kolkata, India. Together, we can create brighter futures.', 'hope-foundation-donations'); ?></p>
            </div>
        </div>

        <div class="donation-options">
            <p class="form-row form-row-wide">
                <label for="hope_foundation_donation"><?php _e('Choose donation amount (optional):', 'hope-foundation-donations'); ?></label>
                <?php 
                // Get selected donation from session
                $selected_donation = WC()->session ? WC()->session->get('hope_foundation_donation', '') : '';
                ?>

                <select name="hope_foundation_donation" id="hope_foundation_donation" class="select">
                    <option value="" <?php selected($selected_donation, ''); ?>><?php _e('No donation', 'hope-foundation-donations'); ?></option>
                    <?php foreach ($donation_amounts_display as $eur_amount => $display_amount): ?>
                        <option value="<?php echo esc_attr($eur_amount); ?>" 
                                data-display-amount="<?php echo esc_attr($display_amount['formatted']); ?>"
                                <?php selected($selected_donation, $eur_amount); ?>>
                            <?php if ($current_currency !== 'EUR'): ?>
                                €<?php echo number_format($eur_amount, 2); ?> (<?php echo wp_strip_all_tags($display_amount['formatted']); ?>)
                            <?php else: ?>
                                €<?php echo number_format($eur_amount, 2); ?>
                            <?php endif; ?>
                        </option>
                    <?php endforeach; ?>
                </select>

            </p>
        </div>
    </div>
    <?php
}

/**
 * Preserve donation selection in session during checkout process
 */
add_action('wp_loaded', 'hope_foundation_preserve_donation_session');
function hope_foundation_preserve_donation_session() {
    if (!is_checkout() || is_admin()) {
        return;
    }
    
    if (isset($_POST['hope_foundation_donation']) && WC()->session) {
        $donation_value = sanitize_text_field($_POST['hope_foundation_donation']);
        if (!empty($donation_value)) {
            WC()->session->set('hope_foundation_donation', floatval($donation_value));
        } elseif ($donation_value === '') {
            WC()->session->__unset('hope_foundation_donation');
        }
    }
    
}

/**
 * Add CSS styles for donation section
 */
add_action('wp_head', 'hope_foundation_add_checkout_styles');
function hope_foundation_add_checkout_styles() {
    if (!is_checkout()) {
        return;
    }
    ?>
    <style type="text/css">
    #hope-foundation-donation {
        background: #f8f9fa;
        border: 1px solid #e9ecef;
        border-radius: 8px;
        padding: 20px;
        margin: 20px 0;
    }
    
    #hope-foundation-donation h3 {
        color: #28a745;
        margin-top: 0;
        font-size: 1.2em;
        margin-bottom: 15px;
    }
    
    .hope-foundation-info {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 15px;
    }
    
    .hope-foundation-logo img {
        border-radius: 4px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .hope-foundation-description p {
        margin: 0;
        font-size: 0.95em;
        line-height: 1.4;
        color: #555;
    }
    
    .donation-options select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        background-color: white;
    }
    
    .donation-options label {
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
        display: block;
    }
    
    @media (max-width: 768px) {
        .hope-foundation-info {
            flex-direction: column;
            text-align: center;
        }
        
        #hope-foundation-donation {
            padding: 15px;
        }
    }
    </style>
    <?php
}

/**
 * Process donation field validation
 */
function hope_foundation_process_donation() {
    if (isset($_POST['hope_foundation_donation']) && !empty($_POST['hope_foundation_donation'])) {
        $donation_amount = floatval($_POST['hope_foundation_donation']);
        $valid_amounts = hope_foundation_get_donation_amounts();

        if (!in_array($donation_amount, $valid_amounts)) {
            wc_add_notice(__('Invalid donation amount selected.', 'hope-foundation-donations'), 'error');
        }
    }
}

/**
 * Add donation as fee to cart
 */
function hope_foundation_add_donation_fee() {
    if (is_admin() && !defined('DOING_AJAX')) {
        return;
    }

    $donation_eur = 0;
    
    if (defined('DOING_AJAX') && isset($_POST['action']) && $_POST['action'] === 'woocommerce_update_order_review') {
        if (isset($_POST['post_data'])) {
            parse_str($_POST['post_data'], $posted_data);
            if (isset($posted_data['hope_foundation_donation']) && !empty($posted_data['hope_foundation_donation'])) {
                $donation_eur = floatval($posted_data['hope_foundation_donation']);
                WC()->session->set('hope_foundation_donation', $donation_eur);
            } elseif (isset($posted_data['hope_foundation_donation']) && $posted_data['hope_foundation_donation'] === '') {
                WC()->session->__unset('hope_foundation_donation');
                return;
            }
        }
    }

    if (!$donation_eur && isset($_POST['hope_foundation_donation']) && !empty($_POST['hope_foundation_donation'])) {
        $donation_eur = floatval($_POST['hope_foundation_donation']);
        WC()->session->set('hope_foundation_donation', $donation_eur);
    } elseif (!$donation_eur && WC()->session) {
        $donation_eur = WC()->session->get('hope_foundation_donation', 0);
    }

    if ($donation_eur > 0) {
        $current_currency = get_woocommerce_currency();
        
        if ($current_currency === 'EUR') {
            $donation_amount = $donation_eur;
        } else {
            $donation_amount = hope_foundation_convert_currency($donation_eur, 'EUR', $current_currency);
        }

        WC()->cart->add_fee(
            __('Hope Foundation Donation', 'hope-foundation-donations'),
            $donation_amount,
            false 
        );
        
    }
}

/**
 * Save donation data to order
 */
function hope_foundation_save_donation_data($order_id) {
    $donation_eur = 0;
    
    if (isset($_POST['hope_foundation_donation']) && !empty($_POST['hope_foundation_donation'])) {
        $donation_eur = floatval($_POST['hope_foundation_donation']);
    } elseif (WC()->session && WC()->session->get('hope_foundation_donation')) {
        $donation_eur = WC()->session->get('hope_foundation_donation');
    }
    
    if ($donation_eur > 0) {
        $current_currency = get_woocommerce_currency();
        
        $donation_display = ($current_currency === 'EUR') ? $donation_eur : hope_foundation_convert_currency($donation_eur, 'EUR', $current_currency);
  
        update_post_meta($order_id, '_hope_foundation_donation_eur', $donation_eur);
        update_post_meta($order_id, '_hope_foundation_donation_display', $donation_display);
        update_post_meta($order_id, '_hope_foundation_donation_currency', $current_currency);
        update_post_meta($order_id, '_hope_foundation_donation_date', current_time('mysql'));
        
        if (WC()->session) {
            WC()->session->__unset('hope_foundation_donation');
        }
    }
}

/**
 * Clear donation session on successful order completion
 */
add_action('woocommerce_thankyou', 'hope_foundation_clear_donation_session');
function hope_foundation_clear_donation_session($order_id) {
    if (WC()->session) {
        WC()->session->__unset('hope_foundation_donation');
    }
    
    if (is_order_received_page()) {
        echo '<script>sessionStorage.removeItem("hope_foundation_backup");</script>';
    }
}

/**
 * Display donation info in admin order details
 */
function hope_foundation_display_admin_donation($order) {
    $donation_eur = get_post_meta($order->get_id(), '_hope_foundation_donation_eur', true);
    $donation_display = get_post_meta($order->get_id(), '_hope_foundation_donation_display', true);
    $donation_currency = get_post_meta($order->get_id(), '_hope_foundation_donation_currency', true);
    $donation_date = get_post_meta($order->get_id(), '_hope_foundation_donation_date', true);
    
    if ($donation_eur) {
        echo '<div class="hope-foundation-admin-info" style="background: #f0f8ff; padding: 15px; margin: 15px 0; border-left: 4px solid #28a745; border-radius: 4px;">';
        echo '<h4 style="margin: 0 0 10px 0; color: #28a745;">🤝 Hope Foundation Donation</h4>';
        
        if ($donation_currency !== 'EUR') {
            echo '<p><strong>' . __('Customer Paid:', 'hope-foundation-donations') . '</strong> ' . 
                 wc_price($donation_display, array('currency' => $donation_currency)) . 
                 ' <span style="color: #666;">(' . __('Base:', 'hope-foundation-donations') . ' €' . number_format($donation_eur, 2) . ' EUR)</span></p>';
        } else {
            echo '<p><strong>' . __('Donation Amount:', 'hope-foundation-donations') . '</strong> €' . number_format($donation_eur, 2) . ' EUR</p>';
        }
        
        if ($donation_date) {
            echo '<p><strong>' . __('Donation Date:', 'hope-foundation-donations') . '</strong> ' . 
                 date_i18n(get_option('date_format') . ' ' . get_option('time_format'), strtotime($donation_date)) . '</p>';
        }
        echo '</div>';
    }
}

/**
 * Add admin menu for donation reports
 */
add_action('admin_menu', 'hope_foundation_add_admin_menu');
function hope_foundation_add_admin_menu() {
    add_submenu_page(
        'woocommerce',
        __('Hope Foundation Donations', 'hope-foundation-donations'),
        __('Charity Donations', 'hope-foundation-donations'),
        'manage_woocommerce',
        'hope-foundation-reports',
        'hope_foundation_donation_reports_page'
    );
}

/**
 * Donation reports page
 */
function hope_foundation_donation_reports_page() {
    $current_month = date('Y-m');
    $selected_month = isset($_GET['month']) ? sanitize_text_field($_GET['month']) : $current_month;
    
    // Handle CSV export
    if (isset($_GET['export']) && $_GET['export'] === 'csv' && isset($_GET['_wpnonce']) && wp_verify_nonce($_GET['_wpnonce'], 'hope_foundation_export_csv')) {
        $donations = hope_foundation_get_donations_by_month($selected_month);
        
        if (empty($donations)) {
            wp_die('No donations found for the selected month.', 'No Data', array('back_link' => true));
        }
        
        hope_foundation_export_donations_csv($donations, $selected_month);
        return; 
    }
    
    // Get donations for display
    $donations = hope_foundation_get_donations_by_month($selected_month);
    $total_eur = array_sum(array_column($donations, 'donation_eur'));
    
    ?>
    <div class="wrap">
        <h1>🤝 <?php _e('Hope Foundation Donation Reports', 'hope-foundation-donations'); ?></h1>
        
        <!-- Rest of your HTML remains the same -->
        <div class="hope-foundation-reports">
            <div class="tablenav top">
                <div class="alignleft actions">
                    <form method="get">
                        <input type="hidden" name="page" value="hope-foundation-reports">
                        <label for="month-filter"><?php _e('Filter by month:', 'hope-foundation-donations'); ?></label>
                        <input type="month" name="month" id="month-filter" value="<?php echo esc_attr($selected_month); ?>">
                        <input type="submit" class="button" value="<?php _e('Filter', 'hope-foundation-donations'); ?>">
                    </form>
                </div>
            </div>

            <div class="donation-summary" style="background: #f0f8ff; padding: 20px; margin: 20px 0; border-left: 4px solid #28a745; border-radius: 4px;">
                <h2 style="margin-top: 0; color: #28a745;"><?php printf(__('Total Donations for %s', 'hope-foundation-donations'), date('F Y', strtotime($selected_month . '-01'))); ?></h2>
                <p style="font-size: 24px; font-weight: bold; color: #28a745; margin: 10px 0;">€<?php echo number_format($total_eur, 2); ?></p>
                <p style="margin: 0; color: #666;"><?php printf(__('%d donations from %d orders', 'hope-foundation-donations'), count($donations), count($donations)); ?></p>
            </div>

            <?php if (!empty($donations)): ?>
            <table class="wp-list-table widefat fixed striped">
                <thead>
                    <tr>
                        <th><?php _e('Order ID', 'hope-foundation-donations'); ?></th>
                        <th><?php _e('Date', 'hope-foundation-donations'); ?></th>
                        <th><?php _e('Customer', 'hope-foundation-donations'); ?></th>
                        <th><?php _e('Donation (EUR)', 'hope-foundation-donations'); ?></th>
                        <th><?php _e('Display Amount', 'hope-foundation-donations'); ?></th>
                        <th><?php _e('Order Status', 'hope-foundation-donations'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($donations as $donation): ?>
                    <tr>
                        <td>
                            <a href="<?php echo admin_url('post.php?post=' . $donation['order_id'] . '&action=edit'); ?>">
                                #<?php echo $donation['order_id']; ?>
                            </a>
                        </td>
                        <td><?php echo date_i18n(get_option('date_format'), strtotime($donation['donation_date'])); ?></td>
                        <td><?php echo esc_html($donation['customer_name']); ?></td>
                        <td><strong>€<?php echo number_format($donation['donation_eur'], 2); ?></strong></td>
                        <td>
                            <?php echo wc_price($donation['donation_display'], array('currency' => $donation['donation_currency'])); ?>
                        </td>
                        <td>
                            <span class="order-status status-<?php echo esc_attr($donation['order_status']); ?>">
                                <?php echo wc_get_order_status_name($donation['order_status']); ?>
                            </span>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="export-actions" style="margin-top: 20px;">
                <?php 
                $export_url = wp_nonce_url(
                    admin_url('admin.php?page=hope-foundation-reports&month=' . $selected_month . '&export=csv'),
                    'hope_foundation_export_csv'
                );
                ?>
                <a href="<?php echo $export_url; ?>" 
                   class="button button-secondary">
                    <?php _e('📊 Export to CSV', 'hope-foundation-donations'); ?>
                </a>
            </div>
            <?php else: ?>
            <div style="text-align: center; padding: 40px; background: #f9f9f9; border-radius: 8px;">
                <p style="font-size: 18px; color: #666;"><?php _e('No donations found for the selected month.', 'hope-foundation-donations'); ?></p>
            </div>
            <?php endif; ?>
        </div>
    </div>
    <?php
}

/**
 * Get donations by month
 */

function hope_foundation_get_donations_by_month($month = null) {
    if (!$month) {
        $month = date('Y-m');
    }
    
    global $wpdb;
    
    $start_date = $month . '-01 00:00:00';
    $end_date = date('Y-m-t 23:59:59', strtotime($start_date));
    
    $valid_statuses = array('wc-completed');
    $status_placeholders = implode(',', array_fill(0, count($valid_statuses), '%s'));
    
    $query = $wpdb->prepare("
        SELECT 
            p.ID as order_id,
            pm1.meta_value as donation_eur,
            pm2.meta_value as donation_display,
            pm3.meta_value as donation_currency,
            pm4.meta_value as donation_date,
            pm5.meta_value as billing_first_name,
            pm6.meta_value as billing_last_name,
            p.post_status as order_status
        FROM {$wpdb->posts} p
        LEFT JOIN {$wpdb->postmeta} pm1 ON (p.ID = pm1.post_id AND pm1.meta_key = '_hope_foundation_donation_eur')
        LEFT JOIN {$wpdb->postmeta} pm2 ON (p.ID = pm2.post_id AND pm2.meta_key = '_hope_foundation_donation_display')
        LEFT JOIN {$wpdb->postmeta} pm3 ON (p.ID = pm3.post_id AND pm3.meta_key = '_hope_foundation_donation_currency')
        LEFT JOIN {$wpdb->postmeta} pm4 ON (p.ID = pm4.post_id AND pm4.meta_key = '_hope_foundation_donation_date')
        LEFT JOIN {$wpdb->postmeta} pm5 ON (p.ID = pm5.post_id AND pm5.meta_key = '_billing_first_name')
        LEFT JOIN {$wpdb->postmeta} pm6 ON (p.ID = pm6.post_id AND pm6.meta_key = '_billing_last_name')
        WHERE p.post_type = 'shop_order'
        AND pm1.meta_value IS NOT NULL 
        AND pm1.meta_value > 0
        AND pm4.meta_value BETWEEN %s AND %s
        AND p.post_status IN ($status_placeholders)
        ORDER BY pm4.meta_value DESC
    ", array_merge(array($start_date, $end_date), $valid_statuses));
    
    $results = $wpdb->get_results($query);
    
    $donations = array();
    foreach ($results as $result) {
        $donations[] = array(
            'order_id' => $result->order_id,
            'donation_eur' => floatval($result->donation_eur),
            'donation_display' => floatval($result->donation_display),
            'donation_currency' => $result->donation_currency,
            'donation_date' => $result->donation_date,
            'customer_name' => trim($result->billing_first_name . ' ' . $result->billing_last_name),
            'order_status' => str_replace('wc-', '', $result->order_status)
        );
    }
    
    return $donations;
}

/**
 * Export donations to CSV
 */
function hope_foundation_export_donations_csv($donations, $month) {
    while (ob_get_level()) {
        ob_end_clean();
    }
    
    if (empty($donations)) {
        wp_die('No donations found for the selected month.');
    }
    
    $filename = 'hope-foundation-donations-' . $month . '.csv';
    
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header('Content-Description: File Transfer');
    header('Content-Transfer-Encoding: binary');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: no-cache');
    header('Expires: 0');
    
    ob_start();
    
    $output = fopen('php://output', 'w');
    
    fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));
    
    fputcsv($output, array(
        'Order ID',
        'Date',
        'Customer Name',
        'Donation EUR',
        'Display Amount',
        'Currency',
        'Order Status'
    ));
    
    $total_eur = 0;
    
    foreach ($donations as $donation) {
        fputcsv($output, array(
            $donation['order_id'],
            date('Y-m-d H:i:s', strtotime($donation['donation_date'])),
            trim($donation['customer_name']),
            number_format($donation['donation_eur'], 2, '.', ''),
            number_format($donation['donation_display'], 2, '.', ''),
            $donation['donation_currency'],
            $donation['order_status']
        ));
        $total_eur += floatval($donation['donation_eur']);
    }
    
    // Add summary row
    fputcsv($output, array('', '', '', '', '', '', ''));
    fputcsv($output, array(
        'TOTAL',
        '',
        count($donations) . ' donations',
        number_format($total_eur, 2, '.', ''),
        '',
        '',
        ''
    ));
    
    fclose($output);
    
    $csv_content = ob_get_clean();
    
    echo $csv_content;
    
    exit;
}