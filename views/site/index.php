
<?php
/** @var yii\web\View $this */
$this->title = 'Geezthor - Gestão para Escritórios de Arquitetura';
?>

<div class="site-index fade-in">
    <!-- Hero Section -->
    <div class="hero-section slide-up mb-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-3 fw-bold mb-4">
                        <i class="bi bi-building me-3"></i>Geezthor
                    </h1>
                    <p class="lead mb-4">Transforme a gestão do seu escritório de arquitetura com nossa plataforma completa e moderna</p>
                    <ul class="list-unstyled mb-4 fs-5">
                        <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-3"></i>Gestão completa de projetos</li>
                        <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-3"></i>Controle de clientes e orçamentos</li>
                        <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-3"></i>Acompanhamento em tempo real</li>
                        <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-3"></i>Interface moderna e intuitiva</li>
                    </ul>
                    <div class="d-flex gap-3 flex-wrap">
                        <a href="<?= \yii\helpers\Url::to(['site/projects']) ?>" class="btn btn-primary btn-lg px-4 py-3">
                            <i class="bi bi-folder-open me-2"></i>Ver Projetos
                        </a>
                        <a href="<?= \yii\helpers\Url::to(['site/projeto-create']) ?>" class="btn btn-success btn-lg px-4 py-3">
                            <i class="bi bi-plus-circle me-2"></i>Novo Projeto
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <div class="hero-image-container">
                        <img src="images/ilustracao-do-conceito-de-arquiteto.png" alt="Geezthor Hero Image" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recursos Section -->
    <div id="recursos" class="container mb-5">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold">Recursos Principais</h2>
            <p class="lead text-muted">Tudo o que você precisa para gerenciar seus projetos de arquitetura</p>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <i class="bi bi-people fs-1 text-primary"></i>
                        </div>
                        <h3 class="card-title h5">Cadastro de Clientes</h3>
                        <p class="card-text">Gerencie informações de clientes de forma organizada e centralizada.</p>
                        <span class="badge bg-success">Novo</span>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <i class="bi bi-calendar-check fs-1 text-primary"></i>
                        </div>
                        <h3 class="card-title h5">Agendamento</h3>
                        <p class="card-text">Agende reuniões com clientes e gerencie sua disponibilidade eficientemente.</p>
                        <span class="badge bg-info">Atualizado</span>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <i class="bi bi-clipboard-data fs-1 text-primary"></i>
                        </div>
                        <h3 class="card-title h5">Gestão de Horas</h3>
                        <p class="card-text">Registre e monitore as horas dedicadas a cada etapa dos seus projetos.</p>
                        <span class="badge bg-warning text-dark">Em breve</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Process Section -->
    <div class="bg-light py-5 mb-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold">Fluxo de Trabalho Otimizado</h2>
                <p class="lead text-muted">Acompanhe cada etapa do projeto com facilidade</p>
            </div>
            
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="timeline">
                        <div class="row g-4">
                            <div class="col-md-4 text-center">
                                <div class="p-3 bg-white rounded-3 shadow-sm mb-2">
                                    <h4 class="h5"><i class="bi bi-person-plus text-primary me-2"></i>Etapa 1</h4>
                                    <p class="mb-0">Cadastro e Agendamento</p>
                                </div>
                                <div class="timeline-arrow"></div>
                            </div>
                            
                            <div class="col-md-4 text-center">
                                <div class="p-3 bg-white rounded-3 shadow-sm mb-2">
                                    <h4 class="h5"><i class="bi bi-bricks text-primary me-2"></i>Etapa 2</h4>
                                    <p class="mb-0">Layout e Volumetria</p>
                                </div>
                                <div class="timeline-arrow"></div>
                            </div>
                            
                            <div class="col-md-4 text-center">
                                <div class="p-3 bg-white rounded-3 shadow-sm mb-2">
                                    <h4 class="h5"><i class="bi bi-box-seam text-primary me-2"></i>Etapa 3</h4>
                                    <p class="mb-0">Detalhamento e Entrega</p>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-4">
                            <a href="#cadastro" class="btn btn-outline-primary btn-lg">Quero otimizar meu fluxo</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Depoimentos Section -->
    <div class="container mb-5">
        <div class="text-center mb-5">
            <h2 class="display-6 fw-bold">O que nossos clientes dizem</h2>
        </div>
        <div class="row g-4 justify-content-center">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <blockquote class="blockquote mb-0">
                            <p class="mb-2">"A plataforma facilitou muito a organização dos meus projetos e o contato com clientes!"</p>
                            <footer class="blockquote-footer">Ana Souza, <cite title="Source Title">Arquiteta</cite></footer>
                        </blockquote>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <blockquote class="blockquote mb-0">
                            <p class="mb-2">"O controle de horas e tarefas é sensacional. Recomendo para todos os escritórios."</p>
                            <footer class="blockquote-footer">Carlos Lima, <cite title="Source Title">Gestor de Projetos</cite></footer>
                        </blockquote>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div id="cadastro" class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h2 class="display-5 fw-bold mb-4">Pronto para Começar?</h2>
                <p class="lead mb-4">Transforme a gestão do seu escritório de arquitetura hoje mesmo.</p>
                <a href="/site/signup" class="btn btn-success btn-lg px-5 py-3">Crie sua Conta Agora</a>
                <p class="mt-3 text-muted">Sem cartão de crédito. Teste grátis por 14 dias.</p>
            </div>
        </div>
    </div>
</div>

<!-- Adicione este CSS no arquivo de layout ou em um arquivo CSS separado -->
<style>
.hero-section {
    border-radius: 2rem 2rem 2rem 2rem;
    background: linear-gradient(180deg, rgb(107, 153, 199) 0%, rgb(255, 255, 255) 100%);
    padding-top: 80px;    /* Apenas o espaço superior */
    padding-bottom: 80px; /* Espaço inferior */
    padding-left: 30px;   /* Espaço à esquerda */
    padding-right: 30px;  /* Espaço à direita */
    right: 0;
    left: 0;
    top: 0;
    bottom: 0;
}

.timeline-arrow {
    position: relative;
    height: 2px;
    background-color: #dee2e6;
    width: 100%;
    margin-top: 1.5rem;
}

.timeline-arrow:after {
    content: '';
    position: absolute;
    right: -5px;
    top: -4px;
    width: 0;
    height: 0;
    border-left: 10px solid #dee2e6;
    border-top: 5px solid transparent;
    border-bottom: 5px solid transparent;
}

@media (max-width: 767.98px) {
    .timeline-arrow {
        transform: rotate(90deg);
        margin: 1rem 0;
    }
}
</style>