<?php
namespace Gajus\Marray;

/**
 * Strip-down $input to values where $input key is found among $template values.
 * 
 * @throws Gajus\Marray\Exception\InvalidArgumentException If $input does not have all the keys defined in $template.
 * @param array $input
 * @param array $template
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