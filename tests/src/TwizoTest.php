<?php

namespace Twizo\Api;

use Twizo\Api\Entity\Factory;
use Twizo\Api\Entity\NumberLookup;

/**
 * Test the main Twizo class
 *
 * @covers \Twizo\Api\Twizo
 */
class TwizoTest extends \PHPUnit_Framework_TestCase
{
    const TWIZO = 'Twizo\Api\Twizo';
    const ENTITY_FACTORY = 'Twizo\Api\Entity\Factory';
    const ENTITY_NUMBER_LOOKUP = 'Twizo\Api\Entity\NumberLookup';
    const ENTITY_POLL = 'Twizo\Api\Entity\Poll';
    const ENTITY_SMS = 'Twizo\Api\Entity\Sms';
    const ENTITY_VERIFICATION = 'Twizo\Api\Entity\Verification';
    const ENTITY_VERIFICATION_EXCEPTION = 'Twizo\Api\Entity\Verification\Exception';

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject|Factory
     */
    protected $mockEntityFactory;

    /**
     * @var Twizo
     */
    protected $twizo;

    protected function setUp()
    {
        $this->mockEntityFactory = $this->getMockBuilder(self::ENTITY_FACTORY)->disableOriginalConstructor()->getMock();
        $this->twizo = new Twizo($this->mockEntityFactory);

        parent::setUp();
    }

    /**
     * Test the function to create a new number lookup object
     *
     * @test
     * @coversDefaultClass createNumberLookup
     */
    public function createNumberLookup()
    {
        $testNumber = ['01234567890'];

        $mockNumberLookup = $this->getMockBuilder(self::ENTITY_NUMBER_LOOKUP)->disableOriginalConstructor()->getMock();
        $this->mockEntityFactory->expects($this->once())->method('createNumberLookup')->with($testNumber)->will($this->returnValue($mockNumberLookup));

        $this->assertSame($mockNumberLookup, $this->twizo->createNumberLookup($testNumber));
    }

    /**
     * Test the function to create a new number lookup object when a string with the number is supplied; should be converted to array
     *
     * @test
     * @coversDefaultClass createNumberLookup
     */
    public function createNumberLookupSingleNumber()
    {
        $testNumber = '01234567890';

        $mockNumberLookup = $this->getMockBuilder(self::ENTITY_NUMBER_LOOKUP)->disableOriginalConstructor()->getMock();
        $this->mockEntityFactory->expects($this->once())->method('createNumberLookup')->with([$testNumber])->will($this->returnValue($mockNumberLookup));

        $this->assertSame($mockNumberLookup, $this->twizo->createNumberLookup($testNumber));
    }

    /**
     * Test the function to create a new sms object
     *
     * @test
     * @coversDefaultClass createSms
     */
    public function createSms()
    {
        $testBody = 'test';
        $testRecipient = ['01234567890'];
        $testSender = 'sender';

        $mockSms = $this->getMockBuilder(self::ENTITY_SMS)->disableOriginalConstructor()->getMock();
        $this->mockEntityFactory->expects($this->once())->method('createSms')->with($testBody, $testRecipient, $testSender)->will($this->returnValue($mockSms));

        $this->assertSame($mockSms, $this->twizo->createSms($testBody, $testRecipient, $testSender));
    }

    /**
     * Test the function to create a new sms object when a string with the recipient is supplied; should be converted to array
     *
     * @test
     * @coversDefaultClass createSms
     */
    public function createSmsSingleRecipient()
    {
        $testBody = 'test';
        $testRecipient = '01234567890';
        $testSender = 'sender';

        $mockSms = $this->getMockBuilder(self::ENTITY_SMS)->disableOriginalConstructor()->getMock();
        $this->mockEntityFactory->expects($this->once())->method('createSms')->with($testBody, [$testRecipient], $testSender)->will($this->returnValue($mockSms));

        $this->assertSame($mockSms, $this->twizo->createSms($testBody, $testRecipient, $testSender));
    }

