@extends('layouts.default') @section('candidate')
<div ng-app="AppCandidate">
	<div class="left-side-bar pull-left">
		<div>@include('menu.menu')</div>
	</div>
	<div id="cv-edit" class="middle-wrapper pull-left" 
		ng-controller="CvEditCtrl" 
		ng-init="loadData({{$candidate->cv->id}})"
	>
		<div id="profile-card">
			<div class="row">
				<div class="col-sm-5">
					<img alt="Profile Photo"
						src="{{asset('assets/images/profile/no-profile-pic.jpg')}}"
						id="profile-pic">
				</div>
				<div class="col-sm-7">
					<h2>
						<span id="first-name">{{$candidate->surname}}</span>&nbsp;<span
							id="last-name">{{$candidate->name}}</span>
					</h2>
					<div>
						<span class="prefix-cv-info">Born</span><span class="cv-info">{{!empty($candidate->date_of_birth) ? \Carbon\Carbon::createFromFormat('Y-m-d', $candidate->date_of_birth)->format('Y-F-d') : ''}}</span>
					</div>
					<div>
						<span class="prefix-cv-info">Gender</span><span class="cv-info">{{Lang::get("local.gender.{$candidate->sex}")}}</span>
					</div>
					<div>
						<span class="prefix-cv-info">Marital Status</span><span
							class="cv-info">{{$candidate->marital_status}}</span>
					</div>
					<div>
						<span class="prefix-cv-info">Nationality</span><span
							class="cv-info">{{$candidate->nationality}}</span>
					</div>
					<div>
						<span class="prefix-cv-info">Phone</span><span
							class="cv-info">{{$candidate->phone_number}}</span>
					</div>
					<div>
						<span class="prefix-cv-info">Email</span><span
							class="cv-info">{{$candidate->email}}</span>
					</div>
				</div>
			</div>
		</div>
		<div id="back-card">
			<span class="card-article">Backgound</span>
			<div id="summary">			
				<h3 class="part">Summary</h3>
				<div class="content-show clearfix" ng-hide="show_frm_summary">
					<p  ng-bind-html="summary_html"></p>
					<div class="card-btn-group">
						<a href="javascript:onclick" id="btn-edit-summary" class="glyphicon glyphicon-pencil" ng-click="show_frm_summary = true"></a>
					</div>
				</div>
				<div class="form-edit" ng-show="show_frm_summary">
					<div class="form-group">
					      <textarea class="form-control" id="ex-summary" ng-model="summary"></textarea>
					</div>
					<div class="opt-controls">
				      <button type="button" class="btn btn-primary btn-save" ng-click="saveSummary()">Save</button>
				      <button type="button" class="btn btn-danger btn-cancel" ng-click="cancelSummary();">Cancel</button>
				  </div>
				</div>
			</div>
			<div id="experience" ng-cloak>
				<h3 class="part">Experience</h3>
				<div class="items">					
					<div class="item" ng-repeat="experience in experiences">						
						<div class="content-show" ng-hide="experience.content_exp_hide">
							<h4 id="span-job-title" class="job-title">{% experience.job_title %}</h4>
							<div>
								<span class="prefix-cv-info">Company</span><span id="span-company-name" class="cv-info">{% experience.company_name %}</span>
							</div>
							<div>
								<span class="prefix-cv-info">From</span>
								<span id="span-from-date" class="cv-info">
									{% getExperienceDate(experience.from_year, experience.from_month) %}
								</span>
								<span class="prefix-cv-info" style="margin-left: 13px;">To</span>
								<span id="span-to-date" class="cv-info">
									{% getExperienceDate(experience.to_year, experience.to_month, 'Present') %}
								</span>
							</div>
							<div>
								<span class="prefix-cv-info">Locate in</span><span id="span-ex-location" class="cv-info" >{% experience.location %}</span>
							</div>										
							<div>
								<p id="span-job-description">{% experience.job_description %}</p>
							</div>										
							<div class="card-btn-group">
								<a href="javascript:onclick" id="btn-edit-experience" class="glyphicon glyphicon-remove" 
									ng-click="deleteExperience(experience)"></a>							
								<a href="javascript:onclick" id="btn-edit-experience" class="glyphicon glyphicon-pencil" 
									ng-click="openEditFormExp(experience)"></a>
							</div>
						</div>
						<div class="form-edit" ng-show="experience.frm_exp_edit_show">
							<form class="form-horizontal">
								<div class="form-group">
									<label for="input-job-title" class="col-sm-3 control-label">Job Title</label>
								    <div class="col-sm-8">
								      <input type="text" class="form-control" id="input-job-title" ng-model="experience.job_title">
								    </div>
								</div>
								<div class="form-group">
									<label for="input-company-name" class="col-sm-3 control-label">Company name</label>
								    <div class="col-sm-5">
								      <input type="text" class="form-control" id="input-company-name" ng-model="experience.company_name">
								    </div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Duration</label>
								    <div class="col-sm-9">
								      <div class="pull-left clearfix">
								      	<select type="text" class="form-control pull-left" id="input-ex-from-month" ng-model="experience.from_month" only-digits style="width: 120px;">
								      		<option value="">---Month--</option>
								      		@foreach(\Config::get('constant.months') as $month)
								      			<option value="{{$month['num']}}">{{$month['name']}}</option>
								      		@endforeach
								      	</select>
								      	<input type="text" class="form-control pull-left" id="input-ex-from-year" ng-model="experience.from_year"  style="width: 60px; margin-left: 5px;" Placeholder="Year">
								      </div> 
								      <div class="pull-left" style="padding-top: 6px; font-weight: 600;">&nbsp;&nbsp;To&nbsp;&nbsp;</div>
								      <div class="pull-left clearfix">
								      	<select type="text" class="form-control pull-left" id="input-ex-to-month" ng-model="experience.to_month" style="width: 120px;">
								      		<option value="">---Month--</option>
								      		@foreach(\Config::get('constant.months') as $month)
								      			<option value="{{$month['num']}}">{{$month['name']}}</option>
								      		@endforeach
								      	</select>
								      	<input type="text" class="form-control pull-left" id="input-ex-to-year" ng-model="experience.to_year"  style="width: 60px; margin-left: 5px;" Placeholder="Year">
								      </div>
								    </div>
								</div>
								<div class="form-group">
									<label for="ex-location" class="col-sm-3 control-label">Location</label>
								    <div class="col-sm-5">
								      <input type="text" class="form-control" id="input-ex-location" name="ex-location" ng-model="experience.location">
								    </div>
								</div>
								<div class="form-group">
									<label for="input-job-description" class="col-sm-3 control-label">Description</label>
								    <div class="col-sm-9">
								      <textarea class="form-control" id="input-job-description" ng-model="experience.job_description"></textarea>
								    </div>
								</div>
								<div class="opt-controls">
							      <button type="button" class="btn btn-primary btn-save" ng-click="updateExperience(experience)">Update</button>
							      <button type="button" class="btn btn-danger btn-cancel" ng-click="cancelFormExperience(experience)">Cancel</button>
							  </div>
						  </form>
						</div>
					</div>				
				</div>
				<a href="" id="btn-show-formnew" ng-click="openNewExpForm()" ng-hide="frm_exp_new_show"><i class="fa fa-plus-circle"></i>Add new</a>
				<div class="form-new" ng-show="frm_exp_new_show">
					<h4 style="margin-bottom: 20px;">What is your work experience?</h4>
					<form class="form-horizontal">
						<div class="form-group">
							<label for="input-job-title" class="col-sm-3 control-label">Job Title</label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" id="input-job-title" ng-model="new_experience.job_title">
						    </div>
						</div>
						<div class="form-group">
							<label for="input-company-name" class="col-sm-3 control-label">Company name</label>
						    <div class="col-sm-5">
						      <input type="text" class="form-control" id="input-company-name" ng-model="new_experience.company_name">
						    </div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Duration</label>
						    <div class="col-sm-9">
						      <div class="pull-left clearfix">
						      	<select type="text" class="form-control pull-left" id="input-ex-from-month" style="width: 120px;" ng-model="new_experience.from_month">
						      		<option value="">---Month--</option>
						      		@foreach(\Config::get('constant.months') as $month)
						      			<option value="{{$month['num']}}">{{$month['name']}}</option>
						      		@endforeach
						      	</select>
						      	<input type="text" class="form-control pull-left" id="input-ex-from-year" style="width: 60px; margin-left: 5px;" Placeholder="Year" ng-model="new_experience.from_year">
						      </div> 
						      <div class="pull-left" style="padding-top: 6px; font-weight: 600;">&nbsp;&nbsp;To&nbsp;&nbsp;</div>
						      <div class="pull-left clearfix">
						      	<select type="text" class="form-control pull-left" id="input-ex-to-month" style="width: 120px;" ng-model="new_experience.to_month">
						      		<option value="">---Month--</option>
						      		@foreach(\Config::get('constant.months') as $month)
						      			<option value="{{$month['num']}}">{{$month['name']}}</option>
						      		@endforeach
						      	</select>
						      	<input type="text" class="form-control pull-left" id="input-ex-to-year" style="width: 60px; margin-left: 5px;" Placeholder="Year" ng-model="new_experience.to_year">
						      </div>
						    </div>
						</div>
						<div class="form-group">
							<label for="ex-location" class="col-sm-3 control-label">Location</label>
						    <div class="col-sm-5">
						      <input type="text" class="form-control" id="input-ex-location" name="ex-location" ng-model="new_experience.location">
						    </div>
						</div>
						<div class="form-group">
							<label for="input-job-description" class="col-sm-3 control-label">Description</label>
						    <div class="col-sm-9">
						      <textarea class="form-control" id="input-job-description" ng-model="new_experience.job_description"></textarea>
						    </div>
						</div>
						<div class="opt-controls">
					      <button type="button" class="btn btn-primary btn-save" ng-click="createNewExperience(new_experience)">Save</button>
					      <button type="button" class="btn btn-danger btn-cancel" ng-click="cancelFormNewExperience()">Cancel</button>
					  </div>
				  </form>
				</div>
			</div>
			<div id="edu" ng-cloak>
				<h3 class="part">Education</h3>
				<div class="items">
					<div class="item" ng-repeat="education in educations">
						<div class="content-show" ng-hide="education.show_frm_edu">
							<h4 id="span-institute">{% education.institute %}</h4>
							<div>
								<span id="span-degree" class="cv-info" ng-show="education.degree_id">{% education.degree %} in </span><span id="span-major">{% education.major %}</span>
							</div>
							<div>
								<span class="cv-info"><span id="span-from-year">{% education.from_year %}</span> - <span id="span-grad-year">{% education.grad_year %}</span></span>&nbsp;
								<span class="span-situation" ng-show="education.situation_id">({% education.situation %})</span>
							</div>
							<div class="card-btn-group">
								<a href="javascript:onclick" class="glyphicon glyphicon-remove" ng-click="deleteEducation(education)"></a>
								<a href="javascript:onclick" id="btn-edit-edu" class="glyphicon glyphicon-pencil" ng-click="openEditFormEdu(education)"></a>
							</div>
						</div>
						<div class="form-edit" ng-show="education.show_frm_edu">
							<form class="form-horizontal">
								<div class="form-group">
										<label for="input-institute" class="col-sm-3 control-label">Institute</label>
									    <div class="col-sm-8">
									      <input type="text" class="form-control" id="input-institute" ng-model="education.institute">
									    </div>
									</div>
									<div class="form-group">
										<label for="input-major" class="col-sm-3 control-label">Major</label>
									    <div class="col-sm-8">
									      <input type="text" class="form-control" id="input-major" ng-model="education.major">
									    </div>
									</div>
									<div class="form-group">
										<label for="input-degree" class="col-sm-3 control-label">Degree</label>
									    <div class="col-sm-4">
									      <select type="text" class="form-control" id="input-degree" ng-model="education.degree_id">
									      	<option value="">--Select--</option>
											@foreach(\Degree::all() as $degree)
											<option value="{{$degree->id}}">{{$degree->description}}</option>
											@endforeach
									      </select>
									    </div>
									</div>
									<div class="form-group">
										<label for="input-from-year" class="col-sm-3 control-label">Start School</label>
									    <div class="col-sm-8">
									      <input type="text" class="form-control" id="input-from-year" ng-model="education.from_year" style="width: 70px;">
									    </div>
									</div>
									<div class="form-group">
										<label for="input-grad-year" class="col-sm-3 control-label">Graduation year</label>
									    <div class="col-sm-8">
									      <input type="text" class="form-control" id="input-grad-year" ng-model="education.grad_year" style="width: 70px;">
									    </div>
									</div>
									<div class="form-group">
										<label for="input-grad-year" class="col-sm-3 control-label">Situation</label>
									    <div class="col-sm-4">
									      <select type="text" class="form-control" id="input-degree" ng-model="education.situation_id">
									      	<option value="">--Select--</option>
											@foreach(\SchoolSituation::all() as $situation)
											<option value="{{$situation->id}}">{{$situation->description}}</option>
											@endforeach
									      </select>
									    </div>
									</div>
									<div class="opt-controls">
								      <button type="button" class="btn btn-primary btn-save" ng-click="updateEducation(education)">Update</button>
								      <button type="button" class="btn btn-danger btn-cancel" ng-click="cancelEditFormEdu(education)">Cancel</button>
								  </div>
							 </form>
						</div>
					</div>
				</div>
				<a href="" id="btn-show-formnew" ng-click="openNewEduForm()" ng-hide="show_frm_edu_new"><i class="fa fa-plus-circle"></i>Add new</a>
				<div class="form-new" ng-show="show_frm_edu_new">
					<h4 style="margin-bottom: 20px;">What is your education background?</h4>
					<form class="form-horizontal">
						<div class="form-group">
							<label for="input-institute" class="col-sm-3 control-label">Institute</label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" id="input-institute" ng-model="new_education.institute">
						    </div>
						</div>
						<div class="form-group">
							<label for="input-major" class="col-sm-3 control-label">Major</label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" id="input-major" ng-model="new_education.major">
						    </div>
						</div>
						<div class="form-group">
							<label for="input-degree" class="col-sm-3 control-label">Degree</label>
						    <div class="col-sm-4">
						      <select type="text" class="form-control" id="input-degree" ng-model="new_education.degree_id">
						      	<option value="">--Select--</option>
								@foreach(\Degree::all() as $degree)
								<option value="{{$degree->id}}">{{$degree->description}}</option>
								@endforeach
						      </select>
						    </div>
						</div>
						<div class="form-group">
							<label for="input-from-year" class="col-sm-3 control-label">Start School</label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" id="input-from-year" ng-model="new_education.from_year" style="width: 70px;">
						    </div>
						</div>
						<div class="form-group">
							<label for="input-grad-year" class="col-sm-3 control-label">Graduation year</label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" id="input-grad-year" ng-model="new_education.grad_year" style="width: 70px;">
						    </div>
						</div>
						<div class="form-group">
							<label for="input-grad-year" class="col-sm-3 control-label">Situation</label>
						    <div class="col-sm-4">
						      <select type="text" class="form-control" id="input-degree" ng-model="new_education.situation_id">
						      	<option value="">--Select--</option>
								@foreach(\SchoolSituation::all() as $situation)
								<option value="{{$situation->id}}">{{$situation->description}}</option>
								@endforeach
						      </select>
						    </div>
						</div>
						<div class="opt-controls">
					      <button type="button" class="btn btn-primary btn-save" ng-click="createNewEducation(new_education)">Save</button>
					      <button type="button" class="btn btn-danger btn-cancel" ng-click="cancelFormNewEdu()">Cancel</button>
					  </div>
					</form>
				</div>
			</div>
			<div id="skills">
				<div>
					<h3 class="part">Skill</h3>
					<div class="content-show" ng-hide="show_frm_skill">
						<div class="items clearfix">
							<div class="item" ng-repeat="skill in skills">
								<span class="cv-info" id="skill-name">{% skill.name %}</span>&nbsp;&nbsp;&nbsp;
								<span class="skill-detail text-muted">{% skill.level %} <span ng-if="skill.year_experience">({% skill.year_experience %} years)</span></span>
							</div>
						</div>
						<a href="" id="btn-show-formnew" ng-click="show_frm_skill = true" ng-hide="skills.length"><i class="fa fa-plus-circle"></i>Add new</a>
						<div class="card-btn-group" ng-show="skills.length">
							<a href="javascript:onclick" id="btn-edit-skill" class="glyphicon glyphicon-pencil btn-edit-cv" ng-click="show_frm_skill = true" ></a>
						</div>
					</div>
					<div class="form-edit" ng-show="show_frm_skill">
							<h4>What is your area of expertise?</h4>
							<div id="new-skill" class="clearfix">
								<input type="text" class="form-control pull-left" id="input-skill-name" placeholder="Skill name" style="width: 202px; margin-right: 5px;" ng-model="new_skill.name">
								<input type="text" class="form-control pull-left" id="input-skill-year-exp" placeholder="Year of experience" style="width: 100px; margin-right: 5px;" ng-model="new_skill.year_experience">
								<select class="form-control pull-left" id="input-skill-level" style="width: 130px; margin-right: 5px;" ng-model="new_skill.level_id">
									<option value="">---Level---</option>
									@foreach(\Level::all() as $level)
									<option value="{{$level->id}}">{{$level->description}}</option>
									@endforeach
								</select>
								<button type="button" id="btn-add" class="btn btn-primary" ng-click="createNewSkill(new_skill)">Add</button>
								<button type="button" id="btn-add" class="btn btn-danger" ng-click="closeFormSkill()">Close</button>
							</div>
							<div id="skills-collection" class="items clearfix" ng-if="skills.length">
								<div class="item round-box-wrapper" ng-repeat="skill in skills">
									<div class="span-content">
										<span class="cv-info" id="skill-name">{% skill.name %}</span>&nbsp;&nbsp;&nbsp;
										<span class="skill-detail text-muted">{% skill.level %}  <span ng-if="skill.year_experience">({% skill.year_experience %} years)</span></span>&nbsp;
										<a href="javascript:onclick" class="btn-remove glyphicon glyphicon-remove" ng-click="deleteSkill(skill)"></a>
									</div>
								</div>
							</div>			
					</div>
				</div>			
			</div>
			<div id="languages">
				<h3 class="part">Language</h3>
				<div class="content-show" ng-hide="show_frm_lang">
					<div class="items">
						<div class="item" ng-repeat="language in languages">
							<span class="lang">{% language.language %}</span>&nbsp;&nbsp;&nbsp;<span
								class="lang-proficiency text-muted">{% language.proficiency %}</span>
						</div>
					</div>
					<a href="" id="btn-show-formnew" ng-click="show_frm_lang = true" ng-hide="languages.length"><i class="fa fa-plus-circle"></i>Add new</a>
					<div class="card-btn-group" ng-show="languages.length">
						<a href="javascript:onclick" id="btn-edit-lang" class="glyphicon glyphicon-pencil" ng-click="show_frm_lang = true"></a>
					</div>
				</div>
				<div class="form-edit" ng-show="show_frm_lang">
					<form  class="form-inline">
						<div class="item-add-new">
						    <h4>What languages can you speak?</h4>
						   	<input type="text" class="form-control" id="input-lang-name" placeholder="Language" ng-model="new_language.language">
						   	<select class="form-control" id="input-lang-proficiency" ng-model="new_language.proficiency_id">
						   		<option value="">---Proficiency---</option>
								@foreach(\Proficiency::all() as $proficiency)
								<option value="{{$proficiency->id}}">{{$proficiency->proficiency}}</option>
								@endforeach
						   	</select>
						    <button type="button" class="btn btn-primary btn-save" ng-click="createNewLang(new_language)">Add</button>
						    <button type="button" class="btn btn-danger btn-close" ng-click="closeLangForm()">Close</button>
						 </div>
						<div id="lang-collection" class="clearfix" ng-show="languages.length">	
							<div class="item round-box-wrapper" ng-repeat="language in languages">
								<div class="span-content">
									<span>{% language.language %}</span>&nbsp;&nbsp;
									<span class="lang-proficiency text-muted">{% language.proficiency %}</span>
									<a href="javascript:onclick" class="btn-remove glyphicon glyphicon-remove" ng-click="deleteLang(language)"></a>
								</div>
							</div>
						</div>					   
					</form>																  	
				</div>						
			</div>
		</div>
		<div id="expectation-card" ng-cloak>
			<span class="card-article">Expectation</span>
			<div id="function">
				<div>
					<h3 class="part">Function</h3>
					<div class="content-show" ng-hide="show_frm_function">						
						<div class="items clearfix">
							<div class="item pull-left" ng-repeat="function in functions">
								<span class="cv-info">{% $last === false ? function.function_name + ',&nbsp;&nbsp;&nbsp;' : function.function_name %}</span>
							</div>
						</div>	
						<a href="" id="btn-show-formnew" ng-click="openFuncForm()" ng-hide="functions.length"><i class="fa fa-plus-circle"></i>Add new</a>						
						<div class="card-btn-group" ng-show="functions.length">
							<a href="javascript:onclick" class="glyphicon glyphicon-pencil" ng-click="openFuncForm()"></a>
						</div>
					</div>
					<div class="form-edit" ng-show="show_frm_function">
						<form  class="form-inline">
							<div class="item-add-new">
							    <h4>What function would you expect?</h4>
							   	<select class="form-control" id="input-function" ng-model="new_function.function_id">
							   		<option value="">---Function---</option>
									@foreach(\Func::getFunctions() as $function)
									<option value="{{$function->id}}">{{$function->name}}</option>
									@endforeach
							   	</select>
							    <button type="button" class="btn btn-primary btn-save" ng-click="createNewFunc(new_function)">Add</button>
							    <button type="button" class="btn btn-danger btn-close" ng-click="closeFuncForm()">Close</button>
							 </div>
							 <div id="collection" class="clearfix" ng-show="functions.length">	
								<div class="item round-box-wrapper" ng-repeat="function in functions">
									<div class="span-content">
										<span>{% function.function_name %}</span>
										<a href="javascript:onclick" class="btn-remove glyphicon glyphicon-remove" ng-click="deleteFunc(function)"></a>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div id="industry">
				<div>
					<h3 class="part">Industry</h3>
					<div class="content-show" ng-hide="show_frm_industry">
						<div class="items clearfix">
							<div class="item pull-left" ng-repeat="industry in industries">
								<span class="cv-info">{% $last === false ? industry.industry_name + ',&nbsp;&nbsp;&nbsp;' : industry.industry_name %}</span>
							</div>
						</div>		
						<a href="" id="btn-show-formnew" ng-click="openIndustryForm()" ng-hide="industries.length"><i class="fa fa-plus-circle"></i>Add new</a>			
						<div class="card-btn-group" ng-show="industries.length">
							<a href="javascript:onclick" class="glyphicon glyphicon-pencil" ng-click="openIndustryForm()"></a>
						</div>
					</div>
					<div class="form-edit" ng-show="show_frm_industry">
						<form  class="form-inline">
							<div class="item-add-new">
							    <h4>What industry would you expect?</h4>
							   	<select class="form-control" id="input-industry" ng-model="new_industry.industry_id">
							   		<option value="">---Industry---</option>
									@foreach(\Industry::getIndustries() as $industry)
									<option value="{{$industry->id}}">{{$industry->name}}</option>
									@endforeach
							   	</select>
							    <button type="button" class="btn btn-primary btn-save" ng-click="createNewIndustry(new_industry)">Add</button>
							    <button type="button" class="btn btn-danger btn-close" ng-click="closeIndustryForm()">Close</button>
							 </div>
							 <div id="collection" class="clearfix" ng-show="industries.length">	
								<div class="item round-box-wrapper" ng-repeat="industry in industries">
									<div class="span-content">
										<span>{% industry.industry_name %}</span>
										<a href="javascript:onclick" class="btn-remove glyphicon glyphicon-remove" ng-click="deleteIndustry(industry)"></a>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>	
			<div id="location">
				<div>
					<h3 class="part">Location</h3>
					<div class="content-show" ng-hide="show_frm_location">
						<div class="items clearfix">
							<div class="item pull-left" ng-repeat="location in locations">
								<span class="cv-info">{% $last === false ? location.location_name + ',&nbsp;&nbsp;&nbsp;' : location.location_name %}</span>
							</div>
						</div>		
						<a href="" id="btn-show-formnew" ng-click="openLocationForm()" ng-hide="locations.length"><i class="fa fa-plus-circle"></i>Add new</a>			
						<div class="card-btn-group" ng-show="locations.length">
							<a href="javascript:onclick" class="glyphicon glyphicon-pencil" ng-click="openLocationForm()"></a>
						</div>
					</div>
					<div class="form-edit" ng-show="show_frm_location">
						<form  class="form-inline">
							<div class="item-add-new">
							    <h4>What location would you expect?</h4>
							   	<select class="form-control" id="input-location" ng-model="new_location.location_id">
							   		<option value="">---Location---</option>
									@foreach(\Location::getProvinces_Cities() as $location)
									<option value="{{$location->id}}">{{$location->name}}</option>
									@endforeach
							   	</select>
							    <button type="button" class="btn btn-primary btn-save" ng-click="createNewLocation(new_location)">Add</button>
							    <button type="button" class="btn btn-danger btn-close" ng-click="closeLocationForm()">Close</button>
							 </div>
							 <div id="collection" class="clearfix" ng-show="locations.length">	
								<div class="item round-box-wrapper" ng-repeat="location in locations">
									<div class="span-content">
										<span>{% location.location_name %}</span>
										<a href="javascript:onclick" class="btn-remove glyphicon glyphicon-remove" ng-click="deleteLocation(location)"></a>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div id="salary">
				<div>
					<h3 class="part">Salary</h3>
					<div class="content-show clearfix" ng-hide="show_frm_salary">
						<span>{% salary_range %}</span>
						<a href="" id="btn-show-formnew" ng-click="openSalaryForm()" ng-show="salary_range == ''"><i class="fa fa-plus-circle"></i>Add new</a>			
						<div class="card-btn-group" ng-show="salary_range != ''">
							<a href="javascript:onclick" class="glyphicon glyphicon-pencil" ng-click="openSalaryForm()"></a>
						</div>
					</div>
					<div class="form-edit" ng-show="show_frm_salary">
						<form  class="form-inline">
							<h4>What salary would you expect?</h4>
							<input type="text" class="form-control" id="input-salary" ng-model="salary_range">
						    <button type="button" class="btn btn-primary btn-save" ng-click="saveSalary()">Save</button>
						    <button type="button" class="btn btn-danger btn-close" ng-click="cancelSalary()">Cancel</button>
						</form>
					</div>
				</div>
			</div>
			<div id="job_term">
				<div>
					<h3 class="part">Job Term</h3>
					<div class="content-show" ng-hide="show_frm_job_term">
						<div class="items clearfix">
							<div class="item pull-left" ng-repeat="job_term in job_terms">
								<span class="cv-info">{% $last === false ? job_term.term + ',&nbsp;&nbsp;&nbsp;' : job_term.term %}</span>
							</div>
						</div>		
						<a href="" id="btn-show-formnew" ng-click="openJobTermForm()" ng-hide="job_terms.length"><i class="fa fa-plus-circle"></i>Add new</a>			
						<div class="card-btn-group" ng-show="job_terms.length">
							<a href="javascript:onclick" class="glyphicon glyphicon-pencil" ng-click="openJobTermForm()"></a>
						</div>
					</div>
					<div class="form-edit" ng-show="show_frm_job_term">
						<form  class="form-inline">
							<div class="item-add-new">
							    <h4>What location would you expect?</h4>
							   	<select class="form-control" id="input-job-term" ng-model="new_job_term.term_id">
							   		<option value="">---Job Term---</option>
									@foreach(\JobTerm::getJobTerms() as $job_term)
									<option value="{{$job_term->id}}">{{$job_term->term}}</option>
									@endforeach
							   	</select>
							    <button type="button" class="btn btn-primary btn-save" ng-click="createNewJobTerm(new_job_term)">Add</button>
							    <button type="button" class="btn btn-danger btn-close" ng-click="closeJobTermForm()">Close</button>
							 </div>
							 <div id="collection" class="clearfix" ng-show="job_terms.length">	
								<div class="item round-box-wrapper" ng-repeat="job_term in job_terms">
									<div class="span-content">
										<span>{% job_term.term %}</span>
										<a href="javascript:onclick" class="btn-remove glyphicon glyphicon-remove" ng-click="deleteJobterm(job_term)"></a>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div id="ref-card">
			<span class="card-article">Reference345</span>
			git from nak2bo
			git from nak2bo 2
			git from cuoool 
			<div class="items hide">
				<div class="items">
					<p>{{$candidate->cv->reference}}</p>			
				</div>
				<div class="card-btn-group">
					<a href="javascript:onclick" class="glyphicon glyphicon-pencil"></a>
				</div>
			</div>
			<form style="margin-top: 10px;">			  
			  <textarea id="textarea" placeholder="Enter text ..." style="width: 100%; height: 200px;"></textarea>
			</form>
		</div>
	</div>
	<div class="right-side-bar pull-left"></div>
