<?php

namespace App\Http\Controllers;

use DB;
use View;
use App\Models\Queue;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TechnicianQueueController extends Controller
{
    public function index ()
    {
        $queues = DB::table('queues')
            ->orderBy('queue_id', 'desc')
            ->get();
        return View::make('technicians.queueIndex', compact('queues'));
    }

    public function edit($id)
    {
        $tickets = Ticket::where('queue_id', $id)->get();
        $stocks = DB::table('stocks')->get();
        return View::make('technicians.queueEdit', compact('tickets', 'stocks'));
    }

    public function finish($id)
    {
        $queue = Queue::where('queue_id', $id)->update([
            'status' => 'finished',
        ]);
        return redirect()->route('techniciansqueue.index');
    }
}
