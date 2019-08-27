<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BlogControllerTest extends WebTestCase
{
	public function testBlogIndexPage()
	{
		$client = static::createClient();
		$client->request('GET', '/');

		$this->assertResponseIsSuccessful();
	}
}
