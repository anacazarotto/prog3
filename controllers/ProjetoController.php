<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\ProjectForm;
use app\models\Project;
use app\models\Comentario;
use app\models\Arquivo;
use yii\web\UploadedFile;

class ProjetoController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['projeto-create', 'projeto-edit', 'projeto-delete'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => false,
                    ],
                ],
            ],
        ];
    }

    public function actionProjetoCreate()
    {
        $model = new ProjectForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $projeto = new Project();
            $projeto->name = $model->name;
            $projeto->description = $model->description;
            $projeto->cliente = $model->cliente;
            $projeto->data_inicio = $model->data_inicio;
            $projeto->data_entrega = $model->data_entrega;
            $projeto->valor_total = $model->valor_total;
            $projeto->endereco = $model->endereco;
            $projeto->tipo_projeto = $model->tipo_projeto;
            $projeto->status = $model->status;
            $projeto->horas_trabalhadas = $model->horas_trabalhadas;
            $projeto->pendencias = $model->pendencias;
            $projeto->user_id = Yii::$app->user->id;

            if ($projeto->save()) {
                Yii::$app->session->setFlash('success', 'Projeto criado com sucesso!');
                return $this->redirect(['projects']);
            } else {
                Yii::$app->session->setFlash('error', 'Erro ao salvar: ' . print_r($projeto->errors, true));
            }
        }

        return $this->render('projeto-create', [
            'model' => $model,
        ]);
    }

    public function actionProjects()
    {
        $userId = Yii::$app->user->id;
        if (Yii::$app->user->identity->role === 'admin'){
            $projetos = Project::find()->orderBy(['id' => SORT_DESC])->all();
        } else {
            $projetos = Project::find()->where(['user_id' => $userId])->orderBy(['id' => SORT_DESC])->all();
        }
        $totalAtivos = Project::find()->where(['status' => 'ativo', 'user_id' => $userId])->count();
        $totalConcluidos = Project::find()->where(['status' => 'concluido', 'user_id' => $userId])->count();
        $totalPausados = Project::find()->where(['status' => 'pausado', 'user_id' => $userId])->count();
        $totalOrcamento = Project::find()->where(['status' => 'orcamento', 'user_id' => $userId])->count();
        $faturamento = Project::find()->where(['user_id' => $userId])->sum('valor_total');

        return $this->render('projects', [
            'projetos' => $projetos,
            'estatisticas' => [
                'ativos' => $totalAtivos,
                'concluidos' => $totalConcluidos,
                'pausados' => $totalPausados,
                'orcamento' => $totalOrcamento,
                'faturamento' => $faturamento,
            ]
        ]);
    }

    public function actionProjetos()
    {
        return $this->redirect(['site/projects']);
    }

    public function actionProjetoView($id)
    {
        
        if (Yii::$app->user->identity->role === 'admin'){
            $projeto = Project::findOne(['id' => $id]);
        } else {
            $projeto = Project::findOne(['id' => $id, 'user_id' => Yii::$app->user->id]);
        }
        if ($projeto === null) {
            Yii::$app->session->setFlash('error', 'Projeto não encontrado ou acesso não autorizado.');
            return $this->redirect(['projects']);
        }

        $comentarioModel = new Comentario();
        $arquivoModel = new Arquivo();

        $comentarioModel->project_id = $projeto->id;
        $comentarioModel->username = Yii::$app->user->identity->username;
        $arquivoModel->project_id = $projeto->id;

        if ($comentarioModel->load(Yii::$app->request->post()) && $comentarioModel->save()) {
            Yii::$app->session->setFlash('success', 'Comentário adicionado!');
            return $this->refresh();
        }

        if (Yii::$app->request->isPost) {
            $arquivoModel->uploadFile = UploadedFile::getInstance($arquivoModel, 'uploadFile');
            if ($arquivoModel->upload() && $arquivoModel->save()) {
                Yii::$app->session->setFlash('success', 'Arquivo enviado!');
                return $this->refresh();
            }
        }

        $comentarios = Comentario::find()->where(['project_id' => $id])->orderBy(['created_at' => SORT_DESC])->all();
        $arquivos = Arquivo::find()->where(['project_id' => $id])->orderBy(['created_at' => SORT_DESC])->all();

        return $this->render('projeto-view', [
            'projeto' => $projeto,
            'comentarioModel' => $comentarioModel,
            'arquivoModel' => $arquivoModel,
            'comentarios' => $comentarios,
            'arquivos' => $arquivos,
        ]);
    }

    public function actionProjetoEdit($id)
    {
        if (Yii::$app->user->identity->role === 'admin'){
            $projeto = Project::findOne(['id' => $id]);
        } else {
            $projeto = Project::findOne(['id' => $id, 'user_id' => Yii::$app->user->id]);
        }

        if ($projeto === null) {
            Yii::$app->session->setFlash('error', 'Projeto não encontrado ou acesso não autorizado.');
            return $this->redirect(['projects']);
        }

        $model = new ProjectForm();
        $model->name = $projeto->name;
        $model->description = $projeto->description;
        $model->cliente = $projeto->cliente;
        $model->data_inicio = $projeto->data_inicio;
        $model->data_entrega = $projeto->data_entrega;
        $model->valor_total = $projeto->valor_total;
        $model->endereco = $projeto->endereco;
        $model->tipo_projeto = $projeto->tipo_projeto;
        $model->status = $projeto->status;
        $model->horas_trabalhadas = $projeto->horas_trabalhadas;
        $model->pendencias = $projeto->pendencias;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $projeto->name = $model->name;
            $projeto->description = $model->description;
            $projeto->cliente = $model->cliente;
            $projeto->data_inicio = $model->data_inicio;
            $projeto->data_entrega = $model->data_entrega;
            $projeto->valor_total = $model->valor_total;
            $projeto->endereco = $model->endereco;
            $projeto->tipo_projeto = $model->tipo_projeto;
            $projeto->status = $model->status;
            $projeto->horas_trabalhadas = $model->horas_trabalhadas;
            $projeto->pendencias = $model->pendencias;

            if ($projeto->save()) {
                Yii::$app->session->setFlash('success', 'Projeto atualizado com sucesso!');
                return $this->redirect(['projeto-view', 'id' => $projeto->id]);
            } else {
                Yii::$app->session->setFlash('error', 'Erro ao atualizar: ' . print_r($projeto->errors, true));
            }
        }

        return $this->render('projeto-edit', [
            'model' => $model,
            'projeto' => $projeto,
        ]);
    }

    public function actionProjetoDelete($id)
    {
        $projeto = $this->findModel($id);

        if ($projeto->delete()) {
            Yii::$app->session->setFlash('success', 'Projeto excluído com sucesso!');
        } else {
            Yii::$app->session->setFlash('error', 'Erro ao excluir projeto!');
        }

        return $this->redirect(['site/projects']);
    }

    protected function findModel($id)
    {
        if (($model = Project::findOne(['id' => $id, 'user_id' => Yii::$app->user->id])) !== null) {
            return $model;
        }
        throw new \yii\web\NotFoundHttpException('Projeto não encontrado ou acesso não autorizado.');
    }
}