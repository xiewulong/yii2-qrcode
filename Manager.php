<?php
/*!
 * yii2 extension - qrcode
 * xiewulong <xiewulong@vip.qq.com>
 * https://github.com/xiewulong/yii2-qrcode
 * https://raw.githubusercontent.com/xiewulong/yii2-qrcode/master/LICENSE
 * create: 2015/1/8
 * update: 2015/1/8
 * version: 0.0.1
 */

namespace yii\qrcode;

use Yii;
use yii\base\ErrorException;
use yii\helpers\Json;

class Manager{

	//文件名前缀
	public $pre = 'qr_';

	//存放路径
	public $path = 'qrcode';

	//文件名
	private $name = false;

	//绝对路径
	private $root = false;

	//创建时间
	private $time = false;

	//时间路径, 精确到天
	public $timepath = false;

	//错误纠正等级, 默认'L'
	public $level;

	//纠错等级取值范围
	private $levelArr = [0, 1, 2, 3, 'l', 'm', 'q', 'h', 'L', 'M', 'Q', 'H'];

	//纠错等级取值默认数组索引
	private $levelDefaultIndex = 0;

	//尺寸
	public $size = 4;

	//最小尺寸
	private $sizeMin = 1;

	//最大尺寸
	private $sizeMax = 10;

	//周围间距, 正整数, 默认2 * 4(px)
	public $margin = 2;

	//背景颜色
	public $bgcolor = 0xffffff;

	//前景颜色
	public $fgcolor = 0x000000;

	/**
	 * 构造器
	 * @method __construct
	 * @since 0.0.1
	 * @return {none}
	 */
	public function __construct(){
	}

	/**
	 * 创建二维码
	 * @method create
	 * @since 0.0.1
	 * @return {array}
	 * @example Yii::$app->qrcode->create($data, $ext);
	 */
	public function create($data, $ext = 'png'){
		echo(__DIR__ . '/phpqrcode/qrlib.php');
		//$qrcode = QRcode::png;
		switch($ext){
			case 'png':
				//echo 'png';
				break;
		}
		$path = $this->getPath();
		$file = $this->getName() . '.' . $ext;
		$root = $this->getRoot() . DIRECTORY_SEPARATOR . $file;
		echo $root;
		//$qrcode($data, $this->, $this->getLevel(), $this->getSize(), $this->margin, $this->bgcolor, $this->fgcolor);
		
		return [
			'name' => $this->name,
			'path' => $path,
			'root' => $file,
			'url' => Yii::getAlias('@web/assets') . DIRECTORY_SEPARATOR . $path . DIRECTORY_SEPARATOR . $file,
		];
	}

	/**
	 * 获取尺寸
	 * @method getSize
	 * @since 0.0.1
	 * @return {number}
	 */
	private function getSize(){
		return min(max($this->size, $this->sizeMin), $this->sizeMax);
	}

	/**
	 * 获取错误纠正等级
	 * @method getLevel
	 * @since 0.0.1
	 * @return {string}
	 */
	private function getLevel(){
		return in_array($this->level, $this->levelArr) ? $this->level : $this->levelArr[$this->levelDefaultIndex];
	}

	/**
	 * 获取文件名
	 * @method getName
	 * @since 0.0.1
	 * @return {string}
	 */
	private function getName(){
		if($this->name === false){
			$this->name = $this->pre . $this->getTime() . '_' . mt_rand();
		}
		return $this->name;
	}

	/**
	 * 获取绝对路径
	 * @method getRoot
	 * @since 0.0.1
	 * @return {string}
	 */
	private function getRoot(){
		if($this->root === false){
			$this->root = Yii::getAlias('@webroot/assets') . DIRECTORY_SEPARATOR . $this->getPath();
		}

		if(!file_exists($this->root)){
			mkdir($this->root, 0777, true);
		};

		return $this->root;
	}

	/**
	 * 获取存放路径
	 * @method getPath
	 * @since 0.0.1
	 * @return {string}
	 */
	private function getPath(){
		if($this->timepath){
			$this->path .= date('/Y/m/d', $this->getTime());
		}

		return $this->path;
	}

	/**
	 * 获取创建时间
	 * @method getTime
	 * @since 0.0.1
	 * @return {timestamp}
	 */
	private function getTime(){
		if($this->time === false){
			$this->time = time();
		}

		return $this->time;
	}

}
