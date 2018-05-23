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
        <a class="p-2 text-dark" href="/">Все товары</a>

        <?foreach ($menu as $item):?>

            <a class="p-2 text-dark" href="?id=<?=$item['id']?>"><?=$item['name']?></a>

        <?endforeach;?>

    </nav>
    <a class="btn btn-outline-secondary" href="/admin">Админка</a>
</div>

    <div class="album py-5">
        <div class="container">

            <div class="row">

                <? foreach ($goods as $good):?>

                    <div class="col-md-4">
                        <div class="card mb-4 box-shadow">
                            <img class="card-img-top" style="height: 290px; width: 100%; display: block;" src="/img/goods/<?=$good['img']?>" >
                            <div class="card-body">
                                <h3><?=$good['name'] ?></h3>
                                <p class="card-text"><?=mb_strimwidth($good['text'], 0, 100, '...') ?></p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <form method="post" action="/product">
                                            <input type="hidden" name="id" value="<?=$good['id']?>">
                                            <button type="submit" class="btn btn-sm btn-outline-secondary">Подробнее</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <? endforeach; ?>

            </div>
        </div>
    </div>


</body>
</html>