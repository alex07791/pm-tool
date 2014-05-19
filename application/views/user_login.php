<div id="login_form">

	<h1>Login, Fool!</h1>
    <?php 
		echo form_open('users/check_login');
		echo form_input('username', 'Username'). "<br/>";
		echo form_password('password', 'Password'). "<br/>";
		echo form_submit('submit', 'submit');
		echo form_submit('cancel', 'cancel') . "<br/>";
		echo form_close();
	?>

</div>