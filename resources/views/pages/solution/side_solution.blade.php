<div class="side-page-warp">
    <div class="head">
        <p>相关解决方案</p>
    </div>
    <div class="list">
        @foreach($sulotions as $solution)
        @if ($loop->first)
        <div class="item">
            <a href="{{ route('solution.show',$solution->id)}}" title="{{ $solution->title}}">
                <img src="{{ $solution->image}}" alt="{{ $solution->title}}">
                <p class="title">{{ $solution->title }}</p>
            </a>
        </div>
        @endif
        <div class="item">
            <a href="{{ route('solution.show',$solution->id)}}">
                <p>{{ $solution->title }}</p>
            </a>
        </div>
        @endforeach
    </div>
</div>