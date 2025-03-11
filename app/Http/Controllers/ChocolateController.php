<?php

namespace App\Http\Controllers;

use App\Models\Chocolate;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ChocolateController extends Controller
{
    public function index()
    {
        $chocolates = Chocolate::all();
        return response()->json($chocolates, 200, ['Access-Control-Allow-Origin' => '*'], JSON_UNESCAPED_UNICODE);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'brand' => 'required|string',
                'chocolate_name' => 'required|string',
                'price' => 'required|integer|min:0',
                'expiry_date' => 'required|date'
            ]);
        } catch (ValidationException $th) {
            return response()->json(['success' => false, 'message' => $th->errors()], 400, ['Access-Control-Allow-Origin' => '*'], JSON_UNESCAPED_UNICODE);
        }

        Chocolate::create([
            'brand' => $request->brand,
            'chocolate_name' => $request->chocolate_name,
            'price' => $request->price,
            'expiry_date' => $request->expiry_date,
        ]);

        return response()->json(['success' => true, 'message' => 'Csokoládé a rendszerben!'], 200, ['Access-Control-Allow-Origin' => '*'], JSON_UNESCAPED_UNICODE);
    }
}
