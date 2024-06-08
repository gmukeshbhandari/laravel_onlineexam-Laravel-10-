<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Province;
use App\Models\District;
use App\Models\Village;
use App\Models\Ward;
use App\Models\ElectionCenter;


class CountryInfoController extends Controller
{
    // public function getProvinces(Request $request)
    // {
    //     $countryId = Country::where('Country', $request->input('country'))->value('id');
    //     $provinces = Province::find($countryId)->Province;
    //     return response()->json($provinces);
    // }

    public function getDistricts(Request $request)
    {
        $provinceId = Province::where('Province', $request->input('province'))->value('id');
        $districts = Province::find($provinceId)->districts;
        return response()->json($districts);
         /*
            In the code snippet $districts = Province::find($provinceId)->districts;, the Province::find($provinceId) part retrieves a Province model instance from the database based on the provided $provinceId. Then, the ->districts part accesses the relationship between the Province and District models.

            In Laravel's Eloquent ORM, relationships are defined between models to represent the associations between database tables. In this case, it seems that the Province model has a one-to-many relationship with the District model. This relationship is likely defined in the Province model.

            The hasMany method indicates that a province can have multiple districts. Therefore, when you call $province->districts, it retrieves all the districts associated with that particular province.

            So, $districts = Province::find($provinceId)->districts; retrieves all the districts belonging to the province with the specified $provinceId. The result is assigned to the $districts variable, and you can use this data, typically in the context of populating a dropdown menu or performing some other action in your Laravel application.
        */
    }

    public function getVillages(Request $request)
    {
        $districtId = District::where('District', $request->input('district'))->value('id');
        $villages = District::find($districtId)->villages;
        return response()->json($villages);
    }

    public function getWards(Request $request)
    {
        $VillageId = Village::where('Village', $request->input('village'))->value('id');
        $wards = Village::find($VillageId)->wards;
        return response()->json($wards);
    }

    // public function getElectionCenter(Request $request)
    // {
    //     $wardId = Ward::where('Ward', $request->input('ward_no'))->value('id');
    //     $election_centers = Ward::find($wardId)->electioncenters;
    //     return response()->json($election_centers);
    // }
}
