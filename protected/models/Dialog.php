<?php

/**
 * @property integer $id
 * @property integer $sender_id
 * @property integer $receiver_id
 * @property string $text
 * @property integer $createdOn
 *
 * @property User $sender
 * @property User $receiver
 */
class Dialog extends CActiveRecord
{
    public function tableName()
    {
        return 'dialog';
    }

    public function rules()
    {
        return array(
            array('sender_id, receiver_id, text, createdOn', 'required'),
            array('sender_id, receiver_id, createdOn', 'numerical', 'integerOnly' => true),
        );
    }

    public function relations()
    {
        return array(
            'sender' => array(self::BELONGS_TO, 'User', 'sender_id'),
            'receiver' => array(self::BELONGS_TO, 'User', 'receiver_id'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'id' => '#',
            'sender_id' => 'Отправитель',
            'receiver_id' => 'Получатель',
            'text' => 'Сообщение',
            'createdOn' => 'Создано',
        );
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Dialog the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    protected function beforeValidate()
    {
        if ($this->isNewRecord) {
            $this->createdOn = time();
        }

        return parent::beforeValidate();
    }
}
