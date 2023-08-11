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

            $data['password'] = md5($request->input('password'));
            Customer::where("id", $request->input('id'))->update($data);
            setMessage("message", "success", "Password Changed Successfully");
            return redirect()->back();

       }else{

            $data['customer_name'] = $request->input('customer_name');
            $data['email_address'] = $request->input('email_address');
            $data['mobile_no'] = $request->input('mobile_no');
            $data['address'] = $request->input('address');
            Customer::where("id", $request->input('id'))->update($data);
            setMessage("message", "success", "Successful");
            return redirect()->back();

       }

    }

    public function studentLogout(){
        Session::flush();
        return redirect('/');
    }

}