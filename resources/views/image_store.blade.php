<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<h1>プロフィール写真アップロード</h1>
    <form method="POST" action="/upload" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="friend_id" value="{{$friend_id}}">
    <input type="file" name="image">
    <button>アップロード</button>
    </form>
</body>
</html>