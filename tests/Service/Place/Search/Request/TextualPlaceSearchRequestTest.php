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
        $this->assertFalse($this->request->hasNames());
        $this->assertEmpty($this->request->getNames());
    }

    public function testKeyword()
    {
        $this->request->setKeyword($keyword = 'foo');

        $this->assertTrue($this->request->hasKeyword());
        $this->assertSame($keyword, $this->request->getKeyword());
    }

    public function testSetNames()
    {
        $this->request->setNames($names = [$name = 'name']);
        $this->request->setNames($names);

        $this->assertTrue($this->request->hasNames());
        $this->assertTrue($this->request->hasName($name));
        $this->assertSame($names, $this->request->getNames());
    }

    public function testAddNames()
    {
        $this->request->setNames($firstNames = ['name1']);
        $this->request->addNames($secondNames = ['name2']);

        $this->assertTrue($this->request->hasNames());
        $this->assertSame(array_merge($firstNames, $secondNames), $this->request->getNames());
    }

    public function testAddName()
    {
        $this->request->addName($name = 'name');

        $this->assertTrue($this->request->hasNames());
        $this->assertTrue($this->request->hasName($name));
        $this->assertSame([$name], $this->request->getNames());
    }

    public function testRemoveName()
    {
        $this->request->addName($name = 'name');
        $this->request->removeName($name);

        $this->assertFalse($this->request->hasNames());
        $this->assertFalse($this->request->hasName($name));
        $this->assertEmpty($this->request->getNames());
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

    public function testBuildQueryWithNames()
    {
        $this->request->setNames($names = ['name1', 'name2']);

        $this->assertSame(['name' => implode('|', $names)], $this->request->buildQuery());
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|AbstractTextualPlaceSearchRequest
     */
    private function createRequestMock()
    {
        return $this->getMockForAbstractClass(AbstractTextualPlaceSearchRequest::class);
    }
}
