<?php

namespace app\controllers;

use Yii;
use app\models\User;
use yii\web\Controller;
use yii\filters\AccessControl;

class UserController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['create'],
                'rules' => [
                    [
                        'actions' => ['create'],
                        'allow' => true,
                        'roles' => ['@'], // Apenas logados
                        'matchCallback' => function () {
                            // Só permite se for admin
                            return Yii::$app->user->identity->role === 'admin';
                        }
                    ],
                ],
            ],
        ];
    }

    public function actionCreate()
    {
        $model = new User();

        // Se for post
        if ($model->load(Yii::$app->request->post())) {
            // Ajuste: se o formulário tem 'password', use esse campo
            if (!empty($model->password)) {
                $model->setPassword($model->password);
            }
            $model->auth_key = Yii::$app->security->generateRandomString();
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Usuário criado com sucesso!');
                return $this->redirect(['create']);
            }
        }

        return $this->render('create', ['model' => $model]);
    }
}