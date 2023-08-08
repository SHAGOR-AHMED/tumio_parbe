<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Request;

/* role static id*/
define('ADMIN', '1');

// Check exist data
function existed($tableName = NULL, $fieldName = NULL, $value = NULL) {
    $query = DB::table($tableName)
            ->select($fieldName)
            ->where($fieldName,$value)
            ->first();
    if ($query)
        return true;
    else
        return false;
}

if (!function_exists('logged_in_user_id')) {

    function logged_in_user_id()
    {
        $logged_in_id = 0;
        if (Auth::user()->id) :
            $logged_in_id = Auth::user()->id;
        endif;
        return $logged_in_id;
    }
}

if (!function_exists('logged_in_role_name')) {

    function logged_in_role_name() {
        $logged_in_role_name = '';
        if (Auth::user()->id):
            $logged_in_role_name = Auth::user()->role;
        endif;
        return $logged_in_role_name;
    }
}

if (!function_exists('logged_in_name')) {

    function logged_in_name()
    {
        $logged_in_name = '';
        if (Auth::user()->id) :
            if (logged_in_role_name() == 'Admin') :
                $logged_in_name = "Admin";
            else :
                $logged_in_name = Auth::user()->name;
            endif;
        endif;
        return $logged_in_name;
    }
}

if (!function_exists('logged_in_role_id')) {

    function logged_in_role_id() {
        $logged_in_role_id = 0;
        return $logged_in_role_id;
    }

}

if (!function_exists('is_super_admin')) {

    function is_super_admin() {
        if(logged_in_role_name() === 'Admin'):
            return true;
        else:
            return false;
        endif;
    }
}

if (!function_exists('textshorten')) {

    function textshorten($text, $limit = 400)
    {
        $text = $text . " ";
        $text = substr($text, 0, $limit);
        $text = substr($text, 0, strrpos($text, ' '));
        return $text = $text . " .....";
    }
}

if (!function_exists('setMessage')) {

    function setMessage($key, $class, $message)
    {
        session()->flash($key, $message);
        session()->flash("class", $class);
        return true;
    }
}

if (!function_exists('active_link')) {

    function set_Topmenu($top_menu_name)
    {
        $session_top_menu = session('top_menu');
        if ($session_top_menu == $top_menu_name) {
            return 'active';
        }
        return "";
    }

    function set_Submenu($sub_menu_name)
    {
        $session_sub_menu = session('sub_menu');
        if ($session_sub_menu == $sub_menu_name) {
            return 'active';
        }
        return "";
    }
}

if (!function_exists('debug_r')) {

    function debug_r($value)
    {
        echo "<pre>";
        print_r($value);
        echo "</pre>";
        die();
    }
}

if (!function_exists('debug_v')) {

    function debug_v($value)
    {
        echo "<pre>";
        var_dump($value);
        echo "</pre>";
        die();
    }
}

if (!function_exists('make_slug')) {

    function make_slug($string)
    {
        return preg_replace('/\s+/u', '-', trim($string));
    }
}