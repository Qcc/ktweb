<div class="mdui-row">
    <div class="mdui-col-xs-6">
        <div class="article-header">
            <div class="article-title">
                <h3 class="article-title-h3">
                    {{ $product->title }}
                </h3>
            </div>
        </div>
    </div>
    <div class="mdui-col-xs-6">
        <div class="article-list">
            <a href="{{ route('product.show',$product->id) }}" target="_blank">
                <div class="images">
                    <img src="{{ $product->image }}" alt="{{ $product->title }}">
                </div>
            </a>
        </div>
    </div>
</div>