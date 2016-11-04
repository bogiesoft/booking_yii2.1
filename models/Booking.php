<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "booking".
 *
 * @property integer $id
 * @property integer $id_user
 * @property integer $id_tour
 * @property string $date_tour
 */
class Booking extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'booking';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_user', 'id_tour', 'date_tour'], 'required'],
            [['id_user', 'id_tour'], 'integer'],
            [['date_tour'], 'safe'],
            [['date_tour'], 'date', 'format' => 'y-m-d'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'id_user' => Yii::t('app', 'Id User'),
            'id_tour' => Yii::t('app', 'Id Tour'),
            'date_tour' => Yii::t('app', 'Date Tour'),
        ];
    }
    
    public function getTours()
    {
        return $this->hasOne(Tour::className(), ['id' => 'id_tour']);
    }
    
}
