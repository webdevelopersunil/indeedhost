@extends('frontend.layouts.master')
@section('content')
<div class="about-us">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-5 about-box-main">
				<div class="about-sidebar">
					<div class="sidebar-inner">
						<div class="about-box">

						@if(!empty($projectDetail->picture))
							<img src="{{ route('image.displayImage',$projectDetail->picture) }}" alt="client">
						@else
							<img src="{{ asset('dist/images/home-box.png') }}">
						@endif

							<div class="about-box-top">
								<a class="back-btn" href="{{ route('myProjectsList') }}">
								<img src="{{ asset('dist/images/arrow-left.png') }}">
								<img class="arrow-img2" src="{{ asset('dist/images/arrow-left2.png') }}"></a>
							</div>

							<div class="about-box-inner">
								<h2>{{$projectDetail->project_title}}</h2>
							</div>
						</div>
					</div>


					<div class="sidebar-inner sidebar-bottom">
						<div class="sidebar-list">
							<div class="list-inner">
								<h6>{{ __('sentence.managed_by')}}:</h6>
								<span>{{ $projectDetail->project_manager->name }}</span>
							</div>
							<div class="list-inner">
								@if(!empty($projectDetail->project_manager->avatar))
									<img src="{{ route('image.displayImage',$projectDetail->project_manager->avatar) }}" alt="client">
								@else
									<img src="{{ asset('dist/images/user-profile.png') }}">
								@endif
							</div>
						</div>
						<div class="sidebar-list sidebar-text">
							<div class="list-inner">
								<h6>{{ __('sentence.project_members')}}:</h6>
								<span>
									@if(!empty($allMembers))
										{{$allMembers}}
									@else
										{{__('No Members')}}
									@endif
								</span>
							</div>
						</div>

						<div class="sidebar-list">
							<ul>

								@if(!empty($projectDetail->status))
									<li><h6>{{ __('sentence.start')}}:</h6><span>
											{{ date('d-m-Y', strtotime($projectDetail->status->real_start_date)) }}
									</span></li>
								@endif

								@if(!empty($projectDetail->status))
									<li><h6>{{ __('sentence.end')}} (est.):</h6><span>
											{{ date('d-m-Y', strtotime($projectDetail->status->realistic_end_date)) }}
									</span></li>
								@endif

								<li><h6>{{ __('sentence.sponsor')}}:</h6><span>{{ $projectDetail->sponsor_name }}</span></li>

								@if(!empty($projectDetail->status->percentage_completion))
									<li><h6>{{ __('sentence.progress')}}:</h6><span>
										{{ $projectDetail->status->percentage_completion }}%
									</span></li>
								@endif


								<!-- For Logged In User -->
								@if(Auth::user())
									@if(Auth::user() && $isFrontEndValid==1 )
										<li><h6>{{ __('sentence.public')}} :</h6><span>
											@if($projectDetail->is_public==1) YES @else NO @endif
										</span></li>
									@endif
									@if(!empty($projectDetail->is_group))
										<li><h6>{{ __('sentence.group_project')}} :</h6><span>
											@if($projectDetail->is_group==1) YES @else NO @endif
										</span></li>
									@endif
								@endif


								@if(!empty($projectDetail->status->updated_at))
									<li><h6>{{ __('sentence.last_update')}} :</h6><span>
										{{ date('d-m-Y', strtotime($projectDetail->status->updated_at)) }}
									</span></li>
								@else
									<li><h6>{{ __('sentence.last_update')}} :</h6><span>
										{{ date('d-m-Y', strtotime($projectDetail->status->created_at ?? $projectDetail->created_at)) }}
									</span></li>
								@endif
							</ul>
						</div>
					</div>



				</div>
			</div>

		<div class="col-lg-8 col-md-8 col-sm-7 about-right">
			<div class="about-content">
				<h2>{{ __('sentence.about')}}</h2>
				<p>
					@if(!empty($projectDetail->project_description))
						{{$projectDetail->project_description}}
					@else
						{{__('No content.')}}
					@endif
				</p>
			</div>


			@if(Auth::user() && $projectDetail->is_active==1 && $isFrontEndValid==1 && !empty($projectDetail->status) )
				<div class="about-details">
					<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
					  <div class="panel-body">
						<div class="about-content-inner">
							<h2>{{ __('sentence.current_situation')}}</h2>
							<p>
								@if(!empty($projectDetail->current_situation))
									{{ $projectDetail->current_situation }}
								@else
									No Content Found
								@endif
							</p>
						</div>
						<div class="about-content-inner">
							<h2>{{ __('sentence.PREREQUISITES_DEPENDENCIES_AND_EXCLUSIONS')}}</h2>
							<p>
								@if(!empty($projectDetail->prerequisite_dependencies_exclusions))
									{{ $projectDetail->prerequisite_dependencies_exclusions }}
								@else
									No Content Found
								@endif
							</p>
						</div>
						<div class="about-content-inner">
							<h2>{{ __('sentence.alternatives_options')}}</h2>
							<p>
								@if(!empty($projectDetail->alternative_or_options))
									{{ $projectDetail->alternative_or_options }}
								@else
									No Content Found
								@endif
							</p>
						</div>
						<div class="about-content-inner">
							<h2>{{ __('sentence.milestones')}}</h2>
							<p>
								@if(!empty($projectDetail->milestones))
									{{ $projectDetail->milestones }}
								@else
									No Content Found
								@endif
							</p>
						</div>
						<div class="about-content-inner">
							<h2>{{ __('sentence.required_resources_financial_human_material')}}</h2>
							<p>
								@if(!empty($projectDetail->required_resources))
									{{ $projectDetail->required_resources }}
								@else
									No Content Found
								@endif
							</p>
						</div>
					  </div>
					</div>
					<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
						<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
						  <span>+</span><span class="minus-icon"></span>{{ __('sentence.show_details')}}
						</a>
					</div>
				</div>


				<div class="feedback-section">
					<h2>{{ __('sentence.project_managers_feedback')}}</h2>
					<div class="col-md-4 col-sm-6 feedback-main">
						<div class="manager-feedback">
							<div class="feedback-heading">
								<div class="feedback-time">
									<img src="{{ asset('dist/images/time-icon.png') }}">
								</div>
								<h2>{{ __('sentence.time')}}</h2>
							</div>
							<div class="feedback-content">
								<p>
									@if(!empty($projectDetail->status->time_planning_explanation))
											{{$projectDetail->status->time_planning_explanation}}
										@else
											No Content
									@endif
								</p>
							</div>
						</div>
					</div>

					<div class="col-md-4 col-sm-6 feedback-main">
						<div class="manager-feedback">
							<div class="feedback-heading">
								<div class="feedback-time">
									<img src="{{ asset('dist/images/quality-icon2.png') }}">
								</div>
								<h2>{{ __('sentence.quality')}}</h2>
							</div>
							<div class="feedback-content">
								<p>
									@if(!empty($projectDetail->status->current_quality_explanation))
											{{$projectDetail->status->current_quality_explanation}}
										@else
											No Content
									@endif
								</p>
							</div>
						</div>
					</div>

					<div class="col-md-4 col-sm-6 feedback-main">
						<div class="manager-feedback">
							<div class="feedback-heading">
								<div class="feedback-time">
									<img src="{{ asset('dist/images/coins1.png') }}">
								</div>
								<h2>{{ __('sentence.costs')}}</h2>
							</div>
							<div class="feedback-content">
								<p>
									@if(!empty($projectDetail->status->cost_situation_explanation))
										{{$projectDetail->status->cost_situation_explanation}}
									@else
										No Content
									@endif
								</p>
							</div>
						</div>
					</div>

				</div>

			@endif

				<div class="project-details-main about-documents">
					<h2>{{ __('sentence.attached_files')}}</h2>
					<div class="project-tagsarea">
						@if(!empty($projectDetail->files) && count($projectDetail->files)>0 )
							@foreach($projectDetail->files as $file)
								<div class="add-tags">
									@if($file->is_public==0 && $isFrontEndValid==1)
										<p><a href="{{ route('getDownloadFile',$file->id) }}" >{{ $file->document }}</a> <span><img src="{{url('dist/images/block.png')}}"></span></p>
									@elseif($file->is_public==1)
										<p><a href="{{ route('getDownloadFile',$file->id) }}" >{{ $file->document }}</a> <span></p>
									@endif
								</div>
							@endforeach
						@else
							<div class="add-tags">
								<p>No Attached Files</p>
							</div>
						@endif
					</div>
				</div>


			</div>			
		</div>
	</div>
</div>

@endsection