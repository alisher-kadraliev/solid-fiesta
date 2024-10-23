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
namespace App\Requests\Admin\SocialLinks;
use Illuminate\Foundation\Http\FormRequest;

class SocialLinksRequest extends FormRequest
{
    public function rules()
    {
        return [
            "telefon_numaras"=>[
				"string",
				"nullable",
				"max:255"
			],
			"email"=>[
				"email:filter",
				"nullable",
				"max:100"
			],
			"working_hours"=>[
				"string",
				"nullable",
				"max:255"
			],
			"instagram"=>[
				"string",
				"nullable",
				"max:255"
			],
			"facebook"=>[
				"string",
				"nullable",
				"max:255"
			],
			"twitter"=>[
				"string",
				"nullable",
				"max:255"
			],
			"katalog_indir_linki"=>[
				"string",
				"nullable",
				"max:255"
			],
			"adres"=>[
				"string",
				"nullable",
				"max:255"
			]
        ];
    }
    public function attributes()
    {
        return [
            "telefon_numaras"=>"Telefon numarası",
			"email"=>"Email",
			"working_hours"=>"Çalışma Saatleri",
			"instagram"=>"İnstagram",
			"facebook"=>"facebook",
			"twitter"=>"twitter (X)",
			"katalog_indir_linki"=>"Katalog indir linki",
			"adres"=>"Adres"
        ];
    }
    
}