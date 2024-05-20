<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Tag;
use App\Models\Note;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Register;

class NotesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
// Finden Sie das erste Bild und den ersten Tag in der Datenbank
        // Finden Sie den ersten Tag in der Datenbank
        $tag1 = Tag::find(1);
        $tag2 = Tag::find(2);
        $tag3 = Tag::find(3);

        $image1 = Image::find(1);
        $image2 = Image::find(2);
        $image3 = Image::find(3);

        $register1 = Register::find(1);
        $register2 = Register::find(2);
        $register3 = Register::find(3);

        // Erstellen von note1 ohne image im register1
        $note1 = new Note();
        $note1->title = "Backend anlegen";
        $note1->description = "Das Backend bildet die Basis für das ganze Projekt";
        $note1->tag_id = $tag1->id; // Verwenden Sie die ID des Tags
        $note1->register_id = $register1->id; // Setzen der register_id in der Notiz
        $note1->save();


        // Erstellen von note2 mit image im register2
        $note2 = new Note();
        $note2->title = "LinkedIn Kampangen";
        $note2->description = "Das ist eine Dokumentation um LinkedIn Kampagnen anzulegen";
        $note2->tag_id = $tag2->id; // Verwenden Sie die ID des Tags
        $note1->register_id = $register2->id; // Setzen der register_id in der Notiz
        if ($image2) {
            $image2->note_id = $note2->id; // Setzen der register_id im Bild
            $image2->save();
        }
        $note2->save();

        // Erstellen von note3 ohne image im register3
        $note1 = new Note();
        $note1->title = "Catering";
        $note1->description = "Hier sind die wichtigsten Kontakte gelistet";
        $note1->tag_id = $tag1->id; // Verwenden Sie die ID des Tags
        $note1->register_id = $register3->id; // Setzen der register_id in der Notiz
        $note1->save();


    }
}
