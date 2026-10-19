<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAgrementDossierRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'raison_sociale' => ['required', 'string', 'max:200'],
            'forme_juridique' => ['nullable', 'string', 'max:100'],
            'numero_rccm' => ['nullable', 'string', 'max:100'],
            'numero_nif' => ['nullable', 'string', 'max:100'],
            'type_agrement' => ['required', 'string', 'max:150'],
            'nom_contact' => ['required', 'string', 'max:150'],
            'email' => ['required', 'email', 'max:150'],
            'telephone' => ['required', 'string', 'max:30'],
            'description' => ['nullable', 'string', 'max:5000'],
            'pieces' => ['required', 'array', 'min:1', 'max:10'],
            'pieces.*' => ['file', 'max:15360', 'mimes:pdf,jpg,jpeg,png,doc,docx,xls,xlsx'],
        ];
    }

    public function messages(): array
    {
        return [
            'raison_sociale.required' => 'La raison sociale est obligatoire.',
            'type_agrement.required' => "Sélectionnez le type d’agrément demandé.",
            'nom_contact.required' => 'Le nom du responsable du dossier est obligatoire.',
            'email.required' => "L’adresse email est obligatoire.",
            'email.email' => "L’adresse email n’est pas valide.",
            'telephone.required' => 'Le numéro de téléphone est obligatoire.',
            'pieces.required' => 'Ajoutez au moins une pièce au dossier.',
            'pieces.max' => 'Vous pouvez joindre 10 fichiers au maximum.',
            'pieces.*.max' => 'Chaque fichier doit peser moins de 15 Mo.',
            'pieces.*.mimes' => 'Formats acceptés : PDF, Word, Excel, JPG et PNG.',
        ];
    }
}
