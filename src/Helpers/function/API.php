<?php
if (!function_exists('array_field_name'))
{
    function array_field_name($key)
    {
        $key_name_parts = explode('.', $key);
        $res = $key_name_parts[0];
        foreach ($key_name_parts as $k => $part)
        {
            if ($k > 0)
            {
                $res .= '[' . $part . ']';
            }
        }
        return $res;
    }
}
if (!function_exists('validation_error_to_api_json'))
{
    function validation_error_to_api_json($errors)
    {
        $api_errors = [];
        foreach ($errors->getMessages() as $key => $value)
        {
            $key = array_field_name($key);
            $api_errors[$key] = array_values($value);
        }
        return $api_errors;
    }
}
?>
