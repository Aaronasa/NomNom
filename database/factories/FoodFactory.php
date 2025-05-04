<?php

namespace Database\Factories;

use App\Models\Food;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Food>
 */
class FoodFactory extends Factory
{

    protected $model = Food::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $foodArray = [
            'Ayam Goreng',
            'Mie Goreng',
            'Cah Kangkung',
            'Nasi Goreng',
            'Sate Ayam',
            'Bakso',
            'Soto Ayam',
            'Gado-Gado',
            'Rendang',
            'Pempek',
            'Nasi Uduk',
            'Nasi Kuning',
            'Martabak',
            'Lontong',
            'Gudeg',
            'Tahu Tempe',
            'Ikan Bakar',
            'Sup Ikan',
            'Bubur Ayam',
            'Kerak Telor',
            'Ayam Pop',
            'Ayam Penyet',
            'Coto Makassar',
            'Mie Aceh',
            'Ayam Bakar',
            'Gule Kambing',
            'Sate Kambing',
            'Pindang Ikan',
            'Sate Lilit',
            'Sate Padang'
        ];
        $foodDescriptions = [
            'Ayam Goreng' => 'Ayam goreng renyah dengan lapisan emas yang gurih, sempurna untuk segala hidangan.',
            'Mie Goreng' => 'Mie goreng lezat dengan campuran sayuran, rempah-rempah, dan saus gurih.',
            'Cah Kangkung' => 'Tumis kangkung dengan bawang putih, cabai, dan sentuhan kecap asin.',
            'Nasi Goreng' => 'Nasi goreng Indonesia yang diaduk dengan sayuran, telur, dan pilihan protein.',
            'Sate Ayam' => 'Sate ayam panggang disajikan dengan saus kacang yang kaya dan lezat.',
            'Bakso' => 'Bakso gurih yang disajikan dalam kuah hangat, makanan kenyamanan khas Indonesia.',
            'Soto Ayam' => 'Soto ayam harum dengan rempah-rempah, sayuran, dan kuah yang kaya.',
            'Gado-Gado' => 'Salad Indonesia dengan campuran sayuran, tahu, dan saus kacang manis-gurih.',
            'Rendang' => 'Gulai daging sapi yang dimasak perlahan dalam santan kental dan rempah aromatik.',
            'Pempek' => 'Pempek goreng yang disajikan dengan saus cuka manis-asam.',
            'Nasi Uduk' => 'Nasi gurih dengan santan, disajikan dengan ayam goreng, tahu, dan sambal.',
            'Nasi Kuning' => 'Nasi kuning berbumbu kunyit, disajikan dengan lauk seperti ayam goreng dan sambal.',
            'Martabak' => 'Martabak dengan isian gurih dari daging cincang, sayuran, dan rempah.',
            'Lontong' => 'Lontong yang disajikan dengan berbagai hidangan sayur dan sambal.',
            'Gudeg' => 'Gudeg nangka muda yang dimasak perlahan dalam santan manis dan gurih.',
            'Tahu Tempe' => 'Tahu dan tempe yang disajikan dengan sambal, sering digoreng atau dibakar untuk tekstur tambahan.',
            'Ikan Bakar' => 'Ikan bakar yang dimarinasi dengan bumbu dan disajikan dengan saus asam pedas.',
            'Sup Ikan' => 'Sup ikan yang dibuat dengan ikan segar, rempah-rempah, dan sayuran, cocok untuk makanan ringan.',
            'Bubur Ayam' => 'Bubur ayam khas Indonesia, biasanya disajikan dengan bawang goreng dan sambal.',
            'Kerak Telor' => 'Kerak telor Betawi tradisional yang dibuat dengan nasi ketan dan telur, dimasak dengan rempah.',
            'Ayam Pop' => 'Ayam khas masakan Padang yang dimasak hingga empuk, disajikan dengan sambal dan nasi.',
            'Ayam Penyet' => 'Ayam goreng yang dipenyet disajikan dengan sambal dan nasi.',
            'Coto Makassar' => 'Sup daging sapi khas Makassar yang kaya, sering disajikan dengan ketupat atau nasi.',
            'Mie Aceh' => 'Mie goreng pedas khas Aceh, biasanya disajikan dengan daging sapi, ayam, atau seafood.',
            'Ayam Bakar' => 'Ayam bakar yang dimarinasi dengan bumbu gurih, sering disajikan dengan sambal.',
            'Gule Kambing' => 'Gulai kambing dengan campuran rempah-rempah dan santan yang kaya rasa.',
            'Sate Kambing' => 'Sate kambing yang dibakar dan disajikan dengan saus kacang pedas.',
            'Pindang Ikan' => 'Sup ikan dengan kuah asam-gurih, sering disajikan dengan nasi.',
            'Sate Lilit' => 'Sate lilit khas Bali yang dibuat dengan daging cincang yang dibalut pada tusuk bambu.',
            'Sate Padang' => 'Sate daging sapi khas Padang yang pedas, disajikan dengan saus kental dan beraroma.',
        ];


