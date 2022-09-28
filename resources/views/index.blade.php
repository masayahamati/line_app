<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <ul class="commentlist">
        @foreach($contents as $content)
        @if($content->user_id==Auth::id())
    <li class="balloon-lef">
        <p class="author"><img src="画像パス" /><br />名前</p>
        <p class="balloon">
            {{$content->content}}
        </p>
    </li>
        @endif
        @if($content->user_id==$friend_id)
    <li class="balloon-rig">
        <p class="author"><img src="画像パス" /><br />名前</p>
        <p class="balloon">
            {{$content->content}}
        </p>
    </li>
    @endif
    @endforeach
</ul>
</body>
</html>