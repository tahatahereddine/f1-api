<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
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

        $query = Driver::query();

        // Apply search functionality
        if ($search) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('full_name', 'like', "%{$search}%");
        }

        // Apply sorting if valid field provided
        if ($sortBy && in_array($sortBy, $sortableFields)) {
            $query->orderBy($sortBy, $sortOrder);
        }

        return $query->Paginate($perPage);
    }

    public function show($id)
    {
        $driver = Driver::find($id);

        if (!$driver) {
            return response()->json(['error' => 'Driver not found'], 404);
        }

        return response()->json($driver);
    }
}
