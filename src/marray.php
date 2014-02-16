<?php
namespace Gajus\Marray;

static private function intersect_inverse (array $whitelist, array $input) {
    return array_intersect_key($input, array_flip($whitelist));
}

static private function intersect_recursive (array $arr1, array $arr2) {
    $return = [];
    
    $common_keys = array_intersect(array_keys($arr1), array_keys($arr2));
    
    foreach ($common_keys as $key) {
        if (is_array($arr1[$key]) && is_array($arr2[$key])) {
            $intersection = array_intersect_recursive ($arr1[$key], $arr2[$key]);
            
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
    
        $return = call_user_func_array(['arrayIntersectRecursive', self], $arguments);
    }
    
    return $return;
}

static private function diff_key_recursive (array $arr1, array $arr2) {
    $diff = array_diff_key($arr1, $arr2);
    $intersect = array_intersect_key($arr1, $arr2);
    
    foreach ($intersect as $k => $v) {
        if (is_array($arr1[$k]) && is_array($arr2[$k])) {
            $d = array_diff_key_recursive($arr1[$k], $arr2[$k]);
            
            if ($d) {
                $diff[$k] = $d;
            }
        }
    }
    
    return $diff;
}