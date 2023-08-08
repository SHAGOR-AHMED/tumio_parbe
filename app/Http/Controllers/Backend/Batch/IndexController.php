<?php

namespace App\Http\Controllers\Backend\Batch;

use Illuminate\Http\Request;
use App\Models\Backend\Batch;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function __construct(){

        $this->middleware(function ($request, $next) {
            \Session::put('top_menu', "batch");
            \Session::put('sub_menu', "batch");
            return $next($request);
        });
    }

    public function index(){
        $data['get_all'] = Batch::all();
        return view("admin.batch.index", $data);
    }

    public function edit($batchId){
        $data['selected_info'] = Batch::find($batchId);
        $data['get_all'] = Batch::all();
        return view("admin.batch.index", $data);
    }

    public function store(
        ?int $batchId = null,
        Request $request
    ) {

        //Validate
        $validatedData = $request->validate([
            'batch_name'       => 'required',
            'batch_timing'     => 'required',
            'total_seat'       => 'required',
            'seat_left'        => 'required',
            'group_link'       => 'required',
        ]);

        if($batchId != null){
            $data = Batch::find($batchId);
        }else{
            $data = new Batch();
        }

        $data->batch_name        = $request->batch_name;
        $data->batch_timing      = $request->batch_timing;
        $data->total_seat        = $request->total_seat;
        $data->seat_left         = $request->seat_left;
        $data->group_link        = $request->group_link;
        $success                 = $data->save();

        if($success){
            setMessage("message", "success", "Successfully");
        }else{
            setMessage("message", "danger", "Failed");
        }
        return redirect(route('batch.add'));
    }

    // destroy
    public function destroy($id)
    {
        $data       =  Batch::find($id);
        $success    =  $data->delete();
        if($success){
            setMessage("message", "success", "Successfully");
        }else{
            setMessage("message", "danger", "Failed");
        }
        return redirect()->back();
    }
}
