<div class="mdui-row product-right">
    <div class="mdui-col-xs-6">
        <div class="product-featrue-image">
                    <img src="{{ $solution->image }}" alt="{{ $solution->title }}">
        </div>
    </div>
    <div class="mdui-col-xs-6">
        <div class="product-point-right">
            <div class="product-title">
                <h3 class="product-title-h3">
                    {{ $solution->title }}
                </h3>
            </div>
            <div class="topic-body product-point">
                {!! $solution->point !!}
            </div>
            <div>
            <a class="mdui-btn ghostbtn mdui-ripple" href="{{ route('solution.show',$solution->id) }}">详情查看</a>
            </div>
        </div>
    </div>
</div>