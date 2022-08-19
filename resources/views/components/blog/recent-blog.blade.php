@props(['recent_posts'])
<div class="side">
    <h3 class="sidebar-heading">Recent Blog</h3>
    @foreach($recent_posts as $post)
    <div class="f-blog">
        <a href="{{ route('posts.show',$post) }}" class="blog-img" style="background-image: url({{asset($post->image->path)}});">
        </a>
        <div class="desc">
            <p class="admin"><span>{{$post->created_at->diffForHumans()}}></span></p>
            <h2><a style="font-size: 18px" href="{{ route('posts.show',$post) }}">{{\Str::limit($post->title,20)}}</a></h2>
            <p>{{Str::limit($post->excerpt,60)}}</p>
        </div>
    </div>
    @endforeach
</div>