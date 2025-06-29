<?php
/** @var yii\web\View $this */
/** @var app\models\Project[] $projetos */
/** @var array $estatisticas */

$this->title = 'Projetos - Geezthor';

// Helper functions
function getStatusLabel($status) {
    switch ($status) {
        case 'ativo':
            return 'Em Andamento';
        case 'concluido':
            return 'Concluído';
        case 'pausado':
            return 'Pausado';
        case 'orcamento':
            return 'Orçamento';
        default:
            return 'Indefinido';
    }
}

function getBadgeClass($status) {
    switch ($status) {
        case 'ativo':
            return 'bg-primary';
        case 'concluido':
            return 'bg-success';
        case 'pausado':
            return 'bg-warning';
        case 'orcamento':
            return 'bg-info';
        default:
            return 'bg-secondary';
    }
}

function getProgressBarClass($status) {
    switch ($status) {
        case 'ativo':
            return 'bg-primary';
        case 'concluido':
            return 'bg-success';
        case 'pausado':
            return 'bg-warning';
        case 'orcamento':
            return 'bg-info';
        default:
            return 'bg-secondary';
    }
}

function getProgressValue($projeto) {
    switch ($projeto->status) {
        case 'ativo':
            return 50;
        case 'concluido':
            return 100;
        case 'pausado':
            return 25;
        case 'orcamento':
            return 10;
        default:
            return 0;
    }
}
?>

