<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class CompanyController extends Controller
{
  public function index()
  {
    return view('company.index');
  }
  public function addJob()
  {
    return view('company.addJob');
  }
  public function jobs()
  {
    $jobs = DB::table('jobs')->where('company_id', Auth::user()->id)
     ->get();
     return view('company.jobs', compact('jobs'));
  }
  public function addJobSubmit(Request $request)
  {
    $job_title = $request->job_title;

    $skills = implode(',',$request->skills);

    $requirements = $request->requirements;
    $contact_email = $request->contact_email;

    $com_id = Auth::user()->id;

    // company img
    $file = $request->file('company_image');

    /* $fileName = $file->getClientOriginalName(); */
    $sha1 = sha1($file->getClientOriginalName());
    $extension = $file->getClientOriginalExtension();
    $fileName = "company_GroupBook-" . date('Y-m-d-h-i-s')."-".$sha1.".".$extension;
    $path = base_path() . '/public/company_image';
    $file->move($path , $fileName);
      $add_job = DB::table('jobs')->insert([
        'skills' => $skills,
        'contact_email' => $contact_email,
        'job_title' => $job_title,
        'requirements' => $requirements,
        'company_id' => $com_id,
        'company_img' => $fileName,
      ]);
      if($add_job){
        $jobs = DB::table('jobs')->where('company_id', Auth::user()->id)
        ->get();
        return view('company.jobs', compact('jobs'));
      }

  }

}
