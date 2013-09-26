<?php
namespace ODesk;

class Network {

    use NetworkArgumentValidator;
    
    protected $count = 0;
    
    protected $db; // reference to the database connection
    
    const QUERY = 'SELECT * FROM connection WHERE userId = ? OR friendId = ?';
    
    public function __construct( $count = 0 )
    {
        $this->requirePositiveInteger( $count, __METHOD__ );
        
        $this->count = $count;
    }
    
    public function connect( $userId = 0, $friendId = 0 )
    {
        $this->requireTwoPositiveIntegers( $userId, $friendId, __METHOD__ );
        
        $this->db->insert('connection', array('userId' => $userId, 'friendId' => $friendId ));        
    }

    public function query( $userId = 0, $friendId = 0 )
    {
        $this->requireTwoPositiveIntegers( $userId, $friendId, __METHOD__ );
        
        return $this->isConnected( $userId, $friendId );
    }
    
    public function setDb(MysqliDb $db)
    {
        $this->db = $db;
    }
    
    protected function isConnected( $userId = 0, $friendId = 0, $ref = null )
    {
        $this->requireTwoPositiveIntegers( $userId, $friendId, __METHOD__ );
        
        $result = false;
        
        $connections = array();
        
        if( $this->hasConnections( $userId, $connections ) ) {
            
            if( $this->inConnections( $userId, $friendId, $connections ) ) {
                                                
                $result = true;
                                                    
            } else {
                
                foreach ( $connections as $connection ) {
                
                    $id = 0;
                
                    if( !is_null( $ref ) && is_int( $ref ) && $ref > 0 ) {
                        
                        if( $connection['userId'] != $ref && $connection['friendId'] != $ref ) {

                            if( $connection['userId'] == $userId ) {
                                $id = $connection['friendId'];
                            } else if ( $connection['friendId'] == $userId ) {
                                $id = $connection['userId'];
                            }
                            
                            if( $this->isConnected( $id, $friendId, $userId ) ) {
                                $result = true;
                                break;
                            }    
                        }
                        
                    } else {
                        
                        if( $connection['userId'] == $userId ) {
                            $id = $connection['friendId'];
                        } else if ( $connection['friendId'] == $userId ) {
                            $id = $connection['userId'];
                        }
                        
                        if( $this->isConnected( $id, $friendId, $userId ) ) {
                            $result = true;
                            break;
                        }
                    }
                    
                }
                   
            }
            
        } 
        
        return $result;
        
    }
    
    protected function hasConnections( $id, &$connections )
    {
        $connections = $this->getConnections( $id );
        
        if( count( $connections ) > 0) {            
            return true;
        }
        
        return false;
    }
    
    protected function inConnections( $userId, $friendId, $connections )
    {
        $result = false;

        foreach ( $connections as $connection ) {
            
            if( ( $connection['userId'] == $userId && $connection['friendId'] == $friendId ) 
                    || ( $connection['userId'] == $friendId && $connection['friendId'] == $userId ) ) {
                $result = true;
                break;
            }
            
        }
        
        return $result;
    }
    
    protected function getConnections( $id )
    {
        return $this->db->rawQuery( self::QUERY, array( $id, $id ) );
    }
    
}