<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\RatioComparison;

class RatioComparisonController extends Controller
{
    public function updateRatioComparisons() {

        RatioComparison::truncate();

        set_time_limit(0);

        $filePath = storage_path('app/public/ratio_comparisons.json');
        $jsonContents = file_get_contents($filePath);
        $records = json_decode($jsonContents, true);

            foreach($records as $record){
                $record['DYNMC_Ratio'] = number_format($record['DYNMC_PixelW'] / $record['DYNMC_PixelH'], 3);
                $record['PRDWORK_Ratio'] = number_format($record['PRDWORK_PixelW'] / $record['PRDWORK_PixelH'], 3);
                $record['RatioDifference'] = abs(number_format($record['DYNMC_Ratio'] - $record['PRDWORK_Ratio'], 3));
                RatioComparison::create($record);
            }

            return response()->json(['success' => true]);

    }
}
