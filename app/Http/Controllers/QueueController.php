<?php

namespace App\Http\Controllers;
use App\Models\Device;
use Illuminate\Http\Request;
use App\Models\Deviceservice;
use App\Models\Queue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use App\Models\Ticket;

class QueueController extends Controller
{
    public function create($id)
    {
        $deviceServices = Deviceservice::where('device_id', $id)->get();
        return View::make('queue.create', compact('deviceServices'));
    }

    public function store(Request $request)
    {
        //dd($request);
        $queue = new Queue();
        $queue->customer_id = $request->customer_id;
        $queue->customer_name = $request->customer_name;
        $queue->date_placed = $request->date_placed;
        $queue->scheduled_date = $request->scheduled_date;
        $queue->save();

        foreach($request->service_id as $service){
        $ticket = new Ticket();
        $ticket->queue_id = $queue->id;
        $ticket->customer_id = $request->customer_id;
        $ticket->customer_name = $request->customer_name;
        $ticket->device_id = $request->device_id;
        $ticket->device_type = $request->device_type[0];
        $ticket->service_id = $service;
        $service_type = Deviceservice::where('service_id', $service)->pluck('service_type')->first();

        $ticket->service_type = $service_type;
        $ticket->technician_id = $request->technician_id;
        $ticket->technician_name = $request->technician_name;
        $ticket->status = 'for diagnosis';
        $ticket->save();
        } 
    }

    public function index()
    {
        $tickets = DB::table('tickets')->get();
        $queues = DB::table('queues')->pluck('queue_id')->toArray();
        return View::make('queues.index', compact('tickets', 'queues'));
    }
}