<?php

/** @var yii\web\View $this */
/** @var app\models\Project $projeto */
/** @var app\models\Comentario $comentarioModel */
/** @var app\models\Arquivo $arquivoModel */
/** @var app\models\Comentario[] $comentarios */
/** @var app\models\Arquivo[] $arquivos */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Projeto: ' . Html::encode($projeto->name) . ' - Geezthor';

function getStatusLabel($status) {
    $labels = [
        'ativo' => 'Em Andamento',
        'concluido' => 'Concluído',
        'pausado' => 'Pausado',
        'orcamento' => 'Orçamento'
    ];
    return $labels[$status] ?? 'Indefinido';
}
function getBadgeClass($status) {
    $classes = [
        'ativo' => 'bg-primary',
        'concluido' => 'bg-success',
        'pausado' => 'bg-warning text-dark',
        'orcamento' => 'bg-secondary'
    ];
    return $classes[$status] ?? 'bg-light';
}
function getProgressValue($projeto) {
    $progress = [
        'orcamento' => 10,
        'ativo' => 50,
        'pausado' => 30,
        'concluido' => 100
    ];
    return $progress[$projeto->status] ?? 0;
}
function getProgressBarClass($status) {
    $classes = [
        'ativo' => 'bg-primary',
        'concluido' => 'bg-success',
        'pausado' => 'bg-warning',
        'orcamento' => 'bg-secondary'
    ];
    return $classes[$status] ?? 'bg-light';
}
function getEtapaIcon($status) {
    switch($status) {
        case 'completed': return 'bi-check-circle-fill text-success';
        case 'current': return 'bi-arrow-right-circle text-primary';
        case 'pending': return 'bi-circle text-muted';
        default: return 'bi-circle text-muted';
    }
}
function getEtapaLabel($status) {
    switch($status) {
        case 'completed': return 'Concluído';
        case 'current': return 'Em Andamento';
        case 'pending': return 'Pendente';
        default: return 'Pendente';
    }
}

$etapas = [
    'orcamento' => [
        'Orçamento' => 'current',
        'Estudo Preliminar' => 'pending',
        'Anteprojeto' => 'pending',
        'Projeto Legal' => 'pending',
        'Projeto Executivo' => 'pending'
    ],
    'ativo' => [
        'Orçamento' => 'completed',
        'Estudo Preliminar' => 'completed',
        'Anteprojeto' => 'current',
        'Projeto Legal' => 'pending',
        'Projeto Executivo' => 'pending'
    ],
    'pausado' => [
        'Orçamento' => 'completed',
        'Estudo Preliminar' => 'current',
        'Anteprojeto' => 'pending',
        'Projeto Legal' => 'pending',
        'Projeto Executivo' => 'pending'
    ],
    'concluido' => [
        'Orçamento' => 'completed',
        'Estudo Preliminar' => 'completed',
        'Anteprojeto' => 'completed',
        'Projeto Legal' => 'completed',
        'Projeto Executivo' => 'completed'
    ]
];
$etapasStatus = $etapas[$projeto->status] ?? $etapas['orcamento'];

?>

