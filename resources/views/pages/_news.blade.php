<div class="mdui-container ktnews-warp">
    <div class="mdui-typo mdui-inline mdui-hidden-xs-down">
        <h2 class="mdui-inline">新闻中心 <small>最新资讯</small></h2>
    </div>
    <div class="ktnews-tab-warp">
        <div class="mdui-tab ktnews-tab" mdui-tab>
            <a href="#ktnews-tab1" class="mdui-ripple">沟通动态</a>
            <a href="#ktnews-tab2" class="mdui-ripple">行业资讯</a>
            <a href="#ktnews-tab3" class="mdui-ripple">管理智库</a>
        </div>
        <!-- 沟通动态 -->
        <div id="ktnews-tab1" class="mdui-p-a-2">
            <div class="mdui-row">
                @foreach($kouton as $index => $news)
                <div class="mdui-col-xs-12 mdui-col-sm-6 mdui-col-lg-4 news-big-item">
                    <div class="news-big-content-warp">
                        <a href="{{ $news->link() }}">
                            <h3 class="mdui-typo-title-opacity">{{ $news->title }}</h3>
                        </a>
                        <p class="mdui-typo-body-1-opacity mdui-hidden-xs news-summary">
                            <span>摘要:</span>
                            {{ $news->excerpt}}</p>
                        <p class="news-date mdui-typo-caption-opacity">{{ $news->updated_at->toDateString() }}</p>
                    </div>
                    <div class="news-big-pictures-warp">
                        <a href="{{ $news->link() }}">
                            <img class="news-big-pictures" src="{{ $news->image }}" alt="{{ $news->title }}">
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <!-- 行业资讯 -->
        <div id="ktnews-tab2" class="mdui-p-a-2">
            <div class="mdui-row">
                @foreach($industry as $index => $news)
                <div class="mdui-col-xs-12 mdui-col-sm-6 mdui-col-lg-4 news-big-item">
                    <div class="news-big-content-warp">
                        <a href="{{ $news->link() }}">
                            <h3 class="mdui-typo-title-opacity">{{ $news->title }}</h3>
                        </a>
                        <p class="mdui-typo-body-1-opacity mdui-hidden-xs news-summary">
                            <span>摘要:</span>
                            {{ $news->excerpt}}</p>
                        <p class="news-date mdui-typo-caption-opacity">{{ $news->updated_at->toDateString() }}</p>
                    </div>
                    <div class="news-big-pictures-warp">
                        <a href="{{ $news->link() }}">
                            <img class="news-big-pictures" src="{{ $news->image }}" alt="{{ $news->title }}">
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <!-- 管理智库 -->
        <div id="ktnews-tab3" class="mdui-p-a-2">
            <div class="mdui-row">
                @foreach($think as $index => $news)
                <div class="mdui-col-xs-12 mdui-col-sm-6 mdui-col-lg-4 news-big-item">
                    <div class="news-big-content-warp">
                        <a href="{{ $news->link() }}">
                            <h3 class="mdui-typo-title-opacity">{{ $news->title }}</h3>
                        </a>
                        <p class="mdui-typo-body-1-opacity mdui-hidden-xs news-summary">
                            <span>摘要:</span>
                            {{ $news->excerpt}}</p>
                        <p class="news-date mdui-typo-caption-opacity">{{ $news->updated_at->toDateString() }}</p>
                    </div>
                    <div class="news-big-pictures-warp">
                        <a href="{{ $news->link() }}">
                            <img class="news-big-pictures" src="{{ $news->image }}" alt="{{ $news->title }}">
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>