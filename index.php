<?php
require_once 'core/init.php';

if(Session::exists('home')){
	echo Session::flash('home');
}

$user = new User();   
if($user->isLoggedIn()){
?>



<p> Hello  <a href="profile.php?user=<?php echo escape($user->data()->id); ?>" style="text-decoration:none;color:black"><?php echo escape($user->data()->name); ?></a> !</p>

<ul>
	<li><a href="update.php">Update Name</a></li>
	<li><a href="logout.php">Log Out</a></li>
	<li><a href="changepassword.php">Change Password</a></li>
</ul>

<?php
if($user->hasPermission('admin')){
	echo 'You are an Administrator.';
}

}else{
	echo '<p>You Have to <a href="login.php">Login</a> or <a href="register.php">Register</a> First</p>';
}