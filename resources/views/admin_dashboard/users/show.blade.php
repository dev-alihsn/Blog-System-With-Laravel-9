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
					<div class="breadcrumb-title pe-3">{{$user->name}} Posts</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">{{$user->name}}</li>
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
						  <div class="ms-auto"><a href="javascript:;" class="btn btn-primary radius-30 mt-2 mt-lg-0"><i class="bx bxs-plus-square"></i>Add New post</a></div>
						</div>
						<div class="table-responsive">
							<table class="table mb-0">
								<thead class="table-light">
									<tr>
										<th>Post#</th>
										<th>Post Title</th>
										<!--<th>Post Excerpt</th>-->
										<th>user</th>
										<th>Created At</th>
										<th>Status</th>
                                        <td>Views</td>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
                                    @foreach($user->posts as $post)
									<tr>
										<td>
											<div class="d-flex align-items-center">
												<div>
													<input class="form-check-input me-3" type="checkbox" value="" aria-label="...">
												</div>
												<div class="ms-2">
													<h6 class="mb-0 font-14">#{{$post->id}}</h6>
												</div>
											</div>
										</td>
										<td>{{$post->title}}</td>
                                        <!--<td>{{$post->excerpt}}</td>-->
										<td>{{$post->user ? $post->user->name : 'no categories'}}</td>
                                        <td>{{$post->created_at->diffForHumans()}}</td>
                                        <td><div class="badge rounded-pill @if($post->status == 'published') text-success bg-light-success @elseif($post->status == 'draft')text-warning bg-light-warning @else text-danger bg-light-danger @endif p-2 text-uppercase px-3"><i class='bx bxs-circle me-1'></i>{{$post->status}}</div></td>
										<td>{{$post->views}}</td>
										<td>
											<div class="d-flex order-actions">
												<a href="{{route('admin.posts.edit',$post)}}" class=""><i class='bx bxs-edit'></i></a>
                                                <form action="{{route('admin.posts.destroy',$post)}}" method="POST" id="delete_form_{{$post->id}}">@csrf @method('DELETE')</form>
												<a href="#" onclick="this.preventDefualt;document.getElementById('delete_form_{{$post->id}}').submit()" class="ms-3"><i class='bx bxs-trash'></i></a>
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
        @endsection
	