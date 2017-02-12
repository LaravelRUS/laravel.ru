<?php declare(strict_types=1);

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

/**
 * Class UsersSeeder
 */
class UsersSeeder extends Seeder
{
    /**
     * @var Factory
     */
    private $faker;

    /**
     * ArticlesSeeder constructor.
     */
    public function __construct()
    {
        $this->faker = Factory::create('ru_RU');
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        User::create([
            'name'     => 'Admin',
            'email'    => 'admin@admin.com',
            'password' => 'admin',
        ]);


        foreach (range(0, 9) as $i) {
            $user = User::create([
                'name'         => $this->faker->name,
                'email'        => $this->faker->email,
                'password'     => md5((string)random_int(0, PHP_INT_MAX)),
                'avatar'       => User::DEFAULT_AVATAR_NAME,
                'is_confirmed' => true,
            ]);
            echo ' - ' . $i . ': ' . $user->name . "\n";
        }
    }
}