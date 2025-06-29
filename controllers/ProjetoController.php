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

    /**
     * Creates a new project.
     *
     * @return Response|string
     */
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

    /**
     * Displays projects page.
     *
     * @return string
     */
    public function actionProjects()
    {
        $projetos = Project::find()->orderBy(['id' => SORT_DESC])->all();
        $totalAtivos = Project::find()->where(['status' => 'ativo'])->count();
        $totalConcluidos = Project::find()->where(['status' => 'concluido'])->count();
        $totalPausados = Project::find()->where(['status' => 'pausado'])->count();
        $totalOrcamento = Project::find()->where(['status' => 'orcamento'])->count();
        $faturamento = Project::find()->sum('valor_total');

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

    /**
     * Redireciona para a listagem de projetos.
     *
     * @return string
     */
    public function actionProjetos()
    {
        return $this->redirect(['site/projects']);
    }

    /**
     * Exibe um projeto e permite comentários/anexos.
     *
     * @param integer $id
     * @return string
     */

    public function actionProjetoView($id)
    {
        $projeto = Project::findOne($id);
        if ($projeto === null) {
            Yii::$app->session->setFlash('error', 'Projeto não encontrado.');
            return $this->redirect(['projects']);
        }

        $comentarioModel = new Comentario();
        $arquivoModel = new Arquivo();

        $comentarioModel->project_id = $projeto->id;
        $arquivoModel->project_id = $projeto->id;

        // Comentário POST
        if ($comentarioModel->load(Yii::$app->request->post()) && $comentarioModel->save()) {
            Yii::$app->session->setFlash('success', 'Comentário adicionado!');
            return $this->refresh();
        }

        // Upload de arquivo
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

    /**
     * Edita um projeto existente.
     *
     * @param integer $id
     * @return Response|string
     */
    public function actionProjetoEdit($id)
    {
        $projeto = Project::findOne($id);

        if ($projeto === null) {
            Yii::$app->session->setFlash('error', 'Projeto não encontrado.');
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

    /**
     * Exclui um projeto existente.
     *
     * @param integer $id
     * @return Response
     */
    public function actionProjetoDelete($id)
    {
        $projeto = $this->findModel($id); // Busca segura

        if ($projeto->delete()) {
            Yii::$app->session->setFlash('success', 'Projeto excluído com sucesso!');
        } else {
            Yii::$app->session->setFlash('error', 'Erro ao excluir projeto!');
        }

        return $this->redirect(['site/projects']);
    }

    /**
     * Busca um modelo Project pelo ID.
     * @param integer $id
     * @return Project o modelo encontrado
     * @throws \yii\web\NotFoundHttpException se não encontrado
     */
    protected function findModel($id)
    {
        if (($model = Project::findOne($id)) !== null) {
            return $model;
        }
        throw new \yii\web\NotFoundHttpException('Projeto não encontrado.');
    }

}