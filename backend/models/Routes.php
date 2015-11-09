<?php

namespace backend\models;

use common\models\User;

use Yii;

/**
 * This is the model class for table "routes".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $route
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property RouteUrls[] $routeUrls
 * @property User $user
 */
class Routes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'routes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['route'], 'required'],
            [['route'], 'unique'],
            [['route'], 'string', 'max' => 255],
            [['route'], 'filter', 'filter' => 'trim'],
            [['route'], 'match', 'pattern' => '/^[a-zA-Z0-9-_\/]+$/'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Username',
            'route' => 'Route',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRouteUrls()
    {
        return $this->hasMany(RouteUrls::className(), ['route_id' => 'id']);
    }

    public function getLastRouteUrl()
    {
        return $this->hasMany(RouteUrls::className(), ['route_id' => 'id'])
            ->orderBy(['created_at' => SORT_DESC])
            ->one();
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function beforeSave($insert)
    {
        if ($insert) {
          $this->created_at = strtotime(date('Y-m-d H:m:s'));
          $this->updated_at = strtotime(date('Y-m-d H:m:s'));
          $this->user_id = Yii::$app->user->identity->getId();
        } else {
          $this->updated_at = strtotime(date('Y-m-d H:m:s'));
        }
        return parent::beforeSave($insert);
    }

    public function beforeDelete()
    {
        if ($this->user_id == Yii::$app->user->identity->getId()) {
            return parent::beforeDelete();
        } else {
            return false;
        }
    }
}
