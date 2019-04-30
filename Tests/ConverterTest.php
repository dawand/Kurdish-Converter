<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Converter\KurdishConverter;

class ConverterTest extends TestCase {
	
	public function testNumber(){
		$KC = new KurdishConverter(350);
		$this->assertEquals('سێ سەد و پەنجا' , $KC->generateText());
	}
}
