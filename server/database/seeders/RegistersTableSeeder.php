<?php

namespace Database\Seeders;

use App\Models\Register;
use Illuminate\Database\Seeder;
use App\Models\Image;
use App\Models\User;
use App\Models\Note;
use App\Models\Tag; // Importieren Sie das Tag-Modell


class RegistersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Finden Sie das erste Bild in der Datenbank
        $image1 = Image::find(1);
        $image2 = Image::find(2);
        $image3 = Image::find(3);

        // Erstellen von zwei Benutzern
        $user1 = User::find(1);
        $user2 = User::find(2);



        // Erstellen von zwei Listen
        $register1 = new Register();
        $register1->name = "Web Projekt";
        $register1->description = "Im Studiengang KWM muss im 6. Semester ein Web Projekt umgesetz werden";
        $register1->user_id = $user1->id; // Setzen der user_id
        $register1->save();
        if ($image1) {
            $image1->register_id = $register1->id; // Setzen der register_id im Bild
            $image1->save();
        }

        $register2 = new Register();
        $register2->name = "Social Media Plan";
        $register2->description = "Der Social Media Plan wird für die nächsten 3 Monate vorbereitet";
        $register2->user_id = $user2->id; // Setzen der user_id
        $register2->save();
        if ($image2) {
            $image2->register_id = $register2->id; // Setzen der register_id im Bild
            $image2->save();
        }

        $register3 = new Register();
        $register3->name = "Firmenevent";
        $register3->description = "Für das Firmenevent findet ihr hier den Eventmanagementleitfaden";
        $register3->user_id = $user2->id; // Setzen der user_id
        $register3->save();
        if ($image3) {
            $image3->register_id = $register3->id; // Setzen der register_id im Bild
            $image3->save();
        }


    }
}
