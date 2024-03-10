@if(session()->has('success'))
<div class="alert alert-success" role="alert">
  {{ session('success') }}
</div>
@endif

@if(session()->has('danger'))
<div class="alert alert-danger" role="alert">
  {{ session('danger') }}
</div>
@endif

@if(session()->has('warning'))
<div class="alert alert-warning" role="alert">
  {{ session('warning') }}
</div>
@endif

@if(session()->has('now'))
<div class="alert alert-primary" role="alert">
  {{ session('now') }}
</div>
@endif
