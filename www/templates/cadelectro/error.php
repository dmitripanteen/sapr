<?php defined('_JEXEC') or die;

use Joomla\CMS\Factory;
/** @var JDocumentError $this */

$templateUrl = $this->baseurl . '/templates/' . $this->template . '/';
$this->addScript($templateUrl . '/assets/js/main.js?v=1');
$document = Factory::getDocument();
$document->setTitle('Страница не найдена');
?>
<!DOCTYPE html>
<html lang="<?= $this->language; ?>" dir="<?= $this->direction; ?>"
      xmlns:jdoc="http://www.w3.org/2001/XInclude">
<head>
    <jdoc:include type="head"/>
</head>
<body class="content-page">
<div class="page-main-content">
    <header>
    </header>
    <div class="page-404">
        <?php if ($this->debug): ?>
            <div>
                <?=JText::_('JERROR_ERROR');?> <?=$this->error->getCode();?>: <?=$this->error->getMessage();?>
                <pre style="white-space: pre-line;">
                                    Erorr <?=$this->error->getCode();?>: <?=$this->error->getMessage();?><br>
                                    File: <?=$this->error->getFile();?> (<?=$this->error->getLine();?>)<br>
                                    <?=$this->error->getTraceAsString();?>
		                    </pre>
            </div>
        <?php endif; ?>
    </div>
</div>
<footer>
</footer>
<?php $this->addStyleSheet($templateUrl . '/assets/css/main.css?v=2'); ?>
</body>
</html>
