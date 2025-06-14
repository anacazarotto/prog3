<?php

/** @var yii\web\View $this */
/** @var app\models\ProjectForm $model */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Novo Projeto - Geezthor';
?>

<div class="projeto-create fade-in">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- Breadcrumb -->
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><?= Html::a('<i class="bi bi-folder me-1"></i>Projetos', ['site/projects'], ['encode' => false]) ?></li>
                        <li class="breadcrumb-item active"><i class="bi bi-plus-circle me-1"></i>Novo Projeto</li>
                    </ol>
                </nav>
                
                <!-- Card Principal -->
                <div class="card shadow-lg border-0 slide-up">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-plus-circle-fill me-3 fs-4"></i>
                            <h3 class="mb-0">Criar Novo Projeto</h3>
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
                                ], [
                                    'class' => 'form-select',
                                    'options' => ['ativo' => ['selected' => true]]
                                ])->label('Status Inicial') ?>
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
                                    'class' => 'form-control',
                                    'value' => date('Y-m-d')
                                ])->label('Data de Início') ?>
                            </div>                            <div class="col-md-4">
                                <?= $form->field($model, 'data_entrega')->input('date', [
                                    'class' => 'form-control'
                                ])->label('Previsão de Entrega') ?>
                            </div>
                            <div class="col-md-4">
                                <?= $form->field($model, 'valor_total')->input('number', [
                                    'class' => 'form-control',
                                    'placeholder' => '0,00',
                                    'step' => '0.01',
                                    'min' => '0'
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
                                    'placeholder' => 'Rua, número, bairro, cidade - UF',
                                    'class' => 'form-control'
                                ])->label('Endereço do Projeto') ?>
                            </div>
                        </div>
                        
                        <!-- Descrição -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="text-primary mb-3">
                                    <i class="bi bi-file-text me-2"></i>Descrição
                                </h5>
                            </div>
                            <div class="col-12">
                                <?= $form->field($model, 'description')->textarea([
                                    'rows' => 5, 
                                    'placeholder' => 'Descreva os detalhes do projeto, objetivos, especificações técnicas, materiais preferenciais, estilo desejado...',
                                    'class' => 'form-control'
                                ])->label('Descrição do Projeto') ?>
                            </div>
                        </div>
                        
                        <!-- Botões de Ação -->
                        <div class="card-footer bg-light border-0 d-flex gap-3 justify-content-end p-4">
                            <?= Html::a('<i class="bi bi-arrow-left me-2"></i>Cancelar', ['site/projects'], [
                                'class' => 'btn btn-outline-secondary btn-lg'
                            ]) ?>
                            <?= Html::submitButton('<i class="bi bi-check-circle me-2"></i>Criar Projeto', [
                                'class' => 'btn btn-primary btn-lg'
                            ]) ?>
                        </div>
                        
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
                
                <!-- Card de Dicas -->
                <div class="card border-0 bg-light mt-4 fade-in-up" style="animation-delay: 0.2s;">
                    <div class="card-body">
                        <h6 class="text-muted mb-3">
                            <i class="bi bi-lightbulb me-2"></i>Dicas para um bom projeto:
                        </h6>
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="list-unstyled small text-muted">
                                    <li><i class="bi bi-check text-success me-2"></i>Use nomes descritivos e específicos</li>
                                    <li><i class="bi bi-check text-success me-2"></i>Inclua detalhes técnicos na descrição</li>
                                    <li><i class="bi bi-check text-success me-2"></i>Defina prazos realistas</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="list-unstyled small text-muted">
                                    <li><i class="bi bi-check text-success me-2"></i>Especifique materiais e acabamentos</li>
                                    <li><i class="bi bi-check text-success me-2"></i>Considere restrições orçamentárias</li>
                                    <li><i class="bi bi-check text-success me-2"></i>Documente preferências do cliente</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
.projeto-create .card {
    border-radius: var(--border-radius-xl);
    overflow: hidden;
}

.projeto-create .card-header {
    padding: 2rem;
    background: linear-gradient(135deg, var(--primary-color), var(--primary-dark)) !important;
    border: none;
}

.projeto-create .form-label {
    font-weight: 600;
    color: var(--gray-700);
    margin-bottom: 0.75rem;
}

.projeto-create .form-control,
.projeto-create .form-select {
    border: 2px solid var(--gray-200);
    border-radius: var(--border-radius);
    padding: 0.875rem 1rem;
    transition: var(--transition);
    font-size: 1rem;
}

.projeto-create .form-control:focus,
.projeto-create .form-select:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    outline: none;
}

.projeto-create .form-control::placeholder {
    color: var(--gray-400);
    font-style: italic;
}

.projeto-create h5 {
    font-weight: 600;
    border-bottom: 2px solid var(--gray-100);
    padding-bottom: 0.5rem;
}

.projeto-create .bg-light {
    background-color: var(--gray-50) !important;
}

/* Validação */
.form-control.is-invalid {
    border-color: var(--danger-color);
}

.form-control.is-valid {
    border-color: var(--success-color);
}

/* Responsividade do formulário */
@media (max-width: 768px) {
    .projeto-create .card-header {
        padding: 1.5rem;
    }
    
    .projeto-create .card-body {
        padding: 1.5rem !important;
    }
    
    .projeto-create .card-footer {
        padding: 1.5rem !important;
        flex-direction: column;
    }
    
    .projeto-create .btn {
        width: 100%;
        margin-bottom: 0.5rem;
    }
}
</style>