<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CountryStatisticsController extends Controller
{
    /**
     * Get combined driver statistics grouped by country.
     */
    public function combinedDriverStatistics(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $search = $request->get('search', null);
        $sortBy = $request->get('sort_by', 'driver_count');
        $sortOrder = $request->get('sort_order', 'desc');

        $sortableFields = [
            'driver_count', 'total_points', 'total_race_wins', 
            'total_podiums', 'total_pole_positions', 'total_fastest_laps'
        ];

        $query = DB::table('driver as d')
            ->join('country as c', 'd.nationality_country_id', '=', 'c.id')
            ->select(
                'd.nationality_country_id',
                'c.alpha2_code',
                'c.name as country_name',
                DB::raw('COUNT(d.id) as driver_count'),
                DB::raw('SUM(d.total_points) as total_points'),
                DB::raw('SUM(d.total_race_wins) as total_race_wins'),
                DB::raw('SUM(d.total_podiums) as total_podiums'),
                DB::raw('SUM(d.total_pole_positions) as total_pole_positions'),
                DB::raw('SUM(d.total_fastest_laps) as total_fastest_laps')
            )
            ->groupBy('d.nationality_country_id', 'c.alpha2_code', 'c.name');

        // Apply search functionality
        if ($search) {
            $query->where('c.name', 'like', "%{$search}%")
                  ->orWhere('c.alpha2_code', 'like', "%{$search}%");
        }

        // Apply sorting if valid field is provided
        if (in_array($sortBy, $sortableFields)) {
            $query->orderBy($sortBy, $sortOrder);
        }

        return $query->paginate($perPage);
    }

    /**
     * Get statistics for a specific country by ID.
     */
    public function countryStatsById($id)
    {
        $results = DB::table('driver as d')
            ->join('country as c', 'd.nationality_country_id', '=', 'c.id')
            ->select(
                'd.nationality_country_id',
                'c.alpha2_code',
                'c.name as country_name',
                DB::raw('COUNT(d.id) as driver_count'),
                DB::raw('SUM(d.total_points) as total_points'),
                DB::raw('SUM(d.total_race_wins) as total_race_wins'),
                DB::raw('SUM(d.total_podiums) as total_podiums'),
                DB::raw('SUM(d.total_pole_positions) as total_pole_positions'),
                DB::raw('SUM(d.total_fastest_laps) as total_fastest_laps')
            )
            ->where('d.nationality_country_id', $id) // Filter by country ID
            ->groupBy('d.nationality_country_id', 'c.alpha2_code', 'c.name')
            ->get(); // Return all results without pagination

        if ($results->isEmpty()) {
            return response()->json(['error' => 'Country not found or no drivers associated with this country'], 404);
        }

        return response()->json($results);
    }
}
