<?php

namespace app\models;

use yii\db\ActiveRecord;

class Comentario extends ActiveRecord
{
    public static function tableName()
    {
        return 'comentario';
    }

    public function rules()
    {
        return [
            [['username', 'comentario', 'project_id'], 'required'],
            [['comentario'], 'string'],
            [['username'], 'string', 'max' => 255],
            [['project_id'], 'integer'],
        ];
    }

    public function getProjeto()
    {
        return $this->hasOne(Project::class, ['id' => 'project_id']);
    }
}
