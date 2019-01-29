<div class="mdui-row product-left">
    <div class="mdui-col-sm-6 mdui-col-xs-12">
        <div class="product-point-left">
            <div class="product-title">
                <h3 class="product-title-h3">
                    {{ $product->title }}
                </h3>
            </div>
            <div class="topic-body product-point">
                {!! $product->point !!}
            </div>
            <div>
            <a class="mdui-btn ghostbtn mdui-ripple" href="{{ $product->link() }}">详情查看</a>
            </div>
        </div>
    </div>
    <div class="mdui-col-sm-6 mdui-col-xs-12">
        <div class="product-featrue-image">
                    <img src="{{ $product->image }}" alt="{{ $product->title }}">
        </div>
    </div>
</div>