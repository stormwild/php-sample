<?php

require_once '../vendor/autoload.php';

use Sample\ServiceManager;
use Sample\MysqliDb;
use Sample\Network;

$sm = new ServiceManager();

// load the config
$config = (object) require 'config.php';

// populate the service manager  
$sm->host = $config->host;
$sm->username = $config->username;
$sm->password = '';
$sm->database = $config->database;

$sm->db = $sm->shared( function( $sm ) {
    return new MysqliDb($sm->host, $sm->username, $sm->password, $sm->database);        
});

$db = $sm->db;

// returns an array of all users from the Sample.user table
$users = $db->get( 'user' );
$connections = $db->get( 'connection' );
var_dump($connections);
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
<title>Network Connections | Sample</title>
</head>
<body>

	<div class="container">
    
        <h1>Sample</h1>
        
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
