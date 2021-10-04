<?php
	foreach($user_name as $row) {
		$login = $row->login;
	}
?>
<p>Zalogowany jako <strong><?php echo $login ?></strong> - <?php echo anchor('user/edit_user', 'Edytuj profil');?> - <?php echo anchor('user/logout', 'Wyloguj');?></p>
