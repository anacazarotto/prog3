<?php

namespace app\models;

use yii\db\ActiveRecord;

class Project extends ActiveRecord
{
    public static function tableName()
    {
        return 'projetos'; // nome da tabela no banco de dados
    }

    public function rules()
    {
        return [
            [['name', 'cliente'], 'required'],
            [['description', 'endereco'], 'string'],
            [['data_inicio'], 'safe'],
            [['valor_total'], 'number'],
            [['cliente', 'tipo_projeto', 'status', 'name'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Nome do Projeto',
            'description' => 'Descrição',
            'cliente' => 'Cliente',
            'data_inicio' => 'Data de Início',
            'valor_total' => 'Valor Total',
            'endereco' => 'Endereço',
            'tipo_projeto' => 'Tipo de Projeto',
            'status' => 'Status',
            'etapas' => 'Etapas',
        ];
    }
}