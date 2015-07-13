<?php

use \t1gor\RobotsTxt\Content\EmptyContent;

/**
 * Class AbstractContentTest
 * @group content
 */
abstract class AbstractContentTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \t1gor\RobotsTxt\Content\EmptyContent
     */
    protected $content;

    /**
     * Set dummy content instance
     */
    public function setUp()
    {
        $this->content = new EmptyContent();
    }

    /**
     * Clean-up
     */
    public function tearDown()
    {
        $this->content = null;
        unset($this->content);
    }

    /**
     * @param string $encoding
     * @dataProvider correctEncodingProvider
     * @covers \t1gor\RobotsTxt\Content\AbstractContent::setEncoding
     * @covers \t1gor\RobotsTxt\Content\AbstractContent::getEncoding
     */
    public function testGetAndSetEncoding($encoding)
    {
        $inst = $this->content->setEncoding($encoding);
        $this->assertInstanceOf('\t1gor\RobotsTxt\Content\ContentInterface', $inst);
        $this->assertEquals($encoding, $this->content->getEncoding());
        $this->assertEquals($encoding, mb_internal_encoding());
    }

    /**
     * @expectedException PHPUnit_Framework_Error
     * @covers \t1gor\RobotsTxt\Content\AbstractContent::setEncoding
     */
    public function testSetEncodingInvalid()
    {
        $this->content->setEncoding('some-dummy-encoding');
    }

    /**
     * @covers \t1gor\RobotsTxt\Content\AbstractContent::setEncoding
     * @covers \t1gor\RobotsTxt\Content\AbstractContent::getEncoding
     */
    public function testSetEncodingFallbackToDefault()
    {
        $default = EmptyContent::DEFAULT_ENCODING;
        $this->content->setEncoding();
        $this->assertEquals($default, $this->content->getEncoding());
    }

    /**
     * Generate correct encodings
     * @link http://php.net/manual/ru/mbstring.supported-encodings.php
     * @return array
     */
    public function correctEncodingProvider()
    {
        return [
            ['UTF-8'],
            ['ISO-8859-1'],
            ['Windows-1251'],
            ['8bit'],
            ['HZ'],
            ['HTML-ENTITIES'],
            ['UTF-32']
        ];
    }
}