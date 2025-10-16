<?php
use Bitrix\Main\Config\Option;

$module = 'faqmodule.qna';
if ($_SERVER['REQUEST_METHOD']==='POST' && check_bitrix_sessid()) {
    Option::set($module, 'PADDING_TOP', (string)max(0, intval($_POST['PADDING_TOP'])));
    Option::set($module, 'PADDING_BOTTOM', (string)max(0, intval($_POST['PADDING_BOTTOM'])));
}
$padTop = Option::get($module,'PADDING_TOP','40');
$padBot = Option::get($module,'PADDING_BOTTOM','40');
?>
<form method="post">
  <?=bitrix_sessid_post();?>
  <table class="adm-detail-content-table edit-table">
    <tr>
      <td width="40%">Отступ сверху (px):</td>
      <td><input type="number" name="PADDING_TOP" value="<?=$padTop?>" min="0"></td>
    </tr>
    <tr>
      <td>Отступ снизу (px):</td>
      <td><input type="number" name="PADDING_BOTTOM" value="<?=$padBot?>" min="0"></td>
    </tr>
  </table>
  <div style="margin-top:10px;">
    <a class="adm-btn" href="/bitrix/admin/faqmodule_qna_list.php">Открыть список вопросов</a>
  </div>
  <input type="submit" value="Сохранить" class="adm-btn-save">
</form>
