<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Service\Geocoder;

use Ivory\GoogleMap\Service\Geocoder\AbstractGeocoderRequest;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class GeocoderRequestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var AbstractGeocoderRequest|\PHPUnit_Framework_MockObject_MockObject
     */
    private $request;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = $this->createAbstractRequestMock();
    }

    public function testDefaultState()
    {
        $this->assertFalse($this->request->hasLanguage());
        $this->assertNull($this->request->getLanguage());
    }

    public function testLanguage()
    {
        $this->request->setLanguage($language = 'pl');

        $this->assertTrue($this->request->hasLanguage());
        $this->assertSame($language, $this->request->getLanguage());
    }

    public function testResetLanguage()
    {
        $this->request->setLanguage('pl');
        $this->request->setLanguage(null);

        $this->assertFalse($this->request->hasLanguage());
        $this->assertNull($this->request->getLanguage());
    }

    public function testQuery()
    {
        $this->assertEmpty($this->request->buildQuery());
    }

    public function testQueryWithLanguage()
    {
        $this->request->setLanguage($language = 'fr');

        $this->assertSame(['language' => $language], $this->request->buildQuery());
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|AbstractGeocoderRequest
     */
    private function createAbstractRequestMock()
    {
        return $this->getMockForAbstractClass(AbstractGeocoderRequest::class);
    }
}
