<?php

namespace App\Http\Controllers;

use App\Models\Morphy\MorphyAnalyzer;

class TestController extends Controller
{
    public function test($word) {
        try {
            $morphyAnalyzer = new MorphyAnalyzer($word);
            dd($morphyAnalyzer->getTypesOfWord());
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'code' => $e->getCode()
            ]);
        }
    }
}
