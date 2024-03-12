<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class TicketController extends Controller
{
    public function index($id)
    {
        $tickets = Ticket::where('queue_id', $id)->get();
        return View::make('tickets.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function repair($id)
    {
        $queue_id = DB::table('tickets')->where('ticket_id', $id)->value('queue_id');
        $device = Ticket::where('ticket_id', $id)->update([
            'status' => 'repairing',
        ]);
        return redirect()->route('tickets.index', ['id' => $queue_id]);
    }

    public function finish(Request $request)
    {
        //dd($request);
        $queue_id = DB::table('tickets')->where('ticket_id', $request->ticket_id)->value('queue_id');
        // $technician_id = DB::table('technicians')
        // ->where('user_id', $request->id)
        // ->value('technician_id');
        $technician_id = DB::table('technicians')
                ->where('user_id', $request->user_id)
                ->value('technician_id');
        $ticket = Ticket::where('ticket_id', $request->ticket_id)->update([
            'status' => 'finished',
            'stock_id' => $request->stock_id,
            'technician_name' => $request->technician_name,
            'technician_id' => $technician_id,
        ]);
        $stock = Stock::where('stock_id', $request->stock_id)->first();
            if ($stock) {
                $stock->qty -= 1;
                $stock->save();
            }
        return redirect()->route('techniciansqueue.edit', ['id' => $queue_id]);
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
