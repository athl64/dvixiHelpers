<?php


namespace dvixi;

/**
 * @version 1.0.1
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

    /**
     * Get human-nice label for set number
     * primary designed for russian\ukrainian languages
     *
     * @param $quantity integer
     * @param $variations array
     * first array value - for one, eleven, twenty one, ... items,
     * second array value - for 2...4 items
     * third array value - for zero or 5+ items
     * [
     *      'позиция',
     *      'позиции',
     *      'позиций'
     * ]
     * @param $includeNumber boolean
     *
     * @throws \Exception
     *
     * @return string
     * */
    public static function getLabelByNumber( $quantity, $variations, $includeNumber = false )
    {
        if( !is_int($quantity) ) {
            throw new \Exception('$quantity must be integer!');
        }

        // if $quantity like 23.00
        $quantity = round($quantity);

        if( !is_array($variations) ) {
            throw new \Exception('$variations must be an array!');
        }

        if( count($variations) < 3 ) {
            throw new \Exception('$variation must contain 3 values!');
        }

        foreach( $variations as $key => $variation ) {
            $variations[$key] = (string)$variation;
        }

        // get absolute value in case of negative values
        $absQuantity = abs( $quantity );
        $quantityLastNumber = substr( (string)$absQuantity, -1);
        $quantityPreLastNumber = strlen( (string)$absQuantity ) > 1 ? substr( (string)$absQuantity, -2 ) : '0';
        $quantityPreLastNumber = substr( $quantityPreLastNumber, 0, 1 );

        $quantity = $includeNumber ? (string)$quantity . ' ' : '';

        if( $quantityPreLastNumber != '1' ) {
            return $quantity . self::getValByKey($quantityLastNumber, [
                '1' => $variations[0],
                '2' => $variations[1],
                '3' => $variations[1],
                '4' => $variations[1],
            ], $variations[2]);
        } else {
            return $quantity . $variations[2];
        }
    }
}