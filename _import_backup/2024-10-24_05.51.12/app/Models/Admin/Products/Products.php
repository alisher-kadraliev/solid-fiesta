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
namespace App\Models\Admin\Products;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Admin\AdminService\Traits\AdminFileUploadTrait;

class Products extends Model
{
    use AdminFileUploadTrait;
    public $table = 'rnler';
    
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
		"product_categy_title",
		"image",
		"ak_image_delete",
    ];
    
	public function fileInfo($key=false)
    {
        $file_info = [
			"image"=>[
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
	public function scopeStartSorting($query, $request)
    {
        if ($request->has('products_sort_by') && $request->products_sort_by) {
            if($request->products_direction == "desc"){
                $query->orderByDesc($request->products_sort_by);
            } else {
                $query->orderBy($request->products_sort_by);
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