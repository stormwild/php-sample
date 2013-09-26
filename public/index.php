<?php

require_once '../vendor/autoload.php';

use ODesk\ServiceManager;
use ODesk\MysqliDb;
use ODesk\Network;

$sm = new ServiceManager();

// populate the service manager  
$sm->host = 'localhost';
$sm->username = 'root';
$sm->password = '';
$sm->database = 'odesk';

$sm->db = $sm->shared( function( $sm ) {
    return new MysqliDb($sm->host, $sm->username, $sm->password, $sm->database);        
});

$db = $sm->db;

// returns an array of all users from the odesk.user table
$connections = $db->get( 'connection' );

// injecting dependencies
$network = new Network( count( $connections ) );
$network->setDb($db);

//var_dump( $network->query(1, 2) );
// var_dump( $network->query(1, 4) );
// var_dump( $network->query(4, 1) );
// var_dump( $network->query(8, 1) );
var_dump( $network->query(7, 1) );
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Network Connections | oDesk</title>
</head>
<body>

	<div class="container">
    
        <h1>oDesk</h1>
        
        <h2>Network Connections</h2>
        
		<h3>Users</h3>

		<a href="">Add User</a>
		
		<?php if( isset($users) ) : ?>    
		<table>
			<thead>
				<tr>
					<th>Id</th>
					<th>Username</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach( $users as $user ) : ?>
			    <tr>
					<td><?php echo $user['id']; ?></td>
					<td><?php echo $user['username']; ?></td>
					<td>
					    <a href="">View</a>
					    
					</td>
				</tr>
			<?php endforeach; ?>	
			</tbody>
		</table>
		<?php else : ?>
		
		<p>No users. <a href="">Add User</a>.</p>
		
        <?php endif; ?>
        
        
	</div>
	<!-- end .container -->

</body>
</html>
