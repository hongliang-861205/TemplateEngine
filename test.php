<?php
require_once 'Template.class.php';

$baseName = dirname(__FILE__);

$template = new Template("{$baseName}/source/","{$baseName}/compiled/");

$template->assign('pagename', '简易版模板引擎');
$template->assign('test', 'hello word');

$template->getTemplate('index');
$template->compileTemplate();
$template->display();