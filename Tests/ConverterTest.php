<?php

use PHPUnit\Framework\TestCase;

class ConverterTest extends TestCase {
	
	public function testNumber(){
		$KC = new KurdishConverter(350);
		$this->assertEquals('سێ سەد و پەنجا' , $KC->generateText());
	}
}
