<?php

namespace App\Http\Controllers;
use Storage;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\requirement;
use App\Repositories\RequirementRepository;

class RequirementController extends Controller
{

    protected $requirements;

    public function __construct(RequirementRepository $requirements)
    {
        $this->middleware('auth');
        $this->requirements=$requirements;
    }

    public function store(Request $request)
    {
    	$this->validate($request,[
    		'name'=>'required|max:255',
    		'location'=>'required|max:255',
    		'mainlang'=>'required|max:255',
    		'practicelang'=>'required|max:255',
            'description'=>'required|max:100000'
    	]);
    	$request->user()->requirements()->create([
    		'name'=>$request->name,
    		'location'=>$request->location,
    		'sex'=>$request->sex,
    		'mainlang'=>$request->mainlang,
    		'practicelang'=>$request->practicelang,
            'description'=>$request->description
            ]);
        $file=$request->file;
        Storage::disk('public')->put($file, 'Contents');    
        return redirect('/');
    	//
    }
    public function index(Request $request){
    	return view('requirements.index');
    }
    public function update(){

    }
    public function delete(){

    }
    public function uploadimg(Request $request){
        $file=$request->file;
        Storage::disk('public')->put($file, 'Contents');    
        //Storage::put($file)

        }

}

