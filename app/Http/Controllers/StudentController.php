<?php

namespace App\Http\Controllers;

use App\Student;
use App\User;
use App\Commnet;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $student =new Student;
        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            request()->avatar->move(public_path('/image/'), $filename);
            $student->picture = $filename;
        }
        $student->firstname = $request->firstname;
        $student->lastname = $request->lastname;
        $student->class = $request->class;
        $student->description = $request->desciption;
        $student ->user_id = $request->tutor;
        $student->save();
        return redirect('/home');
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Student::find($id);
        $users = User::all();
        return view('editstudent', compact('student', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $student = Student::find($id);
        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            request()->avatar->move(public_path('/image/'), $filename);
            $student->picture = $filename;
        }
        $student->firstname = $request->firstname;
        $student->lastname = $request->lastname;
        $student->class = $request->class;
        $student->description = $request->description;
        $student->user_id = $request->tutor;
        $student->save();
        return redirect('/home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function deleteStudent($id)
    {
        $student_delete = Student::find($id);
        $student_delete->delete();
        return redirect('/home');
    }

    public function viewDetail($id){
        $student = Student::find($id);
        $comments = $student->comments;
        return view('/detail', compact('student', 'comments'));
    }

    public function uotFollowup(Request $request ,$id){
        $student = Student::find($id);
        $student->activeFollowup = '1';
        $student->save();
        return redirect('/home');
    }
    public function backToFollowup(Request $request ,$id){
        $student = Student::find($id);
        $student->activeFollowup = '0';
        $student->save();
        return redirect('/home');
    }
}
