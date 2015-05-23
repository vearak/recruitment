<?php

class AdminController extends BaseController
{
	
	public function index()
	{
		return  View::make('admin.dashboard');
	}
	
	public function openCV()
	{
		$cvs = CV::all();
		
		return View::make('admin.cv')->with('cvs', $cvs);
	}
	
	public function openCVCreate()
	{
		return View::make('admin.cv_create');
	}
	
	public function storeCV()
	{
		 $new_cv = [
			'surname' => htmlentities(Input::get('surname')), 
			'name' => htmlentities(Input::get('name')), 
			'sex' => htmlentities(Input::get('sex')), 
			'date_of_birth' => date('Y-m-d',strtotime(htmlentities(Input::get('date_of_birth')))), 
			'marital_status' => htmlentities(Input::get('marital-status')), 
			'nationality' => htmlentities(Input::get('nationality')), 
			'phone_number' => htmlentities(Input::get('phone_number')), 
			'email' => htmlentities(Input::get('email')), 
			'residence' => htmlentities(Input::get('residence')), 
			'address' => htmlentities(Input::get('address')), 
			'desired_industry' => htmlentities(Input::get('desired_industry')), 
			'desired_function' => htmlentities(Input::get('desired_function')), 
			'desired_location' => htmlentities(Input::get('desired_location')), 
			'desired_salary' => htmlentities(Input::get('desired_salary')), 
			'desired_position' => htmlentities(Input::get('desired_position')), 
			'current_job_title' => htmlentities(Input::get('current_job_title')), 
			'available_date' => date('Y-m-d',strtotime(htmlentities(Input::get('available_date'))))
		];
		// $new_cv = CV::all();
		//  echo $new_cv;
		Crawl_cv::create($new_cv);
		
		return Redirect::back();
	}
	//**
	// Seach cv by title and by candidate_id
	public function cvSearch($key){
	
			$keyword = Input::get('keyword');

			// return View::make('admin.cv_search')								
			// 		->with('cv_title', CV::Where('title','LIKE','%'.$keyword.'%')
			// 							->orWhere('id','LIKE','%'. $keyword.'%')
										
			// 							->paginate(3))													
								
		
			$cvs = CV::get_cv_search($keyword);
			return View::make('admin.cv_search')
				->with('cv_title', $cvs)
				->with('keyword', $keyword);

	}
}
