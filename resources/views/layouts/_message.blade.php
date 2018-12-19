@if (Session::has('message'))
<div class="alert alert-info">
    <div class="opacity"></div>
    <div class="bg"></div>
    <div class="content">
        <i class="kticon">&#xe68b;</i>
        <p class="message">
            {{ Session::get('message') }}
        </p>
        <a href="javascript:;">
            <i class="kticon">&#xe6b9;</i>
        </a>
    </div>
</div>
@endif

@if (Session::has('success'))
<div class="alert alert-success">
    <div class="opacity"></div>
    <div class="bg"></div>
    <div class="content">
        <i class="kticon">&#xe676;</i>
        <p class="message">
            {{ Session::get('success') }}
        </p>
        <a href="javascript:;">
            <i class="kticon">&#xe6b9;</i>
        </a>
    </div>
</div>
@endif

@if (Session::has('danger'))
<div class="alert alert-danger">
    <div class="opacity"></div>
    <div class="bg"></div>
    <div class="content">
        <i class="kticon">&#xe651;</i>
        <p class="message">
            {{ Session::get('danger') }}
        </p>
        <a href="javascript:;">
            <i class="kticon">&#xe6b9;</i>
        </a>
    </div>
</div>
@endif
@if (Session::has('error'))
<div class="alert alert-error">
    <div class="opacity"></div>
    <div class="bg"></div>
    <div class="content">
        <i class="kticon">&#xe614;</i>
        <p class="message">
            {{ Session::get('error') }}
        </p>
        <a href="javascript:;">
            <i class="kticon">&#xe6b9;</i>
        </a>
    </div>
</div>
@endif