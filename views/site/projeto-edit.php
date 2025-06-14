<?php

/** @var yii\web\View $this */
/** @var app\models\ProjectForm $model */
/** @var app\models\Project $projeto */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Editar Projeto - ' . $projeto->name;
?>

<div class="projeto-edit">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- Breadcrumb -->
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><?= Html::a('Projetos', ['site/projects']) ?></li>
                        <li class="breadcrumb-item"><?= Html::a($projeto->name, ['site/projeto-view', 'id' => $projeto->id]) ?></li>
                        <li class="breadcrumb-item active">Editar</li>
                    </ol>
                </nav>
                
                <!-- Card Principal -->
                <div class="card shadow-lg border-0 fade-in-up">
                    <div class="card-header bg-gradient-warning text-dark">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-pencil-fill me-3 fs-4"></i>
                            <h3 class="mb-1">Editar Projeto: <?= Html::encode($projeto->name) ?></h3>
                        </div>
                    </div>
                    
                    <div class="card-body p-4">
                        <?php $form = ActiveForm::begin([
                            'options' => ['class' => 'needs-validation', 'novalidate' => true]
                        ]); ?>
                        
                        <!-- Informações Básicas -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="text-primary mb-3">
                                    <i class="bi bi-info-circle me-2"></i>Informações Básicas
                                </h5>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($model, 'name')->textInput([
                                    'placeholder' => 'Ex: Residência Silva',
                                    'class' => 'form-control'
                                ])->label('Nome do Projeto *') ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($model, 'cliente')->textInput([
                                    'placeholder' => 'Nome do cliente',
                                    'class' => 'form-control'
                                ])->label('Cliente *') ?>
                            </div>
                        </div>
                        
                        <!-- Detalhes do Projeto -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="text-primary mb-3">
                                    <i class="bi bi-gear me-2"></i>Detalhes do Projeto
                                </h5>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($model, 'tipo_projeto')->dropDownList([
                                    '' => 'Selecione o tipo de projeto',
                                    'residencial' => 'Residencial',
                                    'comercial' => 'Comercial',
                                    'reforma' => 'Reforma',
                                    'paisagismo' => 'Paisagismo',
                                    'interiores' => 'Design de Interiores',
                                    'outro' => 'Outro'
                                ], ['class' => 'form-select'])->label('Tipo de Projeto') ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($model, 'status')->dropDownList([
                                    'ativo' => 'Em Andamento',
                                    'orcamento' => 'Orçamento',
                                    'pausado' => 'Pausado',
                                    'concluido' => 'Concluído'
                                ], ['class' => 'form-select'])->label('Status') ?>
                            </div>
                        </div>
                        
                        <!-- Informações Financeiras e Cronograma -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="text-primary mb-3">
                                    <i class="bi bi-calendar-check me-2"></i>Cronograma e Valores
                                </h5>
                            </div>
                            <div class="col-md-4">
                                <?= $form->field($model, 'data_inicio')->input('date', [
                                    'class' => 'form-control'
                                ])->label('Data de Início') ?>
                            </div>
                            <div class="col-md-4">
                                <?= $form->field($model, 'data_entrega')->input('date', [
                                    'class' => 'form-control'
                                ])->label('Previsão de Entrega') ?>
                            </div>
                            <div class="col-md-4">
                                <?= $form->field($model, 'valor_total')->textInput([
                                    'placeholder' => 'Ex: 50000.00',
                                    'class' => 'form-control',
                                    'step' => '0.01',
                                    'type' => 'number'
                                ])->label('Valor Total (R$)') ?>
                            </div>
                        </div>
                        
                        <!-- Localização -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="text-primary mb-3">
                                    <i class="bi bi-geo-alt me-2"></i>Localização
                                </h5>
                            </div>
                            <div class="col-12">
                                <?= $form->field($model, 'endereco')->textInput([
                                    'placeholder' => 'Endereço completo do projeto',
                                    'class' => 'form-control'
                                ])->label('Endereço') ?>
                            </div>
                        </div>
                        
                        <!-- Descrição -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="text-primary mb-3">
                                    <i class="bi bi-card-text me-2"></i>Descrição
                                </h5>
                            </div>
                            <div class="col-12">
                                <?= $form->field($model, 'description')->textarea([
                                    'rows' => 4,
                                    'placeholder' => 'Descreva detalhes do projeto, objetivos, especificações técnicas...',
                                    'class' => 'form-control'
                                ])->label('Descrição Detalhada') ?>
                            </div>
                        </div>
                        
                        <!-- Botões -->
                        <div class="row">
                            <div class="col-12">
                                <hr class="my-4">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <?= Html::a('<i class="bi bi-arrow-left me-2"></i>Voltar', 
                                            ['site/projeto-view', 'id' => $projeto->id], 
                                            ['class' => 'btn btn-outline-secondary btn-lg']) ?>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-outline-danger btn-lg me-3" onclick="resetForm()">
                                            <i class="bi bi-arrow-clockwise me-2"></i>Limpar
                                        </button>
                                        <button type="submit" class="btn btn-warning btn-lg">
                                            <i class="bi bi-check-circle me-2"></i>Atualizar Projeto
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Confirmação para Limpar -->
<div class="modal fade" id="resetModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmar Ação</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Tem certeza que deseja descartar todas as alterações e voltar aos dados originais?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" onclick="confirmReset()">Sim, Descartar</button>
            </div>
        </div>
    </div>
</div>

<style>
.fade-in-up {
    animation: fadeInUp 0.6s ease-out;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.bg-gradient-warning {
    background: linear-gradient(135deg, #ffc107 0%, #ff8800 100%);
}

.card-header h3 {
    font-weight: 600;
}

.form-control:focus,
.form-select:focus {
    border-color: #ffc107;
    box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.25);
}

.btn-warning {
    background: linear-gradient(135deg, #ffc107 0%, #ff8800 100%);
    border: none;
    font-weight: 600;
}

.btn-warning:hover {
    background: linear-gradient(135deg, #ff8800 0%, #ffc107 100%);
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.text-primary {
    color: #0d6efd !important;
}

h5.text-primary {
    border-bottom: 2px solid #0d6efd;
    padding-bottom: 8px;
}
</style>

<script>
function resetForm() {
    // Criar modal usando Bootstrap
    var resetModal = new bootstrap.Modal(document.getElementById('resetModal'));
    resetModal.show();
}

function confirmReset() {
    // Recarregar a página para voltar aos dados originais
    window.location.reload();
}

// Validação de formulário
(function() {
    'use strict';
    window.addEventListener('load', function() {
        var forms = document.getElementsByClassName('needs-validation');
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();
</script>
