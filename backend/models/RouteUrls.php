<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "route_urls".
 *
 * @property integer $id
 * @property integer $route_id
 * @property string $url
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Routes $route
 */
class RouteUrls extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'route_urls';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['url'], 'required'],
            [['url'], 'unique'],
            [['url'], 'string', 'max' => 255],
            [['url'], 'filter', 'filter' => 'trim'],
            [['url'], 'match', 'pattern' => '/^[a-zA-Z0-9]+$/'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'route_id' => 'Route ID',
            'url' => 'Url',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoute()
    {
        return $this->hasOne(Routes::className(), ['id' => 'route_id']);
    }

    public function beforeSave($insert)
    {
        $routeId = Yii::$app->request->get('id');

        if ($insert) {
          $this->created_at = strtotime(date('Y-m-d H:m:s'));
          $this->updated_at = strtotime(date('Y-m-d H:m:s'));
          $this->route_id = $routeId;
        } else {
          $this->updated_at = strtotime(date('Y-m-d H:m:s'));
        }
        return parent::beforeSave($insert);
    }

    public function beforeDelete()
    {
        if ($this->route_id->user_id == Yii::$app->user->identity->getId()) {
            return parent::beforeDelete();
        } else {
            return false;
        }
    }

}
