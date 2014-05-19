<h1>Create an Account!</h1>
<fieldset>
<legend>Personal Information</legend>
<?php
   
echo form_open('users/process_register');

echo form_input('name', set_value('name', 'Name Surname')) ."<br/>";
?>
<legend>Login Info</legend>
<?php
echo form_input('username', set_value('username', 'Username')) ."<br/>";
echo form_input('password', set_value('password', 'Password')) ."<br/>";
echo form_input('password2', 'Password Confirm') ."<br/>";
echo form_input('email', 'Email') ."<br/>";

echo form_submit('submit', 'Create Acccount');
echo form_submit('cancel', 'Cancel');
?>