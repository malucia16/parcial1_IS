<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sales = Sale::all();
        return response()->json($sales, 201);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $sale = new Sale();
        $sale->name = $request->name;
        $sale->quantity = $request->quantity;
        $sale->price = $request->price; 
        $sale->taxes = $request->taxes;
        $sale->total = $request->total;
        $sale->save();

        return response()->json($sale, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $sale= Sale::find($id);
        return response()->json($sale,200)
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $sale = Sale::find($id);
        $sale->name = $request->name;
        $sale->quantity = $request->quantity;
        $sale->price = $request->price; 
        $sale->taxes = $request->taxes;
        $sale->total = $request->total;
        $sale->save();

        return response()->json($sale, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sale= Sale::find($id);
        $sale->delete();
        return response()->json(['message'=>'venta eliminado'], 204);
    }
}
