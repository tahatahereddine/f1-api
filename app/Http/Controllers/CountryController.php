<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index(Request $request)
    {
        $sortOrder = $request->get('sort_order', 'asc');
        $search = $request->get('search', null);

        $query = Country::query()->select('id', 'alpha2_code', 'name');

        // Apply search if provided
        if ($search) {
            $query->where('name', 'like', "%{$search}%");
        }

        // Sort by name
        $query->orderBy('name', $sortOrder);

        return response()->json($query->get());
    }

    public function show($id)
    {
        $country = Country::find($id);

        if (!$country) {
            return response()->json(['error' => 'Country not found'], 404);
        }

        return response()->json($country);
    }
}
