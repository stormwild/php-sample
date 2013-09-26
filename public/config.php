<?php

/*
 * @TODO refactor the service manager to accept an array of objects and factories  
 */
return array(
            'host' => 'localhost',
            'username' => 'root',
            'password' => '',
            'database' => 'Sample',
            'db' => array(
                        'shared' => function ( $sm ) {
                            return new MysqliDb($sm->host, $sm->username, $sm->password, $sm->database);
                        }
                    ) 
        );