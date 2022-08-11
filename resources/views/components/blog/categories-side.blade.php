@props(['categories'])
<div class="side">
    <h3 class="sidebar-heading">Categories</h3>
    <div class="block-24">
        <ul>
            @foreach($categories as $gategory)
                <li><a href="{{route('categories.show',$gategory)}}">{{$gategory->name}} <span>{{$gategory->posts_count}}</span></a></li>
            @endforeach
        </ul>
    </div>
</div>