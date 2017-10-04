<?php

use Illuminate\Database\Seeder;
use App\Breed;

class BreedTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $breeds = ['Yorkshire Terrier', 'West Highland White Terrier', 'Staffordshire Bull Terrier', 'Shih Tzu', 'Shetland Sheepdog','Rottweiler Pug','Poodle ','Miniature Schnauzer','Maltese','Labrador Retriever','Great Dane', 'Golden Retriever','German Spitz (all sizes)','German Shorthaired Pointer','German Shepherd', 'French Bulldog', 'English Springer Spaniel', 'English Setter', 'English Cocker Spaniel', 'Doberman', 'Dachshund'];
        foreach ($breeds as $value) {
            Breed::create([
                'pet_type_id' => 1,
                'name' => $value
            ]);
        } 
        
        $breeds = ['Abyssinian', 'Aegean', 'American Curl', 'American Bobtail', 'American Shorthair','American Wirehair','Arabian Mau ','Australian Mist','Asian Semi-longhair','Balinese','Bambino', 'Toyger','Sokoke','Siamese','Serengeti'];
        foreach ($breeds as $value) {
            Breed::create([
                'pet_type_id' => 2,
                'name' => $value
            ]);
        } 
    }
}
