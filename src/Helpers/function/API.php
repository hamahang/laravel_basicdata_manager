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

if (!function_exists('LBDM_EnCodeId'))
{
    function LBDM_EnCodeId($var)
    {
        $hashids = new Hashids\Hashids(md5('sadeghi'));

        return $hashids->encode($var);
    }
}
if (!function_exists('LBDM_DeCodeId'))
{
    function LBDM_DeCodeId($var)
    {
        try
        {
            $hashids = new Hashids\Hashids(md5('sadeghi'));

            return $hashids->decode($var)[0];
        } catch (Illuminate\Contracts\Encryption\DecryptException $e)
        {
            return false;
        }
    }
}

if (!function_exists('LBDM_Get_BasicData_json'))
{
    function LBDM_Get_BasicData_json()
    {
        $items = ArtinCMS\LBDM\Models\Basicdata::select('id', 'title as text')
            ->get()->toJson();

        return $items;
    }
}

if (!function_exists('LBDM_Date_GtoJ'))
{
    function LBDM_Date_GtoJ($GDate = null, $Format = "Y/m/d-H:i", $convert = true)
    {
        if ($GDate == '-0001-11-30 00:00:00' || $GDate == null)
        {
            return '--/--/----';
        }
        $date = new ArtinCMS\LBDM\Helpers\Classes\jDateTime($convert, true, 'Asia/Tehran');
        $time = is_numeric($GDate) ? strtotime(date('Y-m-d H:i:s', $GDate)) : strtotime($GDate);

        return $date->date($Format, $time);

    }

}

if (!function_exists('LBDM_Date_JtoG'))
{
    function LBDM_Date_JtoG($jDate, $delimiter = '/', $to_string = false, $with_time = false, $input_format = 'Y/m/d H:i:s')
    {
        $jDate = ConvertNumbersFatoEn($jDate);
        $parseDateTime = ArtinCMS\LBDM\Helpers\Classes\jDateTime::parseFromFormat($input_format, $jDate);
        $r = ArtinCMS\LBDM\Helpers\Classes\jDateTime::toGregorian($parseDateTime['year'], $parseDateTime['month'], $parseDateTime['day']);
        if ($to_string)
        {
            if ($with_time)
            {
                $r = $r[0] . $delimiter . $r[1] . $delimiter . $r[2] . ' ' . $parseDateTime['hour'] . ':' . $parseDateTime['minute'] . ':' . $parseDateTime['second'];
            }
            else
            {
                $r = $r[0] . $delimiter . $r[1] . $delimiter . $r[2];
            }
        }

        return ($r);
    }

}

?>
