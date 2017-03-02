<?php

namespace Twizo\Api;

/**
 * Test the abstract client class
 *
 * @covers \Twizo\Api\AbstractClient
 */
class AbstractClientTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject|AbstractClient
     */
    protected $mockAbstractClient;

    /**
     * @var string
     */
    protected $testSecret = 'test_secret';

    /**
     * @var string
     */
    protected $testHost = 'test_host';

    /**
     * Setup unit test
     */
    protected function setUp()
    {
        $this->mockAbstractClient = $this->getMockForAbstractClass('Twizo\Api\AbstractClient', [$this->testSecret, $this->testHost]);

        parent::setUp();
    }

    /**
     * @test
     * @coversDefaultClass getUrl
     */
    public function getUrl()
    {
        $this->assertSame('https://' . $this->testHost . '/' . AbstractClient::API_VERSION . '/test/location', $this->mockAbstractClient->getUrl('test/location'));
    }

    /**
     * @test
     * @coversDefaultClass getUserAgent
     */
    public function getUserAgent()
    {
        $this->assertSame('Twizo-php-lib/' . AbstractClient::LIB_VERSION, $this->mockAbstractClient->getUserAgent());
    }

    /**
     * @test
     * @coversDefaultClass getUserAgentInfo
     */
    public function getUserAgentInfo()
    {
        $this->assertSame(['Twizo-php-lib/' . AbstractClient::LIB_VERSION], $this->mockAbstractClient->getUserAgentInfo());
    }
}
