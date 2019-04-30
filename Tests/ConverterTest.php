<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Converter\KurdishConverter;

class ConverterTest extends TestCase {
	
	public function testNumber1(){
		$KC = new KurdishConverter(350);
		$this->assertEquals('سێ سەد و پەنجا' , $KC->generateText());
	}

	public function testNumber2(){
		$KC = new KurdishConverter(1156);
		$this->assertEquals('هەزار و سەد و پەنجا و شەش' , $KC->generateText());
	}

	public function testNumber3(){
		$KC = new KurdishConverter(2002);
		$this->assertEquals('دوو هەزار و دوو' , $KC->generateText());
	}

	public function testTime(){
		$KC = new KurdishConverter("12:25");
		$this->assertEquals('کاتژمێر دوازدە و بیست و پێنج خولەک ', $KC->generateText());
	}

	public function testDate(){
		$KC = new KurdishConverter('30-04-2019');
		$this->assertEquals('سیی نیسانی دوو هەزار و نۆزدە', $KC->generateText());
	}

	public function testDate2(){
		$KC = new KurdishConverter('01-05-2019');
		$this->assertEquals('یەکی مایسی دوو هەزار و نۆزدە', $KC->generateText());
	}
}
