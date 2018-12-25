<div class="side-page-warp">
    <div class="head">
        <p>推荐产品</p>
    </div>
    <div class="list">
        @foreach($products as $product)
        @if ($loop->first)
        <div class="item">
            <span></span>
            <a href="{{ route('product.show',$product->id)}}" title="{{ $product->title}}">
                <img src="{{ $product->image}}" alt="{{ $product->title}}">
                <p class="title">{{ $product->title }}</p>
            </a>
        </div>
        @endif
        <div class="item">
            <span></span>
            <a href="{{ route('product.show',$product->id)}}">
                <p>{{ $product->title }}</p>
            </a>
        </div>
        @endforeach
    </div>
</div>