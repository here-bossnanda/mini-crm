<?php

namespace App\Http\Controllers;

use App\Companies;
use App\Http\Requests\CompaniesRequest;

use Illuminate\Support\Facades\DB;
use DataTables;
use Webpatser\Uuid\Uuid;
use File;
use App\Jobs\SendCompanyMailJob;
use App\Mail\CompanyMail;
use Illuminate\Support\Facades\Mail;

class CompaniesController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }
  
  public function listdata(){
    $datas = Companies::orderBy('created_at','desc')->get();
    $data = array();
    $no =0;
    foreach ($datas as $list) {
      $no++;
      $row = array();
      $row[]= $no;
      $row[]= ($list->logo) ? '<img src="storage/assets/images/perusahaan/'.$list->logo.'" alt="" class="rounded-circle header-profile-user" alt="Header Avatar">'. $list->name : '<img src="storage/assets/images/users/default.png" alt="" class="rounded-circle header-profile-user" alt="Header Avatar">'. $list->name;
      $row[]= ($list->email) ? $list->email : "-";
      $row[]= ($list->website) ? $list->website : "-";
      $row[]= 
      '<div class="btn-group">
      <button onclick="viewForm('.$list->id.')" class=" btn btn-primary">
      <span class="far fa-eye"></span></button>
      <button onclick="editForm('.$list->id.')" class=" btn btn-warning">
      <span class="fas fa-pencil-alt"></span></button>
      <button onclick="deleteData('.$list->id.')" class=" btn btn-danger">
      <span class="far fa-trash-alt"></span></button></div>';
      $data[]=$row;
    }
    return DataTables::of($data)->escapeColumns([])->make(true);
  }
  
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    return view('page.company.index');
  }
  
  
  /**
  * Store a newly created resource in storage.
  *
  * @param  \App\Http\Requests\CompaniesRequest  $request
  * @return \Illuminate\Http\Response
  */
  public function store(CompaniesRequest $request)
  {     
    DB::beginTransaction();
    try {
      $data = $request->all();
      $filename = NULL;
      if ($request->hasFile('logo')) {
        $file = $request->file('logo');
        $filename = Uuid::generate()->string . '-' . time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('assets/images/perusahaan', $filename,"public");
      }
      
      $data['logo'] = $filename;
      // dd($data);
      $companies = Companies::create($data);
      
      // send new email to registered company use jobs
      // SendCompanyMailJob::dispatch($companies)
      //           ->delay(now()->addSeconds(5));

      // send new mail to registered company use mail
      Mail::send(new CompanyMail($companies));

      DB::commit();
      return response()->json(['status' => 'success'], 200);
    } catch (\Exception $e) {
      DB::rollback();
      return response()->json(['status' => 'error', 'data' => $e->getMessage()], 403);
    }
  }
  
  
  public function show($id){
    $company = Companies::findOrFail($id);
    return response()->json(['status' => 'success', 'company' => $company], 200);  
  }
  
  /**
  * Show the form for editing the specified resource.
  *
  * @param  \App\Companies  $companies
  * @return \Illuminate\Http\Response
  */
  public function edit($id)
  {
    $company = Companies::findOrFail($id);
    return response()->json(['status' => 'success', 'company' => $company], 200); 
  }
  
  /**
  * Update the specified resource in storage.
  *
  * @param  \App\Http\Requests\CompaniesRequest  $request
  * @param  \App\Companies  $companies
  * @return \Illuminate\Http\Response
  */
  public function update(CompaniesRequest $request, $id)
  {
    DB::beginTransaction();
    try {
      
      $data = $request->all();
      
      $companies = Companies::findOrFail($id); 
      
      if(!$companies){
        return response()->json([
        'status' => 'error',
        'message' => 'company not found'
        ], 404);
      }
      
      $filename = $companies->logo; 
      
      if ($request->hasFile('logo')) {
        $file = $request->file('logo');
        File::delete(public_path('storage/assets/images/perusahaan/' . $filename));
        $filename = Uuid::generate()->string . '-' . time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('assets/images/perusahaan', $filename,"public");
      }
      $data['logo'] = $filename;
      $companies->update($data);
      DB::commit();
      return response()->json(['status' => 'success'], 200);
    } catch (\Exception $e) {
      DB::rollback();
      return response()->json(['status' => 'error', 'data' => $e->getMessage()], 403);
    }
  }
  
  /**
  * Remove the specified resource from storage.
  *
  * @param  \App\Companies  $companies
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    $companies = Companies::find($id); 
    File::delete(public_path('storage/assets/images/perusahaan/' . $companies->logo)); 
    $companies->delete(); 
    return response()->json(['status' => 'success'], 200);
  }
}