    /**
     * Test the function to create a new verification object
     *
     * @test
     * @coversDefaultClass createVerification
     */
    public function createVerification()
    {
        $testRecipient = '01234567890';

        $mockVerification = $this->getMockBuilder(self::ENTITY_VERIFICATION)->disableOriginalConstructor()->getMock();
        $this->mockEntityFactory->expects($this->once())->method('createVerification')->with($testRecipient)->will($this->returnValue($mockVerification));

        $this->assertSame($mockVerification, $this->twizo->createVerification($testRecipient));
    }

    /**
     * Test the function to create a Twizo instance
     *
     * @test
     * @coversDefaultClass getInstance
     * @uses \Twizo\Api\AbstractClient::__construct
     * @uses \Twizo\Api\Client\Curl::__construct
     * @uses \Twizo\Api\Entity\Factory::__construct
     */
    public function getInstance()
    {
        // Create new instance and test the returned instance type
        $instance = Twizo::getInstance('test_secret', 'test_host');
        $this->assertInstanceOf(self::TWIZO, $instance);

        // Test if a new call returns the same instance
        $sameInstance = Twizo::getInstance('test_secret', 'test_host');
        $this->assertSame($instance, $sameInstance);

        // Test new instance with different host
        $newInstance = Twizo::getInstance('test_secret', 'new_host');
        $this->assertInstanceOf(self::TWIZO, $instance);
        $this->assertNotSame($instance, $newInstance);

        // Test new instance with different secret
        $newInstance = Twizo::getInstance('new_secret', 'test_host');
        $this->assertInstanceOf(self::TWIZO, $instance);
        $this->assertNotSame($instance, $newInstance);
    }

    /**
     * Test the function to retrieve a new number lookup object by message id
     *
     * @test
     * @coversDefaultClass getNumberLookup
     */
    public function getNumberLookup()
    {
        $testMessageId = 'test_message_id';

        $mockNumberLookup = $this->getMockBuilder(self::ENTITY_NUMBER_LOOKUP)->disableOriginalConstructor()->getMock();
        $mockNumberLookup->expects($this->once())->method('populate')->with($testMessageId);
        $this->mockEntityFactory->expects($this->once())->method('createEmptyNumberLookup')->will($this->returnValue($mockNumberLookup));

        $this->assertSame($mockNumberLookup, $this->twizo->getNumberLookup($testMessageId));
    }

    /**
     * Test the function to retrieve number lookup results by polling
     *
     * @test
     * @coversDefaultClass getNumberLookupResults
     */
    public function getNumberLookupResults()
    {
        $testMessage = [ 'message_id' => 'test_123' ];

        $mockNumberLookupPoll = $this->getMockBuilder(self::ENTITY_POLL)->disableOriginalConstructor()->getMock();
        $mockNumberLookupPoll->expects($this->once())->method('getMessages')->will($this->returnValue([$testMessage]));
        $mockNumberLookup = $this->getMockBuilder(self::ENTITY_NUMBER_LOOKUP)->disableOriginalConstructor()->getMock();
        $mockNumberLookup->expects($this->once())->method('setFields')->with($testMessage);
        $mockNumberLookupPoll->expects($this->once())->method('delete');

        $this->mockEntityFactory->expects($this->once())->method('createNumberLookupPoll')->will($this->returnValue($mockNumberLookupPoll));
        $this->mockEntityFactory->expects($this->once())->method('createEmptyNumberLookup')->will($this->returnValue($mockNumberLookup));

        $this->assertSame([$mockNumberLookup], $this->twizo->getNumberLookupResults());
    }

    /**
     * Test the function to retrieve a new sms object by message id
     *
     * @test
     * @coversDefaultClass getSms
     */
    public function getSms()
    {
        $testMessageId = 'test_message_id';

        $mockSms = $this->getMockBuilder(self::ENTITY_SMS)->disableOriginalConstructor()->getMock();
        $mockSms->expects($this->once())->method('populate')->with($testMessageId);
        $this->mockEntityFactory->expects($this->once())->method('createEmptySms')->will($this->returnValue($mockSms));

        $this->assertSame($mockSms, $this->twizo->getSms($testMessageId));
    }

