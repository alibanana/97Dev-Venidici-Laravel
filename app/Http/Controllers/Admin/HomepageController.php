<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\Helper;

use Axiom\Rules\Decimal;

use App\Models\Config;
use App\Models\TrustedCompany;
use App\Models\FakeTestimony;

/*
|--------------------------------------------------------------------------
| Admin HomepageController Class.
|
| Description:
| This controller is responsible in handling the admin's CMS homepage page
| and functions. This include; showing the admin cms-homepage, updating the
| [top section, trusted company section & testimony section].
|--------------------------------------------------------------------------
*/ 
class HomepageController extends Controller
{
    // Shows the Admin CMS Homepage Page.
    public function index() {
        $config_keyword = 'cms.homepage';
        $configs = Config::select('key', 'value')->where([['key', 'like', "%".$config_keyword."%"]])->get()->keyBy('key');
        
        $trusted_companies = TrustedCompany::all();

        $fake_testimonies = FakeTestimony::orderByRaw('CHAR_LENGTH(content) DESC')->get();
        $fake_testimonies_big = $fake_testimonies->whereNotNull('thumbnail')->whereNotNull('name')->whereNotNull('occupancy')->values();
        $fake_testimonies_small = $fake_testimonies->whereNull('thumbnail')->whereNull('name')->whereNull('occupancy')->values();

        return view('admin/cms/homepage', compact('configs', 'trusted_companies', 'fake_testimonies_big',  'fake_testimonies_small'));
    }

    // Update Top Section in the database.
    public function updateTopSection(Request $request) {
        $validated = $request->validate([
            'heading' => 'required',
            'sub-heading' => 'required',
            'image' => 'mimes:jpeg,jpg,png'
        ]);

        $config_heading = Config::where('key', 'cms.homepage.top-section.heading')->firstOrFail();
        $config_heading->value = $validated['heading'];
        $config_heading->save();

        $config_sub_heading = Config::where('key', 'cms.homepage.top-section.sub-heading')->firstOrFail();
        $config_sub_heading->value = $validated['sub-heading'];
        $config_sub_heading->save();

        if ($request->has('image')) {
            $filepath = Helper::storeImage($request->file('image'), 'storage/images/configs/');
            $config_background = Config::where('key', 'cms.homepage.top-section.background')->firstorfail();
            unlink($config_background->value);
            $config_background->value = $filepath;
            $config_background->save();
        }

        return redirect()->route('admin.cms.homepage.index')->with('message', 'Top Section has been updated!');
    }

    // Update Trusted Company in the database.
    public function updateTrustedCompany(Request $request) {
        $validated = $request->validate([
            'trusted-company-count' => 'required',
            'images' => 'array',
            'images.*' => 'mimes:jpeg,jpg,png'
        ]);

        $config_trusted_company_count = Config::where('key', 'cms.homepage.trusted-company-section.trusted-company-count')->firstOrFail();
        $config_trusted_company_count->value = $validated['trusted-company-count'];
        $config_trusted_company_count->save();

        if ($request->has('images')) {
            foreach ($request->file('images') as $company_id => $image) {
                $filepath = Helper::storeImage($image, 'storage/images/trusted-companies/');
                $company = TrustedCompany::findOrFail($company_id);
                unlink($company->image);
                $company->image = $filepath;
                $company->save();
            }
        }

        return redirect()->route('admin.cms.homepage.index')->with('message', 'Trusted Company Section has been updated!');
    }

    // Show page to update Fake Testimonies.
    public function editTestimonies($id, $flag) {
        $testimony = FakeTestimony::findOrFail($id);

        return view('admin/testimony/update', compact('testimony', 'flag'));
    }

    // Update Fake Testimonies in the database.
    public function updateTestimonies(Request $request, $id) {
        if ($request->flag == 'true') {
            $validated = $request->validate([
                'thumbnail' => 'mimes:jpeg,jpg,png',
                'testimony' => 'required',
                'rating' => ['required', 'numeric', 'between:0,5', new Decimal(1, 1)],
                'name' => 'required|alpha_spaces',
                'occupancy' => 'required'
            ]);
        } else if ($request->flag == 'false') {
            $validated = $request->validate([
                'testimony' => 'required',
                'rating' => ['required', 'numeric', 'between:0,5', new Decimal(1, 1)]
            ]);
        }

        $testimony = FakeTestimony::findOrFail($id);

        if ($request->flag == 'true') {
            if ($request->has('thumbnail')) {
                $filepath = Helper::storeImage($request->file('thumbnail'), 'storage/images/testimonies/');
                unlink($testimony->thumbnail);
                $testimony->thumbnail = $filepath;
            }
            $testimony->name = $validated['name'];
            $testimony->occupancy = $validated['occupancy'];
        }

        $testimony->content = $validated['testimony'];
        $testimony->rating = $validated['rating'];
        $testimony->save();
        
        return redirect()->route('admin.cms.homepage.index')->with('message', 'Testimony Section has been updated!');
    }

}
