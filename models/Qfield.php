<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "uq_fields".
 *
 * @property integer $id
 * @property integer $id_tour
 * @property string $field_name
 * @property string $field_data
 */
class Qfield extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'uq_fields';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_tour', 'field_name', 'field_data'], 'required'],
            [['id_tour'], 'integer'],
            [['field_name', 'field_data'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'id_tour' => Yii::t('app', 'Id Tour'),
            'field_name' => Yii::t('app', 'Field Name'),
            'field_data' => Yii::t('app', 'Field Data'),
        ];
    }
}
