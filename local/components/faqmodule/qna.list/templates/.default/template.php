<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$opts = $arResult['OPTIONS'];
?>
<section class="faqmodule-faq" style="padding-top:<?=$opts['PADDING_TOP']?>px;padding-bottom:<?=$opts['PADDING_BOTTOM']?>px;">
  <div class="faqmodule-faq__container">
    <h2 class="faqmodule-faq__title"><?=htmlspecialcharsbx($arParams['TITLE'] ?? 'Ответы на вопросы')?></h2>

    <div class="faqmodule-faq__list">
      <?php foreach ($arResult['ITEMS'] as $i): ?>
        <div class="faqmodule-faq__item" data-id="<?=$i['ID']?>">
          <button class="faqmodule-faq__q" type="button" aria-expanded="false">
            <span><?=htmlspecialcharsbx($i['QUESTION'])?></span>
            <span class="faqmodule-faq__icon" aria-hidden="true">▾</span>
          </button>
          <div class="faqmodule-faq__a" hidden>
            <div class="faqmodule-faq__a-inner">
              <?=$i['ANSWER']?>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

