<?php
require $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_admin_before.php';
\Bitrix\Main\Loader::includeModule('faqmodule.qna');
use Faqmodule\Qna\FaqTable;

$APPLICATION->SetTitle('Модуль "Вопросы-ответ"');

if (isset($_REQUEST['action']) && $_REQUEST['action']==='delete' && check_bitrix_sessid()) {
    $ID = (int)$_REQUEST['ID'];
    if ($ID>0) { FaqTable::delete($ID); }
    LocalRedirect($APPLICATION->GetCurPageParam('', ['action','ID']));
}

require $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_admin_after.php';

$addUrl = '/bitrix/admin/faqmodule_qna_edit.php';

echo '<div style="margin-bottom:10px;"><a class="adm-btn" href="'.$addUrl.'">Добавить вопрос</a></div>';

$rs = FaqTable::getList([
    'order' => ['SORT'=>'ASC','ID'=>'DESC'],
    'select'=> ['ID','ACTIVE','QUESTION','SORT'],
    'filter'=> [],
    'limit' => 500,
]);

?>
<table class="adm-list-table">
  <tr class="adm-list-table-header">
    <td class="adm-list-table-cell">ID</td>
    <td width="10%" class="adm-list-table-cell">Активность</td>
    <td class="adm-list-table-cell">Вопрос</td>
    <td class="adm-list-table-cell">Сортировка</td>
    <td class="adm-list-table-cell">Действия</td>
  </tr>
<?php while($row = $rs->fetch()): 
  $editUrl = '/bitrix/admin/faqmodule_qna_edit.php?ID='.$row['ID'];
  $delUrl  = $APPLICATION->GetCurPageParam('action=delete&ID='.$row['ID'].'&'.bitrix_sessid_get(), ['action','ID']);
?>
  <tr>
    <td class="adm-list-table-cell"><?=$row['ID']?></td>
    <td class="adm-list-table-cell"><?=$row['ACTIVE']=='Y'?'Y':'N'?></td>
    <td class="adm-list-table-cell"><?=htmlspecialcharsbx($row['QUESTION'])?></td>
    <td class="adm-list-table-cell"><?=$row['SORT']?></td>
    <td class="adm-list-table-cell">
      <a href="<?=$editUrl?>">Редактировать</a> /
      <a href="<?=$delUrl?>" onclick="return confirm('Удалить запись #<?=$row['ID']?>?')">Удалить</a>
    </td>
  </tr>
<?php endwhile; ?>
</table>
<?php
require $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/epilog_admin.php';
