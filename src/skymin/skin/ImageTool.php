<?php
/**
 *      _                    _       
 *  ___| | ___   _ _ __ ___ (_)_ __  
 * / __| |/ / | | | '_ ` _ \| | '_ \ 
 * \__ \   <| |_| | | | | | | | | | |
 * |___/_|\_\\__, |_| |_| |_|_|_| |_|
 *           |___/ 
 * 
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the MIT License. see <https://opensource.org/licenses/MIT>.
 * 
 * @author skymin
 * @link   https://github.com/sky-min
 * @license https://opensource.org/licenses/MIT MIT License
 * 
 *   /\___/\
 * 　(∩`・ω・)
 * ＿/_ミつ/￣￣￣/
 * 　　＼/＿＿＿/
 *
 */

declare(strict_types = 1);

namespace skymin\skin;

use function ord;

use GdImage;
use function imagecopy;
use function imagepng;
use function imagecolorat;
use function imagesx;
use function imagesy;
use function imagecreatetruecolor;
use function imagecopyresampled;
use function imagecolortransparent;
use function imagealphablending;
use function imagesavealpha;

final class ImageTool{
	
	public function __construct(private GdImage $image){}
	
	public function getImage() : GdImage{
		return $this->image;
	}
	
	public function saveImg(string $path) :void{
		imagepng($this->image, $path);
	}
	
	public function getHeight() : int{
		return imagesy($this->image);
	}
	
	public function getWidth() : int{
		return imagesx($this->image);
	}
	
	public function getSkinData() :?string{
		$img = $this->image;
		$h = imagesy($img);
		$w = imagesx($img);
		if(!in_array($w * $h * 4, SKIN)) return null;
		$skindata = '';
		for($y = 0; $y < $h; $y++){
			for($x = 0; $x < $w; $x++){
				$colorat = imagecolorat($img, $x, $y);
				$a = ((~((int) ($colorat >> 24))) << 1) & 0xff;
				$r = ($colorat >> 16) & 0xff;
				$g = ($colorat >> 8) & 0xff;
				$b = $colorat & 0xff;
				$skindata .= chr($r) . chr($g) . chr($b) . chr($a);
			}
		}
		return $skindata;
	}
	
	public function mergeImage(ImageTool $image) :?ImageTool{
		$img1_w = $this->getWidth();
		$img1_h = $this->getHeight();
		$img1 = $this->getImage();
		$img2 = $image->imgPix($img1_w, $img1_h);
		if(imagecopy($img1, $img2, 0, 0, 0, 0, $img1_w, $img1_h)){
			return new ImageTool($img1);
		}
		return null;
	}
	
	public function imgPix(int $width, int $height) : GdImage{
		$result = imagecreatetruecolor($width, $height);
		imagecolortransparent($result, imagecolorallocate($result, 0, 0, 0));
		imagealphablending($result, false);
		imagesavealpha($result, true);
		$img = $this->image;
		imagecopyresampled($result, $img, 0, 0, 0, 0, $width, $width, imagesx($img), imagesy($img));
		return $result;
	}
	
}