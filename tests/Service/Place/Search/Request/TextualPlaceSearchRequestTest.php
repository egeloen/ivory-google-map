<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Service\Place\Search\Request;

use Ivory\GoogleMap\Service\Place\Search\Request\AbstractPlaceSearchRequest;
use Ivory\GoogleMap\Service\Place\Search\Request\AbstractTextualPlaceSearchRequest;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class TextualPlaceSearchRequestTest extends\PHPUnit_Framework_TestCase
{
    /**
     * @var AbstractTextualPlaceSearchRequest|\PHPUnit_Framework_MockObject_MockObject
     */
    private $request;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = $this->createRequestMock();
    }

    public function testInheritance()
    {
        $this->assertInstanceOf(AbstractPlaceSearchRequest::class, $this->request);
    }

    public function testDefaultState()
    {
        $this->assertFalse($this->request->hasKeyword());
        $this->assertNull($this->request->getKeyword());
    }

    public function testKeyword()
    {
        $this->request->setKeyword($keyword = 'foo');

        $this->assertTrue($this->request->hasKeyword());
        $this->assertSame($keyword, $this->request->getKeyword());
    }

    public function testBuildQuery()
    {
        $this->assertEmpty($this->request->buildQuery());
    }

    public function testBuildQueryWithKeyword()
    {
        $this->request->setKeyword($keyword = 'foo');

        $this->assertSame(['keyword' => $keyword], $this->request->buildQuery());
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|AbstractTextualPlaceSearchRequest
     */
    private function createRequestMock()
    {
        return $this->getMockForAbstractClass(AbstractTextualPlaceSearchRequest::class);
    }
}
