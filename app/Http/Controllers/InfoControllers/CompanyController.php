<?php

namespace App\Http\Controllers\InfoControllers;

use App\Models\InfoModel\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompanyController extends Controller
{
    protected $path;

    public function __construct()
    {
        $this->path = "admin.pages.company";
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::with("user")->where("is_delete", 0)->orderby('id', 'desc')->paginate(15);
        return view($this->path.".show-company",compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->path.".create-company");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'active' => 'numeric|nullable|max:1',
            'name' => 'required|string|max:155|unique:companies',
            'companyLocation' => 'required|string|max:99',
            'companyAddress' => 'nullable|string|max:200',
            'description' => 'nullable|string|max:400',
        ]);

        $company = new Company();
        $company->active = $request->active ?? 0;
        $company->name = $request->name;
        $company->location = $request->companyLocation;
        $company->address = $request->companyAddress;
        $company->description = $request->description;
        $company->user_id = auth()->user()->id;
        $company->save();

        return back()->with("success", "Company Register successfully");
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
        $company = Company::find($id);
        return view($this->path.".edit-company",compact('company'));
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
        $this->validate($request, [
            'active' => 'numeric|nullable|max:1',
            'name' => 'required|string|max:155|unique:companies,name,' . $id,
            'companyLocation' => 'required|string|max:99',
            'companyAddress' => 'nullable|string|max:200',
            'description' => 'nullable|string|max:400',
        ]);

        $company = Company::find($id);
        $company->active = $request->active ?? 0;
        $company->name = $request->name;
        $company->location = $request->companyLocation;
        $company->address = $request->companyAddress;
        $company->description = $request->description;
        $company->user_id = auth()->user()->id;
        $company->save();

        return back()->with("success", "Company Updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::find($id);
        $company->is_delete = 1;
        $company->save();
        return back()->with("success", "Company Deleted Successfully");
    }
}