<div class="projetos-index fade-in">
    <!-- Header Section -->
    <div class="hero-section slide-up">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 class="display-4 fw-bold">
                    <i class="bi bi-folder-open me-3"></i>Meus Projetos
                </h1>
                <p class="lead">Gerencie todos os seus projetos de arquitetura em um só lugar</p>
                <div class="d-flex gap-2 mt-3">
                    <span class="badge bg-primary">
                        <i class="bi bi-bar-chart me-1"></i><?= count($projetos) ?> Total
                    </span>
                    <span class="badge bg-success">
                        <i class="bi bi-check-circle me-1"></i><?= $estatisticas['ativos'] ?> Ativos
                    </span>
                </div>
            </div>          
            <?php
            use yii\helpers\Url;
            $username = null;
            if (!Yii::$app->user->isGuest) {
                $username = Yii::$app->user->identity->username;
            }
            ?>
            <?php if ($username === 'admin'): ?>
            <div class="col-lg-4 text-lg-end">
                <a href="<?= \yii\helpers\Url::to(['site/projeto-create']) ?>" class="btn btn-success btn-lg shadow" style="border-radius: var(--border-radius-xl); padding: 0.875rem 2rem; font-weight: 600;">
                    <i class="bi bi-plus-circle me-2"></i>Novo Projeto
                </a>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Filtros e Busca -->
    <div class="filter-section">        <div class="row">
            <div class="col-md-6">
                <div class="input-group">
                    <span class="input-group-text" style="border-radius: var(--border-radius-md) 0 0 var(--border-radius-md);"><i class="bi bi-search"></i></span>
                    <input type="text" id="filtro-projeto" class="form-control" placeholder="Buscar projetos por nome ou cliente..." style="border-radius: 0 var(--border-radius-md) var(--border-radius-md) 0;">
                </div>
            </div>
            <div class="col-md-6">
                <select id="filtro-status" class="form-select" style="border-radius: var(--border-radius-md);">
                    <option value="">Todos os Status</option>
                    <option value="ativo">Em Andamento</option>
                    <option value="concluido">Concluído</option>
                    <option value="pausado">Pausado</option>
                    <option value="orcamento">Orçamento</option>
                </select>
            </div>
        </div>
    </div>    <!-- Lista de Projetos -->
    <div class="container mb-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="display-6 fw-bold">Seus Projetos</h2>
            <span class="text-muted"><?= count($projetos) ?> projeto(s) encontrado(s)</span>
        </div>
        <div class="row g-4" id="lista-projetos">
            <?php if (empty($projetos)): ?>
                <div class="col-12 text-center py-5">
                    <div class="empty-state">
                        <i class="bi bi-folder text-muted" style="font-size: 4rem;"></i>
                        <h3 class="mt-3">Nenhum projeto encontrado</h3>
                        <p class="text-muted">Comece criando seu primeiro projeto!</p>                        <a href="<?= \yii\helpers\Url::to(['site/projeto-create']) ?>" class="btn btn-primary mt-3" style="border-radius: var(--border-radius-md); padding: 0.75rem 1.5rem; font-weight: 600;">
                            <i class="bi bi-plus-circle me-2"></i>Criar Projeto
                        </a>
                    </div>
                </div>
            <?php else: ?>
                <?php foreach ($projetos as $projeto): ?>                    <!-- Projeto Card -->
                    <div class="col-lg-4 col-md-6 projeto-item" data-status="<?= $projeto->status ?>">
                        <div class="card h-100 shadow-sm border-0" style="border-radius: var(--border-radius-lg);">                            <div class="card-header d-flex justify-content-between align-items-center" style="border-radius: var(--border-radius-lg) var(--border-radius-lg) 0 0; background: var(--primary-color); color: white;">
                                <h5 class="card-title mb-0 text-white"><?= \yii\helpers\Html::encode($projeto->name) ?></h5>
                                <span class="badge <?= getBadgeClass($projeto->status) ?> rounded-pill">
                                    <?= getStatusLabel($projeto->status) ?>
                                </span>
                            </div>
                            <div class="card-body">
                                <p class="text-muted mb-2">
                                    <i class="bi bi-person me-1"></i>Cliente: <?= \yii\helpers\Html::encode($projeto->cliente) ?>
                                </p>
                                <p class="text-muted mb-2">
                                    <i class="bi bi-calendar me-1"></i>Início: <?= Yii::$app->formatter->asDate($projeto->data_inicio, 'dd/MM/yyyy') ?>
                                </p>                                <p class="text-muted mb-3">
                                    <i class="bi bi-geo-alt me-1"></i><?= \yii\helpers\Html::encode($projeto->endereco ?: 'Sem endereço definido') ?>
                                </p>
                                <div class="progress mb-3" style="border-radius: var(--border-radius-md); height: 10px;">
                                    <div class="progress-bar <?= getProgressBarClass($projeto->status) ?>" style="width: <?= getProgressValue($projeto) ?>%; border-radius: var(--border-radius-md);">
                                    </div>
                                </div>
                                <small class="text-muted"><?= getProgressValue($projeto) ?>% Concluído</small>
                            </div>                           
                            <div class="card-footer bg-transparent border-0" style="border-radius: 0 0 var(--border-radius-lg) var(--border-radius-lg);">                                <div class="btn-group w-100" role="group">
                                <a href="<?= \yii\helpers\Url::to(['site/projeto-view', 'id' => $projeto->id]) ?>" class="btn btn-outline-primary" style="border-radius: var(--border-radius-md) 0 0 var(--border-radius-md); background-color: #ffffff !important; color: var(--primary-color) !important;">Ver Detalhes</a>
                                    <?php
                                    $username = null;
                                    if (!Yii::$app->user->isGuest) {
                                        $username = Yii::$app->user->identity->username;
                                    }
                                    ?>
                                    <?php if ($username === 'admin'): ?>
                                        <a href="<?= \yii\helpers\Url::to(['site/projeto-edit', 'id' => $projeto->id]) ?>" class="btn btn-outline-secondary" style="border-radius: 0 var(--border-radius-md) var(--border-radius-md) 0; background-color: #ffffff !important; color: var(--secondary-color) !important;">Editar</a>
                                    <?php endif; ?>                                    
                                </div>
                            </div>
                        </div>
                    </div>                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>    <!-- Estatísticas -->
    <div class="container mb-5">
        <div class="text-center mb-4">
            <h2 class="display-6 fw-bold">Estatísticas do Portfólio</h2>
            <p class="text-muted">Visão geral dos seus projetos</p>
        </div>        <div class="row g-4">
            <div class="col-md-3">
                <div class="card text-center bg-primary text-white stats-card h-100 shadow-lg">
                    <div class="card-body">
                        <i class="bi bi-play-circle display-1 mb-3"></i>
                        <h3 class="display-4 fw-bold stats-number"><?= $estatisticas['ativos'] ?></h3>
                        <p class="mb-0 fw-semibold">Projetos Ativos</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center bg-success text-white stats-card h-100 shadow-lg">
                    <div class="card-body">
                        <i class="bi bi-check-circle display-1 mb-3"></i>
                        <h3 class="display-4 fw-bold stats-number"><?= $estatisticas['concluidos'] ?></h3>
                        <p class="mb-0 fw-semibold">Concluídos</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center bg-warning text-dark stats-card h-100 shadow-lg">
                    <div class="card-body">
                        <i class="bi bi-pause-circle display-1 mb-3"></i>
                        <h3 class="display-4 fw-bold stats-number"><?= $estatisticas['pausados'] ?></h3>
                        <p class="mb-0 fw-semibold">Pausados</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center bg-info text-white stats-card h-100 shadow-lg">
                    <div class="card-body">
                        <i class="bi bi-currency-dollar display-1 mb-3"></i>
                        <h3 class="display-4 fw-bold stats-number">R$ <?= number_format($estatisticas['faturamento'], 0, ',', '.') ?></h3>
                        <p class="mb-0 fw-semibold">Faturamento</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>