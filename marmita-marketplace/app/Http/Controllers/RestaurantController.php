<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index()
    {
        return Restaurant::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'logo' => 'nullable|string',
            'phone' => 'nullable|string',
            'address' => 'nullable|string'
        ]);

        $restaurant = Restaurant::create($validated);

        return response()->json($restaurant, 201);
    }

    public function show(Restaurant $restaurant)
    {
        return $restaurant;
    }

    public function update(Request $request, Restaurant $restaurant)
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'logo' => 'nullable|string',
            'phone' => 'nullable|string',
            'address' => 'nullable|string'
        ]);

        $restaurant->update($validated);

        return response()->json($restaurant);
    }

    public function destroy(Restaurant $restaurant)
    {
        $restaurant->delete();
        
        return response()->noContent();
    }
}
