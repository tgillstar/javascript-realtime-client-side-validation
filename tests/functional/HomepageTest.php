<?php

namespace Tests\Functional;

class HomepageTest extends BaseTestCase
{
    /**
     * Test that the index route returns a rendered response containing the form field label 'Social Security Number'
     */
    public function testRetrievingForm()
    {
        $response = $this->runApp('GET', '/');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('Social Security Number', (string)$response->getBody());
    }

    /**
     * Test that the index route won't accept a post request
     */
    public function testGeneralPostingFormNotAllowed()
      {
           $response = $this->runApp('POST', '/', ['test']);

           $this->assertEquals(405, $response->getStatusCode());
           $this->assertContains('Method not allowed', (string)$response->getBody());
       }

}