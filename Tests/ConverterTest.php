<?php

class ConverterTest extends PHPUnit_Framework_TestCase {
	public function setUp(){
		
	}

	public function testNumber(){
		$KC = new KurdishConverter(350);
		$this->assertEquals('سێ سەد و پەنجا' , $KC->generateText());
	}
}
