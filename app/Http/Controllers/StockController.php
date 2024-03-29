<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;

class StockController extends Controller
{
    public function index()
    {
        $stocks = Stock::all();
        return view('stocks.index', compact('stocks'));
    }

    public function create()
    {
        return view('stocks.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'stock_name' => 'required',
            'qty' => 'required|numeric',
            'price' => 'required|numeric',
        ]);

        Stock::create($validatedData);

        return redirect()->route('stocks.index')->with('success', 'Stock created successfully.');
    }

    public function edit($id)
    {
        $stock = Stock::findOrFail($id);
        return view('stocks.edit', compact('stock'));
    }

    public function update(Request $request, Stock $stock)
    {
        $validatedData = $request->validate([
            'stock_name' => 'required',
            'qty' => 'required|numeric',
            'price' => 'required|numeric',
        ]);

        $stock->update($validatedData);

        return redirect()->route('stocks.index')->with('success', 'Stock updated successfully.');
    }

    public function destroy(Stock $stock)
    {
        $stock->delete();

        return redirect()->route('stocks.index')->with('success', 'Stock deleted successfully.');
    }
}
