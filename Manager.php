<?php
/*!
 * yii2 extension - wechat
 * xiewulong <xiewulong@vip.qq.com>
 * https://github.com/xiewulong/yii2-qrcode
 * https://raw.githubusercontent.com/xiewulong/yii2-qrcode/master/LICENSE
 * create: 2015/1/8
 * update: 2015/1/8
 * version: 0.0.1
 */

namespace yii\qrcode;

use yii\base\ErrorException;
use yii\helpers\Json;

class Manager{

	//
	private $aaa = 1;

	/**
	 * 
	 * @method show
	 * @since 0.0.1
	 * @return {object}
	 * @example Yii::$app->qrcode->show();
	 */
	public function show(){
		echo $this->aaa;
	}

}
