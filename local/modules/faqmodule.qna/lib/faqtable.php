<?php
namespace Faqmodule\Qna;

use Bitrix\Main\Entity;

class FaqTable extends Entity\DataManager
{
    public static function getTableName()
    {
        return 'b_faqmodule_qna';
    }

    public static function getMap()
    {
        return [
            new Entity\IntegerField('ID', ['primary' => true, 'autocomplete' => true]),
            new Entity\BooleanField('ACTIVE', ['values' => ['N','Y'], 'default_value' => 'Y']),
            new Entity\StringField('QUESTION', ['required' => true, 'validation' => function(){return [new Entity\Validator\Length(null, 1000)];}]),
            new Entity\TextField('ANSWER', ['required' => true]),
            new Entity\IntegerField('SORT', ['default_value' => 500]),
            new Entity\DatetimeField('DATE_CREATE', ['default_value' => function(){ return new \Bitrix\Main\Type\DateTime(); }]),
        ];
    }
}
