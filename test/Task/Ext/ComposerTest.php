<?php

/*
 *  $Id$
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the LGPL. For more information please see
 * <http://phing.info>.
 */
namespace Phing\Test\Task\Ext;

use Phing\Task\Ext\Composer;
use Phing\Type\CommandLine\CommandLineArgument;
use PHPUnit_Framework_TestCase;
use ReflectionMethod;

/**
 * Test class for the Composer task.
 *
 * @author  Nuno Costa <nuno@francodacosta.com>
 * @version $Id$
 * @package phing.tasks.ext
 */
class ComposerTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Composer
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new Composer();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @covers \Phing\Task\Ext\Composer::setCommand
     * @covers \Phing\Task\Ext\Composer::getCommand
     */
    public function testSetGetCommand()
    {
        $o = $this->object;
        $o->setCommand('foo');
        $this->assertEquals('foo', $o->getCommand());
    }

    /**
     * @covers \Phing\Task\Ext\Composer::getPhp
     * @covers \Phing\Task\Ext\Composer::setPhp
     */
    public function testSetGetPhp()
    {
        $o = $this->object;
        $o->setPhp('foo');
        $this->assertEquals('foo', $o->getPhp());
    }

    /**
     * @covers \Phing\Task\Ext\Composer::setComposer
     * @covers \Phing\Task\Ext\Composer::getComposer
     */
    public function testSetGetComposer()
    {
        $o = $this->object;
        $o->setComposer('foo');
        $this->assertEquals('foo', $o->getComposer());
    }

    /**
     * @covers \Phing\Task\Ext\Composer::createArg
     */
    public function testCreateArg()
    {
        $o = $this->object;
        $arg = $o->createArg();
        $this->assertInstanceOf(CommandLineArgument::class, $arg);
    }

    public function testMultipleCalls()
    {
        $o = $this->object;
        $o->setPhp('php');
        $o->setCommand('install');
        $o->createArg()->setValue('--dry-run');
        $method = new ReflectionMethod(Composer::class, 'prepareCommandLine');
        $method->setAccessible(true);
        $this->assertEquals('php composer.phar install --dry-run', strval($method->invoke($o)));
        $o->setCommand('update');
        $o->createArg()->setValue('--dev');
        $this->assertEquals('php composer.phar update --dev', strval($method->invoke($o)));
    }
}