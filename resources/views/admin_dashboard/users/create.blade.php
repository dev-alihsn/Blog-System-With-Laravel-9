
	@extends("admin_dashboard.layouts.app")
    <link href="{{asset('admin_dashboard_assets')}}/plugins/select2/css/select2.min.css" rel="stylesheet" />
	<link href="{{asset('admin_dashboard_assets')}}/plugins/select2/css/select2-bootstrap4.css" rel="stylesheet" />
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
                <div class="breadcrumb-title pe-3">Users</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Add New User</li>
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
                  <h5 class="card-title">Add New User</h5>
                  <hr/>
                  <form action="{{route('admin.users.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                   <div class="form-body mt-4">
                    <div class="row">
                       <div class="col-lg-12">
                       <div class="border border-3 p-4 rounded">
                        <div class="mb-3">
                            <select class="single-select" name="role_id" required>
                                @foreach($roles as $id => $role)
                                <option value="{{$id}}">{{$role}}</option>
                                @endforeach
                            </select>
                            @error('role_id')
                                <small class="error text-danger">{{$message}}</small>
                            @enderror
                          </div>
                          <div class="mb-3">
                            <label for="inputProductTitle" class="form-label">Name</label>
                            <input type="text" class="form-control" id="inputProductTitle" placeholder="Enter the user name" name="name" value="{{old("name")}}">
                            @error('name')
                                <small class="error text-danger">{{$message}}</small>
                            @enderror
                          </div>
                          <div class="mb-3">
                            <label for="inputProductTitle" class="form-label">Image</label>
                            <input type="file" class="form-control" id="inputProductTitle" name="image" value="{{old("image")}}">
                            @error('image')
                                <small class="error text-danger">{{$message}}</small>
                            @enderror
                          </div>
                          <div class="mb-3">
                            <label for="inputProductTitle" class="form-label">Email</label>
                            <input type="email" class="form-control" id="inputProductTitle" placeholder="Enter the user email" name="email" value="{{old("email")}}">
                            @error('email')
                                <small class="error text-danger">{{$message}}</small>
                            @enderror
                          </div>
                          <div class="mb-3">
                            <label for="inputProductTitle" class="form-label">password</label>
                            <input type="password" class="form-control" id="inputProductTitle" placeholder="*****" name="password" value="{{old("password")}}">
                            @error('password')
                                <small class="error text-danger">{{$message}}</small>
                            @enderror
                          </div>
                          <div class="mb-3">
                            <input type="submit" class="btn btn-primary" value="Add User" />
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
<script src="{{asset('admin_dashboard_assets')}}/plugins/select2/js/select2.min.js"></script>
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