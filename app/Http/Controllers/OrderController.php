<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Chocolate;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return response()->json($orders, 200, ['Access-Control-Allow-Origin' => '*'], JSON_UNESCAPED_UNICODE);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'address' => 'required|string',
                'chocolate_id' => 'required|exists:chocolates,id',
                'count' => 'required|integer|min:1|max:40'
            ]);
        } catch (ValidationException $th) {
            return response()->json(['success' => false, 'message' => $th->errors()], 400, ['Access-Control-Allow-Origin' => '*'], JSON_UNESCAPED_UNICODE);
        }

        $chocolate = Chocolate::find($request->chocolate_id);
        $total_price = $chocolate->price * $request->count;

        Order::create([
            'email' => $request->email,
            'address' => $request->address,
            'chocolate_id' => $request->chocolate_id,
            'count' => $request->count,
            'all_price' => $total_price
        ]);

        return response()->json(['success' => true, 'message' => 'Sikeres rendelés!'], 200, ['Access-Control-Allow-Origin' => '*'], JSON_UNESCAPED_UNICODE);
    }

    public function destroy(Request $request)
    {
        $order = Order::find($request->id);

        if (!$order) {
            return response()->json(['success' => false, 'message' => 'Rendelés nem található!'], 404, ['Access-Control-Allow-Origin' => '*'], JSON_UNESCAPED_UNICODE);
        }

        $order->delete();
        return response()->json(['success' => true, 'message' => 'Rendelés törölve'], 200, ['Access-Control-Allow-Origin' => '*'], JSON_UNESCAPED_UNICODE);
    }
}
