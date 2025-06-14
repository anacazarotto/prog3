<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <!-- CSS Personalizado -->
    <link rel="stylesheet" href="<?= Yii::getAlias('@web/css/app.css') ?>">
    <link rel="stylesheet" href="<?= Yii::getAlias('@web/css/components.css') ?>">
    
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    
    <!-- JavaScript Personalizado -->
    <script src="<?= Yii::getAlias('@web/js/app.js') ?>" defer></script>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header id="header">
    <?php
    NavBar::begin([
        'brandLabel' => '<i class="bi bi-building"></i> ' . Html::encode(Yii::$app->name),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-md navbar-dark fixed-top shadow-sm',
    'style' => 'background-color: #2d3e50;'
],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav ms-auto'],
        'items' => [
            ['label' => '<i class="bi bi-house-door me-2"></i>Home', 'url' => ['/site/index'], 'encode' => false],
            ['label' => '<i class="bi bi-folder me-2"></i>Projetos', 'url' => ['/site/projects'], 'encode' => false],
            ['label' => '<i class="bi bi-plus-circle me-2"></i>Novo Projeto', 'url' => ['/site/projeto-create'], 'encode' => false],
            ['label' => '<i class="bi bi-info-circle me-2"></i>Sobre', 'url' => ['/site/about'], 'encode' => false],
            ['label' => '<i class="bi bi-envelope me-2"></i>Contato', 'url' => ['/site/contact'], 'encode' => false],
            Yii::$app->user->isGuest
                ? ['label' => '<i class="bi bi-box-arrow-in-right me-2"></i>Login', 'url' => ['/site/login'], 'encode' => false]
                : '<li class="nav-item">'
                    . Html::beginForm(['/site/logout'], 'post', ['class' => 'd-inline'])
                    . Html::submitButton(
                        '<i class="bi bi-box-arrow-right me-2"></i>Logout (' . Yii::$app->user->identity->username . ')',
                        ['class' => 'nav-link btn btn-link logout p-0 align-baseline text-white']
                    )
                    . Html::endForm()
                    . '</li>'
        ]
    ]);
    NavBar::end();
    ?>
</header>

<main id="main" class="flex-shrink-0" role="main" style="padding-top:70px;">
    <div class="container py-4">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer id="footer" class="mt-auto py-3">
    <div class="container">
        <div class="row text-muted">
            <div class="col-md-6 text-center text-md-start">
                &copy; GeezThor <?= date('Y') ?>
            </div>
            <div class="col-md-6 text-center text-md-end">
                Powered by <a href="https://www.yiiframework.com/" rel="noopener" target="_blank">Yii Framework</a>
            </div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
