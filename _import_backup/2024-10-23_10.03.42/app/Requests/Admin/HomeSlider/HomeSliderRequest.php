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
namespace App\Requests\Admin\HomeSlider;
use Illuminate\Foundation\Http\FormRequest;

class HomeSliderRequest extends FormRequest
{
    public function rules()
    {
        return [
            "title"=>[
				"string",
				"nullable",
				"max:255"
			],
			"alt_title"=>[
				"string",
				"nullable",
				"max:255"
			],
			"foto"=>[
				"image",
				"file_extension:jpg,jpeg,png,webp",
				"mimes:jpg,jpeg,png,webp",
				"nullable"
			]
        ];
    }
    public function attributes()
    {
        return [
            "title"=>"Başlık",
			"alt_title"=>"Alt Başlık",
			"foto"=>"Foto"
        ];
    }
    public function messages()
    {
        return [
            "foto.file_extension"=>trans("admin/form.required_type")
        ];
    }


}