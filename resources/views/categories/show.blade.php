@extends('main_layouts.master')
@section('title','MyBlog | '. $category->name)
@section('content')
		<div class="colorlib-blog">
			<div class="container">
				<div class="row">
					<div class="col-md-8">
                        @forelse($posts as $post)
                         <div class="block-21 d-flex animate-box">
                            <a href="{{ route('posts.show',$post) }}" class="blog-img" style="background-image: url({{$post->image->path}});"></a>
                            <div class="text">
                               <h3 class="heading"><a href="{{ route('posts.show',$post) }}">{{$post->title}}</a></h3>
                               <p>{{$post->excerpt}}</p>
                               <div class="meta">
                                  <div><a href="#"><span class="icon-calendar"></span> {{$post->created_at->diffForHumans()}}</a></div>
                                  <div><a href="#"><span class="icon-user2"></span> {{$post->author->name}}</a></div>
                                  <div><a href="#"><span class="icon-chat"></span> {{$post->comments_count}}</a></div>
                               </div>
                            </div>
                         </div>
                        @empty
                            <p class="lead">
                                There are no posts realted to this category.
                            </p>
                        @endforelse
                        {{$posts->links()}}
					</div>

					<div class="col-md-4 animate-box">
						<div class="sidebar">
							<x-blog.categories-side :categories="$categories"/>
							<x-blog.recent-blog :recent_posts="$recent_posts"/>
							<x-blog.tags-side :tags="$tags"/>
						</div>
					</div>
				</div>
			</div>
		</div>
@endsection

