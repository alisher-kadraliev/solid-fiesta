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
namespace App\Requests\Admin\Products;
use Illuminate\Foundation\Http\FormRequest;

class ProductsRequest extends FormRequest
{
    public function rules()
    {
        return [
            "product_categy_title"=>[
				"string",
				"nullable",
				"max:255"
			],
			"image"=>[
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
            "product_categy_title"=>"Ürün Kategori ismi",
			"image"=>"Foto"
        ];
    }
    public function messages()
    {
        return [
            "image.file_extension"=>trans("admin/form.required_type")
        ];
    }


}