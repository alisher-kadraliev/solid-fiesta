<?php
/**
 * @author Admiko
 * @copyright Copyright (c) Admiko
 * @link https://admiko.com
 * @Help We are committed to delivering the best code quality and user experience. If you have suggestions or find any issues, please don't hesitate to contact us. Thank you.
 * This file is managed by Admiko and is not recommended to be modified.
 * Any custom code should be added elsewhere to avoid losing changes during updates.
 * However, in case your code is overwritten, you can always restore it from a backup folder.
 */

namespace app\Http\Controllers\Admin\AdminService\Global;

class Validators
{
    public static function fileExtension($attribute, $value, $parameters, $validator)
    {
        $extension = $value->getClientOriginalExtension();
        return $extension != '' && in_array($extension, $parameters);
    }
    public static function base64Validator($attribute, $value, $parameters, $validator)
    {
        if ($value) {
            $image = base64_decode($value);
            if ($image === false) {
                return false;
            }
            $pattern = '/<script\b[^>]*>(.*?)<\/script>/is';
            if (preg_match($pattern, $image)) {
                return false; // JS code found in the image source
            }
            if (strpos($value, 'data:') !== false) {
                [, $value] = explode('data:', $value);
            }
            if (!@getimagesize('data://' . $value)) {
                return false;
            } else {
                return true;
            }
        }
        return true;
    }
}

