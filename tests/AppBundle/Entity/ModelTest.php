<?php

namespace AppBundle\Entity;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ModelTest extends  KernelTestCase
{
    /**
     * @var Model
     */
    private $model;

    protected function setUp()
    {
        $this->model = (new Model())->setName('ololo')->setCountedField(5);
    }

    public function testModelCountedField()
    {
        $this->assertEquals('ololo', $this->model->getName());
        $this->assertEquals(21, $this->model->getCountedField());
        $this->assertNotEquals(23, $this->model->getCountedField());
    }

}