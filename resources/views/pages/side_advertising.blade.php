<div class="side-link-box">
    <div class="list">
        @foreach($advertisings as $item)
        <div class="item">
            <a href="{{ $item->link }}" title="{{ $item->title }}">
                <img src="{{ $item->banner }}" alt="{{ $item->title }}">
            </a>
        </div>
        @endforeach
    </div>
</div>