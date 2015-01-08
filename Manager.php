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
use PHPQRCode\QRcode;

class Manager{

	//文件名前缀
	public $pre = 'qr_';

	//缓存路径配置
	public $temp = 'qrcode';

	//存放路径
	private $path = false;

	//文件名
	private $name = false;

	//绝对路径
	private $root = false;

	//创建时间
	private $time = false;

	//时间路径, 精确到天
	public $timepath = false;

	//错误纠正等级0-3
	public $level = 2;

	//尺寸1-27
	public $size = 4;

	//周围间距, 正整数, 默认2 * 4(px)
	public $margin = 2;

	//扩展名
	private $ext = 'png';

	/**
	 * 设置尺寸
	 * @method setSize
	 * @since 0.0.1
	 * @param {number} $size 尺寸
	 * @return {object}
	 * @example Yii::$app->qrcode->setSize($size);
	 */
	public function setSize($size){
		$this->size = $size;

		return $this;
	}

	/**
	 * 设置纠错等级
	 * @method setLevel
	 * @since 0.0.1
	 * @param {string} $level 等级
	 * @return {object}
	 * @example Yii::$app->qrcode->setLevel($level);
	 */
	public function setLevel($level){
		$this->level = $level;

		return $this;
	}

	/**
	 * 设置外间距
	 * @method setMargin
	 * @since 0.0.1
	 * @param {number} $margin 外间距
	 * @return {object}
	 * @example Yii::$app->qrcode->setMargin($margin);
	 */
	public function setMargin($margin){
		$this->margin = $margin;

		return $this;
	}

	/**
	 * 创建二维码
	 * @method create
	 * @since 0.0.1
	 * @param {string} $data 数据
	 * @return {array}
	 * @example Yii::$app->qrcode->create($data);
	 */
	public function create($data){
		$path = $this->getPath();
		$file = $this->getName();
		$root = $this->getRoot() . DIRECTORY_SEPARATOR . $file;
		QRcode::png($data, $root, $this->level, $this->size, $this->margin);

		return [
			'name' => $this->name,
			'path' => $path,
			'root' => $root,
			'url' => Yii::getAlias('@web/assets') . DIRECTORY_SEPARATOR . $path . DIRECTORY_SEPARATOR . $file,
		];
	}

	/**
	 * 获取文件名
	 * @method getName
	 * @since 0.0.1
	 * @return {string}
	 */
	private function getName(){
		if($this->name === false){
			$this->name = $this->pre . $this->getTime() . '_' . md5(mt_rand()) . '.' . $this->ext;
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
			if(!file_exists($this->root)){
				mkdir($this->root, 0777, true);
			}
		}

		return $this->root;
	}

	/**
	 * 获取存放路径
	 * @method getPath
	 * @since 0.0.1
	 * @return {string}
	 */
	private function getPath(){
		if($this->path === false){
			$this->path = $this->temp;
			if($this->timepath){
				$this->path .= date('/Y/m/d', $this->getTime());
			}
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
