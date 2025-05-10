<?php

namespace App\Exports;


use App\Models\Participant;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ParticipantsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Participant::select(
            'id',
            'nombre',
            'apellido',
            'cedula',
            'departamento',
            'ciudad',
            'celular',
            'email',
            'habeas_data',
            'created_at'
        )->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nombre',
            'Apellido',
            'Cédula',
            'Departamento',
            'Ciudad',
            'Celular',
            'Email',
            'Habeas Data',
            'Fecha de Registro'
        ];
    }
}
