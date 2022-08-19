@extends("admin_dashboard.layouts.app")
		
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
					<div class="breadcrumb-title pe-3">eCommerce</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Orders</li>
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
						<div class="d-lg-flex align-items-center mb-4 gap-3">
							<div class="position-relative">
								<input type="text" class="form-control ps-5 radius-30" placeholder="Search Order"> <span class="position-absolute top-50 product-show translate-middle-y"><i class="bx bx-search"></i></span>
							</div>
						  <div class="ms-auto"><a href="javascript:;" class="btn btn-primary radius-30 mt-2 mt-lg-0"><i class="bx bxs-plus-square"></i>Add New Order</a></div>
						</div>
						<div class="table-responsive">
							<table class="table mb-0">
								<thead class="table-light">
									<tr>
										<th>Tag#</th>
										<th>Tag Name</th>
										<!--<th>tag Excerpt</th>-->
                                        <td>Tag Posts Count</td>
										<th>Created At</th>
										<th>Realted tags</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
                                    @foreach($tags as $tag)
									<tr>
										<td>
											<div class="d-flex align-items-center">
												<div>
													<input class="form-check-input me-3" type="checkbox" value="" aria-label="...">
												</div>
												<div class="ms-2">
													<h6 class="mb-0 font-14">#{{$tag->id}}</h6>
												</div>
											</div>
										</td>
										<td>{{$tag->name}}</td>
                                        <td>{{$tag->posts_count}}</td>
                                        <!--<td>{{$tag->excerpt}}</td>-->
                                        <td>{{$tag->created_at->diffForHumans()}}</td>
                                        <td><a href="{{route('admin.tags.show',$tag)}}" class="btn btn-primary btn-sm radius-30 px-4">Realted Posts</a></td>
										<td>
											<div class="d-flex order-actions">
                                                <form action="{{route('admin.tags.destroy',$tag)}}" method="POST" id="delete_form_{{$tag->id}}">@csrf @method('DELETE')</form>
												<a href="#" onclick="this.preventDefualt;document.getElementById('delete_form_{{$tag->id}}').submit()" class="ms-3"><i class='bx bxs-trash'></i></a>
											</div>
										</td>
									</tr>
                                    @endforeach
								</tbody>
							</table>
                            {{$tags->links()}}
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
        @endsection
	