<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    /**
     * Fetch paginated list of drivers with country and continent information.
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 12);
        $sortBy = $request->get('sort_by', null);
        $sortOrder = $request->get('sort_order', 'desc');
        $search = $request->get('search', null);

        $sortableFields = [
            'total_race_wins', 'total_podiums', 'total_championship_wins',
            'total_pole_positions', 'total_fastest_laps'
        ];

        // Build the query with joins
        $query = DB::table('driver as d')
            ->join('country as c', 'd.nationality_country_id', '=', 'c.id')
            ->join('continent as ct', 'c.continent_id', '=', 'ct.id')
            ->select(
                'd.*', // All driver fields
                'c.name as country_name', // Country name
                'ct.name as continent_name' // Continent name
            );

        // Apply search functionality
        if ($search) {
            $query->where('d.name', 'like', "%{$search}%")
                ->orWhere('d.full_name', 'like', "%{$search}%");
        }

        // Apply sorting if valid field provided
        if ($sortBy && in_array($sortBy, $sortableFields)) {
            $query->orderBy($sortBy, $sortOrder);
        }

        // Paginate results
        return response()->json($query->paginate($perPage));
    }

    /**
     * Fetch a single driver with country and continent information by ID.
     */
    public function show($id)
    {
        // Build the query with joins
        $driver = DB::table('driver as d')
            ->join('country as c', 'd.nationality_country_id', '=', 'c.id')
            ->join('continent as ct', 'c.continent_id', '=', 'ct.id')
            ->select(
                'd.*', // All driver fields
                'c.name as country_name', // Country name
                'ct.name as continent_name' // Continent name
            )
            ->where('d.id', $id)
            ->first();

        if (!$driver) {
            return response()->json(['error' => 'Driver not found'], 404);
        }

        return response()->json($driver);
    }
}
