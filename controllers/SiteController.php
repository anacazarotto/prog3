<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\controllers\ProjetoController;
use app\models\LoginForm;

class SiteController extends ProjetoController
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
     * Testa a conexão com o banco de dados.
     *
     * @return string
     */
    public function actionTesteConexao()
    {
        $resultado = '';
        try {
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