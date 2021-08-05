@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@if (session('message'))
<div class="alert alert-danger">
    {{ session('message') }}
</div>
@endif
@if (session('updated'))
<div class="alert alert-success">
    {{ session('updated') }}
</div>
@endif
@if (session('created'))
<div class="alert alert-success">
    {{ session('created') }}
</div>
@endif
@if (session('deleted'))
<div class="alert alert-success">
    {{ session('deleted') }}
</div>
@endif
@if (session('revoked'))
<div class="alert alert-warning">
    {{ session('revoked') }}
</div>
@endif