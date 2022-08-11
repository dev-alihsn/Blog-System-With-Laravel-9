@extends('main_layouts.master')
@section('title','MyBlog | categories')
@section('content')
		<div class="colorlib-blog">
			<div class="container">
				<div class="row">
					<div class="col-md-12 row">
                        @forelse($categories as $category)
                        <div class="col-md-3">
                         <div class="block-21 d-flex animate-box">
                            <a href="{{ route('categories.show',$category) }}" class="blog-img"></a>
                            <div class="text"  style="width: 100%">
                               <h3 class="heading"><a href="{{ route('categories.show',$category) }}">{{$category->name}}</a></h3>
                               <div class="meta">
                                  <div><a href="#"><span class="icon-calendar"></span> {{$category->created_at->diffForHumans()}}</a></div>
                                  <div><a href="#"><span class="icon-user2"></span> {{$category->user->name}}</a></div>
                                  <div><a href="#"><span class="icon-archive"></span> {{$category->posts_count}}</a></div>
                               </div>
                            </div>
                         </div>
                        </div>
                        @empty
                            <p class="lead">
                                There are no categories yet to show.
                            </p>
                        @endforelse
                        {{$categories->links()}}
					</div>
				</div>
			</div>
		</div>
@endsection