<?php

namespace App\Http\Controllers;

use DB;
use View;
use App\Models\Queue;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TechnicianQueueController extends Controller
{
    public function index ()
    {
        // $queues = DB::table('queues')
        //     ->orderBy('queue_id', 'desc')
        //     ->get();
        $user = Auth::user();
        $technician_specialty = DB::table('technicians')
            ->where('user_id', $user->id)
            ->value('specialty_type');

        $queues = DB::table('queues')
            ->select('queues.*', DB::raw('SUM(1 * stocks.price) as order_total'))
            ->leftjoin('tickets', 'queues.queue_id', '=', 'tickets.queue_id')
            ->leftjoin('stocks', 'tickets.stock_id', '=', 'stocks.stock_id')
            ->where('queues.device_type', '=', $technician_specialty)
            ->groupBy('queues.queue_id', 'queues.customer_id', 'queues.customer_name', 'queues.date_placed', 'queues.scheduled_date', 'queues.phone_number', 'queues.status', 'queues.created_at', 'queues.updated_at', 'queues.device_type')
            ->orderByDesc('queues.queue_id')
            ->get();
        return View::make('technicians.queueIndex', compact('queues'));
    }

    public function edit($id)
    {
        $user = Auth::user();
        $tickets = Ticket::where('queue_id', $id)->get();
        $stocks = DB::table('stocks')
            ->orderBy('stock_name', 'asc')
            ->get();
        return View::make('technicians.queueEdit', compact('tickets', 'stocks', 'user'));
    }

    public function finish($id)
    {
        $queue = Queue::where('queue_id', $id)->update([
            'status' => 'finished',
        ]);
        return redirect()->route('techniciansqueue.index');
    }
}
