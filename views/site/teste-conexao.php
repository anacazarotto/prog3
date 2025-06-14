<?php
/** @var yii\web\View $this */
/** @var string $status */
/** @var string $mensagem */
/** @var array $dbInfo */

use yii\helpers\Html;

$this->title = 'Teste de Conexão com Banco de Dados';
$this->params['breadcrumbs'][] = $this->title;

$statusClass = $status === 'Sucesso' ? 'success' : 'danger';
?>

<div class="site-teste-conexao">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h1 class="mb-0 h3"><?= Html::encode($this->title) ?></h1>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-<?= $statusClass ?> mb-4">
                            <h4 class="alert-heading"><?= Html::encode($status) ?></h4>
                            <p><?= Html::encode($mensagem) ?></p>
                        </div>
                        
                        <h5>Informações do Banco de Dados:</h5>
                        <ul class="list-group mb-4">
                            <?php foreach ($dbInfo as $key => $value): ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span><strong><?= Html::encode($key) ?>:</strong></span>
                                    <span><?= Html::encode($value) ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        
                        <?php if ($status === 'Erro'): ?>
                            <div class="mt-4">
                                <h5>Possíveis soluções:</h5>
                                <ul>
                                    <li>Verifique se o MySQL está em execução (verifique no XAMPP Control Panel)</li>
                                    <li>Confira se o banco de dados 'geezthor' foi criado</li>
                                    <li>Verifique as configurações de usuário e senha em config/db.php</li>
                                    <li>Verifique se o servidor MySQL está escutando na porta correta (geralmente 3306)</li>
                                </ul>
                            </div>
                        <?php endif; ?>
                        
                        <div class="mt-4 text-center">
                            <?= Html::a('Voltar para Home', ['site/index'], ['class' => 'btn btn-primary mr-2']) ?>
                            <?= Html::a('Testar novamente', ['site/teste-conexao'], ['class' => 'btn btn-outline-primary']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
