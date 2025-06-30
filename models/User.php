<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{
    // Campo auxiliar para senha (não vai para o banco)
    public $password;

    /**
     * Nome da tabela.
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * Regras de validação.
     */
    public function rules()
    {
        return [
            [['username', 'role'], 'required'],
            ['password', 'required', 'on' => 'create'],
            [['username'], 'string', 'max' => 64],
            [['password_hash'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['role'], 'string', 'max' => 16],
            [['created_at', 'updated_at'], 'integer'],
            [['username'], 'unique'],
            [['password'], 'string', 'min' => 6],
        ];
    }

    /**
     * Labels para o formulário.
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Usuário',
            'password' => 'Senha',
            'password_hash' => 'Hash da Senha',
            'auth_key' => 'Auth Key',
            'role' => 'Papel',
            'created_at' => 'Criado em',
            'updated_at' => 'Atualizado em',
        ];
    }

    /**
     * Antes de salvar, gera o hash da senha se informado.
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if (!empty($this->password)) {
                $this->setPassword($this->password);
            }
            if ($this->isNewRecord) {
                $this->auth_key = Yii::$app->security->generateRandomString();
            }
            return true;
        }
        return false;
    }

    /**
     * Gera e armazena o hash da senha.
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Valida a senha informada.
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    // Métodos do IdentityInterface

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }
}