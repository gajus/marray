<?php
namespace Gajus\Marray;

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
function template (array $input, array $template) {
    if (is_int(key($input))) {
        // Naive, though misuse cases are just as naive.
        throw new Exception\InvalidArgumentException('Input is not an associative array.');
    }

    if (!is_int(key($template))) {
        // Naive, though misuse cases are just as naive.
        throw new Exception\InvalidArgumentException('Template is not a list.');
    }

    $template = array_flip($template);

    if ($diff = array_diff_key($template, $input)) {
        throw new Exception\InvalidArgumentException('Template does not cover input.');
    }

    return array_intersect_key($input, $template);
}

/**
 * http://php.net/array_intersect recursive implementation.
 * 
 * @param array $arr1 The array with master values to check.
 * @param array $arr2 An array to compare values against.
 * @param array ... A variable list of arrays to compare.
 * @return array
 */
function intersect_recursive (array $arr1, array $arr2) {
    $return = [];
    
    $common_keys = array_intersect(array_keys($arr1), array_keys($arr2));
    
    foreach ($common_keys as $key) {
        if (is_array($arr1[$key]) && is_array($arr2[$key])) {
            $intersection = intersect_recursive ($arr1[$key], $arr2[$key]);
            
            if ($intersection) {
                $return[$key] = $intersection;
            }
        } else if ($arr1[$key] == $arr2[$key]) {
            $return[$key] = $arr1[$key];
        }
    }
    
    if (func_num_args() > 2) {
        $arguments = func_get_args();
        
        array_splice($arguments, 0, 2, [$return]);
    
        $return = call_user_func_array('Gajus\Marray\intersect_recursive', $arguments);
    }
    
    return $return;
}

/**
 * http://php.net/array_diff_key recursive implementation.
 * 
 * @todo Support variadic input.
 * @param array $arr1 The array with master keys to check.
 * @param array $arr2 An array to compare keys against.
 * @return array
 */
function diff_key_recursive (array $arr1, array $arr2) {
    $diff = array_diff_key($arr1, $arr2);
    $intersect = array_intersect_key($arr1, $arr2);
    
    foreach ($intersect as $k => $v) {
        if (is_array($arr1[$k]) && is_array($arr2[$k])) {
            $d = diff_key_recursive($arr1[$k], $arr2[$k]);
            
            if ($d) {
                $diff[$k] = $d;
            }
        }
    }
    
    return $diff;
}

/**
 * http://php.net/array_unique implementation with user callback.
 * 
 * @param array The input array.
 * @param Closure $value_func Function must return the value used for comparison.
 * @param int $sort_flags
 */
function uunique ($array, \Closure $value_func, $sort_flags = \SORT_STRING) {
    $copy = array_unique(array_map($value_func, $array), $sort_flags);

    return array_intersect_key($array, $copy);
}