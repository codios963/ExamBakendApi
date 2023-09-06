<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $imageFilePath1 = 'D:/svg/darrebni.jpg';
        
        // Store the image in the storage folder
        $imagePath1 = Storage::putFile('public/Collage', $imageFilePath1);
        Slider::create([
            'uuid'=>Str::uuid(),
            'link' => 'https://www.linkedin.com/company/darrebni/?originalSubdomain=sy',
            'image'=>$imagePath1,
           ]);

        $imageFilePath2 = 'D:/svg/darrebni2.jpg';
        
        // Store the image in the storage folder
        $imagePath2 = Storage::putFile('public/Collage', $imageFilePath2);
        Slider::create([
            'uuid'=>Str::uuid(),
            'link' => 'https://www.linkedin.com/company/darrebni/?originalSubdomain=sy',
            'image'=>$imagePath2,
           ]);

        $imageFilePath3 = 'D:/svg/Darrebni2.png';
        
        // Store the image in the storage folder
        $imagePath3 = Storage::putFile('public/Collage', $imageFilePath3);
        Slider::create([
            'uuid'=>Str::uuid(),
            'link' => 'https://www.facebook.com/darrebni.co/',
            'image'=>$imagePath3,
           ]);
    }
}
