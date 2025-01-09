<?php

namespace App\Http\Controllers;

use App\Models\SeasonConstructorFull;
use App\Models\SeasonDriverFull;
use Illuminate\Http\Request;

class StandingController extends Controller
{
    // Get constructor standings by year
    public function constructorStandings(Request $request, $year)
    {
        $standings = SeasonConstructorFull::where('year', $year)
            ->orderBy('position_number', 'asc') // Use position_number for sorting
            ->get();

        if ($standings->isEmpty()) {
            return response()->json(['error' => 'No constructor standings found for this year'], 404);
        }

        return response()->json($standings);
    }
    public function driverStandings(Request $request, $year)
    {
        $standings = SeasonDriverFull::where('year', $year)
            ->orderBy('position_number', 'asc')
            ->get();

        if ($standings->isEmpty()) {
            return response()->json(['error' => 'No driver standings found for this year'], 404);
        }

        return response()->json($standings);
    }
}
