<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Comparison;

class ComparisonController extends Controller
{
    public function updateComparisons() {

        Comparison::truncate();

        $filePath = storage_path('app/public/comparisons.json');
        $jsonContents = file_get_contents($filePath);
        $records = json_decode($jsonContents, true);

            foreach($records as $record){
                Comparison::create($record);
            }

            return response()->json(['success' => true]);

    }
}