</div>
@endsection

@section('script')
	<!--<script src="{{asset('assets/js/global.js')}}"></script>-->
	
	<script src="{{asset('assets/js/app.js')}}"></script>
	<script src="{{asset('assets/js/controllers/cveditCtrl.js')}}"></script>
	<script src="{{asset('assets/js/factories/cveditFact.js')}}"></script>
	<script src="{{asset('assets/js/directives/cveditDir.js')}}"></script>
<!-- 	<script src="{{asset('assets/js/lib/wysihtml5/parser_rules/advanced.js')}}"></script> -->
	<script src="{{asset('assets/js/lib/wysihtml5/wysihtml5-0.3.0_rc2.js')}}"></script>
	  <script src="{{asset('assets/js/lib/wysihtml5/bootstrap-wysihtml5.js')}}"></script>
	  <script>
	  $('#textarea').wysihtml5({
		  "stylesheets": ["{{asset('assets/js/lib/wysihtml5/css/wysihtml5.css')}}"], // CSS stylesheets to load
		  "color": true, // enable text color selection
		  "size": 'sm', // buttons size
		  "html": true, // enable button to edit HTML
		  "format-code" : true // enable syntax highlighting
		});
	  </script>
	  <link rel="stylesheet" href="{{asset('assets/js/lib/wysihtml5/css/bootstrap-wysihtml5.css')}}">
	  
@endsection
