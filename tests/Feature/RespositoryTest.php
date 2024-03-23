<?php

namespace Tests\Feature;

use PHPUnit\Framework\TestCase;
use App\Models\Repository\Executed\ExecutedRepository;
use App\Models\Repository\Executed\IExecutedRepository;
use App\Models\Repository\Repository as AbstractRepository;
use App\Models\Executed;

class RespositoryTest extends TestCase
{
    public function testClassExists()
    {
        $this->assertTrue(class_exists(ExecutedRepository::class));
    }

    public function testImplementsInterface()
    {
        $reflection = new \ReflectionClass(ExecutedRepository::class);
        $this->assertTrue($reflection->implementsInterface(IExecutedRepository::class));
    }

    public function testExtendsAbstractRepository()
    {
        $this->assertInstanceOf(AbstractRepository::class, new ExecutedRepository());
    }

    public function testModelClassNameProperty()
    {
        $repository = new ExecutedRepository();
        $reflection = new \ReflectionClass($repository);
        $property = $reflection->getProperty('modelClassName');
        $property->setAccessible(true);
        $this->assertEquals(Executed::class, $property->getValue($repository));
    }
}
