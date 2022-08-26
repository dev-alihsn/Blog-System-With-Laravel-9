
	@extends("admin_dashboard.layouts.app")
		
		@section("wrapper")
		<!--start page wrapper -->
        @if(session()->has('success'))
        <div class="alert alert-success global-message">
            {{session('success')}}
        </div>
        @endif
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
				  <div class="card-body p-4">
					  <h5 class="card-title">Add New Category</h5>
					  <hr/>
                      <form action="{{route('admin.categories.store')}}" method="POST">
                        @csrf
                       <div class="form-body mt-4">
					    <div class="row">
						   <div class="col-lg-12">
                           <div class="border border-3 p-4 rounded">
							<div class="mb-3">
								<label for="inputProductTitle" class="form-label">Category Name</label>
								<input type="text" class="form-control" id="inputProductTitle" placeholder="Enter post title" name="name" value="{{old("name")}}">
                                @error('name')
                                    <small class="error text-danger">{{$message}}</small>
                                @enderror
							  </div>
                              <div class="mb-3">
								<label for="inputProductTitle" class="form-label">Category slug</label>
								<input type="text" class="form-control" id="inputProductTitle" placeholder="Enter post slug" name="slug" value="{{old('slug')}}">
                                @error('slug')
                                    <small class="error text-danger">{{$message}}</small>
                                @enderror
							  </div>
                              <div class="mb-3">
                                <input type="submit" class="btn btn-primary" value="Add Role" />
                              </div>
                            </div>
						   </div>
						  </div>
					   </div><!--end row-->
                      </form>
					</div>
                </div>
			</div>
		</div>
		<!--end page wrapper -->
		@endsection
	
	@section("script")
        <script>
            $(document).ready(function () {
                $('#image-uploadify-').imageuploadify();
            })
        </script>
    	<script>
            $('.single-select').select2({
                theme: 'bootstrap4',
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                placeholder: $(this).data('placeholder'),
                allowClear: Boolean($(this).data('allow-clear')),
            });
            $('.multiple-select').select2({
                theme: 'bootstrap4',
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                placeholder: $(this).data('placeholder'),
                allowClear: Boolean($(this).data('allow-clear')),
            });
        </script>
          <script>
            setTimeout(() => {
                $('.global-message').fadeOut();
            }, 4000);
          </script>
	@endsection
