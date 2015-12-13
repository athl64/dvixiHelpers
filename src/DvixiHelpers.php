<?php


namespace dvixi;

/**
 * @version 1.0.0
 * */
class DvixiHelpers
{
    /**
     * Get value by it's key ( switch wrapper for array of cases )
     *
     * @param $key mixed
     * any value that supported as array index, like string or number
     *
     * @param $values array
     * ['key1' => 'val1', 'key2' => 'val2']
     *
     * @param $defaultValue mixed
     * value that will be returned if there is no occurrences of $key in $values
     * default null
     *
     * @throws \Exception
     *
     * @return mixed
     * */
    public static function getValByKey( $key, $values = [], $defaultValue = null )
    {
        if( !is_array($values) ) {
            throw new \Exception('Param is not array');
        }

        foreach( $values as $index => $value ) {
            switch( $key ) {
                case $index :
                    return $value;
                default :
                    continue;
            }
        }

        return $defaultValue;
    }
}