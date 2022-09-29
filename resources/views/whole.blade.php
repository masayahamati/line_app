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
                <!--<td data-label="内容" class="txt"></td>
                <td data-label="価格" class="price"></td>-->
            </tr>
            @endforeach
        </tbody>
    </table>
    <table>
        <thead>
            <tr>
                <td class="non">申請されています</td>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($request_friend_infos as $info)
            <tr>
                <th>{{$info["name"]}}</th>
                <form method="POST" action="/request_permit">
                @csrf
                <input type="hidden" name="friend_id" value="{{$info['id']}}">
                <td><input type="radio" name="request" value="permit">登録</td>
                <td><input type="radio" name="request" value="not_permit">削除
                    <button type="submit">送信</button></td>
                    <!--削除とボタンを一緒の表の中に組み込んでいる-->
                </form>
            </tr>
            @endforeach
        </tbody>
    </table>


    <h1 class="friend_serch">友達申請</h1>
    <form method="POST" action="/friend_serch" class="form">
        @csrf
        <input type="text" name="name" value="友達検索">
        <button type="submit">送信</button>
    </form>
    @if(session("friend_exist_bool"))
        <div class="error">すでに友達です</div>
    @endif
    @if(session("friendname_notexist_bool"))
        <div class="error">その名前の人は存在しません</div>
        <!--この部分のsessionは一時的に情報を保管している
            そのためredirictで変数を渡す時の便利-->
        <ul class="error">
            hint
            <li>名前の間の空白は空けましょう</li>
            <li>スペルをもう一度確認しましょう</li>
        </ul>
    @endif
    @if(session("friend_request_bool"))
        <div class="error">友達申請を送りました</div>
    @endif

</body>
</html>