<?php
//Template Name: New password

if (is_user_logged_in()) {
	wp_redirect(site_url());
}

$queries = array();
parse_str($_SERVER['QUERY_STRING'], $queries);

$user_name = $queries['login'];
$action = $queries['action'];
$key = $queries['key'];
if (!isset($user_name) || !isset($action) || !isset($key)) {
	wp_redirect(site_url());
}

$user = check_password_reset_key($key, $user_name);

if (!$user || is_wp_error($user)) {
	if ($user && $user->get_error_code() === 'expired_key') {
		wp_redirect(site_url('?action=lostpassword&error=expiredkey'));
		exit;
	} else {
		wp_redirect(site_url('?action=lostpassword&error=invalidkey'));
		exit;
	}

	wp_redirect(site_url());
	exit;
}


get_template_part('parts/header');
?>
  <main class="section">
    <div class="container">
      <h1 class="h1">Новый пароль для пользователя <?php echo $user_name; ?></h1>
      <form id="new_password" class="new-password">
        <div class="text-wrap required">
          <input id="password" type="text" name="password" placeholder="...">
          <label for="password">Пароль</label>
        </div>
        <input type="text" class="hidden" value="<?php echo $user_name; ?>" readonly name="user_name" id="user_name">
        <input type="text" class="hidden" value="<?php echo $key; ?>" readonly name="key" id="key">
        <button type="submit" class="button orange big" disabled>Подтвердить</button>
      </form>
    </div>
  </main>


  <div class="dark form-new-password-thx">
    <div class="modal">
      <div class="modal__close-login"></div>
      <h2 class="modal__title h2">Пароль был изменен</h2>
      <p class="modal__desc">Вы можете войти в личный кабинет</p>
    </div>
  </div>

<?php
get_template_part('parts/map');
get_template_part('parts/footer');