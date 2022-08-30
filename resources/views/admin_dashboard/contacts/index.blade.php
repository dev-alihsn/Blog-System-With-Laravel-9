@extends("admin_dashboard.layouts.app")
@section("style")
<link href="{{asset('admin_dashboard_assets')}}/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
@endsection
		@section("wrapper")
        @if(session()->has('success'))
        <div class="alert alert-success global-message">
            {{session('success')}}
        </div>
        @endif
		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">home</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">categories</li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
						<div class="btn-group">
							<button type="button" class="btn btn-primary">Settings</button>
							<button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">	<span class="visually-hidden">Toggle Dropdown</span>
							</button>
							<div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">	<a class="dropdown-item" href="javascript:;">Action</a>
								<a class="dropdown-item" href="javascript:;">Another action</a>
								<a class="dropdown-item" href="javascript:;">Something else here</a>
								<div class="dropdown-divider"></div>	<a class="dropdown-item" href="javascript:;">Separated link</a>
							</div>
						</div>
					</div>
				</div>
				<!--end breadcrumb-->
			  
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example2" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>First Name</th>
										<th>Last Name</th>
										<th>Email</th>
										<th>Subject</th>
										<th>Message</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									@foreach($contacts as $contact)
									<tr>
										<td>{{$contact->fname}}</td>
										<td>{{$contact->lname}}</td>
										<td>{{$contact->email}}</td>
										<td>{{$contact->subject}}</td>
										<td>{{$contact->message}}</td>
										<td>
											<div class="d-flex order-actions">
                                                <form action="{{route('admin.contacts.destroy',$contact)}}" method="POST" id="delete_form_{{$contact->id}}">@csrf @method('DELETE')</form>
												<a href="#" onclick="this.preventDefualt;document.getElementById('delete_form_{{$contact->id}}').submit()" class="ms-3"><i class='bx bxs-trash'></i></a>
											</div>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--end page wrapper -->
		@endsection

        @section('script')
        <script>
            setTimeout(() => {
                $('.global-message').fadeOut();
            }, 4000);
        </script>
        <script src="{{asset('admin_dashboard_assets')}}/plugins/datatable/js/jquery.dataTables.min.js"></script>
        <script src="{{asset('admin_dashboard_assets')}}/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
        <script>
        $(document).ready(function() {
            var table = $('#example2').DataTable( {
                lengthChange: false,
                buttons: [ 'copy', 'excel', 'pdf', 'print']
            } );
        
            table.buttons().container()
                .appendTo( '#example2_wrapper .col-md-6:eq(0)' );
        } );
        </script>
        @endsection
	