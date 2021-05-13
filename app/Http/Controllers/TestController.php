<?php

namespace App\Http\Controllers;

use App\Models\Morphy\MorphyAnalyzer;

class TestController extends Controller
{
    public function test($word) {
        try {
            $morphyAnalyzer = new MorphyAnalyzer($word);
            return response()->json([
                $morphyAnalyzer->getTypesOfWord(),
            ],200, [
                'Content-Type' => 'application/json;charset=UTF-8',
            ], JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'code' => $e->getCode()
            ], 404);
        }
    }
}
