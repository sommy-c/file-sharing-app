<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Document</title>
</head>
<body>

   @include('layouts.navigation')


<div>
<div class="hero-upload">
    <div class="hero-message">
        <h1>Welcome to FileShare</h1>
        <p>Securely share your files with anyone, anywhere.</p>
        <p>Upload large projects, code files, or private documents and share them safely with a key.</p>
    </div>

    <div class="hero-upload-box">
        <form action="#" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="file">Choose a file to upload</label>
            <input type="file" name="file" id="file" required>
            <button type="submit">Upload</button>
        </form>
    </div>
</div>


<div class="category-section">

<div class="category-tabs">
  <a href="#">All</a>
  <a href="#">Documents</a>
  <a href="#">Images</a>
  <a href="#">Code</a>
  <a href="#">Projects</a>
</div>
</div>
</div>


















   @include('layouts.footer')


</body>
</html>
