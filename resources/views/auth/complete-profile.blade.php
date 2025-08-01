<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{ route('profile.complete') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div>
        <label for="phone">Phone</label>
        <input type="text" name="phone" required>
    </div>

    <div>
        <label for="address">Address</label>
        <input type="text" name="address" required>
    </div>

    <div>
        <label for="image">Profile Image</label>
        <input type="file" name="image" accept="image/*">
    </div>

    <button type="submit">Sign up</button>
</form>


</body>
</html>
