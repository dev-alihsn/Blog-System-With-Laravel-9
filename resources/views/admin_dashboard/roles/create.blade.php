
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
                <div class="breadcrumb-title pe-3">Roles</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Add new role</li>
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
                  <h5 class="card-title">Add New Role</h5>
                  <hr/>
                  <form action="{{route('admin.roles.store')}}" method="POST">
                    @csrf
                   <div class="form-body mt-4">
                    <div class="row">
                       <div class="col-lg-12">
                       <div class="border border-3 p-4 rounded">
                        <div class="mb-3">
                            <label for="inputProductTitle" class="form-label">Role Name</label>
                            <input type="text" class="form-control" id="inputProductTitle" placeholder="Enter role name" name="name" value="{{old("name")}}" required>
                            @error('name')
                                <small class="error text-danger">{{$message}}</small>
                            @enderror
                          </div>
                          <div class="mb-3 d-flex justify-content-between flex-wrap p-1">
                            @foreach($permissions as $permission)
                            <label class="form-label" style="width:30%;">
                                <input type="checkbox" name="permissions[]" value="{{$permission->id}}"> 
                                {{$permission->name}}
                            </label>
                            @endforeach
                          </div>
                          <div class="mb-3">
                            <input type="submit" class="btn btn-primary" value="Add Rule" />
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
