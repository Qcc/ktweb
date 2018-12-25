<div class="side-page-warp">
    <div class="head">
        <p>客户案例</p>
    </div>
    <div class="list">
        @foreach($customers as $customer)
        @if ($loop->first)
        <div class="item">
            <span></span>
            <a href="{{ route('customer.show',$customer->id)}}" title="{{ $customer->title}}">
                <img src="{{ $customer->image}}" alt="{{ $customer->title}}">
                <p class="title">{{ $customer->title }}</p>
            </a>
        </div>
        @endif
        <div class="item">
            <span></span>
            <a href="{{ route('customer.show',$customer->id)}}">
                <p>{{ $customer->title }}</p>
            </a>
        </div>
        @endforeach
    </div>
</div>