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

            <a class="p-2 text-dark" href="/?id=<?=$item['id']?>"><?=$item['name']?></a>

        <?endforeach;?>

    </nav>
        <a class="btn btn-outline-primary" href="/admin">Админка</a>
</div>

<div class="album py-5">
    <div class="container">

                <div class="card flex-md-row mb-4 box-shadow h-md-250">
                    <div class="card-body d-flex flex-column align-items-start">
                        <h3 class="mb-0">
                            <?=$product['name'] ?>
                        </h3>
                        <strong class="d-inline-block mb-2 text-success">US <?=$product['price'] ?> </strong>
                        <p class="card-text mb-auto"><?=$product['text'] ?></p>
                        <button type="button" class="btn btn-secondary" disabled>Купить</button>
                    </div>
                    <img class="card-img-right flex-auto d-none d-md-block" style="width: 290px; height: 285px;" src="/img/goods/<?=$product['img'] ?>">
                </div>


    </div>
</div>


</body>
</html>