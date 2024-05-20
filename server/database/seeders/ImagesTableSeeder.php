<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $image1 = new Image();
        $image1->url = "https://images.unsplash.com/photo-1488590528505-98d2b5aba04b?q=80&w=2970&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D";
        $image1->title = "image1";
        $image1->save(); // Speichern des Bildes, um die ID zu erhalten

        $image2 = new Image();
        $image2->url = "https://images.unsplash.com/photo-1531297484001-80022131f5a1?q=80&w=2920&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D";
        $image2->title = "image2";
        $image2->save(); // Speichern des Bildes, um die ID zu erhalten

        $image3 = new Image();
        $image3->url = "https://images.unsplash.com/photo-1550751827-4bd374c3f58b?q=80&w=2970&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D";
        $image3->title = "image3";
        $image3->save(); // Speichern des Bildes, um die ID zu erhalten

        $image4 = new Image();
        $image4->url = "https://plus.unsplash.com/premium_photo-1661898424988-a5f6d40d3db2?q=80&w=2970&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D";
        $image4->title = "image4";
        $image4->save(); // Speichern des Bildes, um die ID zu erhalten




    }
}
