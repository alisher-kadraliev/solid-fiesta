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
namespace App\Models\Admin\FixedContent;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Admin\AdminService\Traits\AdminFileUploadTrait;

class FixedContent extends Model
{
    use AdminFileUploadTrait;
    public $table = 'sayfa_ynetimi';
    
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
		"title",
		"description",
		"image",
		"ak_image_delete",
		"product_catalog_title",
		"product_catalog_desc",
		"about1",
		"about_top_desc",
		"about_down_desc",
		"about_foto",
		"ak_about_foto_delete",
		"about2",
		"about_top_desc_2",
		"about_down_desc_2",
		"about_foto_2",
		"ak_about_foto_2_delete",
		"call_to_action_title",
		"call_to_action_alt_title",
    ];
    
	public function fileInfo($key=false)
    {
        $file_info = [
			"image"=>[
				"disk"=>config("admin.settings.upload_disk"),
				"quality"=>config("admin.images.image_quality"),
				"webp"=>["action"=>"none","quality"=>config("admin.images.webp_quality")],
				"original"=>["action"=>"resize","width"=>1920,"height"=>1080,"folder"=>"/upload/"]
			],
			"about_foto"=>[
				"disk"=>config("admin.settings.upload_disk"),
				"quality"=>config("admin.images.image_quality"),
				"webp"=>["action"=>"none","quality"=>config("admin.images.webp_quality")],
				"original"=>["action"=>"resize","width"=>1920,"height"=>1080,"folder"=>"/upload/"]
			],
			"about_foto_2"=>[
				"disk"=>config("admin.settings.upload_disk"),
				"quality"=>config("admin.images.image_quality"),
				"webp"=>["action"=>"none","quality"=>config("admin.images.webp_quality")],
				"original"=>["action"=>"resize","width"=>1920,"height"=>1080,"folder"=>"/upload/"]
			]
		];
        return ($key)?$file_info[$key]:$file_info;
    }
    public function setImageAttribute()
    {
        if (request()->hasFile('image')) {
            $this->attributes['image'] = $this->akImageUpload(request()->file("image"), $this->fileInfo("image"), $this->getOriginal('image'));
        }
    }
    public function getImageAttribute($value)
    {
        if ($value && $this->akFileExists($this->fileInfo("image")['disk'],$this->fileInfo("image")['original']["folder"],$value)) {
            return $this->akGetURLPath($this->fileInfo("image")['disk'],$this->fileInfo("image")['original']["folder"],$value);
        }
        return false;
    }
    public function setAkImageDeleteAttribute($delete)
    {
        if (!request()->hasFile('image') && $delete == 1) {
            $this->attributes['image'] = $this->akImageUpload('', $this->fileInfo("image"), $this->getOriginal('image'), 1);
        }
    }
	public function setAboutFotoAttribute()
    {
        if (request()->hasFile('about_foto')) {
            $this->attributes['about_foto'] = $this->akImageUpload(request()->file("about_foto"), $this->fileInfo("about_foto"), $this->getOriginal('about_foto'));
        }
    }
    public function getAboutFotoAttribute($value)
    {
        if ($value && $this->akFileExists($this->fileInfo("about_foto")['disk'],$this->fileInfo("about_foto")['original']["folder"],$value)) {
            return $this->akGetURLPath($this->fileInfo("about_foto")['disk'],$this->fileInfo("about_foto")['original']["folder"],$value);
        }
        return false;
    }
    public function setAkAboutFotoDeleteAttribute($delete)
    {
        if (!request()->hasFile('about_foto') && $delete == 1) {
            $this->attributes['about_foto'] = $this->akImageUpload('', $this->fileInfo("about_foto"), $this->getOriginal('about_foto'), 1);
        }
    }
	public function setAboutFoto2Attribute()
    {
        if (request()->hasFile('about_foto_2')) {
            $this->attributes['about_foto_2'] = $this->akImageUpload(request()->file("about_foto_2"), $this->fileInfo("about_foto_2"), $this->getOriginal('about_foto_2'));
        }
    }
    public function getAboutFoto2Attribute($value)
    {
        if ($value && $this->akFileExists($this->fileInfo("about_foto_2")['disk'],$this->fileInfo("about_foto_2")['original']["folder"],$value)) {
            return $this->akGetURLPath($this->fileInfo("about_foto_2")['disk'],$this->fileInfo("about_foto_2")['original']["folder"],$value);
        }
        return false;
    }
    public function setAkAboutFoto2DeleteAttribute($delete)
    {
        if (!request()->hasFile('about_foto_2') && $delete == 1) {
            $this->attributes['about_foto_2'] = $this->akImageUpload('', $this->fileInfo("about_foto_2"), $this->getOriginal('about_foto_2'), 1);
        }
    }
	public function scopeStartSorting($query, $request)
    {
        if ($request->has('fixed_content_sort_by') && $request->fixed_content_sort_by) {
            if($request->fixed_content_direction == "desc"){
                $query->orderByDesc($request->fixed_content_sort_by);
            } else {
                $query->orderBy($request->fixed_content_sort_by);
            }
        } else {
            $query->orderByDesc("id");
        }
    }
	public function scopeStartSearch($query, $search)
    {
        if ($search) {
            $query->where("id","like","%".$search."%");
        }
    }
}