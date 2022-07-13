<?php
defined('_JEXEC') or die;

$listDirn = $this->escape($this->state->get('list.direction'));
$listOrder = $this->escape($this->state->get('list.ordering'));
$saveOrder = $listOrder == 'ordering';

foreach ($this->items as $i => $item): ?>
	<tr class="row<?= $i % 2; ?>">
		<td class="center">
			<?= $item->id; ?>
		</td>
		<td class="center">
			<?= JHtml::_('grid.id', $i, $item->id); ?>
		</td>
        <td class="center">
            <?= JHtml::_('jgrid.published', $item->published, $i, 'videos.', true, 'cb', null, null); ?>
        </td>
        <td>
            <a href="<?= JRoute::_('index.php?option=com_videos&task=video.edit&id='.$item->id);?>">
			    <?= $item->title; ?>
            </a>
		</td>
        <td>
			<?= strip_tags($item->description); ?>
		</td>
        <td class="order center">
            <?php $disabled = $saveOrder ? '' : 'disabled="disabled"'; ?>
            <input type="text" name="order[]" size="5" value="<?=$item->ordering;?>" <?=$disabled;?>
                   class="text-area-order input-mini center" />
            <?php if ($saveOrder): ?>
                <?php if ($listDirn == 'asc'): ?>
                    <span><?=$this->pagination->orderUpIcon($i, true, 'videos.orderup', 'JLIB_HTML_MOVE_UP',
                            $saveOrder);?></span>
                    <span><?=$this->pagination->orderDownIcon($i, $this->pagination->total, true, 'videos.orderdown',
                            'JLIB_HTML_MOVE_DOWN', $saveOrder);?></span>
                <?php elseif ($listDirn == 'desc'): ?>
                    <span><?=$this->pagination->orderUpIcon($i, true, 'videos.orderdown', 'JLIB_HTML_MOVE_UP',
                            $saveOrder);?></span>
                    <span><?=$this->pagination->orderDownIcon($i, $this->pagination->total, true, 'videos.orderup',
                            'JLIB_HTML_MOVE_DOWN', $saveOrder);?></span>
                <?php endif; ?>
            <?php endif; ?>
        </td>
	</tr>
<?php endforeach; ?>