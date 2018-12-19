@if (count($errors) > 0)
<div class="alert alert-error">
    <div class="opacity"></div>
    <div class="bg"></div>
    <div class="content">
        <i class="kticon">&#xe614;</i>
        <p class="message">
            @foreach ($errors->all() as $error)
            {{ $error }}
            @endforeach
        </p>
        <a href="javascript:;">
            <i class="kticon">&#xe6b9;</i>
        </a>
    </div>
</div>
@endif