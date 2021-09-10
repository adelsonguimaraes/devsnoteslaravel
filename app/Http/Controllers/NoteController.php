<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;

class NoteController extends Controller
{
    private $array = ['error'=>'', 'result'=>[]];

    public function all() {
        $notes = Note::all();

        foreach($notes as $note) {
            $this->array['result'][] = [
                'id'=> $note->id,
                'title'=> $note->title
            ];
        }

        return $this->array;
    }

    public function one($id) {
        $note = Note::find($id);

        if ($note) {
            $this->array['result'] = $note;
        }else{
            $this->array['error'] = 'ID não encontado';
        }

        return $this->array;
    }

    public function new(Request $r) {
        $title = $r->input('title');
        $body = $r->input('body');

        if ($title && $body) {
            $note = new Note();
            $note->title = $title;
            $note->body = $body;
            $note->save();

            $this->array['result'] = [
                'id' => $note->id,
                'title' => $title,
                'body' => $body
            ];

        }else{
            $this->array['error'] = 'Campos não enviados';
        }

        return $this->array;
    }

    public function edit (Request $r, $id) {
        $title = $r->input('title');
        $body = $r->input('body');

        if ($id && $title && $body) {

            $note = Note::find($id);
            if ($note) {
                $note->title = $title;
                $note->body = $body;
                $note->save();

                $this->array['result'] = [
                    'id' => $id,
                    'title' => $title,
                    'body' => $body
                ];

            }else{
                $this->array['error'] = 'ID não encontrado';    
            }

        }else{
            $this->array['error'] = 'Edit: Campos não enviados';
        }
        
        return $this->array;
    }

    public function delete($id) {
        $note = Note::find($id);
        if ($note) {
            $note->delete();
        }else{
            $this->array['error'] = 'ID não encontrado.';
        }

        return $this->array;
    }
}