    /**
     * Test the function to retrieve number lookup results by polling
     *
     * @test
     * @coversDefaultClass getSmsResults
     */
    public function getSmsResults()
    {
        $testMessage = [ 'message_id' => 'test_123' ];

        $mockSmsPoll = $this->getMockBuilder(self::ENTITY_POLL)->disableOriginalConstructor()->getMock();
        $mockSmsPoll->expects($this->once())->method('getMessages')->will($this->returnValue([$testMessage]));
        $mockSms = $this->getMockBuilder(self::ENTITY_SMS)->disableOriginalConstructor()->getMock();
        $mockSms->expects($this->once())->method('setFields')->with($testMessage);
        $mockSmsPoll->expects($this->once())->method('delete');

        $this->mockEntityFactory->expects($this->once())->method('createSmsPoll')->will($this->returnValue($mockSmsPoll));
        $this->mockEntityFactory->expects($this->once())->method('createEmptySms')->will($this->returnValue($mockSms));

        $this->assertSame([$mockSms], $this->twizo->getSmsResults());
    }

    /**
     * Test the function to verify a token and retrieve the verification result
     *
     * @test
     * @coversDefaultClass getTokenResult
     */
    public function getTokenResult()
    {
        $testMessageId = 'test_message_id';
        $testToken = '12345';

        $mockVerification = $this->getMockBuilder(self::ENTITY_VERIFICATION)->disableOriginalConstructor()->getMock();
        $mockVerification->expects($this->once())->method('verify')->with($testToken, $testMessageId);
        $this->mockEntityFactory->expects($this->once())->method('createEmptyVerification')->will($this->returnValue($mockVerification));

        $this->assertSame($mockVerification, $this->twizo->getTokenResult($testMessageId, $testToken));
    }

    /**
     * Test the function to retrieve a new verification object by message id
     *
     * @test
     * @coversDefaultClass getSms
     */
    public function getVerification()
    {
        $testMessageId = 'test_message_id';

        $mockVerification = $this->getMockBuilder(self::ENTITY_VERIFICATION)->disableOriginalConstructor()->getMock();
        $mockVerification->expects($this->once())->method('populate')->with($testMessageId);
        $this->mockEntityFactory->expects($this->once())->method('createEmptyVerification')->will($this->returnValue($mockVerification));

        $this->assertSame($mockVerification, $this->twizo->getVerification($testMessageId));
    }

    /**
     * Test the function to verify a token and return boolean for the success status of the verification
     *
     * @test
     * @coversDefaultClass verifyToken
     */
    public function verifyToken()
    {
        $testMessageId = 'test_message_id';
        $testToken = '12345';

        $mockVerification = $this->getMockBuilder(self::ENTITY_VERIFICATION)->disableOriginalConstructor()->getMock();
        $mockVerification->expects($this->once())->method('getStatusCode')->will($this->returnValue(Entity\Verification::STATUS_SUCCESS));

        $this->twizo = $this->getMockBuilder(self::TWIZO)->setConstructorArgs([$this->mockEntityFactory])->disableOriginalConstructor()->setMethods(['getTokenResult'])->getMock();
        $this->twizo->expects($this->once())->method('getTokenResult')->with($testMessageId, $testToken)->will($this->returnValue($mockVerification));

        $this->assertTrue($this->twizo->verifyToken($testMessageId, $testToken));
    }

    /**
     * Test the function to verify a token and return boolean for the success status of the verification when the verification fails due to a verification exception
     *
     * @test
     * @coversDefaultClass verifyToken
     */
    public function verifyTokenFailed()
    {
        $testMessageId = 'test_message_id';
        $testToken = '12345';

        $this->twizo = $this->getMockBuilder(self::TWIZO)->setConstructorArgs([$this->mockEntityFactory])->disableOriginalConstructor()->setMethods(['getTokenResult'])->getMock();
        $mockVerificationException = $this->getMockBuilder(self::ENTITY_VERIFICATION_EXCEPTION)->disableOriginalConstructor()->getMock();
        $this->twizo->expects($this->once())->method('getTokenResult')->with($testMessageId, $testToken)->will($this->throwException($mockVerificationException));

        $this->assertFalse($this->twizo->verifyToken($testMessageId, $testToken));
    }
}
