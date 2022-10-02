<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link rel="stylesheet" href="/css/style.css">
    <nav>
<ul>
  <li><a href="/whole">友達一覧</a></li>
</ul>
</nav>
</head>
<body>
    <ul class="commentlist">
        @foreach($contents as $content)
            @if($content->user_id==Auth::id())
    <li class="balloon-lef">
                @if(!is_null($user_image))
        <p class="author"><a href='/image_store/{{$friend_info->id}}'><img src="{{Storage::url($user_image->path)}}" width="60" height="60"></a><br>{{$user_info->name}}</p>
                @else
        <p class="author"><a href='/image_store/{{$friend_info->id}}'><img src="#"></a><br>{{$user_info->name}}</p>
                @endif
        <p class="balloon">
            {{$content->content}}
        </p>
    </li>
            @endif
            @if($content->user_id==$friend_info->id)
    <li class="balloon-rig">
        <p class="author"><img src="画像パス"><br>{{$friend_info->name}}</p>
        <p class="balloon">
            {{$content->content}}
        </p>
    </li>
            @endif
        @endforeach
</ul>
<form method="POST" action="/store">
@csrf
<input type="hidden" id="user_id" name="user_id" value="{{Auth::id()}}">
<input type="hidden" id="friend_id" name="friend_id" value="{{$friend_info->id}}">
<input type="text" name="content">
<button type="submit">送信</button>
</form>
</body>
</html>