<?php
namespace Sample;

class ServiceManager {
    
    protected $objects = array();
    
    public function __set( $key, $value )
    {
        $this->objects[$key] = $value;
    }
    
    public function __get( $key )
    {
        if( ! isset( $this->objects[$key] ) ) {
            throw new \InvalidArgumentException(
                    sprintf( '%s is not defined.', $key )
            );
        }
        
        if( is_callable( $this->objects[$key]) ) {
            return $this->objects[$key]( $this ); 
        } else {
            return $this->objects[$key];
        }
    }
    
    public function shared( \Closure $callable )
    {
        return function ( $sm ) use ( $callable ) {

            static $object;

            if( is_null( $object ) ) {
                $object = $callable( $sm );
            }
            
            return $object;
        };
    }
    
}