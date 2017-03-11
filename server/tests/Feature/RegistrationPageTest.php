<?php

/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Tests\Feature;

use Faker\Factory;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RegistrationPageTest extends TestCase
{
    use DatabaseMigrations;

    public function testRegistrationPageAvailable()
    {
        $response = $this->get(route('registration', [], false));

        $response->assertStatus(200);
    }

    public function testRegistrationFailedAction(): void
    {
        $response = $this->post(route('registration', [], false));

        $response->assertStatus(302);
        $response->assertRedirect(route('registration'));
    }

    public function testRegistrationAction(): void
    {
        $email = Factory::create()->email;
        $password = '111' . random_int(1, 999999999);

        $response = $this->post(route('registration', [], false), [
            'name'                  => 'Unit test user',
            'email'                 => $email,
            'password'              => $password,
            'password_confirmation' => $password,
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('home'));

        /** @var User $user */
        $user = User::whereEmail($email)->first();

        $this->assertNotNull($user);
        $this->assertEquals($user->name, 'Unit test user');
        $this->assertNotEquals($user->password, $password);
        $this->assertTrue(password_verify($password, $user->password));
    }
}
