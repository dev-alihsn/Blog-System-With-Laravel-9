
	@extends("admin_dashboard.layouts.app")

	@section("style")
    <link href="{{asset('admin_dashboard_assets')}}/plugins/input-tags/css/tagsinput.css" rel="stylesheet" />
    <link href="{{asset('admin_dashboard_assets')}}/plugins/select2/css/select2.min.css" rel="stylesheet" />
	<link href="{{asset('admin_dashboard_assets')}}/plugins/select2/css/select2-bootstrap4.css" rel="stylesheet" />
    <script src="https://cdn.tiny.cloud/1/e33fttcqjuoso844fwsu095r2ve5cuvrvum6olzjf1pseqx6/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
	@endsection
		
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
					  <h5 class="card-title">Add New Product</h5>
					  <hr/>
                      <form action="{{route('admin.posts.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                       <div class="form-body mt-4">
					    <div class="row">
						   <div class="col-lg-12">
                           <div class="border border-3 p-4 rounded">
							<div class="mb-3">
								<label for="inputProductTitle" class="form-label">Post Title</label>
								<input type="text" class="form-control" id="inputProductTitle" placeholder="Enter post title" name="title" value="{{old("title")}}">
                                @error('title')
                                    <small class="error text-danger">{{$message}}</small>
                                @enderror
							  </div>
                              <div class="mb-3">
								<label for="inputProductTitle" class="form-label">Post slug</label>
								<input type="text" class="form-control" id="inputProductTitle" placeholder="Enter post slug" name="slug" value="{{old('slug')}}">
                                @error('slug')
                                    <small class="error text-danger">{{$message}}</small>
                                @enderror
							  </div>
							  <div class="mb-3">
								<label for="inputProductDescription" class="form-label">Post Excerpt</label>
								<textarea class="form-control" id="inputProductDescription" rows="3" name="excerpt">{{old('excerpt')}}</textarea>
                                @error('excerpt')
                                    <small class="error text-danger">{{$message}}</small>
                                @enderror
							  </div>
                              <div class="mb-3">
								<label for="inputProductTitle" class="form-label">Post category</label>
                                <div class="card">
                                    <div class="card-body">
                                        <div class=" p-3 ">
                                            <div class="mb-3">
                                                <select class="single-select" name="category" required>
                                                    @foreach($categories as $id => $category)
                                                    <option value="{{$id}}">{{$category}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Post Tags</label>
                                                <input type="text" class="form-control" data-role="tagsinput" name="tags" value="{{old('tags')}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
							  </div>
                              <div class="mb-3">
								<label for="inputProductDescription" class="form-label">Post Thumbnail</label>
								<input id="image-uploadify" type="file" name="thumbnail" value="{{old('thumbnail')}}" accept="image/*" multiple />
                                @error('thumbnail')
                                    <small class="error text-danger">{{$message}}</small>
                                @enderror
							  </div>
                              <div class="mb-3">
								<label for="inputProductDescription" class="form-label">Post content</label>
								<textarea id="post_content" class="form-control" id="inputProductDescription" rows="3" name="body" value="{{old('body')}}"></textarea>
                                @error('body')
                                    <small class="error text-danger">{{$message}}</small>
                                @enderror
							  </div>
                              <div class="mb-3">
                                <input type="submit" class="btn btn-primary" value="Add Post" />
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
            tinymce.init({
              selector:'#post_content',
              plugins: 'a11ychecker advcode casechange export formatpainter image editimage linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tableofcontents tinycomments tinymcespellchecker',
              toolbar_mode:'floating',
              height:'500',
              toolbar: 'a11ycheck addcomment showcomments casechange checklist code export formatpainter image editimage pageembed permanentpen table tableofcontents',
              toolbar_mode:'floating',
              image_title:true,
              automatic_uploads:true,
              tinycomments_mode: 'embedded',
              tinycomments_author: 'Author name',
              images_upload_handler: function(blobinfo,success,failure){
                console.log(blobinfo)
                console.log(success)
                console.log(failure)
                let xhr = new XMLHttpRequest();
                let formData = new FormData();
                let token = $('input[name="_token"]').val();
                xhr.open('post','{{route('admin.upload_tinymce_image')}}');
                xhr.onload = function(){
                    if(xhr.status !== 200){
                        failure('Http error: ' + xhr.status);
                        return
                    }
                    let json = JSON.parse(xhr.responseText);
                    if(! json || typeof json.location != 'string'){
                        failure('invalid json: ' + xhr.responseText);
                        return
                    }
                    success(json.location)
                }
                formData.append('_token',token);
                formData.append('file',blobinfo.blob(),blobinfo.filename());
                xhr.send(formData);
              }
            });

            setTimeout(() => {
                $('.global-message').fadeOut();
            }, 4000);
          </script>
          	<script src="{{asset('admin_dashboard_assets')}}/plugins/input-tags/js/tagsinput.js"></script>
	@endsection
