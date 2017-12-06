<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>

<div class="container">
<!-- Вывод флеш сообщений-->
    <!-- Вывод флеш сообщения при удачном заказе-->
        <?php if (Yii::$app->session->hasFlash('success')): // пореряем если есть метод hasFlash с ключем success, то выводим с одним оформлением?>
            <div class="alert alert-success alert-dismissable" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
                <?= Yii::$app->session->getFlash('success');?>
            </div>
        <?php endif;?>
    <!-- Вывод флеш сообщения при неудачном заказе-->
        <?php if (Yii::$app->session->hasFlash('error')): // пореряем если есть метод hasFlash с ключем error, то выводим с другим оформлением?>?>
            <div class="alert alert-danger alert-dismissable" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
                <?= Yii::$app->session->getFlash('error');?>
            </div>
        <?php endif;?>
<!-- Конец вывода флеш сообшений-->

    <?php if(!empty($session['cart'])):?>
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                <tr>
                    <th>Фото</th>
                    <th>Наименование</th>
                    <th>Количество</th>
                    <th>Цена</th>
                    <th>Сумма</th>
                    <th><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($session['cart'] as $id=>$item):?>
                    <tr>
                        <td><?= \yii\helpers\Html::img($item['img'], ['alt' => $item['name'], 'height' => 50]);?></td>
                        <td><a href="<?= Url::to(['product/view', 'id' =>$id])?>"><?= $item['name'];?></a></td>
                        <td><?= $item['qty'];?></td>
                        <td><?= $item['price'];?></td>
                        <td><?= $item['qty']*$item['price'];?></td>
                        <td><span data-id="<?= $id?>" class="glyphicon glyphicon-remove text-danger del-item" aria-hidden="true"></span></td>
                    </tr>
                <?php endforeach?>
                <tr>
                    <td colspan="5">Итого:</td>
                    <td><?= $session['cart.qty']?></td>
                </tr>
                <tr>
                    <td colspan="5">Сумма:</td>
                    <td><?= $session['cart.sum']?></td>
                </tr>
                </tbody>
            </table>
        </div>
        <hr/>
       <?php $form = ActiveForm::begin() //начало формы?>
        <?= $form->field($orders, 'name') // поля формы?>
        <?= $form->field($orders, 'email')?>
        <?= $form->field($orders, 'phone')?>
        <?= $form->field($orders, 'address')?>
        <?= Html::submitButton('Заказать', ['class' => 'btn btn-success']) // кнопка?>
        <?php $form = ActiveForm::end() // конец формы?>
    <?php else:?>
        <h3>Корзина пуста</h3>
    <?php endif;?>


</div>