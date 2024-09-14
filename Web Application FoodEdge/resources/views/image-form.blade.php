<!DOCTYPE html>
<html>
<head>
  <title>Laravel 11 Image Upload Example - Tutsmake.com</title>

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>

<div class="container mt-4">

  @if(session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
  @endif

  <div class="card">

    <div class="card-header text-center font-weight-bold">
      <h2>Food Image Upload</h2>
    </div>

    <div class="card-body">
        <form method="POST" enctype="multipart/form-data" id="upload-image" action="{{ url('upload') }}" >
           @csrf
            <div class="row">

                <div class="col-md-8">
                    <div class="form-group">
                        <input type="file" name="image" placeholder="Choose image" id="image">
                    @error('image')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                    </div>
                </div>
                  
                <div class="col-md-8">
                    <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                </div>
            </div>     
        </form>

    </div>

  </div>

</div>  
</body>
</html>