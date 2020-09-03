<?php

namespace App\Http\Controllers;

use App\Employees;
use App\Companies;
use App\Http\Requests\EmployeeRequest;
use Illuminate\Http\Request;


use DB;
use DataTables;

class EmployeesController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }
  
  public function listdata(){
    $datas = Employees::with('company')->orderBy('created_at','desc')->get();
    $data = array();
    $no =0;
    foreach ($datas as $list) {
      $no++;
      $row = array();
      $row[]= $no;
      $row[]= $list->first_name ;
      $row[]= $list->last_name;
      $row[]= ($list->email) ? $list->email : "-";
      $row[]= ($list->phone) ? $list->phone : "-";
      $row[]= $list->company->name;
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
    return view('page.employee.index');
  }
  
  /**
  * Store a newly created resource in storage.
  *
  * @param  \App\Http\Requests\EmployeeRequest  $request
  * @return \Illuminate\Http\Response
  */
  public function store(EmployeeRequest $request)
  { 
    DB::beginTransaction();
    try {
      $data = $request->all();
      Employees::create($data);
      DB::commit();
      return response()->json(['status' => 'success'], 200);
    } catch (\Exception $e) {
      DB::rollback();
      return response()->json(['status' => 'error', 'data' => $e->getMessage()], 400);
    }
  }
  
  /**
  * Display the specified resource.
  *
  * @param  \App\Employees  $employees
  * @return \Illuminate\Http\Response
  */
  public function show($id)
  {
    $employee = Employees::with('company')->findOrFail($id);
    return response()->json(['status' => 'success', 'employee' => $employee], 200);  
  }
  
  /**
  * Show the form for editing the specified resource.
  *
  * @param  \App\Employees  $employees
  * @return \Illuminate\Http\Response
  */
  public function edit($id)
  {
    $employee = Employees::with('company')->findOrFail($id);
    return response()->json(['status' => 'success', 'employee' => $employee], 200);  
  }
  
  /**
  * Update the specified resource in storage.
  *
  * @param  \App\Http\Requests\EmployeeRequest  $request
  * @param  \App\Employees  $employees
  * @return \Illuminate\Http\Response
  */
  public function update(EmployeeRequest $request, $id)
  {   
    DB::beginTransaction();
    try {
      
      $employees = Employees::findOrFail($id); 

      $data = $request->all();
      
      if(!$employees){
        return response()->json([
        'status' => 'error',
        'message' => 'employees not found'
        ], 404);
      }
      
      $companyId = $request->company_id;
      if($companyId){
        $company = Companies::find($companyId);
        if(!$company){
          return response()->json([
          'status' => 'error',
          'message' => 'company not found'
          ],404);
        }
      }
      
      $employees->update($data);
      DB::commit();
      return response()->json(['status' => 'success'], 200);
    } catch (\Exception $e) {
      DB::rollback();
      return response()->json(['status' => 'error', 'data' => $e->getMessage()], 400);
    }
  }
  
  /**
  * Remove the specified resource from storage.
  *
  * @param  \App\Employees  $employees
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    $employees = Employees::find($id); 
    $employees->delete(); 
    return response()->json(['status' => 'success'], 200);
  }
  
  public function select2company(Request $request){
    $data = Companies::selectRaw('id,name')
    ->where('name','LIKE',"%$request->q%")
    ->orderBy('name','asc')
    ->paginate(10);
    return response()->json(['items' => $data->toArray()['data'], 'pagination' => $data->nextPageUrl() ? true : false]);
  }
}
