<?php

namespace App\Http\Controllers;

use App\Models\Benefit;
use App\Models\Subscription;
use App\Models\Subscribers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Session;
use DB;

class SubscriptionController extends Controller
{
    //view subscription page
    // public function subcription()
    // {
    //     return view('subscription.view');
    // }
    public function subcription(): View
    {
        $subs = Subscription::paginate(10);
        return view('subscriptions.index', compact('subs'))->with('subs', $subs);
    }
    public function showSubs(string $id): View
    {
        $subs = Subscription::find($id);
        return view('subscriptions.show')->with('subs', $subs);
    }
    public function viewEditSubs(string $id): View
    {
        $sub = Subscription::find($id);
        $benefits =
            Benefit::where('subs_id', $sub->id)->paginate(10);

        return view('subscriptions.edit', compact('benefits'))->with('benefits', $benefits)->with('sub', $sub);
    }


    public function findSubBenefit(string $id)
    {
        $subBenefit = Benefit::find($id);
        return response()->json($subBenefit);
        //return with('subBenefit', $subBenefit);
    }

    public function editSubBenefit(Request $request)
    {
        // $data = new Benefit();
        // $data->subs_benefit = $request->input('benefit');
        // $data->subs_cons = $request->input('cons');
        // $data->save();
        $validatorBenefit = Validator::make($request->all(), [
            'benefit' => 'required'
        ]);

        if ($validatorBenefit->fails()) {
            //  return back()->with('editBenefitError', 'Input Benefit');
            return response()->json(['message' => 'Input Benefit']);

        }
        $benefits = Benefit::find($request['id']);
        $benefits->update([
            'subs_benefit' => $request['benefit'],
            //$data->subs_benefit,
            'subs_cons' => $request['cons'] //$data->subs_cons,

        ]);

        return response()->json(['message' => 'Benefit updated successfully']);

        //return back()->with('editBenefitSuccess', 'Benefit updated successfully');
    }
    public function editSubs(Request $request)
    {

        $validatorprice = Validator::make($request->all(), [
            'price' => 'required'
        ]);

        if ($validatorprice->fails()) {
            return back()->with('editSubError', 'Input Price');

        }

        $subs = Subscription::find($request['id']);
        $subs->update([
            'subs_user' => $request->users,
            'sub_type' => $request->type,
            'subs_plan' => $request->plan,
            'subs_price' => $request->price,

        ]);

        return back()->with('editSubSuccess', 'Subscription updated successfully');
    }
    public function deleteSubBenefits(string $id)
    {

        $benefits = Benefit::findorFail($id);
        $benefits->delete();

        return back()->with('deleteSuccess', 'Deleted Successfully');
    }
    public function addSubBenefits(Request $request, $id)
    {
        // $validatorbenefit = Validator::make(
        //     $request->all(),
        //     [
        //         'inputs.*.addbenefit' => 'required',
        //     ],
        // );
        // $validatorcons = Validator::make(
        //     $request->all(),
        //     [
        //         'inputs.*.addcons' => 'required',
        //     ],
        // );
        //if ($validatorbenefit->fails()) {
        // Session::put('addBenefitError', 'Input Benefit!');
        //    Session::flash('addBenefiterror', 'Input Benefit!');

        // session()->flash('addBenefiterror', );
        // return back();

        //  return back()->with('addBenefitError', 'this1');
        //  return back()->response()->json(['addBenefitError' => 'this1']);
        //     $message = 'Your message here';
        //     return compact('message');

        // } else if ($validatorcons->fails()) {
        //     //  Session::put('addBenefitError', 'Select cons option!');
        //     // session()->flash('addBenefiterror', 'Select cons option!');
        //     // Session::flash('addBenefiterror', 'Select cons option!');
        //     // return back();
        //     return back()->with('addBenefitError', 'this2');
        //     // return back()->response()->json(['addBenefitError' => 'this2']);

        // } else {

        // $request->validate(
        //     [
        //         'inputs.*.addbenefit' => 'required',
        //         'inputs.*.addcons' => 'required',
        //     ],
        //     [
        //         'inputs.*.addbenefit' => 'Input Benefit!',
        //         'inputs.*.addcons' => 'Select cons option!',
        //     ]
        // );
        foreach ($request->inputs as $data) {

            $model = new Benefit();
            $model->subs_benefit = $data['addbenefit'];
            $model->subs_cons = $data['addcons'];
            $model->subs_id = $id;

            $model->save();

        }

        return back()->with('addBenefitSuccess', 'Subscription benefits updated successfully');



        // $request->validate(
        //     [
        //         'inputs.*.addbenefit' => 'required',
        //         'inputs.*.addcons' => 'required',
        //     ],
        //     [
        //         'inputs.*.addbenefit' => 'Input Benefit!',
        //         'inputs.*.addcons' => 'Select cons option!',
        //     ]
        // );

        // if ($request['inputs.*.addbenefit'] == null && $request['inputs.*.addcons'] == null) {
        //     return back()->with('addBenefitError', 'Input required fields!');

        // } else if ($request['inputs.*.addbenefit'] == null) {
        //     return back()->with('addBenefitError', 'Input Benefit!');

        // } else if ($request['inputs.*.addcons'] == null) {
        //     return back()->with('addBenefitError', 'Select cons option!');

        // }


    }
    // public function addSubBenefits(Request $request, $id)
    // {
    //     //  $benefitinputs = $request->addbenefit('addbenefit');
    //     // $validate = Validator::make($request->all(), ([
    //     //     'inputs.*.addbenefit' => 'required',
    //     //     'inputs.*.addcons' => 'required',
    //     // ]));
    //     // $validatorprice = Validator::make($request->all(), [
    //     //     'addbenefit' => 'required',
    //     //     'addcons' => 'required'
    //     // ]);


