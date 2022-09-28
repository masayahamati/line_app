<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <table>
        <thead>
            <tr>
                <td class="non">友達</td>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($friend_infos as $info)
            <tr>
                <th><a href="/{{$info['id']}}">{{$info["name"]}}</a></th>
                <td data-label="内容" class="txt"></td>
                <td data-label="価格" class="price"></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <h1 class="friend_serch">友達検索</h1>
    <form method="POST" action="/friend_serch" class="form">
        @csrf
        <input type="text" name="name" value="友達検索">
        <button type="submit">送信</button>
    </form>
</body>
</html>