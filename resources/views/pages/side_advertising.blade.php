<div class="side-link-box">
    <div class="list">
        @foreach($advertisings as $value)
        <div class="item">
            <a href="{{ $value['link'] }}">
                <img src="{{ $value['img'] }}" alt="{{ $value['link'] }}">
            </a>
        </div>
        @endforeach
    </div>
</div>