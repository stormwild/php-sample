<?php
namespace Sample;

trait NetworkArgumentValidator {
    
    public function requirePositiveInteger( $count, $method) {
        if( ! is_int( $count ) ) {
            throw new \InvalidArgumentException(
                sprintf( '%s requires an integer, %s given.', $method, gettype( $count ) )
            );
        }
        
        if( $count < 1 ) {
            throw new \InvalidArgumentException(
                sprintf('%s requires a positive integer, %d given', $method, $count )
            );
        }
    }
    
    public function requireTwoPositiveIntegers( $userId, $friendId, $method ) {        
        if( ! is_int( $userId ) ) {
            throw new \InvalidArgumentException(
                sprintf( '%s requires the first argument to be an integer, %s given.', $method, gettype( $userId ) )
            );
        }
        
        if( ! is_int( $friendId ) ) {
            throw new \InvalidArgumentException(
                sprintf( '%s requires the second argument to be an integer, %s given.', $method, gettype( $friendId ) )
            );
        }
    
        if( $userId < 1 ) {
            throw new \InvalidArgumentException(
                sprintf('%s requires the first argument to be a positive integer, %d given.', $method, $userId )
            );
        }
        
        if( $friendId < 1 ) {
            throw new \InvalidArgumentException(
                sprintf('%s requires the second argument to be a positive integer, %d given.', $method, $friendId )
            );
        }
        
    }
}