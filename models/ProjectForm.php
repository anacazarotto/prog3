<?php

namespace app\models;

use yii\base\Model;

class ProjectForm extends Model
{
    public $name;
    public $description;
    public $cliente;
    public $data_inicio;
    public $data_entrega;
    public $valor_total;
    public $endereco;
    public $tipo_projeto;
    public $status;
    public $etapas;
    public $horas_trabalhadas;
    public $pendencias;

    public function rules()
    {
        return [
            [['name', 'cliente'], 'required'],
            [['description', 'endereco'], 'string'],
            [['data_inicio', 'data_entrega'], 'date', 'format' => 'yyyy-MM-dd'],
            [['valor_total'], 'number'],
            [['cliente', 'tipo_projeto', 'status'], 'string'],
            [['horas_trabalhadas', 'pendencias'], 'integer'],
            [['etapas'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Nome do Projeto',
            'description' => 'Descrição',
            'cliente' => 'Cliente',
            'data_inicio' => 'Data de Início',
            'data_entrega' => 'Previsão de Entrega',
            'valor_total' => 'Valor Total',
            'endereco' => 'Endereço',
            'tipo_projeto' => 'Tipo de Projeto',
            'status' => 'Status',
            'etapas' => 'Etapas',
            'horas_trabalhadas' => 'Horas Trabalhadas',
            'pendencias' => 'Pendências',
        ];
    }
}