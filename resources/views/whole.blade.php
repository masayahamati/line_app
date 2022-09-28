<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
</body>
</html>