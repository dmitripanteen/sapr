<?php defined('_JEXEC') or die;

if ($this->params['menu-meta_description']){
    JFactory::getDocument()->setDescription($this->params['menu-meta_description']);
}
if ($this->params['menu-meta_keywords']){
    JFactory::getDocument()->setMetaData('keywords', $this->params['menu-meta_keywords']);
}
?>
<h1 class="page-header"><?=$this->pageHeading;?></h1>
<?php if ($this->textBeforeVideos): ?>
    <div class="text-before-content">
        <?= $this->textBeforeVideos; ?>
    </div>
<?php endif; ?>
<div class="videos">
    <?php foreach ($this->items as $item):?>
    <div class="col">
        <div class="video-header">
            <?=$item->title;?>
        </div>
        <div class="video-descr">
            <?=$item->description;?>
        </div>
        <div class="video-iframe youtubeVideoWrapper responsive-youtube">
            <?=$item->link;?>
        </div>
    </div>
    <?php endforeach;?>
</div>
