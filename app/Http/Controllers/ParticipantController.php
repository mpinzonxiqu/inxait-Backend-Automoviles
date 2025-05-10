<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ParticipantsExport;

class ParticipantController extends Controller
{
    // Mostrar la landing con participantes y ganador (si hay)
    public function index()
    {
        $participants = Participant::all();
        $winner = Participant::count() >= 5 ? Participant::inRandomOrder()->first() : null;

        return view('landing', compact('participants', 'winner'));
    }

    // Guardar participante nuevo
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|alpha',
            'apellido' => 'required|alpha',
            'cedula' => 'required|numeric',
            'departamento' => 'required|string',
            'ciudad' => 'required|string',
            'celular' => 'required|numeric',
            'email' => 'required|email',
            'habeas_data' => 'accepted',
        ]);

        Participant::create($request->only([
            'nombre', 'apellido', 'cedula', 'departamento',
            'ciudad', 'celular', 'email', 'habeas_data'
        ]));

        return redirect('/')->with('success', 'Registro exitoso');
    }

    // Seleccionar un ganador si hay al menos 5 participantes
    public function selectWinner()
    {
        if (Participant::count() >= 5) {
            $winner = Participant::inRandomOrder()->first();
            $participants = Participant::all();

            return view('landing', compact('participants', 'winner'));
        }

        return redirect('/')->with('error', 'Deben existir al menos 5 participantes.');
    }

    // Exportar datos a Excel
    public function export()
    {
        return Excel::download(new ParticipantsExport, 'participantes.xlsx');
    }
}
