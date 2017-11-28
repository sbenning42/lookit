<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\DataAccess\ProductCategoryDataAccess;

class ProductCategoryController extends Controller
{
    private function _prepareWith(Request $request) {
        $allowedWithKeys = [
            'products',
            'products.category',
            'products.pictures'
        ];
        return isset($request->with) ?
            array_filter($request->with, function($withKey) use($allowedWithKeys) {
                return array_search($withKey, $allowedWithKeys) === false ? false : true;
            }) :
            null;
    }

    public function index(Request $request) {
        if ($with = $this->_prepareWith($request)) {
            $collection = ProductCategoryDataAccess::allWith($with);
        } else {
            $collection = ProductCategoryDataAccess::all();
        }
        return response()->json($collection, 200);
    }

    public function show(Request $request, $id) {
        if ($with = $this->_prepareWith($request)) {
            $productCategory = ProductCategoryDataAccess::findWith($id, $with);
        } else {
            $productCategory = ProductCategoryDataAccess::find($id);
        }
        return response()->json($productCategory, 200);
    }
}