<div class="projeto-view fade-in">
    <div class="container mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><?= Html::a('<i class="bi bi-folder me-1"></i>Projetos', ['site/projects'], ['encode' => false]) ?></li>
                <li class="breadcrumb-item active"><i class="bi bi-eye me-1"></i><?= Html::encode($projeto->name) ?></li>
            </ol>
        </nav>

        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="display-5 fw-bold"><?= Html::encode($projeto->name) ?></h1>
                <span class="badge <?= getBadgeClass($projeto->status) ?> fs-6"><?= getStatusLabel($projeto->status) ?></span>
            </div>
            <div class="btn-group">
                <a href="<?= \yii\helpers\Url::to(['site/projeto-edit', 'id' => $projeto->id]) ?>" class="btn btn-outline-primary">
                    <i class="bi bi-pencil me-1"></i>Editar
                </a>
                <?= Html::a(
                    '<i class="bi bi-archive me-1"></i>Apagar',
                    ['site/projeto-delete', 'id' => $projeto->id],
                    [
                        'class' => 'btn btn-outline-danger',
                        'data' => [
                            'confirm' => 'Tem certeza que deseja excluir este projeto? Esta ação não poderá ser desfeita.',
                            'method' => 'post',
                        ],
                        'encode' => false
                    ]
                ) ?>
            </div>
        </div>
    </div>

    <!-- Informações do Projeto -->
    <div class="container mb-5">
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Detalhes do Projeto</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <strong>Cliente:</strong><br>
                                <?= Html::encode($projeto->cliente) ?><br>
                                <small class="text-muted"><?= Html::encode($projeto->tipo_projeto) ?></small>
                            </div>
                            <div class="col-md-6">
                                <strong>Endereço:</strong><br>
                                <?= Html::encode($projeto->endereco ?: 'Não informado') ?><br>
                                <small class="text-muted">Localização do projeto</small>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <strong>Data de Início:</strong><br>
                                <?= $projeto->data_inicio ? Yii::$app->formatter->asDate($projeto->data_inicio, 'dd/MM/yyyy') : 'Não definida' ?>
                            </div>
                            <div class="col-md-4">
                                <strong>Previsão de Entrega:</strong><br>
                                <?= $projeto->data_entrega ? Yii::$app->formatter->asDate($projeto->data_entrega, 'dd/MM/yyyy') : 'Não definida' ?>
                            </div>
                            <div class="col-md-4">
                                <strong>Valor Total:</strong><br>
                                <?= $projeto->valor_total ? 'R$ ' . number_format($projeto->valor_total, 2, ',', '.') : 'Não definido' ?>
                            </div>
                        </div>
                        <div>
                            <strong>Descrição:</strong><br>
                            <p class="text-muted mt-2">
                                <?= Html::encode($projeto->description ?: 'Nenhuma descrição disponível.') ?>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Documentos</h5>
                    </div>
                    <div class="card-body">
                        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
                        <?= $form->field($arquivoModel, 'uploadFile')->fileInput()->label('Envie um novo arquivo: ') ?>
                        <?= Html::submitButton('Enviar Arquivo', ['class' => 'btn btn-success btn-sm']) ?>
                        <?php ActiveForm::end(); ?>
                        <hr>
                        <?php foreach ($arquivos as $arquivo): ?>
                            <div class="mb-2">
                                <i class="bi bi-paperclip"></i>
                                <?= Html::a(basename($arquivo->caminho), ['/' . $arquivo->caminho], ['target' => '_blank']) ?>
                                <small class="text-muted"> | <?= Yii::$app->formatter->asDatetime($arquivo->created_at) ?></small>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Comentários</h5>
                    </div>
                    <div class="card-body">
                        <?php $form = ActiveForm::begin(); ?>
                        <?= $form->field($comentarioModel, 'username')->textInput(['maxlength' => true, 'readonly' => true])->label('Nome do Usuário') ?>
                        <?= $form->field($comentarioModel, 'comentario')->textarea(['rows' => 3])->label('Comentário') ?>
                        <?= Html::submitButton('Adicionar Comentário', ['class' => 'btn btn-primary btn-sm']) ?>
                        <?php ActiveForm::end(); ?>

                        <hr>

                        <?php foreach ($comentarios as $comentario): ?>
                            <div class="d-flex mb-3">
                                <div class="avatar bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                    <?= strtoupper(substr($comentario->username, 0, 2)) ?>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <strong><?= Html::encode($comentario->username) ?></strong>
                                        <small class="text-muted"><?= Yii::$app->formatter->asDatetime($comentario->created_at) ?></small>
                                    </div>
                                    <p class="mb-0 text-muted"><?= Html::encode($comentario->comentario) ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Progresso</h5>
                    </div>
                    <div class="card-body">
                        <div class="progress mb-3" style="height: 20px;">
                            <div class="progress-bar <?= getProgressBarClass($projeto->status) ?>" style="width: <?= getProgressValue($projeto) ?>%">
                                <?= getProgressValue($projeto) ?>%
                            </div>
                        </div>
                        <div class="d-flex justify-content-between small text-muted">
                            <span>Início</span>
                            <span><?= getProgressValue($projeto) ?>% Concluído</span>
                            <span>Entrega</span>
                        </div>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Etapas</h5>
                    </div>
                    <div class="card-body">
                        <div class="list-group list-group-flush">
                            <?php foreach($etapasStatus as $etapa => $status): ?>
                                <div class="list-group-item d-flex justify-content-between">
                                    <span><i class="<?= getEtapaIcon($status) ?> me-2"></i><?= $etapa ?></span>
                                    <small class="text-muted"><?= getEtapaLabel($status) ?></small>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Informações</h5>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-6 mb-3">
                                <div class="border rounded p-2">
                                    <h6 class="text-primary mb-1">
                                        <?= Html::encode($projeto->horas_trabalhadas ?? '0') ?>
                                    </h6>
                                    <small class="text-muted">Horas Trabalhadas</small>
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="border rounded p-2">
                                    <h6 class="text-success mb-1">
                                        <?= Html::encode($projeto->total_arquivos ?? count($arquivos)) ?>
                                    </h6>
                                    <small class="text-muted">Arquivos</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="border rounded p-2">
                                    <h6 class="text-warning mb-1">
                                        <?= Html::encode($projeto->pendencias ?? '0') ?>
                                    </h6>
                                    <small class="text-muted">Pendências</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>