    //     $request->validate(
    //         [
    //             'inputs.*.addbenefit' => 'required',
    //             'inputs.*.addcons' => 'required',
    //         ],
    //         [
    //             'inputs.*.addbenefit' => 'Input Benefit!',
    //             'inputs.*.addcons' => 'Select cons option!',
    //         ]
    //     );

    //     // foreach ($request->inputs as $key => $value) {

    //     //     Benefit::create($value);

    //     // }
    //     $i = 0;
    //     foreach ($request->inputs as $data) {

    //         $model = new Benefit();
    //         $model->subs_benefit = $data['addbenefit'];
    //         $model->subs_cons = $data['addcons'];
    //         $model->subs_id = $id;
    //         // ... and so on for other columns

    //         $model->save();
    //         $i++;
    //     }
    //     // $inputs = $request->input('addbenefit');
    //     // $benefits = [];
    //     // foreach ($inputs as $data) {
    //     //     Benefit::create([
    //     //         $data
    //     //     ]);
    //     // }

    //     // $inputs = $request->all();

    //     // //  $benefits = Benefit::where('subs_id', ($request['id']))->first();
    //     // foreach ($inputs as $key => $value) {

    //     //     Benefit::create([
    //     //         'subs_benefit' => $inputs[$key],
    //     //         'subs_cons' => $inputs[$key],
    //     //         'subs_id' => $id,
    //     //     ]);

    //     // }


    //     return back()->with('addBenefitSuccess', 'Subscription benefits updated successfully');

    // }
    /////////MOBILE///////////

    /////////NEW SUBS///////////
    public function getSubss(Request $request)
    {
        $usertype = $request->usertype;
        $getsubs = Subscription::where('subs_user', $usertype)->get();


        return Response([
            'subs' => $getsubs,

        ], 200);

    }

    public function getBenefitss(Request $request)
    {
        $usertype = $request->usertype;
        $subid = $request->subid;

        $getbenefits = Benefit::where('subs_cons', '0')->where('subs_id', $subid)->get();

        return Response([
            'benefits' => $getbenefits,

        ], 200);

    }


    public function getConss(Request $request)
    {
        $usertype = $request->usertype;
        $subid = $request->subid;


        $getcons = Benefit::where('subs_cons', '1')->where('subs_id', $subid)->get();

        return Response([
            'cons' => $getcons,

        ], 200);

    }










    ///////END NEW SUBS//////////////
    public function getSubs(Request $request)
    {
        $usertype = $request->usertype;
        $getsubsbasic = Subscription::where('subs_user', $usertype)->where('sub_type', 'Basic')->get();
        $getsubsmonthly = Subscription::where('subs_user', $usertype)->where('subs_plan', 'Monthly')->get();
        $getsubsannual = Subscription::where('subs_user', $usertype)->where('subs_plan', 'Annually')->get();


        return Response([
            'basic' => $getsubsbasic,
            'monthly' => $getsubsmonthly,
            'annual' => $getsubsannual,

        ], 200);

    }
    public function getBenefits(Request $request)
    {
        $usertype = $request->usertype;
        if ($usertype == 'pet_owner') {
            //basic
            $getsubsbasic = Subscription::where('subs_user', $usertype)->where('sub_type', 'Basic')->pluck('id');
            $getbenefitbasic = Benefit::where('subs_cons', '0')->where('subs_id', $getsubsbasic)->get();
            //monthly
            $getsubsmonthly = Subscription::where('subs_user', $usertype)->where('subs_plan', 'Monthly')->pluck('id');
            $getbenefitmonthly = Benefit::where('subs_cons', '0')->where('subs_id', $getsubsmonthly)->get();
            //dual
            $getsubsdual = Subscription::where('subs_user', $usertype)->where('subs_plan', 'Annually')->pluck('id');
            $getbenefitdual = Benefit::where('subs_cons', '0')->where('subs_id', $getsubsdual)->get();

            return Response([
                'basicbenefits' => $getbenefitbasic,
                'monthlybenefits' => $getbenefitmonthly,
                'annualbenefits' => $getbenefitdual,

            ], 200);
        } else {
            //monthly
            $getsubsmonthly = Subscription::where('subs_user', $usertype)->where('subs_plan', 'Monthly')->pluck('id');
            $getbenefitmonthly = Benefit::where('subs_cons', '0')->where('subs_id', $getsubsmonthly)->get();
            //dual
            $getsubsdual = Subscription::where('subs_user', $usertype)->where('subs_plan', 'Annually')->pluck('id');
            $getbenefitdual = Benefit::where('subs_cons', '0')->where('subs_id', $getsubsdual)->get();

            return Response([
                'monthlybenefits' => $getbenefitmonthly,
                'annualbenefits' => $getbenefitdual,

            ], 200);
        }
    }


