<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\ProjectForm;
use app\models\Project;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

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
     */    /**
     * Displays projects page.
     *
     * @return string
     */
    public function actionProjects()
    {
        // Buscar todos os projetos do banco de dados
        $projetos = Project::find()->orderBy(['id' => SORT_DESC])->all();
        
        // Obter estatísticas
        $totalAtivos = Project::find()->where(['status' => 'ativo'])->count();
        $totalConcluidos = Project::find()->where(['status' => 'concluido'])->count();
        $totalPausados = Project::find()->where(['status' => 'pausado'])->count();
        $totalOrcamento = Project::find()->where(['status' => 'orcamento'])->count();
        
        // Calcular valor total dos projetos (faturamento)
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
     * Displays projetos page.
     *
     * @return string
     */
    public function actionProjetos()
    {
        return $this->redirect(['site/projects']);
    }

    /**
     * Displays a single project.
     *
     * @param integer $id
     * @return string
     */
    public function actionProjetoView($id = 1)
    {
        // Buscar o projeto específico no banco de dados
        $projeto = Project::findOne($id);
        
        // Se o projeto não for encontrado, redirecionar para a lista
        if ($projeto === null) {
            Yii::$app->session->setFlash('error', 'Projeto não encontrado.');
            return $this->redirect(['projects']);
        }
        
        return $this->render('projeto-view', [
            'projeto' => $projeto,
        ]);
    }

    /**
     * Edits an existing project.
     *
     * @param integer $id
     * @return Response|string
     */
    public function actionProjetoEdit($id)
    {
        // Buscar o projeto específico no banco de dados
        $projeto = Project::findOne($id);
        
        // Se o projeto não for encontrado, redirecionar para a lista
        if ($projeto === null) {
            Yii::$app->session->setFlash('error', 'Projeto não encontrado.');
            return $this->redirect(['projects']);
        }

        // Criar um modelo de formulário e preencher com os dados existentes
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

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // Atualizar os dados do projeto
            $projeto->name = $model->name;
            $projeto->description = $model->description;
            $projeto->cliente = $model->cliente;
            $projeto->data_inicio = $model->data_inicio;
            $projeto->data_entrega = $model->data_entrega;
            $projeto->valor_total = $model->valor_total;
            $projeto->endereco = $model->endereco;
            $projeto->tipo_projeto = $model->tipo_projeto;
            $projeto->status = $model->status;

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
     * Testa a conexão com o banco de dados
     * 
     * @return string
     */
    public function actionTesteConexao()
    {
        $resultado = '';
        
        try {
            // Tenta executar uma consulta simples
            $resultado = Yii::$app->db->createCommand('SELECT 1 as teste')->queryOne();
            
            if ($resultado) {
                return $this->render('teste-conexao', [
                    'status' => 'Sucesso',
                    'mensagem' => 'Conexão com o banco de dados estabelecida com sucesso!',
                    'dbInfo' => [
                        'Driver' => Yii::$app->db->driverName,
                        'Nome do Banco' => Yii::$app->db->createCommand('SELECT DATABASE() as db')->queryScalar(),
                        'Versão do Servidor' => Yii::$app->db->createCommand('SELECT VERSION() as version')->queryScalar()
                    ]
                ]);
            }
        } catch (\Exception $e) {
            return $this->render('teste-conexao', [
                'status' => 'Erro',
                'mensagem' => 'Falha na conexão com o banco de dados: ' . $e->getMessage(),
                'dbInfo' => [
                    'DSN' => Yii::$app->db->dsn,
                    'Username' => Yii::$app->db->username
                ]
            ]);
        }
    }
}
