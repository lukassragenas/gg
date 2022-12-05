<?php

add_filter('woocommerce_billing_fields', 'remove_company_name_from_checkout', 10, 1);

function remove_company_name_from_checkout($fields)
{

    unset($fields['billing_company']);

    return $fields;

}
add_filter('woocommerce_checkout_fields', 'custom_woocommerce_billing_fields');

function custom_woocommerce_billing_fields($fields)
{

    $fields['billing']['billing_company_true'] = array(
        'label' => __('Reikia sąskaitos?', 'woocommerce'),
        // 'clear' => false,
        'type' => 'checkbox',
        'class' => array('billing_company_true'),
        'priority' => 25,
    );

    $fields['billing']['billing_company_name'] = array(
        'label' => __('Įmonės pavadinimas', 'woocommerce'),
        'clear' => false,
        'type' => 'text',
        'class' => array('my-billing_company_name'),
        'priority' => 25,
    );

    $fields['billing']['billing_company_code'] = array(
        'label' => __('Įmonės kodas', 'woocommerce'),
        'clear' => false,
        'type' => 'text',
        'class' => array('billing_company_code'),
        'priority' => 25,
    );

    $fields['billing']['billing_company_vat'] = array(
        'label' => __('Įmonės PVM', 'woocommerce'),
        'clear' => false,
        'type' => 'text',
        'class' => array('billing_company_vat'),
        'priority' => 25,
    );

    return $fields;
}

add_action('woocommerce_after_checkout_form', 'bbloomer_conditionally_hide_show_new_field', 9999);

function bbloomer_conditionally_hide_show_new_field()
{

    wc_enqueue_js("
      jQuery('input#billing_company_true').change(function(){

         if (! this.checked) {
            // HIDE IF NOT CHECKED
            jQuery('#billing_company_name_field').hide();
            jQuery('#billing_company_name input').val('');
            jQuery('#billing_company_vat_field').hide();
            jQuery('#billing_company_code input').val('');
            jQuery('#billing_company_code_field').hide();
            jQuery('#billing_company_vat input').val('');
         } else {
            // SHOW IF CHECKED
            jQuery('#billing_company_name_field').show();
            jQuery('#billing_company_vat_field').show();
         }
      }).change();
  ");

}

add_action('woocommerce_checkout_update_user_meta', 'my_custom_checkout_field_update_user_meta');

function my_custom_checkout_field_update_user_meta($user_id)
{
    if ($user_id && $_POST['billing_company_name']) {
        update_user_meta($user_id, 'billing_company_name', esc_attr($_POST['billing_company_name']));
    }

    if ($user_id && $_POST['billing_company_vat']) {
        update_user_meta($user_id, 'billing_company_vat', esc_attr($_POST['billing_company_vat']));
    }

}

add_action('woocommerce_checkout_update_order_meta', 'my_custom_checkout_field_update_order_meta');

function my_custom_checkout_field_update_order_meta($order_id)
{
    if ($_POST['billing_company_name']) {
        update_post_meta($order_id, 'billing_company_name', esc_attr($_POST['billing_company_name']));
    }
    if ($_POST['billing_company_vat']) {
        update_post_meta($order_id, 'billing_company_vat', esc_attr($_POST['billing_company_vat']));
    }

}