<?php

use ODesk\ServiceManager;
use ODesk\MysqliDb;
use ODesk\Network;

class NetworkTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
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
        
        $this->network = new Network( count( $connections ) );
        $this->network->setDb($db);
        
    }
    
    public function constructorArgumentProvider()
    {
        return array(
                array( 'string' ),
                array( 0 ),
                array( -1 ),
                array( array() ),
                array( array(1) ),
                array( false ),
                array( true ),
        );
    }
    
    public function connectOrQueryArgumentProvider()
    {
        return array(
                array( 'string', 1 ),
                array( 0, 1 ),
                array( -1, 1 ),
                array( array(), 1 ),
                array( array(1), 1 ),
                array( false, 1 ),
                array( true, 1 ),
                
                array( 1, 'string'  ),
                array( 1, 0 ),
                array( 1, -1 ),
                array( 1, array() ),
                array( 1, array(1) ),
                array( 1, false  ),
                array( 1, true  ),
        );
    }    
    
    public function queryArgumentProvider()
    {
        return array(
                array(1, 2, true),
                array(2, 1, true),
                array(1, 4, true),
                array(4, 1, true),
                
                array(2, 4, true),
                array(4, 2, true),
                array(2, 6, true),
                array(6, 2, true),
                
                array(1, 7, false),
                array(7, 1, false),
                array(1, 8, false),
                array(8, 1, false),
                
        );
    }
    
    /**
     * @dataProvider constructorArgumentProvider
     */
    public function testConstructorThrowsInvalidArgumentException( $arg )
    {
        $this->setExpectedException('InvalidArgumentException');
        $network = new Network( $arg );                
    }
    
    /**
     * @dataProvider connectOrQueryArgumentProvider
     */
    public function testConnectThrowsInvalidArgumentException( $arg1, $arg2 )
    {
        $this->setExpectedException('InvalidArgumentException');
        
        $this->network->connect( $arg1, $arg2 );
    }
    
    /**
     * @dataProvider connectOrQueryArgumentProvider
     */
    public function testQueryThrowsInvalidArgumentException( $arg1, $arg2 )
    {
        $this->setExpectedException('InvalidArgumentException');
        
        $this->network->query( $arg1, $arg2 );
    }
    
    /**
     * @dataProvider queryArgumentProvider
     */
    public function testQueryReturnsBoolean( $arg1, $arg2, $arg3 )
    {
        
        $result = $this->network->query( $arg1, $arg2 );
        $this->assertEquals( $arg3, $result );
        
    }
    
}