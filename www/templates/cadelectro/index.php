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
$currPageClass = $currPage->getParams()->get('pageclass_sfx');
?>
<!DOCTYPE html>
<html lang="<?= $this->language; ?>" dir="<?= $this->direction; ?>" xmlns:jdoc="http://www.w3.org/2001/XInclude">
<head>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	<jdoc:include type="head" />
    <jdoc:include type="modules" name="analytics"/>
</head>
<body class="<?php if(! $homepage):?>content-page<?php endif;?>">
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
        <jdoc:include type="modules" name="slider" />
        <div class="main-body <?=$currPageClass;?>">
            <jdoc:include type="component" />
        </div>
	</div>
	<footer>
        <div class="inner">
            <div class="desktop-logo-footer">
                <a href="/">
                    <img class="footer-logo"
                         src="/templates/cadelectro/assets/img/cadelectro-logo.png">
                </a>
            </div>
            <div class="footer-body">
                <div class="footer-body-1">
                    <div class="footer-menu">
                        <jdoc:include type="modules" name="footer-menu" />
                    </div>
                    <div class="contacts">
                        <jdoc:include type="modules" name="footer-contacts" />
                    </div>
                </div>
                <div class="footer-social">
                    <jdoc:include type="modules" name="footer-social" />
                </div>
            </div>
        </div>
	</footer>
<?php $this->addStyleSheet($template.'/assets/css/main.css?v=1');?>
</body>
</html>
