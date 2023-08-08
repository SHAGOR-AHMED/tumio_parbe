<?php

namespace App\Http\Controllers\Backend\Course;

use Illuminate\Http\Request;
use App\Models\Backend\Course;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function __construct(){

        $this->middleware(function ($request, $next) {
            \Session::put('top_menu', "course");
            \Session::put('sub_menu', "course");
            return $next($request);
        });
    }

    public function index(){
        $data['get_all'] = Course::all();
        return view("admin.course.index", $data);
    }

    public function edit($courseId){
        $data['selected_info'] = Course::find($courseId);
        $data['get_all'] = Course::all();
        return view("admin.course.index", $data);
    }

    public function store(
        ?int $courseId = null,
        Request $request
    ) {

        //Validate
        $validatedData = $request->validate([
            'course_name'         => 'required',
            'description'         => 'required',
            'admission_fee'       => 'required',
            'monthly_tuition_fee' => 'required',
        ]);

        if($courseId != null){
            $data = Course::find($courseId);
        }else{
            $data = new Course();
        }

        $data->course_name          = $request->course_name;
        $data->description          = $request->description;
        $data->admission_fee        = $request->admission_fee;
        $data->monthly_tuition_fee  = $request->monthly_tuition_fee;
        $success                    = $data->save();

        if($success){
            setMessage("message", "success", "Successfully");
        }else{
            setMessage("message", "danger", "Failed");
        }
        return redirect(route('course.add'));
    }

    // destroy
    public function destroy($id)
    {
        $data       =  Course::find($id);
        $success    =  $data->delete();
        if($success){
            setMessage("message", "success", "Successfully");
        }else{
            setMessage("message", "danger", "Failed");
        }
        return redirect()->back();
    }
    
}
