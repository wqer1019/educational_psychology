<div class="left">
    <div class="title">
        <img src="{{cdn('edu/images/news.png')}}" alt="新闻速递">
        <h2>新闻通告</h2>
        <a class="more" {!! $category->getPresenter()->linkAttribute() !!}>更多</a>
    </div>
    <div class="content">
        @widget('image_post', ['category' => '新闻通告'])
        <ul class="news_list">
            @forelse($posts as $post)
                <li>
                    <a href="{!! $post->getPresenter()->url() !!}">{!! $post->title !!}</a>
                    <span>{!! $post->published_at->format('Y-m-d')!!}</span>
                </li>
            @empty
                <p class="no_data"><img src="{{cdn('edu/images/no_data.png')}}" alt=""></p>
            @endforelse
        </ul>
    </div>
</div>