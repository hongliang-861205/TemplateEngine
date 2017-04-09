<?php
class Template {
	private $templateDir;
	private $compileDir;
	private $leftTag = '{#';
	private $rightTag = '#}';
	private $currentTemplate; //存储当前正在编译的模板
	private $outputHtml; //存放当前正在编译的模板中文件中的html代码
	private $varPool = array(); //一个变量池，在编译模板源文件之前，会把模板中需要用到的变量，把它们的值通通存到这个变量池中
	
	
}