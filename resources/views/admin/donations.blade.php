@extends('admin.layout')

@section('content')
	<h5 class="mb-4 fw-light">
    <a class="text-reset" href="{{ url('panel/admin') }}">{{ __('admin.dashboard') }}</a>
      <i class="bi-chevron-right me-1 fs-6"></i>
      <span class="text-muted">{{ __('misc.donations') }}</span>
  </h5>

<div class="content">
	<div class="row">

		<div class="col-lg-12">

			@if (session('success_message'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
              <i class="bi bi-check2 me-1"></i>	{{ session('success_message') }}

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                </button>
                </div>
              @endif

			<div class="card shadow-custom border-0">
				<div class="card-body p-lg-4">

					<div class="table-responsive p-0">
						<table class="table table-hover">
						 <tbody>

                  @if ($data->count() !=  0)
                     <tr>
											 <th class="active">ID</th>
                       <th class="active">{{ __('auth.full_name') }}</th>
                       <th class="active">{{ trans_choice('misc.campaigns_plural', 1) }}</th>
                       <th class="active">{{ __('misc.donation') }}</th>
                       <th class="active">{{ __('misc.earnings') }}  ({{__('users.admin') }})</th>
                       <th class="active">{{ __('misc.payment_gateway') }}</th>
                       <th class="active">{{ __('misc.reward') }}</th>
                       <th class="active">{{ __('admin.date') }}</th>
											 <th class="active">{{ __('auth.status') }}</th>
                       <th class="active">{{ __('admin.actions') }}</th>
                      </tr>

                    @foreach ($data as $donation)
											<tr>
	                      <td>{{ $donation->id }}</td>
	                      <td>{{ $donation->fullname }}</td>
	                      <td>
	                          @if(isset($donation->campaigns()->id))
	                        <a href="{{url('campaign',$donation->campaigns_id)}}" target="_blank">
	                        {{ str_limit($donation->campaigns()->title, 10, '...') }} <i class="bi-box-arrow-up-right"></i>
	                      </a>
	                      @else
	                      <em class="text-muted">{{__('misc.campaign_deleted')}}</em>
	                      @endif
	                      </td>
	                      <td>{{ App\Helper::amountFormat($donation->donation) }}</td>
	                      <td>{{ $donation->approved == '1' ? App\Helper::earningsNetDonation($donation->id, 'admin') : __('misc.not_available') }}</td>
	                      <td>{{ $donation->payment_gateway }}</td>
	                      <td>@if( $donation->rewards_id )<i class="bi-gift"></i>@else - @endif</td>
	                      <td>{{ date($settings->date_format, strtotime($donation->date)) }}</td>
												<td>
													@if ($donation->approved == 0)
													<span class="badge bg-warning text-dark text-uppercase">{{__('admin.pending')}}</span>
												@else
													<span class="badge bg-success text-uppercase">{{__('misc.success')}}</span>
												@endif
												</td>

	                      <td>

													<div class="d-flex">

													<button type="button" data-bs-toggle="modal" data-bs-target="#viewDetail{{ $donation->id }}" class="btn btn-success showTooltip rounded-pill btn-sm padding-btn me-2" title="{{ __('admin.view') }}">
						                <i class="bi-eye"></i>
						              </button>

	                        @if ($donation->approved == 0)

														{{-- Delete Donation --}}
														<form method="POST" action="{{ url('approve/donation') }}" accept-charset="UTF-8" class="d-inline-block me-2" enctype="multipart/form-data">
															@csrf
																<input name="id" type="hidden" value="{{ $donation->id }}">
																<button class="btn btn-success rounded-pill btn-sm e-none" type="submit" title="{{ __('misc.approve_donation') }}"><i class="bi-check2"></i></button>
														</form>

														{{-- Delete Donation --}}
														<form method="POST" action="{{ url('delete/donation') }}" accept-charset="UTF-8" class="d-inline-block" enctype="multipart/form-data">
															@csrf
															<input name="id" type="hidden" value="{{ $donation->id }}">
															<button class="btn btn-danger rounded-pill btn-sm e-none actionDelete" type="submit" title="{{ __('misc.delete') }}"><i class="bi-trash3"></i></button>
														</form>
	                        @endif

													</div>

	                      </td>
	                    </tr><!-- /.TR -->

											<!-- Modal -->
						          <div class="modal fade" id="viewDetail{{ $donation->id }}" tabindex="-1" aria-labelledby="viewDetail{{ $donation->id }}" aria-hidden="true">
						            <div class="modal-dialog">
						              <div class="modal-content">
						                <div class="modal-header border-0">
						                  <h5 class="modal-title" id="viewDetail{{ $donation->id }}">{{ __('misc.donation') }} #{{$donation->id}}</h5>
						                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						                </div>
						                <div class="modal-body">
						                  <dl class="dl-horizontal">
						                  <!-- start -->
						                  <dt>{{ __('auth.full_name') }}</dt>
						                  <dd>{{$donation->fullname}}</dd>
						                  <!-- ./end -->

						                  <!-- start -->
						                  <dt>{{ trans_choice('misc.campaigns_plural', 1) }}</dt>
						                  <dd>
											@if (!isset($donation->campaigns()->id))
											{{ __('misc.campaign_deleted') }}
											@else
											<a href="{{url('campaign', $donation->campaigns()->id)}}" target="_blank">
											{{ $donation->campaigns()->title }} <i class="bi-box-arrow-up-right ms-1"></i>
											</a>
											@endif
										</dd>
						                  <!-- ./end -->

						                  <!-- start -->
						                  <dt>{{ __('auth.email') }}</dt>
						                  <dd>{{$donation->email}}</dd>
						                  <!-- ./end -->

						                  <!-- start -->
						                  <dt>{{ __('misc.donation') }}</dt>
						                  <dd><strong class="text-success">{{App\Helper::amountFormat($donation->donation)}}</strong></dd>
						                  <!-- ./end -->

						                  <!-- start -->
						                  <dt>{{ __('misc.country')  }}</dt>
						                  <dd>{{$donation->country}}</dd>
						                  <!-- ./end -->

						                  <!-- start -->
						                  <dt>{{ __('misc.postal_code') }}</dt>
						                  <dd>{{$donation->postal_code}}</dd>
						                  <!-- ./end -->

						                  <!-- start -->
						                  <dt>{{ __('misc.payment_gateway') }}</dt>
						                  <dd>{{$donation->payment_gateway}}</dd>
						                  <!-- ./end -->

										  @if ($donation->payment_gateway == 'Bank Transfer' && $donation->bank_transfer == '')
											<br />
											<dt>{{ __('misc.bank_swift_code') }}</dt>
													<dd>{{$donation->bank_swift_code}}</dd>

											<dt>{{ __('misc.account_number') }}</dt>
													<dd>{{$donation->account_number}}</dd>

											<dt>{{ __('misc.branch_name') }}</dt>
													<dd>{{$donation->branch_name}}</dd>

											<dt>{{ __('misc.branch_address') }}</dt>
													<dd>{{$donation->branch_address}}</dd>

											<dt>{{ __('misc.account_name') }}</dt>
													<dd>{{$donation->account_name}}</dd>

											<dt>{{ __('misc.iban') }}</dt>
													<dd>{{$donation->iban}}</dd>
											<br />

											@elseif ($donation->payment_gateway == 'Bank Transfer' && $donation->bank_transfer != '')
											<dt>{{ __('admin.bank_transfer_details') }}</dt>
													<dd>{!! nl2br($donation->bank_transfer) !!}</dd>
											<br />
											@endif

						                  <!-- start -->
						                  <dt>{{ __('misc.comment') }}</dt>
						                  <dd>
						                  @if( $donation->comment != '' )
						                  {{$donation->comment}}
						                  @else
						                  -------------------------------------
						                  @endif
						                  </dd>
						                  <!-- ./end -->

						                  <!-- start -->
						                  <dt>{{ __('admin.date') }}</dt>
						                  <dd>{{date($settings->date_format, strtotime($donation->date))}}</dd>
						                  <!-- ./end -->

						                  <!-- start -->
						                  <dt>{{ __('misc.anonymous') }}</dt>
						                  <dd>
						                  @if( $donation->anonymous == '1' )
						                  {{__('misc.yes')}}
						                  @else
						                  {{__('misc.no')}}
						                  @endif
						                  </dd>
						                  <!-- ./end -->

						                  <!-- start -->
						                  <dt>{{ __('misc.reward') }}</dt>
						                  <dd>
						                  @if( $donation->rewards_id )
						                  <strong>ID</strong>: {{$donation->rewards()->id}} <br />
						                  <strong>{{__('misc.title')}}</strong>: {{$donation->rewards()->title}} <br />
						                  <strong>{{__('misc.amount')}}</strong>: {{$settings->currency_symbol.$donation->rewards()->amount}} <br />
						                  <strong>{{__('misc.delivery')}}</strong>: {{ date('F, Y', strtotime($donation->rewards()->delivery)) }} <br />
						                  <strong>{{__('misc.description')}}</strong>:{{$donation->rewards()->description}}
						                  @else
						                  {{__('misc.no')}}
						                  @endif
						                  </dd>
						                  <!-- ./end -->
						                  </dl>

						                </div>
						              </div>
						            </div>
						          </div><!-- End Modal -->
                      @endforeach

									@else
										<h5 class="text-center p-5 text-muted fw-light m-0">{{ __('misc.no_results_found') }}</h5>
									@endif

								</tbody>
								</table>
							</div><!-- /.box-body -->

				 </div><!-- card-body -->
 			</div><!-- card  -->

			@if( $data->lastPage() > 1 )
		 {{ $data->onEachSide(0)->links() }}
		 @endif
 		</div><!-- col-lg-12 -->

	</div><!-- end row -->
</div><!-- end content -->
@endsection