        // List of real image filenames (you should add images to public/images/)
        $imageArray = [
            'Ayam Goreng' => 'Image1.avif',
            'Mie Goreng' => 'image2.jpg',
            'Cah Kangkung' => 'image3.jpg',
            'Nasi Goreng' => 'image4.jpg',
            'Sate Ayam' => 'image5.jpg',
            'Bakso' => 'image6.avif',
            'Soto Ayam' => 'image7.jpg',
            'Gado-Gado' => 'image8.jpg',
            'Rendang' => 'image9.jpg',
            'Pempek' => 'image10.jpg',
            'Nasi Uduk' => 'image11.jpg',
            'Nasi Kuning' => 'image12.jpg',
            'Martabak' => 'image13.jpg',
            'Lontong' => 'image14.jpg',
            'Gudeg' => 'image15.png',
            'Tahu Tempe' => 'image16.png',
            'Ikan Bakar' => 'image17.jpg',
            'Sup Ikan' => 'image18.jpg',
            'Bubur Ayam' => 'image19.png',
            'Kerak Telor' => 'image20.jpg',
            'Ayam Pop' => 'image21.jpg',
            'Ayam Penyet' => 'image22.jpg',
            'Coto Makassar' => 'image23.jpg',
            'Mie Aceh' => 'image24.jpg',
            'Ayam Bakar' => 'image25.jpg',
            'Gule Kambing' => 'image26.jpg',
            'Sate Kambing' => 'image27.jpg',
            'Pindang Ikan' =>  'image28.jpg',
            'Sate Lilit' => 'image29.jpg',
            'Sate Padang' => 'image30.jpg',
        ];

        // $selectedImage =  $this->faker->randomElement($imageArray);

        return [
            'foodName' => implode(', ', $this->faker->randomElements($foodArray, 2)),

            'foodDescription' => function (array $attributes) use ($foodDescriptions) {
                $foodNames = explode(', ', $attributes['foodName']);


                $descriptions = array_map(function ($food) use ($foodDescriptions) {
                    return $foodDescriptions[$food] ?? 'Enak dan lezat .';
                }, $foodNames);




                return implode(' and ', $descriptions) . ' Membuatnya menjadi makanan yang sempurna!';
            },

            'foodPrice' => $this->faker->randomFloat(2, 50000, 100000),

            'foodImage' => function (array $attributes) use ($imageArray) {
                $foodNames = explode(', ', $attributes['foodName']);

                $selectedImages = array_map(function ($food) use ($imageArray) {
                    return 'images/' . $imageArray[$food];
                }, $foodNames);

                // Store images as a JSON array
                return implode(',', $selectedImages );
            },


            'restaurant_id' => Restaurant::inRandomOrder()->first()->id,
        ];
    }
}
