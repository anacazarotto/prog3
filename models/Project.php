<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Project extends ActiveRecord
{
    public static function tableName()
    {
        return 'projetos';
    }

    public function rules()
    {
        return [
            [['name', 'description', 'cliente', 'data_inicio', 'data_entrega', 'valor_total', 'endereco', 'tipo_projeto', 'status', 'horas_trabalhadas', 'pendencias', 'user_id'], 'safe'],
            [['name', 'user_id'], 'required'],
            [['user_id'], 'integer'],
            [['valor_total'], 'number'],
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}