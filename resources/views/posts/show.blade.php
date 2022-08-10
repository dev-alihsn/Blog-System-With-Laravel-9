@extends('main_layouts.master')
@section('title','MyBlog | '. $post->title)
@section('content')
<div class="colorlib-classes">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="row row-pb-lg">
                    <div class="col-md-12 animate-box">
                        <div class="classes class-single">
                            <div class="classes-img" style="background-image: url({{$post->image()->first()->path}});">
                            </div>
                            <div class="desc desc2">
                                <h3><a href="#">{{$post->title}}</a></h3>
                                <p>When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her own road, the Line Lane. Pityful a rethoric question ran over her cheek, then she continued her way.</p>
                                <p>The Big Oxmox advised her not to do so, because there were thousands of bad Commas, wild Question Marks and devious Semikoli, but the Little Blind Text didn’t listen. She packed her seven versalia, put her initial into the belt and made herself on the way.</p>
                                <blockquote>
                                    The Big Oxmox advised her not to do so, because there were thousands of bad Commas, wild Question Marks and devious Semikoli, but the Little Blind Text didn’t listen. She packed her seven versalia, put her initial into the belt and made herself on the way.
                                </blockquote>
                                <h3>Some Features</h3>
                                <p>The Big Oxmox advised her not to do so, because there were thousands of bad Commas, wild Question Marks and devious Semikoli, but the Little Blind Text didn’t listen. She packed her seven versalia, put her initial into the belt and made herself on the way.</p>

                                <p>On her way she met a copy. The copy warned the Little Blind Text, that where it came from it would have been rewritten a thousand times and everything that was left from its origin would be the word "and" and the Little Blind Text should turn around and return to its own, safe country. But nothing the copy said could convince her and so it didn’t take long until a few insidious Copy Writers ambushed her, made her drunk with Longe and Parole and dragged her into their agency, where they abused her for their.</p>
                                <p><a href="#" class="btn btn-primary btn-outline btn-lg">Live Preview</a> or <a href="#" class="btn btn-primary btn-lg">Download File</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row row-pb-lg animate-box">
                    <div class="col-md-12">
                        <h2 class="colorlib-heading-2">{{$post->comments()->count()}} Comments</h2>
                        @foreach($post->comments()->get() as $comment)
                        <div id="comment_{{$comment->id}}" class="review">
                           <div class="user-img" style="background-image: url({{ ($comment->user->image) ? $comment->user->image->path : 'https://via.placeholder.com/640x480.png'; }})"></div>
                           <div class="desc">
                               <h4>
                                   <span class="text-left">{{$comment->user->name}}</span>
                                   <span class="text-right">{{$comment->created_at->diffForHumans()}}</span>
                               </h4>
                               <p>{{$comment->the_comment}}</p>
                               <p class="star">
                                   <span class="text-left"><a href="#" class="reply"><i class="icon-reply"></i></a></span>
                               </p>
                           </div>
                       </div>
                       @endforeach

                    </div>
                </div>
        
                <div class="row animate-box">
                    <div class="col-md-12">
                        <h2 class="colorlib-heading-2">Say something</h2>
                        <x-blog.message status="success"/>
                        @if(auth()->check())
                        <form action="{{route('posts.add_comment',$post)}}" method="POST">
                            @csrf
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <!-- <label for="message">Message</label> -->
                                    <textarea name="the_comment" id="message" cols="30" rows="10" class="form-control" placeholder="Say something about us"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Post Comment" class="btn btn-primary">
                            </div>
                        </form>	
                        @else
                        <p>You must be registered to comment <a href="{{route('login')}}">sign in</a> or <a href="{{route('register')}}">signup</a> if don't have an accont</p>
                        @endif
                    </div>
                </div>
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