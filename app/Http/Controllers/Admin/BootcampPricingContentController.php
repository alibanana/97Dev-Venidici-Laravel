<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Course;
use App\Models\BootcampFullPaymentFeature;
use App\Models\BootcampIncomeShareAgreementFeature;



class BootcampPricingContentController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function updateFullPayment(Request $request, $course_id){
        $validator = Validator::make($request->all(), [
            'full_payment_content' => 'required',
            'full_payment_features' => 'required|array|min:1',
        ]);

        if ($validator->fails())
            return redirect()->back()->with(['page-option' => 'pricing-content-page'])->withErrors($validator);

        $validated = $validator->validate();
        $course = Course::findOrFail($course_id);

        $courseDetail = $course->bootcampCourseDetail;
        $courseDetail->full_payment_description = $validated['full_payment_content'];
        $courseDetail->save();

        $course->bootcampFullPaymentFeatures()->delete();
        
        foreach ($request->full_payment_features as $full_payment_features_value) {
            if ($full_payment_features_value != "") {
                $new_requirement = new BootcampFullPaymentFeature;
                $new_requirement->course_id = $course->id;
                $new_requirement->feature = $full_payment_features_value;
                $new_requirement->save();
            }
        }

        $message = 'Content (' . $course->title . ') has been successfully edited.';

        return redirect()->route('admin.bootcamp.edit', $course_id)
            ->with('message', $message)
            ->with('page-option', 'pricing-content-page');

    }

    public function updateIncomeShareAgreement(Request $request, $course_id){
        $validator = Validator::make($request->all(), [
            'income_share_description' => 'required',
            'income_share_agreement_features' => 'required|array|min:1',
        ]);

        if ($validator->fails())
            return redirect()->back()->with(['page-option' => 'pricing-content-page'])->withErrors($validator);

        $validated = $validator->validate();
        $course = Course::findOrFail($course_id);

        $courseDetail = $course->bootcampCourseDetail;
        $courseDetail->income_share_description = $validated['income_share_description'];
        $courseDetail->save();

        $course->bootcampIncomeShareAgreementFeatures()->delete();
        
        foreach ($request->income_share_agreement_features as $value) {
            if ($value != "") {
                $new_requirement = new BootcampIncomeShareAgreementFeature;
                $new_requirement->course_id = $course->id;
                $new_requirement->feature = $value;
                $new_requirement->save();
            }
        }

        $message = 'Content (' . $course->title . ') has been successfully edited.';

        return redirect()->route('admin.bootcamp.edit', $course_id)
            ->with('message', $message)
            ->with('page-option', 'pricing-content-page');
    }
}
