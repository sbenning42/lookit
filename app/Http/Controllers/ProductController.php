<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataAccess\ProductDataAccess;

use App\ProductCategory;

class ProductController extends Controller
{
    private function _validateCreation(Request $request) {
        $this->validate($request, [
            'category_id' => 'required|exists:product_categories,id',
            'name' => 'required|unique:products,name',
            'description' => 'required',
            'price' => 'required'            
        ]);
    }
    private function _validateUpdate(Request $request) {
        $this->validate($request, [
            'category_id' => 'required|exists:product_categories,id',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required'          
        ]);
    }
    private function _prepareData(Request $request) {
        return array(
            'category_id' => $request->category_id,
            'name' => trim($request->name),
            'description' => trim($request->description),
            'price' => $request->price,
        );
    }
    private function _prepareWith(Request $request) {
        $allowedWithKeys = [
            'category',
            'pictures'
        ];
        return isset($request->with) ?
            array_filter($request->with, function($withKey) use($allowedWithKeys) {
                return array_search($withKey, $allowedWithKeys) === false ? false : true;
            }) :
            null;
    }


    public function index(Request $request) {
        if ($with = $this->_prepareWith($request)) {
            $collection = ProductDataAccess::allWith($with);
        } else {
            $collection = ProductDataAccess::all();
        }
        return response()->json($collection, 200);
    }

    public function show(Request $request, $id) {
        if ($with = $this->_prepareWith($request)) {
            $product = ProductDataAccess::findWith($id, $with);
        } else {
            $product = ProductDataAccess::find($id);
        }
        return response()->json($product, 200);
    }

    public function store(Request $request) {
        $this->_validateCreation($request);
        $data = $this->_prepareData($request);
        $product = ProductDataAccess::create($data);
        return response()->json($product, 200);
    }

    public function update(Request $request, $id) {
        $this->_validateUpdate($request);
        $data = $this->_prepareData($request);
        $product = ProductDataAccess::find($id);
        $product = ProductDataAccess::update($product, $data);
        return response()->json($product, 200);
    }

    public function delete(Request $request, $id) {
        $product = ProductDataAccess::find($id);
        $product = ProductDataAccess::delete($product);
        return response()->json([], 200);
    }
}
