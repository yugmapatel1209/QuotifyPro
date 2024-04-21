<?php
function d($data) {
    echo '<pre>';
    print_r($data);
    die;
}
function da($data) {
    echo '<pre>';
    print_r($data->toArray());
    die;
}

/**
 * Created by PhpStorm.
 * User: nestcode-101
 * Date: 24/4/18
 * Time: 11:05 AM
 */
function version() {
    return '1.3.6';
}

/**
 * created by yp at 11-01-2018
 * Created for delete the audio at edit time
 */
function delete_exercise_audio( $file, $path = 'uploads/') {
    $name = explode('/',$file);
    $filename = end($name);
    $filepath = public_path($path.$filename); 
    if(file_exists($filepath)){
        unlink($filepath);
        return 1;
    } else {
        return 0;
    }
}


function makeComparer($criteria) {
    $comparer = function ($first, $second) use ($criteria) {
      foreach ($criteria as $key => $orderType) {
        // normalize sort direction
        $orderType = strtolower($orderType);
        if ($first[$key] < $second[$key]) {
          return $orderType === "asc" ? -1 : 1;
        } else if ($first[$key] > $second[$key]) {
          return $orderType === "asc" ? 1 : -1;
        }
      }
      // all elements were equal
      return 0;
    };
    return $comparer;
  };
function dateUTC($format, $timestamp = null)
{
    if ($timestamp === null) $timestamp = time();

    $tz = date_default_timezone_get();
    date_default_timezone_set('UTC');

    $result = date($format, $timestamp);

    date_default_timezone_set($tz);
    return $result;
}
function groupArray($arr, $group, $preserveGroupKey = false, $preserveSubArrays = false)
{
    $temp = array();
    foreach ($arr as $key => $value) {
        $groupValue = $value[$group];
        if (!$preserveGroupKey) {
            unset($arr[$key][$group]);
        }
        if (!array_key_exists($groupValue, $temp)) {
            $temp[$groupValue] = array();
        }

        if (!$preserveSubArrays) {
            $data = count($arr[$key]) == 1 ? array_pop($arr[$key]) : $arr[$key];
        } else {
            $data = $arr[$key];
        }
        $temp[$groupValue][] = $data;
    }
    return $temp;
}

function secToHR($seconds) {
    $hours = floor($seconds / 3600);
    $minutes = floor(($seconds / 60) % 60);
    $seconds = $seconds % 60;

    // if( $hours > 0 ) {
    //     return "$hours hr, $minutes min" ;
    // } else {
    //     if( $minutes > 0 ) {
    //         if( $seconds > 0) {
    //             return "$minutes min, $seconds sec" ;
    //         } else {
    //             return "$minutes min" ;
    //         }
    //     } else {
    //         return "$seconds sec";
    //     }
    // }

    return $hours > 0 ? "$hours hr, $minutes min" : ($minutes > 0 ? ( $seconds > 0 ? "$minutes min, $seconds sec" :  "$minutes min") : "$seconds sec");
    // return "$hours:$minutes:$seconds";
}

function secToHROri($seconds) {
    $hours = floor($seconds / 3600);
    $minutes = floor(($seconds / 60) % 60);
    $seconds = $seconds % 60;
    return $hours > 0 ? "$hours hr, $minutes min" : ($minutes > 0 ? "$minutes min, $seconds sec" : "$seconds sec");
    // return "$hours:$minutes:$seconds";
}
