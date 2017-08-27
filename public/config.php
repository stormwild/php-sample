<?php

/*
 * @TODO refactor the service manager to accept an array of objects and factories  
 */
return array(
            'host' => getenv('IP'),
            'username' => getenv('C9_USER'),
            'password' => '',
            'database' => 'sample',
            'db' => array(
                        'shared' => function ( $sm ) {
                            return new MysqliDb($sm->host, $sm->username, $sm->password, $sm->database);
                        }
                    ) 
        );