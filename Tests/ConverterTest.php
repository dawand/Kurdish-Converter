<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Converter\KurdishConverter;

class ConverterTest extends TestCase {
	
	public function testNumber(){
		$KC = new KurdishConverter(350);
		$this->assertEquals('سێ سەد و پەنجا' , $KC->generateText());
	}

	public function testTime(){
		$KC = new KurdishConverter("12:25");
		$this->assertEquals('کاتژمێر دوازدە و بیست و پێنج خولەک ', $KC->generateText());
	}

	public function testDate(){
		$KC = new KurdishConverter('30-04-2019');
		$this->assertEquals('سیی نیسانی دوو هەزار و  و نۆزدە', $KC->generateText());
	}
}
