<?php

namespace App\Http\Controllers;

use App\Models\Constructor;
use Illuminate\Http\Request;

class ConstructorController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $sortBy = $request->get('sort_by', null);
        $sortOrder = $request->get('sort_order', 'desc');
        $search = $request->get('search', null);

        $sortableFields = [
            'id', 'name', 'full_name', 'country_id', 
            'total_championship_wins', 'total_race_wins', 
            'total_podiums', 'total_points', 'total_fastest_laps'
        ];

        $query = Constructor::query();

        if ($search) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('full_name', 'like', "%{$search}%");
        }

        if ($sortBy && in_array($sortBy, $sortableFields)) {
            $query->orderBy($sortBy, $sortOrder);
        }

        return $query->simplePaginate($perPage);
    }

    public function show($id)
    {
        $constructor = Constructor::find($id);

        if (!$constructor) {
            return response()->json(['error' => 'Constructor not found'], 404);
        }

        return response()->json($constructor);
    }
}
