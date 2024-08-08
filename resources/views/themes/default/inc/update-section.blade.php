@php
$cat_posts = $home->get_posts_by_single_cats('trending-now', 10);
@endphp
<section class="update-section clearfix">
  <div class="container d-flex py-2">
    @if($cat_posts->isNotEmpty())
    <div class="notice d-none d-sm-block">Trending Now</div>
    <div id="text-news" class="flexslider">
      <ul class="slides">
        @foreach($cat_posts as $cat_post)
        <li>
          <a href="{{url($cat_post->post_type."/".$cat_post->id."/".$cat_post->post_slug)}}"
            class="nav-link">{{word_limiter($cat_post->post_title,17)}}</a>
        </li>
        @endforeach
      </ul>
    </div>
    @endif
  </div>
</section> <!-- update-section-->