<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Models\Admin;
use App\Models\Faculty;
use App\Models\Subject;
use App\Models\Question;
use App\Models\Result;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class FacultyController extends Controller
{
    public function manageFaculties(Request $request)
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

        // Query to fetch faculty list with pagination
        // $query = Faculty::where('Institute_Username',$admininfo->institute_username)->where('Status', '1')->orderBy('Faculty_Name', 'desc');
         $query = Faculty::where('Institute_Username',$admininfo->institute_username)->orderBy('created_at', 'desc');
        $faculty_list = $query->paginate($perPage, ['*'], 'page', $page);

        // Check if the provided page is not in the range of available pages
        if ($page > $faculty_list->lastPage()) {
            $page = 1; // Set page to 1 if the provided value is invalid
            $faculty_list = $query->paginate($perPage, ['*'], 'page', $page); // Re-fetch with default page
            return Redirect::to(request()->url() . '?per_page=' . $perPage . '&page=' . $page);
        }

        $faculty_list = $query->paginate($perPage);
        return view('admin.faculty', compact('admininfo','faculty_list','perPage','page'));
    }

    public function addFaculties(Request $request)
    {
        // $per_page = request('per_page', 10); //10 is default value as provided in public function studentList function
        // $page = request('page', 1);//Default page is 1
        $request->validate([
            'faculty_name' => [
                'required',
                'max:100',
                'regex:/^[a-zA-Z0-9-_ ]+$/',
                Rule::unique('faculties', 'Faculty_Name')->where(function ($query) {
                    return $query->where('Institute_Username', Auth::guard('admin')->user()->institute_username);
                }),
            ],
        ], [
            'faculty_name.required' => 'Faculty name is required.',
            'faculty_name.unique' => 'This faculty already exists.',
            'faculty_name.max' => 'Faculty name must not exceed 100 characters.',
            'faculty_name.regex' => 'Faculty name should only contain letters, numbers, space, dashes, and underscores.',
        ], [
            'faculty_name' => 'Faculty Name',
        ]);


        $facultyCount = Faculty::where('Institute_Username', Auth::guard('admin')->user()->institute_username)->count();

        $faculty_name = trim($request->input('faculty_name'));

        $token = Str::random(10); // Generate a unique token

        // Check if the token already exists in Two table
        while (Faculty::where('Faculty_Name_Code', $token)->exists() || Subject::where('Subject_Name_Code', $token)->exists() || Result::where('Result_Name_Code', $token)->exists())
        {
            $token = Str::random(10); // Regenerate the token if it already exists
        }

        $faculty_added = Faculty::create([
            'Faculty_Name' => $faculty_name,
            'Institute_Username' => Auth::guard('admin')->user()->institute_username,
            'Faculty_Name_Code' => $token,
            'Date_Added' => now(),
        ]);

        if($faculty_added)
        {
            if($facultyCount > 0)
            {
                return response()->json(['msg' => 'Faculty Added Successfully.','subject_count' => 'Greater than 0']);
                 //return response()->json(['msg' => 'Faculty Added Successfully.','subject_count' => 'Greater than 0','per_page' => $per_page, 'page' => $page]);
            }
            else
            {
                return response()->json(['msg' => 'Faculty Added Successfully.','subject_count' => 'Equals to 0']);
                // return response()->json(['msg' => 'Faculty Added Successfully.','subject_count' => 'Equals to 0','per_page' => $per_page, 'page' => $page]);
            }

        }
        else
        {
             return response()->json(['msg' => 'Something went wrong.']);
            // return response()->json(['msg' => 'Something went wrong.','per_page' => $per_page, 'page' => $page]);
        }
    }

    public function massManageFaculties(Request $request)
    {
        $ticked_faculties = $request->input('ticked_faculties_list');
        $per_page = request('per_page', 10); //10 is default value as provided in public function studentList function
        $page = request('page', 1);//Default page is 1
        $deleted_faculty_name = [];
        $not_deleted_faculty_name = [];

        foreach ($ticked_faculties as $faculty_id => $isChecked)
        {
            // if ($isChecked)
            if ($isChecked === 'true')
            {
                $faculty = Faculty::find($faculty_id);
                $faculty_name = $faculty->Faculty_Name;
                if($faculty->Status === '1')
                {
                    $is_faculty_deleted = $faculty->delete();
                    if($is_faculty_deleted)
                    {
                        $deleted_faculty_name[] = $faculty_name; // Store the deleted ID
                    }
                    else
                    {
                        $not_deleted_faculty_name[] = $faculty_name; // Store the ID which is not deleted
                    }
                }
                else
                {
                    $not_deleted_faculty_name[] = $faculty_name; // Store the ID which is not deleted
                }
            }
        }
        return response()->json(['message' => 'successful','per_page' => $per_page, 'page' => $page,'deleted_faculty_name' => $deleted_faculty_name,'not_deleted_faculty_name' => $not_deleted_faculty_name]);
    }

    public function manageFacultyIndividual($id,Request $request)
    {
        $faculties = DB::table('faculties')->find($id);
        $per_page = request('per_page', 10); //10 is default value as provided in public function studentList function
        $page = request('page', 1); //Default page is 1

        if($faculties)
        {
            $delete_faculties = DB::table('faculties')->where('id', $id)->delete();
            if($delete_faculties)
            {
                // $request->session()->put('msg', 'Successfully Deleted');
                $facultyCount = Faculty::where('Institute_Username', Auth::guard('admin')->user()->institute_username)->count();

                if($facultyCount > 0)
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
                // return redirect()->route('admin_manage_faculties', ['per_page' => $per_page, 'page' => $page]);
                return response()->json(['message' => 'Something went wrong.','per_page' => $per_page, 'page' => $page]);
            }
        }
        else{
            return response()->json(['message' => 'faculty_not_found','per_page' => $per_page,'page' => $page]);
        }
    }

    public function manageFacultyIndividualEdit($id, Request $request)
    {
        $request->validate([
            'new_faculty_name' => [
                'required',
                'max:100',
                'regex:/^[a-zA-Z0-9-_ ]+$/',
                Rule::unique('faculties', 'Faculty_Name')->where(function ($query) {
                    return $query->where('Institute_Username', Auth::guard('admin')->user()->institute_username);
                }),
            ],
        ], [
            'new_faculty_name.required' => 'The faculty name is required.',
            'new_faculty_name.unique' => 'This faculty name already exists.',
            'new_faculty_name.max' => 'The faculty name must not exceed 100 characters.',
            'new_faculty_name.regex' => 'The faculty name should only contain letters, numbers, space, dashes, and underscores.',
        ], [
            'new_faculty_name' => 'Faculty Name',
        ]);

        $per_page = request('per_page', 10); //10 is default value as provided in public function studentList function
        $page = request('page', 1); //Default page is 1
        $faculty = Faculty::find($id);

        if($faculty)
        {
            $faculty->Faculty_Name = $request->input('new_faculty_name');
            $faculty->Faculty_Name_Last_Updated_Date = now();

            $old_faculty_names = $faculty->Old_Faculty_Names; /// Get the existing old faculty names
            $new_faculty_name = $request->input('old_faculty_name'); // Old faculty name to be added
            $currentDate = now()->toDateTimeString();
            if ($old_faculty_names) {
                // If there are existing old faculty names, concatenate the new text with a comma
                $old_faculty_names .= "," . $currentDate . ":" .  $new_faculty_name;
            } else {
                // If there are no existing  old faculty names, set the new text directly
                $old_faculty_names = $currentDate . ":". $new_faculty_name;
            }
            $faculty->Old_Faculty_Names = $old_faculty_names;

            $is_faculty_updated = $faculty->save();
            if($is_faculty_updated)
            {

                $facultyCount = Faculty::where('Institute_Username', Auth::guard('admin')->user()->institute_username)->count();

                if($facultyCount > 0)
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
            return response()->json(['message' => 'faculty_not_found','per_page' => $per_page,'page' => $page]);
        }
    }
}
