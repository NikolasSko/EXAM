<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $userRequests app\models\Request[] */

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Ваши купленные книги:</p>

    <ul>
        <?php foreach ($userRequests as $request): ?>
            <?php if ($request->book->status == 1): ?>
                <li><?= Html::encode($request->book->name) ?></li>
            <?php else: ?>
                <li><?= Html::encode($request->book->name) ?>(Скоро)</li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
</div>
