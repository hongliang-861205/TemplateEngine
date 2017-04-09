<?php
class Template {
	private $templateDir;
	private $compileDir;
	private $leftTag = '{#';
	private $rightTag = '#}';
	private $currentTemplate; //存储当前正在编译的模板
	private $outputHtml; //存放当前正在编译的模板中文件中的html代码
	private $varPool = array(); //一个变量池，在编译模板源文件之前，会把模板中需要用到的变量，把它们的值通通存到这个变量池中
	
	public function __construct($templateDir, $compileDir, $leftTag = null, $rightTag = null) {
		$this->templateDir = $templateDir;
		$this->compileDir = $compileDir;
		if(!empty($leftTag)) $this->leftTag = $leftTag;
		if(!empty($rightTag)) $this->rightTag = $rightTag;
	}
	
	public function assign($key, $value) {
		$this->varPool[$key] = $value;
	}
	
	public function getVar($key) {
		return $this->varPool[$key];
	}
	
	public function getTemplate($templatename, $extension = '.html') {
		$this->$currentTemplate = $templatename;
		$sourceFilename = $this->$templateDir.$this->$currentTemplate.$extension;
		$this->$outputHtml = file_get_contents($sourceFilename);
	}
	
	public function compileTemplate($templatename = null, $extension = '.html') {
		$templatename = empty($templatename) ? $this->$currentTemplate : $templatename;
		
		$pattern = '/'.preg_quote($this->leftTag);
		$pattern .= ' *\$([a-zA-z_]\w*) *';
		$pattern .= preg_quote($this->rightTag).'/';
		
		$this->$outputHtml = preg_replace($pattern, "<?php echo {$this->getVar('$1')}?>", $this->$outputHtml);
		$compileName = $this->$compileDir.md5($templatename).$extension;
		file_put_contents($compileName, $this->$outputHtml);
	}
	
	public function display($templatename = null, $extension = '.html') {
		$templatename = empty($templatename) ? $this->$currentTemplate : $templatename;
		include_once $this->$compileDir.md5($templatename).$extension;
	}
}
