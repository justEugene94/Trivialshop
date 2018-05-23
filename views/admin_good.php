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
<h4 class="text-center"><?=(isset($good) ? 'Редактировать товар' : 'Новый товар') ?></h4>

<? if(isset($ErrorStatus)): ?>
    <div class="alert alert-danger" role="alert">
        <?=$ErrorStatus;?>
    </div>
<? endif;?>

<div class="container">
    <form  method="post" action="<?=(isset($good) ? '/editgood' : '/good') ?>" enctype="multipart/form-data">

        <div class="form-group">

            <div class="form-row">
                <div class="col-md-8">
                    <label for="name">Название</label>
                    <input type="text" name="name" class="form-control" id="name" value="<?=$good['name']?>" placeholder="Введите название товара">
                </div>

                <div class="col-md-4">
                    <label for="price">Цена</label>
                    <input type="text" name="price" class="form-control" value="<?=$good['price']?>" id="price" placeholder="Введите цену">
                </div>
            </div>
        </div>

        <div class="form-group">

            <div class="form-row">
                    <label for="text">Описание</label>
                    <textarea name="text" id="text" cols="200" rows="10"><?=$good['text']?></textarea>
            </div>
        </div>

        <div class="form-group">
            <div class="form-row">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Выберите фото</span>
                    </div>
                    <div class="custom-file">
                        <input type="file" name="img" class="custom-file-input">
                        <label class="custom-file-label" for="inputGroupFile01">Выбрать фаил...</label>
                    </div>
                </div>
            </div>
        </div>

        <? if(isset($good)): ?>
            <div class="form-group">
                <div class="form-row">
                    <img class="card-img-top" style="height: 300px; width: 50%; display: block;" src="/img/goods/<?=$good['img']?>" >
                </div>
                <input type="hidden" name="old_img" value="<?=$good['img'] ?>">
            </div>
        <? endif; ?>

        <button type="submit" class="btn btn-secondary">Сохранить</button>
    </form>
</div>

</body>
</html>