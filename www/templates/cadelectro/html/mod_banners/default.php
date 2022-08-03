<?php
defined('_JEXEC') or die;
$app = JFactory::getApplication();
$menu = $app->getMenu();
$lang = JFactory::getLanguage();
$currPage
    = JFactory::getApplication()->getMenu()->getActive()
    ?: $menu->getItems(
        'link',
        trim($app->input->server->getHtml('REQUEST_URI'), '/\\'),
        true
    );
$homepage = ($currPage == $menu->getDefault($lang->getTag()));
$classes = [];
if ($homepage) {
    $classes[] = 'homepage';
}
if (isset($attribs['type']) && $attribs['type'] === 'mobile') {
    $classes[] = 'mobile';
}

/** @var stdClass[] $list */
?>

<div id="slider"
     <?php if (count($classes)){
         echo 'class="'.implode(' ', $classes).'"';
     };?>
>
    <?php foreach ($list as $item): ?>
        <?php if ($item->type === 1): ?>
            <div class="slide">
                <?= $item->custombannercode; ?>
            </div>
        <?php else: ?>
            <div class="slide"
                 style="background-image:url('<?= $item->params->get(
                     'imageurl'
                 ); ?>')">
            </div>
            <div class="bgr">
                <div class="triangle triangle1"></div>
                <div class="triangle triangle2"></div>
                <div class="triangle triangle3"></div>
                <div class="triangle triangle-white"></div>
                <div class="white-area"></div>
            </div>
            <div class="bgr-mobile">
            </div>
            <div class="logo">
                <img class="banner-logo"
                     src="/templates/cadelectro/assets/img/cadelectro-logo.png">
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
</div>