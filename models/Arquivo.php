<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use Yii;

class Arquivo extends ActiveRecord
{
    public $uploadFile;

    public static function tableName()
    {
        return 'arquivo';
    }

    public function rules()
    {
        return [
            [['project_id'], 'integer'],
            [['caminho'], 'string', 'max' => 255],
            [
                ['uploadFile'], 'file',
                'skipOnEmpty' => false,
                'message' => 'Por favor, selecione um arquivo para enviar.'
            ],
        ];
    }

    public function upload()
{
    if ($this->validate()) {
        $uploadDir = Yii::getAlias('@webroot') . '/uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0775, true);
        }
        $fileName = uniqid() . '.' . $this->uploadFile->extension;
        $filePath = $uploadDir . $fileName;
        if ($this->uploadFile->saveAs($filePath)) {
            $this->caminho = 'uploads/' . $fileName;
            return true;
        }
    }
    return false;
}

    public function getProjeto()
    {
        return $this->hasOne(Project::class, ['id' => 'project_id']);
    }
}