    public function getCons(Request $request)
    {
        $usertype = $request->usertype;
        if ($usertype == 'pet_owner') {
            //basic
            $getsubsbasic = Subscription::where('subs_user', $usertype)->where('sub_type', 'Basic')->pluck('id');
            $getbenefitbasic = Benefit::where('subs_cons', '1')->where('subs_id', $getsubsbasic)->get();
            //monthly
            $getsubsmonthly = Subscription::where('subs_user', $usertype)->where('subs_plan', 'Monthly')->pluck('id');
            $getbenefitmonthly = Benefit::where('subs_cons', '1')->where('subs_id', $getsubsmonthly)->get();
            //dual
            $getsubsdual = Subscription::where('subs_user', $usertype)->where('subs_plan', 'Annually')->pluck('id');
            $getbenefitdual = Benefit::where('subs_cons', '1')->where('subs_id', $getsubsdual)->get();

            return Response([
                'basiccons' => $getbenefitbasic,
                'monthlycons' => $getbenefitmonthly,
                'annualcons' => $getbenefitdual,

            ], 200);
        } else {
            //monthly
            $getsubsmonthly = Subscription::where('subs_user', $usertype)->where('subs_plan', 'Monthly')->pluck('id');
            $getbenefitmonthly = Benefit::where('subs_cons', '1')->where('subs_id', $getsubsmonthly)->get();
            //dual
            $getsubsdual = Subscription::where('subs_user', $usertype)->where('subs_plan', 'Annually')->pluck('id');
            $getbenefitdual = Benefit::where('subs_cons', '1')->where('subs_id', $getsubsdual)->get();

            return Response([
                'monthlycons' => $getbenefitmonthly,
                'annualcons' => $getbenefitdual,

            ], 200);
        }


    }


    //get subscribers type
    public function getsubstype()
    {
        //basic
        $getsubstype = Subscribers::where('user_id', auth()->user()->userID)->with('subscription')->get();

        return Response([
            'subscriber' => $getsubstype,
        ], 200);

    }

    // public function getAllBenefits(Request $request)
    // {

    //     $getbenefit1 = Benefit::where('subs_id', 1)->where('subs_cons', 0)->get();
    //     $getcon1 = Benefit::where('subs_id', 1)->where('subs_cons', 1)->get();

    //     $getbenefit2 = Benefit::where('subs_id', 2)->where('subs_cons', 0)->get();
    //     $getcon2 = Benefit::where('subs_id', 2)->where('subs_cons', 1)->get();


    //     $getbenefit3 = Benefit::where('subs_id', 3)->where('subs_cons', 0)->get();
    //     $getcon3 = Benefit::where('subs_id', 3)->where('subs_cons', 1)->get();


    //     $getbenefit4 = Benefit::where('subs_id', 4)->where('subs_cons', 0)->get();
    //     $getcon4 = Benefit::where('subs_id', 4)->where('subs_cons', 1)->get();

    //     $getbenefit5 = Benefit::where('subs_id', 5)->where('subs_cons', 0)->get();
    //     $getcon5 = Benefit::where('subs_id', 5)->where('subs_cons', 1)->get();
    //     $getbenefit6 = Benefit::where('subs_id', 6)->where('subs_cons', 0)->get();
    //     $getcon6 = Benefit::where('subs_id', 6)->where('subs_cons', 1)->get();
    //     $getbenefit7 = Benefit::where('subs_id', 7)->where('subs_cons', 0)->get();
    //     $getcon7 = Benefit::where('subs_id', 7)->where('subs_cons', 1)->get();

    //     return Response([
    //         'benefit1' => $getbenefit1,
    //         'con1' => $getcon1,
    //         'benefit2' => $getbenefit2,
    //         'con2' => $getcon2,
    //         'benefit3' => $getbenefit3,
    //         'con3' => $getcon3,
    //         'benefit4' => $getbenefit4,
    //         'con4' => $getcon4,
    //         'benefit5' => $getbenefit5,
    //         'con5' => $getcon5,
    //         'benefit6' => $getbenefit6,
    //         'con6' => $getcon6,
    //         'benefit7' => $getbenefit7,
    //         'con7' => $getcon7,
    //     ], 200);
    // }

}
