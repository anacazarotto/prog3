<?php
/** @var yii\web\View $this */

$this->title = 'Projetos - Geezthor';
?>

<div class="projetos-index">
    <!-- Header Section -->
    <div class="bg-primary text-white py-5 mb-5 rounded shadow">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <h1 class="display-4 fw-bold">Meus Projetos</h1>
                    <p class="lead">Gerencie todos os seus projetos de arquitetura em um só lugar</p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a href="<?= \yii\helpers\Url::to(['site/projeto-create']) ?>" class="btn btn-success btn-lg rounded-pill">
                        <i class="bi bi-plus
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <h1 class="display-4 fw-bold">Meus Projetos</h1>
                    <p class="lead">Gerencie todos os seus projetos de arquitetura em um só lugar</p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a href="<?= \yii\helpers\Url::to(['site/projeto-create']) ?>" class="btn btn-success btn-lg">
                        <i class="bi bi-plus-circle me-2"></i>Novo Projeto
                    </a>
                </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Filtros e Busca -->
    <div class="container mb-4">
        <div class="row">
            <div class="col-md-6">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-search"></i></span>
                    <input type="text" class="form-control" placeholder="Buscar projetos...">
                </div>
            </div>
            <div class="col-md-6">
                <select class="form-select">
                    <option value="">Todos os Status</option>
                    <option value="ativo">Em Andamento</option>
                    <option value="concluido">Concluído</option>
                    <option value="pausado">Pausado</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Lista de Projetos -->
    <div class="container mb-5">
        <div class="row g-4">
            <!-- Projeto 1 -->
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Residência Silva</h5>
                        <span class="badge bg-success">Em Andamento</span>
                    </div>
                    <div class="card-body">
                        <p class="text-muted mb-2">
                            <i class="bi bi-person me-1"></i>Cliente: João Silva
                        </p>
                        <p class="text-muted mb-2">
                            <i class="bi bi-calendar me-1"></i>Início: 15/01/2025
                        </p>
                        <p class="text-muted mb-3">
                            <i class="bi bi-geo-alt me-1"></i>São Paulo, SP
                        </p>
                        <div class="progress mb-3">
                            <div class="progress-bar bg-success" style="width: 65%"></div>
                        </div>
                        <small class="text-muted">65% Concluído</small>
                    </div>
                    <div class="card-footer">
                        <div class="btn-group w-100">
                            <a href="/site/projeto-view?id=1" class="btn btn-outline-primary">Ver Detalhes</a>
                            <a href="#" class="btn btn-outline-secondary">Editar</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Projeto 2 -->
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Escritório Comercial</h5>
                        <span class="badge bg-warning text-dark">Pausado</span>
                    </div>
                    <div class="card-body">
                        <p class="text-muted mb-2">
                            <i class="bi bi-person me-1"></i>Cliente: Maria Santos
                        </p>
                        <p class="text-muted mb-2">
                            <i class="bi bi-calendar me-1"></i>Início: 08/12/2024
                        </p>
                        <p class="text-muted mb-3">
                            <i class="bi bi-geo-alt me-1"></i>Rio de Janeiro, RJ
                        </p>
                        <div class="progress mb-3">
                            <div class="progress-bar bg-warning" style="width: 30%"></div>
                        </div>
                        <small class="text-muted">30% Concluído</small>
                    </div>
                    <div class="card-footer">
                        <div class="btn-group w-100">
                            <a href="/site/projeto-view?id=2" class="btn btn-outline-primary">Ver Detalhes</a>
                            <a href="#" class="btn btn-outline-secondary">Editar</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Projeto 3 -->
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Reforma Apartamento</h5>
                        <span class="badge bg-primary">Concluído</span>
                    </div>
                    <div class="card-body">
                        <p class="text-muted mb-2">
                            <i class="bi bi-person me-1"></i>Cliente: Carlos Lima
                        </p>
                        <p class="text-muted mb-2">
                            <i class="bi bi-calendar me-1"></i>Início: 20/10/2024
                        </p>
                        <p class="text-muted mb-3">
                            <i class="bi bi-geo-alt me-1"></i>Belo Horizonte, MG
                        </p>
                        <div class="progress mb-3">
                            <div class="progress-bar bg-success" style="width: 100%"></div>
                        </div>
                        <small class="text-muted">100% Concluído</small>
                    </div>
                    <div class="card-footer">
                        <div class="btn-group w-100">
                            <a href="/site/projeto-view?id=3" class="btn btn-outline-primary">Ver Detalhes</a>
                            <a href="#" class="btn btn-outline-secondary">Relatório</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Estatísticas -->
    <div class="container mb-5">
        <div class="row g-4">
            <div class="col-md-3">
                <div class="card text-center bg-primary text-white">
                    <div class="card-body">
                        <h3 class="display-4">12</h3>
                        <p class="mb-0">Projetos Ativos</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center bg-success text-white">
                    <div class="card-body">
                        <h3 class="display-4">28</h3>
                        <p class="mb-0">Concluídos</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center bg-warning text-dark">
                    <div class="card-body">
                        <h3 class="display-4">3</h3>
                        <p class="mb-0">Pausados</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center bg-info text-white">
                    <div class="card-body">
                        <h3 class="display-4">₹ 85k</h3>
                        <p class="mb-0">Faturamento</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>