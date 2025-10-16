<?php
require $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_admin_before.php';
\Bitrix\Main\Loader::includeModule('faqmodule.qna');
use Faqmodule\Qna\FaqTable;

$ID = $_REQUEST['ID'] ?? 0;
$data = ['ACTIVE'=>'Y','SORT'=>500,'QUESTION'=>'','ANSWER'=>''];

if ($ID>0) {
    $row = FaqTable::getByPrimary($ID)->fetch();
    if ($row) { $data = array_merge($data, $row); }
}

if ($_SERVER['REQUEST_METHOD']==='POST' && $_POST['action'] == 'Отмена' && check_bitrix_sessid()) {

	LocalRedirect('/bitrix/admin/faqmodule_qna_list.php');

} elseif ($_SERVER['REQUEST_METHOD']==='POST' && check_bitrix_sessid()) {
    $fields = [
        'ACTIVE'   => ($_POST['ACTIVE'] ?? '') === 'Y' ? 'Y' : 'N',
        'QUESTION' => (string)$_POST['QUESTION'],
        'ANSWER'   => (string)$_POST['ANSWER'],
        'SORT'     => (int)$_POST['SORT'],
    ];
    if ($ID>0) {
        FaqTable::update($ID, $fields);
    } else {
        $res = FaqTable::add($fields);
        if ($res->isSuccess()) { $ID = (int)$res->getId(); }
    }
    LocalRedirect('/bitrix/admin/faqmodule_qna_list.php');
}

$APPLICATION->SetTitle($ID>0 ? 'Редактирование вопроса #'.$ID : 'Добавление вопроса');

require $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_admin_after.php';
?>
<form method="post">
  <?=bitrix_sessid_post();?>
  <table class="adm-detail-content-table edit-table">
    <tr>
      <td width="40%">Активность</td>
      <td><input type="checkbox" name="ACTIVE" value="Y" <?=$data['ACTIVE']==='Y'?'checked':''?>></td>
    </tr>
    <tr>
      <td>Сортировка</td>
      <td><input type="number" name="SORT" value="<?=$data['SORT']?>"></td>
    </tr>
    <tr>
      <td>Вопрос:</td>
      <td><input type="text" name="QUESTION" style="width:100%;" value="<?=htmlspecialcharsbx($data['QUESTION'])?>"></td>
    </tr>
    <tr>
      <td>Ответ:</td>
      <td><textarea name="ANSWER" style="width:100%;height:220px;"><?=htmlspecialcharsbx($data['ANSWER'])?></textarea></td>
    </tr>
  </table>
  <input type="submit" class="adm-btn-save" value="Сохранить">
  <input type="submit" name="action" value="Отмена">
</form>
<?php
require $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/epilog_admin.php';
