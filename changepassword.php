<?php
require_once 'core/init.php';
$user = new User();
if(!$user->isLoggedIn()){
	Redirect::to('index.php');
}
if (Input::exists()) {
	if (Token::check(Input::get('token'))) {
		
		$validate =new Validate();
		$validation = $validate->check($_POST,array(
			'password_current' =>array(
				'required' =>true,
				'min' =>6
			),
			'new_password' =>array(
				'required' =>true,
				'min' =>6
			),
			'new_password_again' =>array(
				'required' =>true,
				'min' =>6,
				'matches' => 'new_password'
			)
		));
		if ($validation->passed()) {
			
			if (Hash::make(Input::get('password_current'),$user->data()->salt) !== $user->data()->password) {
				echo 'Your Current Password is Wrong';
			} else{
				$salt = Hash::salt(32);
				$user->update(array(
					'password' => Hash::make(Input::get('new_password'),$salt),
					'salt' => $salt
				));
				Session::flash('home', 'Your Password Changed Successfully.');
				Redirect::to('index.php');
			}

		} else {
			foreach($validation->errors() as $error){
				echo $error, '<br>';
			}
		}
		
	}
}
?>
<form action="" method="post">
	<div class="field">
		<label for="password_current">Current Password</label>
		<input type="password" name="password_current" id="password_current">
	</div>
	<div class="field">
		<label for="new_password">New Password</label>
		<input type="password" name="new_password" id="new_password">
	</div>
	<div class="field">
		<label for="new_password_again">Re-enter New Password</label>
		<input type="password" name="new_password_again" id="new_password_again">
	</div>
	<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
	<input type="submit" value="Change Password">
</form>

<?php

?>