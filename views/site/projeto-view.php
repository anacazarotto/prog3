
<?php

/** @var yii\web\View $this */
/** @var app\models\Project $projeto */

use yii\helpers\Html;

$this->title = 'Projeto: ' . Html::encode($projeto->name) . ' - Geezthor';

// Funções auxiliares para formatação
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
?>

<div class="projeto-view fade-in">
    <!-- Header -->
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
            </div>            <div class="btn-group">
                <a href="<?= \yii\helpers\Url::to(['site/projeto-edit', 'id' => $projeto->id]) ?>" class="btn btn-outline-primary">
                    <i class="bi bi-pencil me-1"></i>Editar
                </a>
                <button class="btn btn-outline-secondary">
                    <i class="bi bi-file-earmark-text me-1"></i>Relatório
                </button>
                <button class="btn btn-outline-danger">
                    <i class="bi bi-archive me-1"></i>Arquivar
                </button>
            </div>
        </div>
    </div>

    <!-- Informações do Projeto -->
    <div class="container mb-5">
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Detalhes do Projeto</h5>
                    </div>                    <div class="card-body">
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
                        
                        <hr>
                        
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
                        
                        <hr>
                        
                        <div>
                            <strong>Descrição:</strong><br>
                            <p class="text-muted mt-2">
                                <?= Html::encode($projeto->description ?: 'Nenhuma descrição disponível.') ?>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Documentos e Arquivos -->
                <div class="card mt-4">
                    <div class="card-header">
                        <h5 class="mb-0">Documentos</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="d-flex align-items-center p-3 border rounded">
                                    <i class="bi bi-file-earmark-pdf-fill text-danger fs-2 me-3"></i>
                                    <div>
                                        <h6 class="mb-1">Planta Baixa.pdf</h6>
                                        <small class="text-muted">2.5 MB • 20/01/2025</small>
                                    </div>
                                    <div class="ms-auto">
                                        <button class="btn btn-sm btn-outline-primary">Download</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center p-3 border rounded">
                                    <i class="bi bi-file-earmark-image-fill text-info fs-2 me-3"></i>
                                    <div>
                                        <h6 class="mb-1">Fachada.jpg</h6>
                                        <small class="text-muted">1.8 MB • 18/01/2025</small>
                                    </div>
                                    <div class="ms-auto">
                                        <button class="btn btn-sm btn-outline-primary">Download</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Comentários -->
                <div class="card mt-4">
                    <div class="card-header">
                        <h5 class="mb-0">Comentários</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <textarea class="form-control" rows="3" placeholder="Adicionar comentário..."></textarea>
                        </div>
                        <button class="btn btn-primary btn-sm">Adicionar Comentário</button>
                        
                        <hr>
                        
                        <div class="d-flex mb-3">
                            <div class="avatar bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                JS
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-center">
                                    <strong>João Silva</strong>
                                    <small class="text-muted">22/01/2025 14:30</small>
                                </div>
                                <p class="mb-0 text-muted">Gostei muito da proposta inicial. Podemos marcar uma reunião para discutir os detalhes?</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">                <!-- Progresso -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Progresso</h5>
                    </div>
                    <div class="card-body">
                        <div class="progress mb-3" style="height: 20px;">
                            <div class="progress-bar <?= getProgressBarClass($projeto->status) ?>" style="width: <?= getProgressValue($projeto) ?>%"><?= getProgressValue($projeto) ?>%</div>
                        </div>
                        
                        <div class="d-flex justify-content-between small text-muted">
                            <span>Início</span>
                            <span><?= getProgressValue($projeto) ?>% Concluído</span>
                            <span>Entrega</span>
                        </div>
                    </div>
                </div>
  <?php
// Determinar o progresso das etapas baseado no status
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
?>
                
                <!-- Etapas -->
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

                <!-- Informações Rápidas -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Informações</h5>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-6 mb-3">
                                <div class="border rounded p-2">
                                    <h6 class="text-primary mb-1">120</h6>
                                    <small class="text-muted">Horas Trabalhadas</small>
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="border rounded p-2">
                                    <h6 class="text-success mb-1">8</h6>
                                    <small class="text-muted">Arquivos</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="border rounded p-2">
                                    <h6 class="text-warning mb-1">3</h6>
                                    <small class="text-muted">Pendências</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="border rounded p-2">
                                    <h6 class="text-info mb-1">12</h6>
                                    <small class="text-muted">Comentários</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>