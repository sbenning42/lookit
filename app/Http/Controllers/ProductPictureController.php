<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Http\File;

use App\DataAccess\ProductPictureDataAccess;

class ProductPictureController extends Controller
{
    public $warningUploadMsg = '::: ProductPictureController@_handleUploadedFile: got originRelFsPath in DirectoryName for request->product_id ::: ';
    public $baseServerUrl = 'http://api.lookit.dev';
    public $basePicturePath = 'public/pictures/REF-';
    public $baseThumbnailPath = 'public/thumbnails/REF-';

    private function _validateCreation(Request $request) {
        $this->validate($request, [
            'product_id' => 'required|exists:products,id',
            'picture' => 'required'
        ]);
    }
    private function _validateUpdate(Request $request) {
        $this->validate($request, [
            'order' => 'required',
        ]);
    }
    private function _prepareDataCreate(Request $request) {
        return array(
            'product_id' => $request->product_id,
            'order' => $request->order,
            'origin_name' => $request->origin_name,
            'origin_abs_fs_path' => $request->origin_abs_fs_path,
            'origin_http_public_path' => $request->origin_http_public_path,
            'origin_size' => $request->origin_size,
            'origin_type' => $request->origin_type,
            'thumb_name' => $request->thumb_name,
            'thumb_abs_fs_path' => $request->thumb_abs_fs_path,
            'thumb_http_public_path' => $request->thumb_http_public_path,
            'thumb_size' => $request->thumb_size,
            'thumb_type' => $request->thumb_type,
        );
    }
    private function _prepareDataUpdate(Request $request) {
        return array(
            'order' => $request->order,
        );
    }
    private function _prepareWith(Request $request) {
        $allowedWithKeys = [
            'product',
            'product.category',
            'product.pictures'
        ];
        return isset($request->with) ?
            array_filter($request->with, function($withKey) use($allowedWithKeys) {
                return array_search($withKey, $allowedWithKeys) === false ? false : true;
            }) :
            null;
    }
    private function _makeThumbnail(Request $request) {
        $file = $request->file('picture');
        $requestImagePath = $file->getRealPath() . '.jpg';
        $directoryName = $this->baseThumbnailPath . $request->product_id;
        $thumb = Image::make($file)
            ->resize(200, null, function ($constraint) { $constraint->aspectRatio(); })
            ->encode('jpg')
            ->save($requestImagePath);
        $thumbRelFsPath = Storage::putFile($directoryName, new File($requestImagePath));
        $request->thumb_name = substr(strrchr($thumbRelFsPath, '/'), 1);
        $request->thumb_abs_fs_path = dirname(__FILE__) . '/' . $thumbRelFsPath;
        $request->thumb_http_public_path = $this->baseServerUrl . Storage::url($thumbRelFsPath);
        $request->thumb_size = Storage::size($thumbRelFsPath);
        $request->thumb_type = 'image';
        return $request;
    }
    private function _handleUploadedFile(Request $request) {
        $file = $request->file('picture');
        $directoryName = $this->basePicturePath . $request->product_id;
        $originRelFsPath = Storage::putFile($directoryName, $file);
        $request->origin_name = substr(strrchr($originRelFsPath, '/'), 1);
        $request->origin_abs_fs_path = dirname(__FILE__) . '/' . $originRelFsPath;
        $request->origin_http_public_path = $this->baseServerUrl . Storage::url($originRelFsPath);
        $request->origin_size = Storage::size($originRelFsPath);
        $request->origin_type = 'image';
        return $request;
    }

    public function index(Request $request) {
        if ($with = $this->_prepareWith($request)) {
            $collection = ProductPictureDataAccess::allWith($with);
        } else {
            $collection = ProductPictureDataAccess::all();
        }
        return response()->json($collection, 200);
    }

    public function show(Request $request, $id) {
        if ($with = $this->_prepareWith($request)) {
            $productPicture = ProductPictureDataAccess::findWith($id, $with);
        } else {
            $productPicture = ProductPictureDataAccess::find($id);
        }
        return response()->json($productPicture, 200);
    }

    public function store(Request $request) {
        $this->_validateCreation($request);
        $request->order = 999;
        $request = $this->_handleUploadedFile($request);
        $request = $this->_makeThumbnail($request);
        $data = $this->_prepareDataCreate($request);
        $productPicture = ProductPictureDataAccess::create($data);
        return response()->json($productPicture, 200);
    }

    public function update(Request $request, $id) {
        $this->_validateUpdate($request);
        $data = $this->_prepareDataUpdate($request);
        $productPicture = ProductPictureDataAccess::find($id);
        $productPicture = ProductPictureDataAccess::update($productPicture, $data);
        return response()->json($productPicture, 200);
    }

    public function delete(Request $request, $id) {
        $productPicture = ProductPictureDataAccess::find($id);
        $productPicture = ProductPictureDataAccess::delete($productPicture);
        return response()->json([], 200);
    }
}
