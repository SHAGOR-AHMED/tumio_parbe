<?php

namespace App\Http\Controllers\Web;

use DB;
use Session;
use App\Models\Frontend\Student;
use App\Models\Frontend\StudentDetail;
use App\Models\Backend\Course;
use App\Models\Backend\Batch;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{

    public function studentLoginCheck (Request $request) {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);
   
        $studentInfo = Student::where('user_name', $request->username)->where('password', md5($request->password))->first();
        if ($studentInfo){
            session(['studentId' => $studentInfo->id, 'student_name' => $studentInfo->full_name]);
            return redirect('my-account')->withSuccess('You have successfully logged in!');
        }else{
            return redirect('/');
        }
    }

    public function myAccount(){
        $studentId = Session('studentId');
        $data['total_courses'] = StudentDetail::where('student_id', $studentId)->count();
        // $data['total_purchase'] = DB::table('orders')->where('customer_id',$customer_id)->sum('amount');
        return view("frontend.student.my_account",$data);
    }

    public function myCourse($studentId){
        $data['all_courses'] = Course::all();
        $data['all_batches'] = Batch::all();
        $data['selected_info'] = DB::table("student_details as SD")
            ->join('courses as C', 'SD.course_id', '=', 'C.id')
            ->join('batches as B', 'SD.batch_id', '=', 'B.id')
            ->select('SD.*', 'C.course_name', 'C.admission_fee', 'B.batch_name', 'B.group_link')
            ->where('SD.student_id', Session('studentId'))
            ->get();
        return view("frontend.student.my_course", $data);
    }

    public function saveStudentCourse(Request $request){

        $this->validate($request, [
            'student_id' => 'required',
            'course_id'  => 'required',
            'batch_id'   => 'required',
        ]);

        $data = new StudentDetail;
        $data->student_id = $request->student_id;
        $data->course_id = $request->course_id;
        $data->batch_id = $request->batch_id;
        if ($data->save()) {
            setMessage('message', 'success', 'Saved Successfully.Waiting for confirmation.');
        } else {
            setMessage('message', 'danger', 'Failed to save');
        }
        return redirect()->back();
    }

    public function editProfile($customer_id){

        $data['selected_info'] = DB::table('students')->where('id', decrypt($customer_id))->first();
        return view("frontend.student.my_profile", $data);
    }

    public function updateProfile(Request $request){

        if ($request->input('password')) {

            $this->validate($request, [
                'password'    => 'required|string|min:6',
            ]);

            $data['password'] = md5($request->input('password'));
            Student::where("id", $request->input('id'))->update($data);
            setMessage("message", "success", "Password Changed Successfully");
            return redirect()->back();

        }else{

            $this->validate($request, [
                'full_name'   => 'required|string|max:255',
                'father_name' => 'required|string|max:255',
                'mother_name' => 'required|string|max:255',
                'phone'       => 'required',
                'age'         => 'required|numeric',
                'grade'       => 'required',
                'district'    => 'required',
                'address'     => 'required',
                'fb_link'     => 'required',
            ]);

            $data['full_name'] = $request->input('full_name');
            $data['father_name'] = $request->input('father_name');
            $data['mother_name'] = $request->input('mother_name');
            $data['phone'] = $request->input('phone');
            $data['email'] = $request->input('email');
            $data['age'] = $request->input('age');
            $data['grade'] = $request->input('grade');
            $data['school'] = $request->input('school');
            $data['district'] = $request->input('district');
            $data['address'] = $request->input('address');
            $data['fb_link'] = $request->input('fb_link');

            if ($request->hasFile('photo')) {
                $folder = "images/students_photo/";
                $pictureinfo = $request->file("photo");
                $picture_name = "STUDENT-" . time() . "." . $pictureinfo->getClientOriginalExtension();
                $pictureinfo->move(public_path($folder), $picture_name);
                $picture_url = $folder . $picture_name;
                $data['photo'] = $picture_url;
            }

            Student::where("id", $request->input('id'))->update($data);

            setMessage("message", "success", "Profile Updated");
            return redirect()->back();

       }

    }

    public function studentLogout(){
        Session::flush();
        return redirect('/');
    }

}