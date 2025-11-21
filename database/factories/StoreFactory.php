<?php

namespace Database\Factories;

use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Helpers\ImageHelper;

class StoreFactory extends Factory
{
    protected $model = Store::class;

    public function definition(): array
    {
        $city = $this->faker->city();
        $imageHelper = new ImageHelper();

        return [
            'name'        => $this->faker->unique()->company(),
            'logo'        => $imageHelper->storeAndResizeImage(
                $imageHelper->createDummyImageWithTextSizeAndPosition(250, 250, 'center', 'center', 'random', 'medium'),
                'store',
                250,
                250
            ),
            'about'       => $this->faker->paragraphs(2, true),
            'phone'       => $this->faker->unique()->numerify('+628##########'),
            'address_id'  => $this->faker->uuid(),
            'city'        => $city,
            'address'     => $this->faker->streetAddress().', '.$city,
            'postal_code' => $this->faker->postcode(),
            'is_verified' => $this->faker->boolean(70),
        ];
    }


    public function verified(): self
    {
        return $this->state(fn () => [
            'is_verified' => true,
        ]);
    }

    public function unverified(): self
    {
        return $this->state(fn () => [
            'is_verified' => false,
        ]);
    }
}
