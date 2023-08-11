<?php

namespace App\Http\Controllers\Web;

use DB;
use Session;
use Artisan;
use App\Models\Frontend\Student;
use App\Models\Backend\Course;
use App\Models\Backend\Batch;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\View;

class WebController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
    }

    public function ourCourses(){
        $data['get_all'] = Course::all();
        return view("frontend.student.course", $data);
    }

    public function ourBatches(){
        $data['get_all'] = Batch::all();
        return view("frontend.student.batch", $data);
    }

    public function saveStudent(Request $request)
    {
        $this->validate($request, [
            'full_name'   => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'phone'       => 'required',
            'age'         => 'required|numeric',
            'grade'       => 'required',
            'district'    => 'required',
            'user_name'   => 'required|max:255',
            'password'    => 'required|string|min:6',
            'address'     => 'required',
            'fb_link'     => 'required',
        ]);

        if ($request->hasFile('photo')) {
            $folder = "images/students_photo/";
            $pictureinfo = $request->file("photo");
            $picture_name = "STUDENT-" . time() . "." . $pictureinfo->getClientOriginalExtension();
            $pictureinfo->move(public_path($folder), $picture_name);
            $picture_url = $folder . $picture_name;
        } else {
            $picture_url = '';
        }

        $data = new Student;
        $data->full_name = $request->full_name;
        $data->father_name = $request->father_name;
        $data->mother_name = $request->mother_name;
        $data->phone = $request->phone;
        $data->email = $request->email;
        $data->age = $request->age;
        $data->grade = $request->grade;
        $data->school = $request->school;
        $data->district = $request->district;
        $data->user_name = $request->user_name;
        $data->password = md5($request->password);
        $data->address = $request->address;
        $data->fb_link = $request->fb_link;
        $data->photo = $picture_url;
        
        if ($data->save()) {
            setMessage('message', 'success', 'Saved Successfully.Waiting for confirmation.');
        } else {
            setMessage('message', 'danger', 'Failed');
        }
        return redirect()->back();
    }

} //WebController
