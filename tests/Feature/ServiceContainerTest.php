<?php

namespace Tests\Feature;

use App\Services\HelloService;
use App\Services\HelloServiceIndonesia;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Data\Person;
use Tests\TestCase;
use App\Data\Foo;
use App\Data\Bar;

class ServiceContainerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testDependencyInjectionServiceContainer()
    {
        $foo = $this->app->make(Foo::class); // New Foo();
        $foo2 = $this->app->make(Foo::class); // New Foo();

        self::assertEquals('Foo', $foo->foo());
        self::assertEquals('Foo', $foo2->foo());
        self::assertNotSame($foo, $foo2);

    }

    public function testBind(): void
    {
        $this->app->bind(Person::class, function ($app) {
            return new Person("Eza", "Pratama");
        });

        $person1 = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);

        self::assertEquals('Eza', $person1->firstName);
        self::assertEquals('Pratama', $person1->lastName);
        self::assertEquals('Eza', $person2->firstName);
        self::assertEquals('Pratama', $person2->lastName);
        self::assertNotSame($person1, $person2);
    }

    public function testSingleton(): void
    {
        $this->app->singleton(Person::class, function ($app) {
            return new Person("Eza", "Pratama");
        });

        $person1 = $this->app->make(Person::class); // new Person ("Eza", "Pratama");
        $person2 = $this->app->make(Person::class); // return existing

        self::assertEquals('Eza', $person1->firstName);
        self::assertEquals('Pratama', $person1->lastName);
        self::assertEquals('Eza', $person2->firstName);
        self::assertEquals('Pratama', $person2->lastName);
        self::assertSame($person1, $person2);
    }

    public function testInstance(): void
    {
        $person = new Person('Eza', 'Pratama');
        $this->app->instance(Person::class, $person);

        $person1 = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);

        self::assertEquals('Eza', $person1->firstName);
        self::assertEquals('Pratama', $person1->lastName);
        self::assertEquals('Eza', $person2->firstName);
        self::assertEquals('Pratama', $person2->lastName);
        self::assertSame($person1, $person2);
    }

    public function testDependencyInjection(): void
    {
        $this->app->singleton(Foo::class, function ($app) {
            return new Foo();
        });

        $this->app->singleton(Bar::class, function ($app) {
            $foo = $app->make(Foo::class);
            return new Bar($foo);
        });

        $foo = $this->app->make(Foo::class);
        $bar1 = $this->app->make(Bar::class);
        $bar2 = $this->app->make(Bar::class);


        self::assertSame($foo, $bar1->foo);

        self::assertSame($bar1, $bar2);
    }

    public function testInterfaceToClass(): void
    {
        // Simple
        // $this->app->singleton(HelloService::class, HelloServiceIndonesia::class);

        // Complex
        $this->app->singleton(HelloService::class, function ($app) {
            return new HelloServiceIndonesia();
        });

        $helloService = $this->app->make(HelloService::class);

        self::assertEquals('Halo Eza', $helloService->hello('Eza'));
    }
}
