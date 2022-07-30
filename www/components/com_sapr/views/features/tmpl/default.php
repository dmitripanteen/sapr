<?php defined('_JEXEC') or die;

if ($this->params['menu-meta_description']) {
    JFactory::getDocument()->setDescription(
        $this->params['menu-meta_description']
    );
}
if ($this->params['menu-meta_keywords']) {
    JFactory::getDocument()->setMetaData(
        'keywords',
        $this->params['menu-meta_keywords']
    );
}
?>
<div class="left-menu">
    <div class="menu-items">
        <?php foreach ($this->items as $key => $item):?>
        <div class="left-menu-item<?php if(!$key):?> active<?php endif;?>"
             data-target="#<?=$item->alias;?>"
        >
            <a href="#<?=$item->alias;?>"><?=$item->title;?></a>
        </div>
        <?php endforeach;?>
    </div>
    <a class="btn btn-default btn-orange rounded menu-btn"
       href="/trial-version"
    >
        <?= JText::_('COM_SAPR_REQUEST_TRIAL_VERSION_BUTTON_LABEL'); ?>
    </a>
</div>

<?php foreach ($this->items as $key => $item):?>
    <?php if($item->layout==='column'):?>
        <div class="feature-item-content content-column<?php if(!$key):?> active<?php endif;?>"
             id="<?=$item->alias;?>"
        >
            <h1 class="page-header">
                <?=$item->custom_header ?: $item->title;?>
            </h1>
            <div class="description">
                <?=$item->description;?>
            </div>
            <?php if($item->type==='article' && $item->image):?>
                <img class="item-image"
                     src="<?=$item->image;?>"
                     alt="<?=$item->title;?>"
                />
            <?php endif;?>
            <?php if ($item->type==='images' && $item->gallery):?>
                <div class="gallery-content">
                    <div class="gallery-menu">
                        <?php foreach ($item->gallery as $key => $galleryItem):?>
                            <?php if($galleryItem->published):?>
                                <div class="gallery-menu-item<?= $key==='gallery0' ? ' active' : '';?>"
                                     data-group="<?=$key;?>"
                                >
                                    <?=$galleryItem->title;?>
                                </div>
                            <?php endif;?>
                        <?php endforeach;?>
                    </div>
                    <div class="gallery-images">
                        <?php foreach ($item->gallery as $key => $galleryItem):?>
                            <?php if($galleryItem->published):?>
                                <div class="gallery-images-items<?= $key==='gallery0' ? ' active' : '';?>"
                                     data-group="<?=$key;?>"
                                >
                                    <?php if($galleryItem->image1):?>
                                        <div class="image">
                                            <img src="/templates/cadelectro/assets/img/magnifier.png"
                                                 class="magnifier"
                                            >
                                            <img id="<?= $key . 'image1'; ?>"
                                                 class="scheme"
                                                 src="<?= $galleryItem->image1; ?>">
                                        </div>
                                    <?php endif;?>
                                    <?php if($galleryItem->image2):?>
                                        <div class="image">
                                            <img src="/templates/cadelectro/assets/img/magnifier.png"
                                                 class="magnifier"
                                            >
                                            <img id="<?= $key . 'image2'; ?>"
                                                 class="scheme"
                                                 src="<?= $galleryItem->image2; ?>">
                                        </div>
                                    <?php endif;?>
                                    <?php if($galleryItem->image3):?>
                                        <div class="image">
                                            <img src="/templates/cadelectro/assets/img/magnifier.png"
                                                 class="magnifier"
                                            >
                                            <img id="<?= $key . 'image3'; ?>"
                                                 class="scheme"
                                                 src="<?= $galleryItem->image3; ?>">
                                        </div>
                                    <?php endif;?>
                                </div>
                            <?php endif;?>
                        <?php endforeach;?>
                    </div>
                </div>
            <?php endif;?>
        </div>
    <?php else:?>
        <div class="feature-item-content content-row<?php if(!$key):?> active<?php endif;?>"
             id="<?=$item->alias;?>"
        >
            <div class="col-left">
                <h1 class="page-header">
                    <?=$item->custom_header ?: $item->title;?>
                </h1>
                <div class="description">
                    <?=$item->description;?>
                </div>
            </div>
            <div class="col-right">
                <?php if($item->image):?>
                    <div class="triangle"></div>
                    <div class="item-image"
                         style="background-image: url(<?=$item->image;?>)"
                    ></div>
                <?php endif;?>
            </div>
        </div>
    <?php endif;?>
<?php endforeach;?>

<div id="modal" class="modal">
    <span class="close">&times;</span>
    <img class="modal-content" id="modal-image">
</div>