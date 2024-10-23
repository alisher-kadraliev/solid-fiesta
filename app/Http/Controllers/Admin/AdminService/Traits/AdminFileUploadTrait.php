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

namespace App\Http\Controllers\Admin\AdminService\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

trait AdminFileUploadTrait
{
    public static function bootAdminFileUploadTrait(): void
    {
        static::deleting(function (Model $model) {
            if (!method_exists($model, 'runSoftDelete')) {
                $model->akSoftDeleteFilesCascade(get_class($model), [$model->id]);
                $model->akDeleteFiles($model, 'id', [$model->id]);
            }
        });
    }

    public function akSoftDeleteFilesCascade($modelPath, $deleteId): void
    {
        $path = 'App\Models\Admin\\';
        if (property_exists(app($modelPath), 'adminCascadeModels')) {
            $cascade = $modelPath::$adminCascadeModels;
            foreach ($cascade as $key_id => $modelArray) {
                foreach ($modelArray as $model) {
                    $getModel = app($path . $model);
                    if (property_exists($getModel, 'adminCascadeModels')) {
                        $deleteIdArray = $getModel::whereIn($key_id, $deleteId)->pluck('id');
                        if (count($deleteIdArray) > 0) {
                            $this->akSoftDeleteFilesCascade($path . $model, $deleteIdArray);
                        }
                    }
                    $this->akDeleteFiles($getModel, $key_id, $deleteId);
                }
            }
        }
    }

