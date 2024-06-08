<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faculty;
use App\Models\Admin;
use App\Models\Subject;
use App\Models\Result;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class SubjectController extends Controller
{
    public function manageSubjects(Request $request)
    {
        $admininfo = Auth::guard('admin')->user();
        // $perPage = $request->input('per_page', 10);
        // $page = request('page', 1);//Default page is 1

        $perPage = (int)$request->input('per_page', 10);
        $page = (int)request('page', 1);


        if (!in_array($perPage, [5, 10, 15, 20, 50, 100])) {
            $perPage = 10; // Set default per_page to 10 if the provided value is invalid
            //return Redirect::to(request()->url() . '?per_page=' . $perPage); // Redirect with corrected per_page value
            return Redirect::to(request()->url() . '?per_page=' . $perPage . '&page=' . $page);
        }

        // $total_subject_list = Subject::join('faculties', 'subjects.Faculty_ID', '=', 'faculties.id')->where('faculties.Institute_Username', $admininfo->institute_username)->select('subjects.*', 'subjects.id','faculties.Faculty_Name')->paginate($perPage);
        // dd($total_subject_list);
        $query = Subject::join('faculties', 'subjects.Faculty_ID', '=', 'faculties.id')->where('faculties.Institute_Username', $admininfo->institute_username)->select('subjects.*', 'subjects.id','faculties.Faculty_Name')->orderBy('created_at', 'desc');


        $total_subject_list = $query->paginate($perPage, ['*'], 'page', $page);

        // Check if the provided page is not in the range of available pages
        if ($page > $total_subject_list->lastPage()) {
            $page = 1; // Set page to 1 if the provided value is invalid
            $total_subject_list = $query->paginate($perPage, ['*'], 'page', $page); // Re-fetch with default page
            return Redirect::to(request()->url() . '?per_page=' . $perPage . '&page=' . $page);
        }


        $search_subjects = $request->input('search_subjects');
        if ($search_subjects) {
            $query->where(function ($q) use ($search_subjects) {
                if (in_array(strtolower($search_subjects), ['jan','janu','janua','januar','january'])) {
                    $search_subjects_custom = '-01-';
                }
                elseif(in_array(strtolower($search_subjects), ['feb','febr','febru','februa','februar','february']))
                {
                    $search_subjects_custom = '-02-';
                }
                elseif(in_array(strtolower($search_subjects), ['mar','marc','march']))
                {
                    $search_subjects_custom = '-03-';
                }
                elseif(in_array(strtolower($search_subjects), ['apr','apri','april']))
                {
                    $search_subjects_custom = '-04-';
                }
                elseif(in_array(strtolower($search_subjects), ['may']))
                {
                    $search_subjects_custom = '-05-';
                }
                elseif(in_array(strtolower($search_subjects), ['jun','june']))
                {
                    $search_subjects_custom = '-06-';
                }
                elseif(in_array(strtolower($search_subjects), ['jul','july']))
                {
                    $search_subjects_custom = '-07-';
                }
                elseif(in_array(strtolower($search_subjects), ['aug','augu','augus','august']))
                {
                    $search_subjects_custom = '-08-';
                }
                elseif(in_array(strtolower($search_subjects), ['sep','sept','septe','septem','septemb','septembe','september']))
                {
                    $search_subjects_custom = '-09-';
                }
                elseif(in_array(strtolower($search_subjects), ['oct','octo','octob','octobe','october']))
                {
                    $search_subjects_custom = '-10-';
                }
                elseif(in_array(strtolower($search_subjects), ['nov','nove','novem','novemb','novembe','november']))
                {
                    $search_subjects_custom = '-11-';
                }
                elseif(in_array(strtolower($search_subjects), ['dec','dece','decem','decemb','decembe','december']))
                {
                    $search_subjects_custom = '-12-';
                }
                else
                {
                    $search_subjects_custom = $search_subjects;
                }

                $q->where('subjects.Date_Added', 'like', '%' . $search_subjects . '%')
                ->orWhere('subjects.Date_Added', 'like', '%' . $search_subjects_custom . '%')
                ->orWhere('Subject_Name_Last_Updated_Date', 'like', '%' . $search_subjects . '%')
                ->orWhere('subjects.Subject_Name_Last_Updated_Date', 'like', '%' . $search_subjects_custom . '%')
                ->orWhere('subjects.Subject_Name', 'like', '%' . $search_subjects . '%')
                ->orWhere('faculties.Faculty_Name', 'like', '%' . $search_subjects . '%');
            });
        }

        $faculty_list = Faculty::where('Institute_Username',$admininfo->institute_username)->where('Status','1')->get();

        if ($request->ajax()) {
              // Count the number of matching records
              $matching_search_records_count = $query->count();
              //dd($matchingRecordsCount);
              $total_subject_list = $query->paginate($matching_search_records_count);
            return view('admin.subject_search_table', compact('admininfo','total_subject_list','faculty_list','perPage','page'))->render();
        }
        else{
            $total_subject_list = $query->paginate($perPage);
            return view('admin.subject', compact('admininfo','total_subject_list','faculty_list','perPage','page'));
        }

    }

    public function addSubjects(Request $request)
    {
        $admin_username = Auth::guard('admin')->user()->institute_username;
        // $per_page = request('per_page', 10); //10 is default value as provided in public function studentList function
        // $page = request('page', 1);//Default page is 1
        $faculty_id = $request->input('faculty_id');
        // $faculty = Faculty::find('faculty_id');
        $request->validate([
            'faculty_id' => [
                'required',
                function ($attribute, $value, $fail) use ($admin_username) {
                    $exists = Faculty::where('id', $value)
                                     ->where('Institute_Username', $admin_username)
                                     ->exists();
                    if (!$exists) {
                        $fail("Faculty does not exist.");
                    }
                },
            ],
            'subject_name' => [
                'required',
                'max:100',
                'regex:/^[a-zA-Z0-9-_ ]+$/',
                function ($attribute, $value, $fail) use ($faculty_id) {
                    $exists = Subject::where('Subject_Name', $value)
                                     ->where('Faculty_ID', $faculty_id)
                                     ->exists();
                    if ($exists) {
                        $fail("Subject already exist.");
                    }
                },
            ],
            'full_marks' =>['nullable','numeric','min:0.001','max:9999.999','regex:/^\d{1,4}(\.\d{1,3})?$/'],
            'exam_duration' =>['nullable','numeric','min:60','max:14400'],
            'pass_marks' =>['nullable','numeric','min:0.001','max:9999.998','lt:full_marks','regex:/^\d{1,4}(\.\d{1,3})?$/'],
        ], [
            'faculty_id.required' => 'Faculty name is required.',
            'subject_name.required' => 'Subject name is required.',
            'subject_name.unique' => 'This subject already exists.',
            'subject_name.max' => 'Subject name must not exceed 100 characters.',
            'subject_name.regex' => 'Subject name should only contain letters, numbers, space, dashes, and underscores.',
            'full_marks.numeric' => 'Full Marks must be a number.',
            'full_marks.min' => 'Invalid full marks',
            'full_marks.max' => 'Maximum value for full marks cannot be greater than 9999.999',
            'full_marks.regex' => 'Invalid pass marks',

            'exam_duration.numeric' => 'Exam duration must be a number.',
            'exam_duration.min' => 'Minimum value for exam duration must be 60 (i.e 1 minute)',
            'exam_duration.max' => 'Maximum value for exam duration cannot be greater 14400 (i.e 4 Hours)',

            'pass_marks.numeric' => 'Pass Marks must be a number.',
            'pass_marks.min' => 'Invalid pass marks',
            'pass_marks.max' => 'Maximum value for pass marks cannot be greater than 9999.998',
            'pass_marks.regex' => 'Invalid pass marks',
            'pass_marks.lt' => 'Pass Marks must be less than full marks.',
        ], [
            'faculty_id' => 'Faculty Name',
            'subject_name' => 'Subject Name',
            'full_marks' => 'Full Marks',
            // 'exam_duration' => 'Exam Duration',
            'pass_marks' => 'Pass Marks',
        ]);



        $total_subject_count = Subject::join('faculties', 'subjects.Faculty_ID', '=', 'faculties.id')->where('faculties.Institute_Username', $admin_username)->count();
        $subject_name = trim($request->input('subject_name'));

        $token = Str::random(10); // Generate a unique token

        // Check if the token already exists in Two table
        while (Faculty::where('Faculty_Name_Code', $token)->exists() || Subject::where('Subject_Name_Code', $token)->exists() || Result::where('Result_Name_Code', $token)->exists())
        {
            $token = Str::random(10); // Regenerate the token if it already exists
        }

        $subject_added = Subject::create([
            'Subject_Name' => $subject_name,
            'Faculty_ID' =>  $faculty_id,
            'Subject_Name_Code' => $token,
            'Full_Marks' => $request->input('full_marks'),
            'Pass_Marks' => $request->input('pass_marks'),
            // 'Exam_Duration' => $request->input('exam_duration'),
            'Date_Added' => now(),
        ]);

        if($subject_added)
        {
            if($total_subject_count > 0)
            {
               return response()->json(['msg' => 'Subject Added Successfully.','subject_count' => 'Greater than 0']);
               // return response()->json(['msg' => 'Subject Added Successfully.','subject_count' => 'Greater than 0','per_page' => $per_page, 'page' => $page]);
            }
            else
            {
                return response()->json(['msg' => 'Subject Added Successfully.','subject_count' => 'Equals to 0']);
                //return response()->json(['msg' => 'Subject Added Successfully.','subject_count' => 'Equals to 0','per_page' => $per_page, 'page' => $page]);
            }

        }
        else
        {
            return response()->json(['msg' => 'Something went wrong.']);
            // return response()->json(['msg' => 'Something went wrong.','per_page' => $per_page, 'page' => $page]);
        }
    }

    public function massManageSubjects(Request $request)
    {
        $ticked_subjects = $request->input('ticked_subjects_list');
        $per_page = request('per_page', 10); //10 is default value as provided in public function studentList function
        $page = request('page', 1);//Default page is 1
        $deleted_subject_name = [];
        $not_deleted_subject_name = [];

        foreach ($ticked_subjects as $subject_id => $isChecked)
        {
            // if ($isChecked)
            if ($isChecked === 'true')
            {
                $subject = Subject::find($subject_id);
                $subject_name = $subject->Subject_Name;
                if($subject->Status === '1')
                {
                    $is_subject_deleted = $subject->delete();
                    if($is_subject_deleted)
                    {
                        $deleted_subject_name[] = $subject_name; // Store the deleted ID
                    }
                    else
                    {
                        $not_deleted_subject_name[] = $subject_name; // Store the ID which is not deleted
                    }
                }
                else
                {
                    $not_deleted_subject_name[] = $subject_name; // Store the ID which is not deleted
                }
            }
        }
        return response()->json(['message' => 'successful','per_page' => $per_page, 'page' => $page,'deleted_subject_name' => $deleted_subject_name,'not_deleted_subject_name' => $not_deleted_subject_name]);
    }

    public function manageSubjectIndividualEdit($id, Request $request)
    {
        $faculty_id = $request->input('faculty_id');
        $request->validate([
            'new_subject_name' => [
                'required',
                'max:100',
                'regex:/^[a-zA-Z0-9-_ ]+$/',
                function ($attribute, $value, $fail) use ($faculty_id) {
                    $exists = Subject::where('Subject_Name', $value)
                                     ->where('Faculty_ID', $faculty_id)
                                     ->exists();
                    if ($exists) {
                        $fail("Subject already exist.");
                    }
                },
            ],
        ], [
            'new_subject_name.required' => 'Subject name is required.',
            'new_subject_name.unique' => 'This subject already exists.',
            'new_subject_name.max' => 'Subject name must not exceed 100 characters.',
            'new_subject_name.regex' => 'Subject name should only contain letters, numbers, space, dashes, and underscores.',
        ], [
            'new_subject_name' => 'Subject Name',
        ]);

        $per_page = request('per_page', 10); //10 is default value as provided in public function studentList function
        $page = request('page', 1); //Default page is 1

        $admin_username = Auth::guard('admin')->user()->institute_username;
        $subject = Subject::find($id);

        if($subject)
        {
            $subject->Subject_Name = $request->input('new_subject_name');
            $subject->Subject_Name_Last_Updated_Date = now();

            $old_subject_names = $subject->Old_Subject_Names; // Get the existing old subject names
            $new_subject_name = $request->input('old_subject_name'); // New Subject name to be added
            $currentDate = now()->toDateTimeString();
            if ($old_subject_names) {
                // If there are existing old subject names, concatenate the new text with a comma
                $old_subject_names .= "," . $currentDate . ":" .  $new_subject_name;
            } else {
                // If there are no existing  old faculty names, set the new text directly
                $old_subject_names = $currentDate . ":". $new_subject_name;
            }
            $subject->Old_Subject_Names = $old_subject_names;

            $is_subject_updated = $subject->save();
            if($is_subject_updated)
            {
                $total_subject_count = Subject::join('faculties', 'subjects.Faculty_ID', '=', 'faculties.id')->where('faculties.Institute_Username', $admin_username)->count();

                if($total_subject_count > 0)
                {
                    return response()->json(['message' => 'successful','subject_count' => 'Greater than 0','per_page' => $per_page,'page' => $page]);
                }
                else
                {
                    return response()->json(['message' => 'successful','subject_count' => 'Equals to 0','per_page' => $per_page,'page' => $page]);
                }
            }
            else
            {
                return response()->json(['message' => 'Something went wrong.','per_page' => $per_page, 'page' => $page]);
            }
        }
        else{
            return response()->json(['message' => 'subject_not_found','per_page' => $per_page,'page' => $page]);
        }
    }

    public function manageSubjectIndividual($id,Request $request)
    {
        $subject = Subject::find($id);
        $admin_username = Auth::guard('admin')->user()->institute_username;
        $per_page = request('per_page', 10); //10 is default value as provided in public function studentList function
        $page = request('page', 1); //Default page is 1

        if($subject)
        {
            $delete_subjects = DB::table('subjects')->where('id', $id)->delete();
            if($delete_subjects)
            {
                // $request->session()->put('msg', 'Successfully Deleted');
                $total_subject_count = Subject::join('faculties', 'subjects.Faculty_ID', '=', 'faculties.id')->where('faculties.Institute_Username', $admin_username)->count();
                if($total_subject_count > 0)
                {
                    return response()->json(['message' => 'successful','subject_count' => 'Greater than 0','per_page' => $per_page,'page' => $page]);
                }
                else
                {
                    return response()->json(['message' => 'successful','subject_count' => 'Equals to 0','per_page' => $per_page,'page' => $page]);
                }
            }
            else
            {
                // $request->session()->put('msg', 'Something went wrong.');
                // return redirect()->route('admin_manage_subjects', ['per_page' => $per_page, 'page' => $page]);
                return response()->json(['message' => 'Something went wrong.','per_page' => $per_page, 'page' => $page]);
            }
        }
        else
        {
            return response()->json(['message' => 'subject_not_found','per_page' => $per_page,'page' => $page]);
        }
    }
}
