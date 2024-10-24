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
namespace App\Models\Admin\HomeSlider;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Admin\AdminService\Traits\AdminFileUploadTrait;

class HomeSlider extends Model
{
    use AdminFileUploadTrait;
    public $table = 'anasayfa_slider';
    
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
		"title",
		"alt_title",
		"foto",
		"ak_foto_delete",
    ];
    
	public function fileInfo($key=false)
    {
        $file_info = [
			"foto"=>[
				"disk"=>config("admin.settings.upload_disk"),
				"quality"=>config("admin.images.image_quality"),
				"webp"=>["action"=>"none","quality"=>config("admin.images.webp_quality")],
				"original"=>["action"=>"resize","width"=>1920,"height"=>1080,"folder"=>"/upload/"]
			]
		];
        return ($key)?$file_info[$key]:$file_info;
    }
    public function setFotoAttribute()
    {
        if (request()->hasFile('foto')) {
            $this->attributes['foto'] = $this->akImageUpload(request()->file("foto"), $this->fileInfo("foto"), $this->getOriginal('foto'));
        }
    }
    public function getFotoAttribute($value)
    {
        if ($value && $this->akFileExists($this->fileInfo("foto")['disk'],$this->fileInfo("foto")['original']["folder"],$value)) {
            return $this->akGetURLPath($this->fileInfo("foto")['disk'],$this->fileInfo("foto")['original']["folder"],$value);
        }
        return false;
    }
    public function setAkFotoDeleteAttribute($delete)
    {
        if (!request()->hasFile('foto') && $delete == 1) {
            $this->attributes['foto'] = $this->akImageUpload('', $this->fileInfo("foto"), $this->getOriginal('foto'), 1);
        }
    }
	public function scopeStartSorting($query, $request)
    {
        if ($request->has('home_slider_sort_by') && $request->home_slider_sort_by) {
            if($request->home_slider_direction == "desc"){
                $query->orderByDesc($request->home_slider_sort_by);
            } else {
                $query->orderBy($request->home_slider_sort_by);
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