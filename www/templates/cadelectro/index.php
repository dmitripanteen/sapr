<?php defined( '_JEXEC' ) or die;

/** @var JDocumentHtml $this */
/** @var JMenuItem $currPage */

setlocale(LC_ALL, 'ru_RU.UTF-8');
$app = JFactory::getApplication();
$menu = $app->getMenu();
$lang = JFactory::getLanguage();
$template = '/templates/'.$this->template;

$currPage =
	$menu->getActive() ?: 
	$menu->getItems('link', trim($app->input->server->getHtml('REQUEST_URI'), '/\\'), true);
if (! $currPage) $currPage = $menu->getDefault($lang->getTag());

$this->setHtml5(true);
$this->setGenerator(null);
$this->setMetaData('X-UA-Compatible', 'IE=edge');
$this->setMetaData('viewport', 'width=device-width, initial-scale=1');
$this->setMetadata('copyright', htmlspecialchars($app->get('sitename')));

$this->addFavicon($template.'/images/cadelectro-logo.png');
$this->addScript($template.'/assets/js/main.js?v=1');

$homepage = ($currPage == $menu->getDefault($lang->getTag()));
$user = JFactory::getUser();
?>
<!DOCTYPE html>
<html lang="<?= $this->language; ?>" dir="<?= $this->direction; ?>" xmlns:jdoc="http://www.w3.org/2001/XInclude">
<head>
	<jdoc:include type="head" />
    <jdoc:include type="modules" name="analytics"/>
</head>
<body class="<?php if(! $homepage):?>content-page<?php endif;?> page-option-<?=$app->input->get('option');?> page-view-<?=$app->input->get('view');?>">
	<div class="page-main-content<?php if ($homepage):?> homepage<?php endif;
	?>">
        <jdoc:include type="message" />
        <header>
            <div class="inner">
                <div id="mainmenu">
                    <a class="desktop-logo" href="/">
                        <img class="header-logo"
                             src="/templates/cadelectro/assets/img/cadelectro-logo.png">
                    </a>
                    <jdoc:include type="modules" name="navbar" />
                </div>
            </div>
        </header>
        <div class="main-body">

        </div>
	</div>
	<footer>
        <div class="inner">
            <a class="desktop-logo" href="/">
                <img class="footer-logo"
                     src="/templates/cadelectro/assets/img/cadelectro-logo.png">
            </a>
        </div>
	</footer>
<?php $this->addStyleSheet($template.'/assets/css/main.css?v=1');?>
</body>
</html>