    public function akDeleteFiles($getModel, $key_id, $deleteId): void
    {
        if (method_exists($getModel, 'fileInfo')) {
            $deleteFilesAll = $getModel::whereIn($key_id, $deleteId)->get();
            foreach ($deleteFilesAll as $fileData) {
                foreach ($getModel->fileInfo() as $key => $data) {
                    if ($fileData->getRawOriginal($key)) {
                        if (array_key_exists('original', $data) && array_key_exists('folder', $data['original'])) {
                            $this->akDeleteFile($data['original']['folder'] . $fileData->getRawOriginal($key), $data['disk']);
                        }
                        if (array_key_exists('webp', $data) && $data['webp']['action'] == "add" && array_key_exists('folder', $data['original'])) {
                            $currentFileWebp = pathinfo($fileData->getRawOriginal($key), PATHINFO_FILENAME) . '.webp';
                            $this->akDeleteFile($data['original']['folder'] . $currentFileWebp, $data['disk']);
                        }
                        if (array_key_exists('thumbnail', $data) && is_array($data['thumbnail'])) {
                            foreach ($data['thumbnail'] as $thumbnailInfo) {
                                if (array_key_exists('folder', $thumbnailInfo)) {
                                    $this->akDeleteFile($thumbnailInfo['folder'] . $thumbnailInfo['prefix'] . $fileData->getRawOriginal($key), $data['disk']);
                                    $currentFileWebp = pathinfo($fileData->getRawOriginal($key), PATHINFO_FILENAME) . '.webp';
                                    $this->akDeleteFile($thumbnailInfo['folder'] . $thumbnailInfo['prefix'] . $currentFileWebp, $data['disk']);
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    public function akDeleteFile($file, $disk): bool
    {
        if (Storage::disk($disk)->exists($file)) {
            Storage::disk($disk)->delete($file);
            return true;
        }
        return false;
    }

    public function akImageUpload($uploadedFile, $fileInfo, $currentFile = '', $deleteFile = 0)
    {
        $fileNameToStore = null;
        if ($currentFile != '' || $deleteFile == 1) {
            $this->akDeleteFile($fileInfo['original']['folder'] . basename($currentFile), $fileInfo['disk']);
            if ($fileInfo['webp']['action'] == "add" && strtolower(pathinfo($currentFile, PATHINFO_EXTENSION)) != "webp") {
                $currentFileWebp = pathinfo($currentFile, PATHINFO_FILENAME) . '.webp';
                $this->akDeleteFile($fileInfo['original']['folder'] . $currentFileWebp, $fileInfo['disk']);
            }
            if (isset($fileInfo['thumbnail']) && count($fileInfo['thumbnail']) > 0) {
                foreach ($fileInfo['thumbnail'] as $thumbnail) {
                    $this->akDeleteFile($thumbnail['folder'] . $thumbnail['prefix'] . basename($currentFile), $fileInfo['disk']);
                    if ($fileInfo['webp']['action'] == "add" && strtolower(pathinfo($thumbnail['folder'] . $thumbnail['prefix'] . $currentFile, PATHINFO_EXTENSION)) != "webp") {
                        $currentFileWebp = pathinfo($currentFile, PATHINFO_FILENAME) . '.webp';
                        $this->akDeleteFile($thumbnail['folder'] . $thumbnail['prefix'] . $currentFileWebp, $fileInfo['disk']);
                    }
                }
            }
        }
        if ($uploadedFile) {
            $fileNameToStore = $this->akFixImageFileName($uploadedFile->getClientOriginalName(), $fileInfo['original']['folder'], $fileInfo);
            $resize_crop = $fileInfo['original']['action'];
            if ($resize_crop != 'none') {
                $newWidth = $fileInfo['original']['width'];
                $newHeight = $fileInfo['original']['height'];
                $this->akImageResize($uploadedFile, $fileInfo['original']['folder'], $fileInfo, $fileNameToStore, $newWidth, $newHeight, $resize_crop);
            } else {
                $uploadedFile->storePubliclyAs($fileInfo['original']['folder'], $fileNameToStore, $fileInfo['disk']);
            }
            if (isset($fileInfo['thumbnail']) && count($fileInfo["thumbnail"]) > 0) {
                foreach ($fileInfo["thumbnail"] as $thumbnail) {
                    $newWidth = $thumbnail['width'];
                    $newHeight = $thumbnail['height'];
                    $resize_crop = $thumbnail['action'];
                    $this->akImageResize($uploadedFile, $thumbnail['folder'], $fileInfo, $thumbnail['prefix'] . $fileNameToStore, $newWidth, $newHeight, $resize_crop);
                }
            }
        }
        return $fileNameToStore;
    }

    public function akFixImageFileName($originalFileName, $folder, $fileInfo)
    {
        $fileName = $this->akFixFileName($originalFileName, $folder, $fileInfo['disk']);
        if ($fileInfo['webp']['action'] == "convert" && strtolower(pathinfo($fileName, PATHINFO_EXTENSION)) != "webp") {
            $fileName = pathinfo($fileName, PATHINFO_FILENAME) . '.webp';
        }
        return $fileName;
    }

    public function akFixFileName($fileName, $folder, $disk, $defaultName = 'file', $addNum = 0)
    {
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        if (strlen($fileExtension) > 0) {
            $fileExtension = '.' . $fileExtension;
            $baseFileName = pathinfo($fileName, PATHINFO_FILENAME);
        } else {
            $fileExtension = '';
            $baseFileName = $fileName;
        }
        $baseFileName = str_replace(' ', '_', $baseFileName);
        $baseFileName = preg_replace('/[^A-Za-z0-9\-_]/', '', $baseFileName); // Removes special chars.
        if (strlen($baseFileName) == 0) {
            $baseFileName = $defaultName;
        }
        if ($addNum > 0) {
            $newFileName = strtolower($baseFileName) . '_' . $addNum . $fileExtension;
        } else {
            $newFileName = strtolower($baseFileName) . $fileExtension;
        }
        if (Storage::disk($disk)->exists($folder . $newFileName)) {
            $addNum++;
            $newFileName = $this->akFixFileName(strtolower($baseFileName) . $fileExtension, $folder, $disk, $defaultName, $addNum);
        }
        return $newFileName;
    }
    public function akImageResize($uploadedFile, $folderToStore, $fileInfo, $fileNameToStore, $newWidth, $newHeight, $resize_crop): void
    {
        $imageMaker = new ImageManager(new Driver());
        $image = $imageMaker->read($uploadedFile);
        if ($resize_crop == 'resize') {
            $image->scaleDown(width: $newWidth,height: $newHeight);
        } else {
            $image->coverDown($newWidth, $newHeight);
        }
        if ($fileInfo['webp']['action'] == "none" || $fileInfo['webp']['action'] == "add") {
            //regular image
            $content = $image->encodeByMediaType(quality: $fileInfo['quality']);
            Storage::disk($fileInfo['disk'])->put($folderToStore . $fileNameToStore, $content, 'public');
            if ($fileInfo['webp']['action'] == "add") {
                //webp image
                $content = $image->toWebp($fileInfo['webp']['quality']);
                $fileNameToStoreWebP = pathinfo($fileNameToStore, PATHINFO_FILENAME) . '.webp';
                Storage::disk($fileInfo['disk'])->put($folderToStore . $fileNameToStoreWebP, $content, 'public');
            }
        }
        if ($fileInfo['webp']['action'] == "convert") {
            //webp image
            $content = $image->toWebp($fileInfo['webp']['quality']);
            Storage::disk($fileInfo['disk'])->put($folderToStore . $fileNameToStore, $content, 'public');
        }
    }

    public function akFileUpload($uploadedFile, $fileInfo, $currentFile = '', $deleteFile = 0)
    {
        $fileNameToStore = null;
        if ($currentFile != '' || $deleteFile == 1) {
            $this->akDeleteFile($fileInfo['original']['folder'] . basename($currentFile), $fileInfo['disk']);
        }
        if ($uploadedFile) {
            $fileNameToStore = $this->akFixFileName($uploadedFile->getClientOriginalName(), $fileInfo['original']['folder'], $fileInfo['disk']);
            $uploadedFile->storePubliclyAs($fileInfo['original']['folder'], $fileNameToStore, $fileInfo['disk']);
        }
        return $fileNameToStore;
    }

    public function akFileExists($disk, $folder, $fileName): bool
    {
        if ($fileName) {
            return Storage::disk($disk)->exists($folder . $fileName);
        }
        return false;
    }

    public function akGetURLPath($disk, $folder, $fileName): string
    {
        return Storage::disk($disk)->url($folder . $fileName);
    }

    public function akDeleteMultipleFiles($filesArray): void
    {
        Storage::disk(config("admin.settings.upload_disk"))->delete($filesArray);
    }
}

