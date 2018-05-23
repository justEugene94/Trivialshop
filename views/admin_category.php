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
    <h5 class="my-0 mr-md-auto font-weight-normal"><a href="/">Cool shop</a></h5>
    <nav class="my-2 my-md-0 mr-md-3">

        <?foreach ($adminMenu as $item):?>

            <a class="p-2 text-dark" href="/admin?id=<?=$item['id']?>"><?=$item['name']?></a>

        <?endforeach;?>

    </nav>
    <a class="btn btn-outline-secondary" href="/logout">Выйти</a>
</div>
<h4 class="text-center"><?=(isset($category) ? 'Редактировать категорию' : 'Новая категория') ?></h4>

<? if(isset($ErrorStatus)): ?>
    <div class="alert alert-danger" role="alert">
        <?=$ErrorStatus;?>
    </div>
<? endif;?>

<div class="container">
    <form  method="post" action="<?=(isset($category) ? '/editcategory' : '/category') ?>">
        <div class="form-group">
            <label for="name">Категория</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Введите категорию" value="<?=$category['name']?>">

            <? if(isset($category)):?>
                <input type="hidden" name="id" value="<?=$category['id'] ?>">
            <? endif; ?>

        </div>

        <button type="submit" class="btn btn-secondary">Сохранить</button>
    </form>
</div>

</body>
</html>