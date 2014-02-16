# Marray

[![Build Status](https://travis-ci.org/gajus/marray.png?branch=master)](https://travis-ci.org/gajus/marray)
[![Coverage Status](https://coveralls.io/repos/gajus/marray/badge.png)](https://coveralls.io/r/gajus/marray)

Extension to the already vast [PHP array toolkit](http://ie2.php.net/manual/en/book.array.php).

```php
/**
 * Strip-down $input to values where $input key is found among $template values.
 * 
 * @throws Gajus\Marray\Exception\InvalidArgumentException If input is not an associative array.
 * @throws Gajus\Marray\Exception\InvalidArgumentException If template is not a list.
 * @throws Gajus\Marray\Exception\InvalidArgumentException If $input does not have all the keys defined in $template.
 * @param array $input
 * @param array $template
 * @return array
 */
array \Gajus\Marray\template ( array $input, array $template )

/**
 * http://php.net/array_intersect recursive implementation.
 * 
 * @param array $arr1 The array with master values to check.
 * @param array $arr2 An array to compare values against.
 * @param array ... A variable list of arrays to compare.
 * @return array
 */
array \Gajus\Marray\intersect_recursive ( array $arr1 , array $arr2 [, array $... ] )

/**
 * http://php.net/array_diff_key recursive implementation.
 * 
 * @todo Support variadic input.
 * @param array $arr1 The array with master keys to check.
 * @param array $arr2 An array to compare keys against.
 * @return array
 */
array \Gajus\Marray\diff_key_recursive ( array $arr1 , array $arr )
```