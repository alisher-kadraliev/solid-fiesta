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
namespace App\Models\Admin\SocialLinks;
use Illuminate\Database\Eloquent\Model;


class SocialLinks extends Model
{
    
    public $table = 'social_links';
    
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
		"telefon_numaras",
		"email",
		"working_hours",
		"instagram",
		"facebook",
		"twitter",
		"katalog_indir_linki",
		"adres",
    ];
    
    
}