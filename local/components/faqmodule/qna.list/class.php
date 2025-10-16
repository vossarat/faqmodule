<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Loader;
use Bitrix\Main\Config\Option;
use Faqmodule\Qna\FaqTable;

class FaqmoduleQnaListComponent extends CBitrixComponent
{
    public function executeComponent()
    {
        Loader::includeModule('faqmodule.qna');
		
		$this->arResult['OPTIONS'] = [
			'PADDING_TOP'    => (int)($this->arParams['PADDING_TOP'] ?: Option::get('faqmodule.qna','PADDING_TOP','40')),
			'PADDING_BOTTOM' => (int)($this->arParams['PADDING_BOTTOM'] ?: Option::get('faqmodule.qna','PADDING_BOTTOM','40')),
		];

        $this->arResult['ITEMS'] = FaqTable::getList([
            'select' => ['ID','QUESTION','ANSWER'],
            'filter' => ['=ACTIVE'=>'Y'],
            'order'  => ['SORT'=>'ASC','ID'=>'DESC'],
            'limit'  => 500,
        ])->fetchAll();

        $this->includeComponentTemplate();
    }
}
