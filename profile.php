<?php
require_once 'core/init.php';

if(!$username =Input::get('user')){
	Redirect::to('index.php');
} else{
	$user = new User($username);
	if(!$user->exists()){
		Redirect::to(404);
	}else{
		$data = $user->data();
	}
}

?>
<h1 align="center"><u>Profile</u></h1>

<p><h2 align="center"><?php echo $data->name; ?>
 has joined Code Partner on <?php echo $data->joined; ?>
 as <?php $user->permissionCheck();?></h2></p>

<h4 align="left"><a href="index.php">Go back</a></h4>
<?php  ?>