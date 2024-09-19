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
		update_user_meta($customer_id, 'country', $_POST['billing_country']);
//		update_user_meta($customer_id, 'billing_country', $_POST['billing_country']);
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
	add_user_meta($customer_id, '_is_new_user', 'yes');
}

add_action('woocommerce_created_customer', 'text_domain_woo_save_reg_form_fields');


remove_action('woocommerce_register_form', 'wc_registration_privacy_policy_text', 20);


function vb_reg_new_user()
{
	// Verify nonce
	if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'vb_new_user'))
		die('Ошибка  что-то пошло не так');

	// Post values
	$username = sanitize_text_field($_POST['user']);
	$billing_last_name = sanitize_text_field($_POST['billing_last_name']);
	$billing_first_name = sanitize_text_field($_POST['billing_first_name']);
	$billing_patronymic_name = sanitize_text_field($_POST['billing_patronymic_name']);
	$email = sanitize_text_field($_POST['email']);
	$billing_phone = sanitize_text_field($_POST['billing_phone']);
	$billing_country = sanitize_text_field($_POST['billing_country']);
	$billing_postcode = sanitize_text_field($_POST['billing_postcode']);
	$billing_state = sanitize_text_field($_POST['billing_state']);
	$billing_city = sanitize_text_field($_POST['billing_city']);
	$billing_address_1 = sanitize_text_field($_POST['billing_address_1']);
	$billing_home = sanitize_text_field($_POST['billing_home']);
	$billing_body = sanitize_text_field($_POST['billing_body']);
	$billing_apartment = sanitize_text_field($_POST['billing_apartment']);

	$userdata = array(
		'user_login' => $username,
		'user_email' => $email,
		'first_name' => $billing_first_name,
		'last_name' => $billing_last_name,
		'role' => 'customer'
	);

	$userdata['user_pass'] = wp_generate_password(6, false);


	if (empty($username)) {
		echo 'Please fill in your username !';
	} elseif (empty($email)) {
		echo 'Email can not be empty !';
	} elseif (!is_email($email)) {
		echo 'Email address is not valid !';
	} elseif (email_exists($email)) {
		echo 'Sorry, that email address is already used!';
	} elseif (username_exists($username)) {
		echo 'Sorry, that username is already used!';
	} else {
		$user_id = wp_insert_user($userdata);
		// Return
		if (!is_wp_error($user_id)) :

			update_user_meta( $user_id, 'billing_first_name', $billing_first_name );
			update_user_meta( $user_id, 'billing_last_name', $billing_last_name );
			update_user_meta( $user_id, 'billing_address_1', $billing_address_1 );
			update_user_meta( $user_id, 'billing_city', $billing_city );
			update_user_meta( $user_id, 'billing_postcode', $billing_postcode );
			update_user_meta( $user_id, 'billing_country', $billing_country );
			update_user_meta( $user_id, 'billing_state', $billing_state );
			update_user_meta( $user_id, 'billing_email', $email );
			update_user_meta( $user_id, 'billing_phone', $billing_phone );
			update_user_meta( $user_id, 'billing_patronymic_name', $billing_patronymic_name );
			update_user_meta( $user_id, 'billing_home', $billing_home );
			update_user_meta( $user_id, 'billing_body', $billing_body );
			update_user_meta( $user_id, 'billing_apartment', $billing_apartment );

			// Sent email registration automatic
			$to = $email;
			$subject = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES) . ' - Вы зарегистрированы!';
			$body = 'Ваш временный пароль: ' . $userdata['user_pass'];
			$headers = array('Content-Type: text/html; charset=UTF-8');
			$mailResult = false;
			$mailResult = wp_mail($to, $subject, $body, $headers);
			echo $mailResult;
			wp_mail($to, $subject, $body, $headers);
		else :
			echo $user_id->get_error_message();
		endif;
	}
	die();

}

add_action('wp_ajax_register_user', 'vb_reg_new_user');
add_action('wp_ajax_nopriv_register_user', 'vb_reg_new_user');