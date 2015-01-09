@extends('layouts.default') @section('candidate')
<div class="col-md-2 left-side-bar">
	<div>
		@include('menu.menu')
	</div>
</div>
<div id="cv-edit" class="col-md-9">
	<div class="outter-box">
		<form method="post" action="{{URL::route('candidate.cv.create.edit.post', ['id' => $candidate->cv->id])}}">
			<div class="box">
				<div class="view-name title-bar">
					<strong>CV</strong>
					<a href="javascript:onclick" class="btn-min-max glyphicon glyphicon-chevron-up" style="color: #fff; float: right; text-decoration: none;"></a>
				</div>
				<div class="box-body">
					<div class="inner-wrapper">
						<div class="row input-elements">
							<div class="col-sm-4 label-title">
								<label>CV title</label>
							</div>
							<div class="col-sm-8">
								<input type="text" class="form-control input-sm" id="cv-name"
									name="cv-name" value="{{$candidate->cv->title}}">
							</div>
						</div>
						<div class="row input-elements" style="display: flex; align-items: baseline;">
							<div class="col-sm-4 label-title">
								<label>Who can see your CV</label>
							</div>
							<div class="col-sm-8">
								<div class="radio input-element">
									<label><input type="radio" id="cv-privacy" name="cv-privacy" value="1" {{$candidate->cv->searchable == 1 ? 'checked' : '' }}>Everyone</label>&nbsp;&nbsp;&nbsp;
									<label><input type="radio" id="cv-privacy" name="cv-privacy" value="0" {{$candidate->cv->searchable == 0 ? 'checked' : '' }}>Only you</label>
								</div>
							</div>
						</div>					
					</div>
				</div>
			</div>
			<div class="box">
				<div class="view-name title-bar">
					<strong>Basic Information</strong>
					<a href="javascript:onclick" class="btn-min-max glyphicon glyphicon-chevron-up" style="color: #fff; float: right; text-decoration: none;"></a>
				</div>
				<div class="box-body">
					<div class="inner-wrapper">
						<div class="row input-elements">
							<div class="col-sm-4 label-title">
								<label>Surname</label>
							</div>
							<div class="col-sm-8">
								<span class="data"><strong>{{$candidate->surname}}</strong></span>
							</div>
						</div>
						<div class="row input-elements">
							<div class="col-sm-4 label-title">
								<label>Given name</label>
							</div>
							<div class="col-sm-8">
								<span class="data"><strong>{{$candidate->name}}</strong></span>
							</div>
						</div>
						<div class="row input-elements">
							<div class="col-sm-4 label-title">
								<label>Sex</label>
							</div>
							<div class="col-sm-8">
								<span class="data"><strong>{{Lang::get("local.gender.{$candidate->sex}")}}</strong></span>
							</div>
						</div>
						<div class="row input-elements">
							<div class="col-sm-4 label-title">
								<label>Date Of Birth</label>
							</div>
							<div class="col-sm-8">
								<span class="data"><strong>{{!empty($candidate->date_of_birth) ? \Carbon\Carbon::createFromFormat('Y-m-d', $candidate->date_of_birth)->format('Y-F-d') : '' }}</strong></span>
							</div>
						</div>
						<div class="row input-elements">
							<div class="col-sm-4 label-title">
								<label>Marital Status</label>
							</div>
							<div class="col-sm-8">
								<span class="data"><strong>{{Lang::get("local.marital.{$candidate->marital_id}")}}</strong></span>	
							</div>
						</div>
						<div class="row input-elements">
							<div class="col-sm-4 label-title">
								<label>Nationality</label>
							</div>
							<div class="col-sm-8">
								<span class="data"><strong>{{$candidate->nationality}}</strong></span>
							</div>
						</div>
						<div class="row input-elements">
							<div class="col-sm-4 label-title">
								<label>Residence</label>
							</div>
							<div class="col-sm-8">
								<span class="data"><strong>{{$candidate->residence}}</strong></span>
							</div>
						</div>
						<div class="row input-elements">
							<div class="col-sm-4 label-title">
								<label>Address</label>
							</div>
							<div class="col-sm-8">
								<span class="data"><strong>{{$candidate->address}}</strong></span>
							</div>
						</div>
						<div class="row input-elements">
							<div class="col-sm-4 label-title">
								<label>Phone</label>
							</div>
							<div class="col-sm-8">
								<span class="data"><strong>{{$candidate->phone_number}}</strong></span>
							</div>
						</div>
						<div class="row input-elements">
							<div class="col-sm-4 label-title">
								<label>Email</label>
							</div>
							<div class="col-sm-8">
								<span class="data"><strong>{{Auth::user()->email}}</strong></span>
							</div>
						</div>
					</div>			
				</div>
			</div>
			<div class="box">
				<div class="view-name title-bar">
					<strong>Education Background</strong>
					<a href="javascript:onclick" class="btn-min-max glyphicon glyphicon-chevron-up" style="color: #fff; float: right; text-decoration: none;"></a>
				</div>
				<div class="box-body">
					<div>
						<table class="table table-bordered">
						  <thead>
						  	<tr>
						  		<th style="width: 20%; text-align: center;">Institute</th>
						  		<th style="width: 20%; text-align: center;">Major</th>
						  		<th style="width: 20%; text-align: center;">Degree</th>
						  		<th style="width: 20%; text-align: center;">Situation</th>
						  		<th style="width: 20%; text-align: center;">Graduation</th>
						  		<th style="width: 10px; text-align: center;">Action</th>
						  	</tr>
						  </thead>
						  <tbody>
						  	@foreach($candidate->cv->education as $education)	
						  	<tr>						  					  		
						  		<td>
						  			<span>{{$education->institute}}</span>
						  			<input type="hidden" id="institute" name="institute[]" value="{{$education->institute}}">
						  		</td>
						  		<td>
						  			<span>{{$education->major}}</span>
						  			<input type="hidden" id="major" name="major[]" value="{{$education->major}}">
						  		</td>
						  		<td>
						  			<span>{{$education->degree}}</span>
						  			<input type="hidden" id="degree" name="degree[]" value="{{$education->degree_id}}">
						  		</td>
						  		<td>
						  			<span>{{$education->situation}}</span>
						  			<input type="hidden" id="situation" name="situation[]" value="{{$education->situation_id}}">
						  		</td>
						  		<td>
						  			<span>{{$education->graduation_date}}</span>
						  			<input type="hidden" id="graduation-year" name="graduation-year[]" value="{{$education->graduation_date}}">
						  		</td>
						  		<td  style="text-align: center; vertical-align: middle;">
						  			<a href="javascript:onclick"><i class="glyphicon glyphicon-pencil"></i></a><br>
						  			<a href="javascript:onclick"><i class="glyphicon glyphicon-remove"></i></a>
						  			<input type="hidden" name="work_experience_id[]" value="{{$education->id}}">
						  		</td>						  					  		
						  	</tr>						  	
						  	@endforeach	
						  	<tr>
						  		<td><input type="text" class="form-control input-sm input-margin" id="institute_new" name="institute_new" placeholder="Institute"></td>
						  		<td><input type="text" class="form-control input-sm" id="major_new" name="major_new" placeholder="Major"></td>
						  		<td>
									<select class="form-control input-sm input-margin" id="degree_new" name="degree_new">
										<option value="">---Degree---</option> 
										@foreach(\Constants::getDegrees() as $degree)
											<option value="{{$degree->id}}">{{$degree->description}}</option>
										@endforeach
									</select>
								</td>
						  		<td>
						  			<select class="sl-location form-control input-sm" id="situation_new" name="situation_new">
										<option value="">---Situation---</option> 
										@foreach(\Constants::getSchoolingSituations() as $situation)
										<option value="{{$situation->id}}">{{$situation->description}}</option>
										@endforeach
									</select>
						  		</td>
						  		<td>
										<input type="text" class="form-control input-sm" id="graduation-year_new" name="graduation-year_new"  placeholder="Graduation Date">
								</td>
						  		<td style="text-align: center; vertical-align: middle;">
						  			<a href="javascript:onclick"><i class="glyphicon glyphicon-plus"></i></a>
						  		</td>
						  	</tr>
						  </tbody>
						</table>
					</div>			
				</div>
			</div>
			<div class="box">
				<div class="view-name title-bar">
					<strong>Work Experience</strong>
					<a href="javascript:onclick" class="btn-min-max glyphicon glyphicon-chevron-up" style="color: #fff; float: right; text-decoration: none;"></a>
				</div>
				<div class="box-body">
					<div>
						<table class="table table-bordered">
						  <thead>
						  	<tr>
						  		<th style="width: 20%; text-align: center;">Job title</th>
						  		<th style="width: 20%; text-align: center;">Company</th>
						  		<th style="width: 20%; text-align: center;">Industry</th>
						  		<th style="width: 20%; text-align: center;">Location</th>
						  		<th style="width: 20%; text-align: center;">Duration</th>
						  		<th style="width: 10px; text-align: center;">Action</th>
						  	</tr>
						  </thead>
						  <tbody>
						  	@foreach($candidate->cv->work_experiences as $work_experience)	
						  	<tr>						  					  		
						  		<td>
						  			<span>{{$work_experience->job_title}}</span>
						  			<input type="hidden" id="job_title" name="job_title[]" value="{{$work_experience->job_title}}">
						  		</td>
						  		<td>
						  			<span>{{$work_experience->company_name}}</span>
						  			<input type="hidden" id="company" name="company[]" value="{{$work_experience->company_name}}">
						  		</td>
						  		<td>
						  			<span>{{$work_experience->industry}}</span>
						  			<input type="hidden" id="ex_industry" name="ex_industry[]" value="{{$work_experience->industry_id}}">
						  		</td>
						  		<td>
						  			<span>{{$work_experience->location}}</span>
						  			<input type="hidden" id="ex_location" name="ex_location[]" value="{{$work_experience->location_id}}">
						  		</td>
						  		<td>
						  			<span>{{$work_experience->from_date}} To {{$work_experience->to_date}}</span>
						  			<input type="hidden" id="durartion" name="experience_from_date[]" value="{{$work_experience->from_date}}">
						  			<input type="hidden" id="durartion" name="experience_to_date[]" value="{{$work_experience->to_date}}">
						  		</td>
						  		<td  style="text-align: center; vertical-align: middle;">
						  			<a href="javascript:onclick"><i class="glyphicon glyphicon-pencil"></i></a><br>
						  			<a href="javascript:onclick"><i class="glyphicon glyphicon-remove"></i></a>
						  			<input type="hidden" name="work_experience_id[]" value="{{$work_experience->id}}">
						  		</td>						  					  		
						  	</tr>						  	
						  	@endforeach	
						  	<tr>
						  		<td><input type="text" class="form-control input-sm input-margin" id="job-title_new" name="job-title_new" placeholder="Job Title"></td>
						  		<td><input type="text" class="form-control input-sm" id="company_new" name="company_new" placeholder="Company"></td>
						  		<td>
									<select class="form-control input-sm input-margin" id="ex-industry_new" name="ex-industry_new">
										<option value="">---Industry---</option> 
										@foreach(\Industry::getIndustries() as $industry)
											<option value="{{$industry->id}}">{{$industry->name}}</option>
										@endforeach
									</select>
								</td>
						  		<td>
						  			<select class="sl-location form-control input-sm" id="ex-location_new" name="ex-location_new">
										<option value="">---Location---</option> 
										@foreach(\Location::getProvinces_Cities() as $location)
										<option value="{{$location->id}}">{{$location->name}}</option>
										@endforeach
									</select>
						  		</td>
						  		<td>
										<input type="text" class="form-control input-sm" id="ex-from-date" name="ex-from-date" placeholder="From" style="width: 45%; float: left; margin-right: 9px;">
										<input type="text" class="form-control input-sm" id="ex-from-date" name="ex-from-date" placeholder="To" style="width: 45%; float: left;">
								</td>
						  		<td style="text-align: center; vertical-align: middle;">
						  			<a href="javascript:onclick"><i class="glyphicon glyphicon-plus"></i></a>
						  		</td>
						  	</tr>
						  </tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="box">
				<div class="view-name title-bar">
					<strong>Skills</strong>
					<a href="javascript:onclick" class="btn-min-max glyphicon glyphicon-chevron-up" style="color: #fff; float: right; text-decoration: none;"></a>
				</div>
				<div class="box-body">
					<div class="inner-wrapper">
						<div class="row input-elements">
							<div class="col-sm-4 label-title">
								<label>Skill</label>
							</div>
							<div class="col-sm-8">
								<input type="text" class="form-control input-sm" id="skill" name="skill">
							</div>
						</div>
						<div class="row input-elements">
							<div class="col-sm-4 label-title">
								<label>Year of experience</label>
							</div>
							<div class="col-sm-8">
								<input type="text" class="form-control input-sm" id="year-experience" name="year-experience" style="width: 54px;">
							</div>
						</div>
						<div class="row input-elements">
							<div class="col-sm-4 label-title">
								<label>Level</label>
							</div>
							<div class="col-sm-8">
								<select class="form-control input-sm" id="skill-level" name="skill-level" style="width: 115px;">
									<option value="">---Select---</option>
									@foreach(\Constants::getLevels() as $level)
									<option value="{{$level->id}}">{{$level->description}}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="box">
				<div class="view-name title-bar">
					<strong>Languages</strong>
					<a href="javascript:onclick" class="btn-min-max glyphicon glyphicon-chevron-up" style="color: #fff; float: right; text-decoration: none;"></a>
				</div>
				<div class="box-body">
					<div class="inner-wrapper">
						<div class="row input-elements">
							<div class="col-sm-4 label-title">
								<label>Language</label>
							</div>
							<div class="col-sm-8">
								<input type="text" class="form-control input-sm" id="language"
									name="language">
							</div>
						</div>
						<div class="row input-elements">
							<div class="col-sm-4 label-title">
								<label>Level</label>
							</div>
							<div class="col-sm-8">
								<select class="form-control input-sm" id="language-level"
									name="language-level" style="width: 115px;">
									<option value="">---Select---</option>
									<option value="0">Poor</option>
									<option value="1">Fair</option>
									<option value="2">Good</option>
									<option value="3">Very Good</option>
									<option value="4">Excellent</option>
								</select>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="box">
				<div class="view-name title-bar">
					<strong>Expectation</strong>
					<a href="javascript:onclick" class="btn-min-max glyphicon glyphicon-chevron-up" style="color: #fff; float: right; text-decoration: none;"></a>
				</div>
				<div class="box-body" style="border-bottom: none;">
					<div class="inner-wrapper">
						<div class="row input-elements">
							<div class="col-sm-4 label-title">
								<label>Function</label>
							</div>
							<div class="col-sm-8">
								<select class="form-control input-sm" id="function" name="desired_function">
									<option value="">---Select---</option> 
									@foreach(\Func::getFunctions() as $function)
									<option value="{{$function->id}}" {{$candidate->cv->desired_function == $function->id ? 'selected' : '' }}>{{$function->name}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="row input-elements">
							<div class="col-sm-4 label-title">
								<label>Industry</label>
							</div>
							<div class="col-sm-8">
								<select class="form-control input-sm" id="industry" name="desired_industry">
									<option value="">---Select---</option> 
									@foreach(\Industry::getIndustries() as $industry)
									<option value="{{$industry->id}}" {{$candidate->cv->desired_industry == $industry->id ? 'selected' : '' }}>{{$industry->name}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="row input-elements">
							<div class="col-sm-4 label-title">
								<label>Location</label>
							</div>
							<div class="col-sm-8">
								<select class="sl-location form-control input-sm" id="location" name="desired_location">
									<option value="">---Select---</option> 
									@foreach(\Location::getProvinces_Cities() as $location)
									<option value="{{$location->id}}" {{$candidate->cv->desired_location == $location->id ? 'selected' : '' }}>{{$location->name}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="row input-elements">
							<div class="col-sm-4 label-title">
								<label>Salary</label>
							</div>
							<div class="col-sm-8">
								<select class="sl-salary form-control input-sm" id="salary" name="desired_salary">
									<option value="">---Select---</option>  
									@foreach(\Salary::getSalaries() as $salary)
										<option value="{{$salary->id}}" {{$candidate->cv->desired_salary == $salary->id ? 'selected' : '' }}>{{$salary->min}} ~ {{$salary->max}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="row input-elements">
							<div class="col-sm-4 label-title">
								<label>Job Term</label>
							</div>
							<div class="col-sm-8">
								<select class="sl-salary form-control input-sm" id="job-term" name="job-term">
									<option value="">---Select---</option>
									@foreach(\Constants::getJobTerm() as $job_term)
										<option value="{{$job_term->id}}" {{$candidate->cv->job_term == $job_term->id ? 'selected' : '' }}>{{$job_term->term}}</option>
									@endforeach
								</select>
							</div>
						</div>						
					</div>
				</div>
			</div>				
			<div class="box-footer">
				<button type="submit" class="btn btn-default" style="width: 100px;"><i class="fa fa-floppy-o"></i> Save</button>
				<button type="button" class="btn btn-default" style="width: 100px;"><i class="fa fa-newspaper-o"></i> Preview</button>
			</div>			
		</form>
	</div>
	<div class="col-md-3 right-side-bar"></div>
	@endsection