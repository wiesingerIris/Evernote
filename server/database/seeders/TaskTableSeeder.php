<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Note;
use App\Models\Task;
use App\Models\Register;


class TaskTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Die gewünschte Notiz aus der Datenbank abrufen
        $note1 = Note::find(1);
        $note2 = Note::find(2);
        $note3 = Note::find(3);

        $tag1 = Tag::find(1);
        $tag2 = Tag::find(2);
        $tag3 = Tag::find(3);

        $image1 = Image::find(1);
        $image2 = Image::find(2);
        $image3 = Image::find(3);

        // Erstellen von task zur note1
        $task1 = new Task();
        $task1->title = "Migrations";
        $task1->description = "Alle Tabellen anlegen";
        $task1->tag_id = $tag1->id; // Verwenden Sie die ID des Tags
        $task1->due_date = '2024-12-31 23:59:59'; // Beispiel-Fälligkeitsdatum
        $task1->note_id = $note1->id; // Setzen der register_id in der Notiz
        $task1->save();

        $task2 = new Task();
        $task2->title = "Migrations";
        $task2->description = "Alle Tabellen anlegen";
        $task2->tag_id = $tag2->id; // Verwenden Sie die ID des Tags
        $task2->due_date = '2024-12-31 23:59:59'; // Beispiel-Fälligkeitsdatum
        if ($image3) {
            $image3->register_id = $task2->id; // Setzen der register_id im Bild
            $image3->save();
        }
        $task2->save();


    }
}
