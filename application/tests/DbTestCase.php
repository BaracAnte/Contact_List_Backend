<?php

class DbTestCase extends CIPHPUnitTestDbTestCase
{
    
	public function test_insert()
	{
		$output = $this->hasInDatabase('contacts', ['fullname'=>'john doe','email'=>'example@gmail.com']);
		$this->seeInDatabase('contacts', ['email'=>'example@gmail.com']);
	}
}
