<?php
/*!
 * yii2 extension - qrcode
 * xiewulong <xiewulong@vip.qq.com>
 * https://github.com/xiewulong/yii2-qrcode
 * https://raw.githubusercontent.com/xiewulong/yii2-qrcode/master/LICENSE
 * create: 2015/1/8
 * update: 2015/3/28
 * version: 0.0.1
 */

namespace yii\qrcode;

use Yii;
use PHPQRCode\QRcode;

class Manager{

	//文件名前缀
	public $pre = 'qr_';

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
		$fileupload = \Yii::$app->fileupload;
		$file = $fileupload->createFile($this->ext, null, $this->pre);
		QRcode::png($data, $file['tmp'], $this->level, $this->size, $this->margin);

		return $fileupload->finalFile($file, 'images');
	}

}
