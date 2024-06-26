<?php
namespace App\Http\Controllers;
use App\Models\Device;
use Illuminate\Http\Request;
use App\Models\Deviceservice;
use App\Models\Queue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use App\Models\Ticket;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
class QueueController extends Controller
{
    public function create($id)
    {
        
        if(Auth::check()){
            $user = Auth::user();
            $deviceServices = Deviceservice::where('device_id', $id)->get();
            return View::make('queue.create', compact('deviceServices', 'user'));
        }else{
            return redirect()->route('login');
        }
        
    }
    public function store(Request $request)
    {
        //dd($request);
        $existingCustomer = Customer::where('user_id', $request->user_id)->first();
        if ($existingCustomer) {
            // If a customer record already exists, you can update the existing record if needed
            // For example, you might want to update the customer's details based on the new order
            $existingCustomer->update([
                'phone_number' => $request->phone_number,
                // Add more fields to update as needed
            ]);
            $queue = new Queue();
            $queue->customer_id = $existingCustomer->customer_id;
            $queue->customer_name = $request->customer_name;
            $queue->date_placed = $request->date_placed;
            $queue->scheduled_date = $request->scheduled_date;
            $queue->phone_number = $request->phone_number;
            $queue->device_type = $request->device_type[0];
            $queue->status = 'for diagnosis';
            $queue->save();

            foreach($request->service_id as $service){
                $ticket = new Ticket();
                $ticket->queue_id = $queue->queue_id;
                $ticket->customer_id = $existingCustomer->customer_id;
                $ticket->customer_name = $request->customer_name;
                $ticket->device_id = $request->device_id;
                $ticket->device_type = $request->device_type[0];
                $ticket->service_id = $service;
                $service_type = Deviceservice::where('service_id', $service)->pluck('service_type')->first();

                $ticket->service_type = $service_type;
                $ticket->status = 'for diagnosis';
                $ticket->save();
            } 
            return redirect()->route('homepage.index')->with('success', 'Booking Complete');
            
        }else {
              // If no customer record exists, create a new one
              $customer = new Customer();
              $customer->user_id = $request->user_id;
              $customer->customer_name = $request->customer_name;
              $customer->phone_number = $request->phone_number;
              $customer->email = $request->email;
              $customer->save();
  
              $queue = new Queue();
              $queue->customer_id = $customer->customer_id;
              $queue->customer_name = $request->customer_name;
              $queue->date_placed = $request->date_placed;
              $queue->scheduled_date = $request->scheduled_date;
              $queue->phone_number = $request->phone_number;
              $queue->device_type = $request->device_type[0];
              $queue->status = 'for diagnosis';
              $queue->save();
  
              foreach($request->service_id as $service){
                  $ticket = new Ticket();
                  $ticket->queue_id = $queue->queue_id;
                  $ticket->customer_id = $customer->customer_id;
                  $ticket->customer_name = $request->customer_name;
                  $ticket->device_id = $request->device_id;
                  $ticket->device_type = $request->device_type[0];
                  $ticket->service_id = $service;
                  $service_type = Deviceservice::where('service_id', $service)->pluck('service_type')->first();
  
                  $ticket->service_type = $service_type;
                  $ticket->status = 'for diagnosis';
                  $ticket->save();
                  } 
                  return redirect()->route('homepage.index')->with('success', 'Booking Complete');
        }
    }
    
    public function index()
    {
        $queues = DB::table('queues')
            ->select('queues.*', DB::raw('SUM(1 * stocks.price) as order_total'))
            ->leftjoin('tickets', 'queues.queue_id', '=', 'tickets.queue_id')
            ->leftjoin('stocks', 'tickets.stock_id', '=', 'stocks.stock_id')
            ->groupBy('queues.queue_id', 'queues.customer_id', 'queues.customer_name', 'queues.date_placed', 'queues.scheduled_date', 'queues.phone_number', 'queues.status', 'queues.created_at', 'queues.updated_at', 'queues.device_type')
            ->orderByDesc('queues.queue_id')
            ->get();
        return View::make('queues.index', compact('queues'));
    }

    public function queueIndex()
    {
        $user = Auth::user();
        $customer = DB::table('customers')
            ->where('user_id', $user->id)
            ->first();
        
        if ($customer) {
            $queues = DB::table('queues')
            ->select('queues.*', DB::raw('SUM(1 * stocks.price) as order_total'))
            ->where('queues.customer_id', $customer->customer_id)
            ->leftjoin('tickets', 'queues.queue_id', '=', 'tickets.queue_id')
            ->leftjoin('stocks', 'tickets.stock_id', '=', 'stocks.stock_id')
            ->groupBy('queues.queue_id', 'queues.customer_id', 'queues.customer_name', 'queues.date_placed', 'queues.scheduled_date', 'queues.phone_number', 'queues.status', 'queues.created_at', 'queues.updated_at', 'queues.device_type')
            ->orderByDesc('queues.queue_id')
            ->get();
            // $queues = DB::table('queues')
            //     ->where('customer_id', $customer->customer_id)
            //     ->get();
        } else {
            $queues = [];
        }
        return View::make('queues.customerQueues', compact('queues'));
    }

    public function queueDestroy(Request $request)
    {
        // Delete the supplier
        $queue = Queue::find($request->queue_id);

    // Check if the queue instance exists
        if ($queue) {
            // Delete the queue
            $queue->delete();
            return redirect()->route('Queues')->with('success', 'Queue deleted successfully.');
        } else {
            // Queue not found, handle the situation (e.g., show an error message)
            return redirect()->route('Queues')->with('error', 'Queue not found.');
        }
    }

    public function finish($id)
    {
        $queue = Queue::where('queue_id', $id)->update([
            'status' => 'finished',
        ]);
        return redirect()->route('queues.index');
    }
}