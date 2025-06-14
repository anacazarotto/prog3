<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = 'Architecture Projects';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-projects">
    <h1><?= Html::encode($this->title) ?></h1>

    <h2>Add New Project</h2>
    <?php $form = ActiveForm::begin(['action' => Url::to(['site/add-project']), 'method' => 'post']); ?>
        <?= $form->field($model, 'name')->textInput(['placeholder' => 'Project Name']) ?>
        <?= $form->field($model, 'description')->textarea(['rows' => 4]) ?>
        <?= Html::submitButton('Add Project', ['class' => 'btn btn-primary']) ?>
    <?php ActiveForm::end(); ?>

    <h2>Existing Projects</h2>
    <ul>
        <?php foreach ($projects as $project): ?>
            <li>
                <strong><?= Html::encode($project->name) ?></strong>
                <p><?= Html::encode($project->description) ?></p>
            </li>
        <?php endforeach; ?>
    </ul>
</div>