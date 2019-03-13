<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\restaurant;

class RestaurantController extends Controller
{
    //
    public function index()
    {
        $restaurant = restaurant::all();
        return response()->json($restaurant);
    }

    public function show(restaurant $restaurant)
    {
        return $restaurant;
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);

        $restaurant = restaurant::create($request->all());

        return response()->json($restaurant, 201);
    }

    public function update(Request $request,restaurant $restaurant)
    {
        $request->validate([
            'name'       => 'nullable',
            'description' => 'nullable'
        ]);

        $restaurant->update($request->all());

        return response()->json($restaurant, 200);
    }

    public function delete(Request $request, restaurant $restaurant)
    {
        $restaurant->delete();

        return response()->json(null, 204);
    }
}
