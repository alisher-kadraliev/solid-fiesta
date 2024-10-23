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
namespace App\Requests\Admin\FixedContent;
use Illuminate\Foundation\Http\FormRequest;

class FixedContentRequest extends FormRequest
{
    public function rules()
    {
        return [
            "title"=>[
				"string",
				"required",
				"max:255"
			],
			"description"=>[
				"nullable"
			],
			"image"=>[
				"image",
				"file_extension:jpg,jpeg,png,webp",
				"mimes:jpg,jpeg,png,webp",
				"nullable"
			],
			"product_catalog_title"=>[
				"string",
				"nullable",
				"max:255"
			],
			"product_catalog_desc"=>[
				"nullable"
			],
			"about1"=>[
				"string",
				"nullable",
				"max:255"
			],
			"about_top_desc"=>[
				"nullable"
			],
			"about_down_desc"=>[
				"nullable"
			],
			"about_foto"=>[
				"image",
				"file_extension:jpg,jpeg,png,webp",
				"mimes:jpg,jpeg,png,webp",
				"nullable"
			],
			"about2"=>[
				"string",
				"nullable",
				"max:255"
			],
			"about_top_desc_2"=>[
				"nullable"
			],
			"about_down_desc_2"=>[
				"nullable"
			],
			"about_foto_2"=>[
				"image",
				"file_extension:jpg,jpeg,png,webp",
				"mimes:jpg,jpeg,png,webp",
				"nullable"
			],
			"call_to_action_title"=>[
				"string",
				"nullable",
				"max:255"
			],
			"call_to_action_alt_title"=>[
				"string",
				"nullable",
				"max:255"
			]
        ];
    }
    public function attributes()
    {
        return [
            "title"=>"Başlık",
			"description"=>"Açıklama",
			"image"=>"foto",
			"product_catalog_title"=>"Ürünler Katalog başlık",
			"product_catalog_desc"=>"Ürünler Katalog açıklama",
			"about1"=>"Hakkımızda başlık bir",
			"about_top_desc"=>"Hakkımızda üst açıklama",
			"about_down_desc"=>"Hakkımızda alt açıklama",
			"about_foto"=>"Hakkımızda foto",
			"about2"=>"Hakkımızda başlık iki",
			"about_top_desc_2"=>"Hakkımızda üst açıklama 2",
			"about_down_desc_2"=>"Hakkımızda alt açıklama 2",
			"about_foto_2"=>"Hakkımızda foto 2",
			"call_to_action_title"=>"İletişime geç başlık",
			"call_to_action_alt_title"=>"İletişime geç alt başlık"
        ];
    }
    public function messages()
    {
        return [
            "image.file_extension"=>trans("admin/form.required_type"),
			"about_foto.file_extension"=>trans("admin/form.required_type"),
			"about_foto_2.file_extension"=>trans("admin/form.required_type")
        ];
    }


}