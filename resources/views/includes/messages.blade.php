<div class="row">
  <div class="col-sm-12">
    @if(count($errors) > 0)
        @foreach($errors->all() as $error)
            <div class="alert alert-danger">
                <i class="fa fa-exclamation-triangle"></i> {{$error}}
            </div>
        @endforeach
    @endif

    @if(session('success'))
        <div class="alert alert-success">
            <i class="fa fa-check"></i> {{session('success')}}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
           <i class="fa fa-exclamation-triangle"></i>  {{session('error')}}
        </div>
    @endif
  </div>
</div>
