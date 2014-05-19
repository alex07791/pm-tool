<?php
/*
		View Name: user_view.
*/
	if($users !== FALSE)
	{
		echo "<table border=\'1\'>
				<tr>
					<th>ID #</th>
					<th>Username</th>
					<th>Password</th>
					<th>Name</th>
					<th>is_Active</th>
				</tr>";
		if(!is_null($users) && is_array($users) && count($users) > 0)
		{
			foreach ($users as $value) 
			{
				echo "<tr>
						<td>{$value->get_id()}</td>
						<td>{$value->get_username()}</td>
						<td>{$value->get_password()}</td>
						<td>{$value->get_name()}</td>
						<td>{$value->get_active()}</td>
					 </tr>";
			}
		}
		else
		{
			echo "<tr>
					<td>{$users->get_id()}</td>
					<td>{$users->get_username()}</td>
					<td>{$users->get_password()}</td>
					<td>{$users->get_name()}</td>
					<td>{$users->get_active()}</td>
				 </tr>";
		}
		echo"</table>";
	}
	else 
	{
		echo "<p>A user could not be found with the specified user ID#, please try again.</p>";
	}
?>