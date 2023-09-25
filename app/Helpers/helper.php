<?php
use Illuminate\Support\Facades\Route;

if(!function_exists('set_active')){
    function set_active($uri, $output ='active')
    {
        if(is_array($uri)){
            foreach ($uri as $u){
                if(Route::is($u)){
                    return $output;
                }
            }
        }else{
            
            if(Route::is($uri)){
                return $output;
            }
        }
    }
}

function set_collapse($uri, $output = 'collapse')
{
    if(is_array($uri)){
        foreach ($uri as $u){
            if(Route::is($u)){
                return $output;
            }
        }
    }else{
        
        if(Route::is($uri)){
            return $output;
        }
    }
}

function set_show($uri, $output = 'show')
{
    if(is_array($uri)){
        foreach ($uri as $u){
            if(Route::is($u)){
                return $output;
            }
        }
    }else{
        
        if(Route::is($uri)){
            return $output;
        }
    }
}

function unique_code()
{
    return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 16);
}

function convertArray($object)
{
    $output = json_decode(json_encode($object), true);
    return $output;
}

function is_array_empty($arr){
    if(is_array($arr)){     
        foreach($arr as $key => $value){
            if(!empty($value) || $value != NULL || $value != ""){
                return true;
                break;//stop the process we have seen that at least 1 of the array has value so its not empty
            }
        }
        return false;
    }
}