<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\Tests\GoogleMap\Service\Utility;

use Http\Client\Common\Plugin\Journal as JournalInterface;
use Http\Client\Exception;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class Journal implements JournalInterface
{
    /**
     * @var mixed[]
     */
    private $data = [];

    /**
     * @return mixed[]
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * {@inheritdoc}
     */
    public function addSuccess(RequestInterface $request, ResponseInterface $response)
    {
        if (substr($request->getUri()->getPath(), -5) === '/json') {
            $this->data = json_decode((string) $response->getBody(), true);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function addFailure(RequestInterface $request, Exception $exception)
    {
        throw new \BadMethodCallException(sprintf('The method %s::%s is not supported.', __CLASS__, __METHOD__));
    }
}
