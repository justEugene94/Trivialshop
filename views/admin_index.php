<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title><?=$title;?></title>
</head>
<body>
<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
    <h5 class="my-0 mr-md-auto font-weight-normal"><a href="/">Cool Shop</a></h5>
    <nav class="my-2 my-md-0 mr-md-3">

        <?foreach ($adminMenu as $item):?>

            <a class="p-2 text-dark" href="/admin?id=<?=$item['id']?>"><?=$item['name']?></a>

        <?endforeach;?>

    </nav>
    <a class="btn btn-outline-secondary" href="/logout">Выйти</a>
</div>

<? if(isset($ErrorStatus)): ?>
    <div class="alert alert-danger" role="alert">
        <?=$ErrorStatus;?>
    </div>
<? endif;?>

<? if(isset($successStatus)): ?>
    <div class="alert alert-success" role="alert">
        <?=$successStatus;?>
    </div>
<? endif;?>

<div class="container">
    <? if(isset($categories)): ?>

        <p align="right"><a href="/category">Добавить категорию</a></p>
        <table class="table">
            <thead class="thead-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Имя</th>
                <th scope="col">Удалить</th>
            </tr>
            </thead>
            <tbody>
            <? foreach ($categories as $category):?>
                <tr>
                    <th><a href="/category?id=<?=$category['id'];?>"><?=$category['id'];?></a></th>
                    <td><?=$category['name'];?></td>
                    <td>
                        <form method="post" action="/deletec">
                            <input type="hidden" name="id" value="<?=$category['id']?>">
                            <button type="submit" class="btn btn-danger">Удалить</button>
                        </form>
                    </td>

                </tr>
            <? endforeach;?>

            </tbody>
        </table>

    <?elseif(isset($goods)) :?>

        <p align="right"><a href="/good">Добавить товар</a></p>
        <table class="table">
            <thead class="thead-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Имя</th>
                <th scope="col">Текст</th>
                <th scope="col">Цена</th>
                <th scope="col">Картинка</th>
                <th scope="col">Удалить</th>
            </tr>
            </thead>
            <tbody>
            <? foreach ($goods as $good):?>
                <tr>
                    <th><a href="/good?id=<?=$good['id'];?>"><?=$good['id'];?></a></th>
                    <td><?=$good['name'];?></td>
                    <td><?=$good['text'];?></td>
                    <td><?=$good['price'];?></td>
                    <td><img class="card-img-top" style="height: 100px; width: 50%; display: block;" src="/img/goods/<?=$good['img']?>" ></td>
                    <td>
                        <form method="post" action="/deleteg">
                            <input type="hidden" name="id" value="<?=$good['id']?>">
                            <button type="submit" class="btn btn-danger">Удалить</button>
                        </form>
                    </td>

                </tr>
            <? endforeach;?>

            </tbody>
        </table>

    <?endif;?>
</div>

</body>
</html>