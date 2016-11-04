<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tour".
 *
 * @property integer $id
 * @property string $name
 * @property integer $adult_q
 * @property integer $child_q
 * @property integer $baby_q
 */
class Tour extends \yii\db\ActiveRecord
{
	use \mootensai\relation\RelationTrait;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tour';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string'],
            [['adult_q', 'child_q', 'baby_q'], 'integer', 'max'=>9],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'adult_q' => Yii::t('app', 'Adult Q'),
            'child_q' => Yii::t('app', 'Child Q'),
            'baby_q' => Yii::t('app', 'Baby Q'),
        ];
    }
	
	public function getQfields()
    {
        return $this->hasMany(Qfield::className(), ['id_tour' => 'id']);
    }
}
