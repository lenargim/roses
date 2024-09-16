<?php

/**
	* To validate WooCommerce registration form custom fields.
	*/
function text_domain_woo_validate_reg_form_fields($username, $email, $validation_errors)
{
//	if (isset($_POST['billing_first_name']) && empty($_POST['billing_first_name'])) {
//		$validation_errors->add('billing_first_name_error', __('<strong>Error</strong>: First name is required!', 'text_domain'));
//	}
	return $validation_errors;
}

add_action('woocommerce_register_post', 'text_domain_woo_validate_reg_form_fields', 10, 3);


/**
	* To save WooCommerce registration form custom fields.
	*/
function text_domain_woo_save_reg_form_fields($customer_id)
{
	if (isset($_POST['billing_first_name'])) {
		update_user_meta($customer_id, 'first_name', sanitize_text_field($_POST['billing_first_name']));
		update_user_meta($customer_id, 'billing_first_name', sanitize_text_field($_POST['billing_first_name']));
	}
	if (isset($_POST['billing_last_name'])) {
		update_user_meta($customer_id, 'last_name', sanitize_text_field($_POST['billing_last_name']));
		update_user_meta($customer_id, 'billing_last_name', sanitize_text_field($_POST['billing_last_name']));
	}
	if (isset($_POST['billing_patronymic_name'])) {
		update_user_meta($customer_id, 'patronymic_name', sanitize_text_field($_POST['billing_patronymic_name']));
		update_user_meta($customer_id, 'billing_patronymic_name', sanitize_text_field($_POST['billing_patronymic_name']));
	}
	if (isset($_POST['billing_phone'])) {
		update_user_meta($customer_id, 'phone', sanitize_text_field($_POST['billing_phone']));
		update_user_meta($customer_id, 'billing_phone', sanitize_text_field($_POST['billing_phone']));
	}
	if (isset($_POST['billing_country'])) {
//		update_user_meta($customer_id, 'country', $_POST['billing_country']);
		update_user_meta($customer_id, 'billing_country', $_POST['billing_country']);
	}
	if (isset($_POST['billing_postcode'])) {
		update_user_meta($customer_id, 'postcode', sanitize_text_field($_POST['billing_postcode']));
		update_user_meta($customer_id, 'billing_postcode', sanitize_text_field($_POST['billing_postcode']));
	}
	if (isset($_POST['billing_state'])) {
		update_user_meta($customer_id, 'state', sanitize_text_field($_POST['billing_state']));
		update_user_meta($customer_id, 'billing_state', sanitize_text_field($_POST['billing_state']));
	}
	if (isset($_POST['billing_city'])) {
		update_user_meta($customer_id, 'city', sanitize_text_field($_POST['billing_city']));
		update_user_meta($customer_id, 'billing_city', sanitize_text_field($_POST['billing_city']));
	}
	if (isset($_POST['billing_address_1'])) {
		update_user_meta($customer_id, 'address_1', sanitize_text_field($_POST['billing_address_1']));
		update_user_meta($customer_id, 'billing_address_1', sanitize_text_field($_POST['billing_address_1']));
	}
	if (isset($_POST['billing_home'])) {
		update_user_meta($customer_id, 'home', sanitize_text_field($_POST['billing_home']));
		update_user_meta($customer_id, 'billing_home', sanitize_text_field($_POST['billing_home']));
	}
	if (isset($_POST['billing_body'])) {
		update_user_meta($customer_id, 'body', sanitize_text_field($_POST['billing_body']));
		update_user_meta($customer_id, 'billing_body', sanitize_text_field($_POST['billing_body']));
	}
	if (isset($_POST['billing_apartment'])) {
		update_user_meta($customer_id, 'apartment', sanitize_text_field($_POST['billing_apartment']));
		update_user_meta($customer_id, 'billing_apartment', sanitize_text_field($_POST['billing_apartment']));
	}
	add_user_meta( $customer_id, '_is_new_user', 'yes' );
}

add_action('woocommerce_created_customer', 'text_domain_woo_save_reg_form_fields');
