<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faculty;
use App\Models\Subject;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    public function manageQuestions(Request $request)
    {
        $admininfo = Auth::guard('admin')->user();
        $faculty_list = Faculty::where('Institute_Username',$admininfo->institute_username)->where('Status','1')->get();
        $subject_list = Subject::join('faculties', 'subjects.Faculty_ID', '=', 'faculties.id')->where('faculties.Institute_Username', $admininfo->institute_username)->select('subjects.*', 'subjects.id','faculties.Faculty_Name')->orderBy('created_at', 'desc')->get();
        return view('admin.question', compact('admininfo','faculty_list','subject_list'));
    }

    public function manageQuestionsSelected(Request $request)
    {
        $admininfo = Auth::guard('admin')->user();
        $subject_id = $request->input('subject_id');
        $subject = Subject::find($subject_id);
        $subject_list = Subject::join('faculties', 'subjects.Faculty_ID', '=', 'faculties.id')->where('faculties.Institute_Username', $admininfo->institute_username)->where('subjects.id', $subject_id)->select('subjects.*', 'subjects.id', 'faculties.Faculty_Name')->first();
        dd($subject_list);
        return view('admin.managequestion',compact('admininfo','subject_list'));
    }

    public function getSubject(Request $request)
    {
        $facultyId = Faculty::where('id', $request->input('faculty_id'))->value('id');
        $subject_list_from_faculty = Faculty::find($facultyId)->subjects;
        return response()->json($subject_list_from_faculty);
    }

    public function addQuestions(Request $request)
    {

    }
}
