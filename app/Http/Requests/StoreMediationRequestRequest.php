<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreMediationRequestRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'prenom' => ['required', 'string', 'max:100'],
            'nom' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:150'],
            'telephone' => ['nullable', 'string', 'max:30'],
            'etablissement' => ['required', 'string', 'max:150'],
            'nature_litige' => ['required', 'string', 'max:150'],
            'description' => ['required', 'string', 'max:5000'],
            'pieces' => ['nullable', 'array', 'max:5'],
            'pieces.*' => ['file', 'max:10240', 'mimes:pdf,jpg,jpeg,png,docx'],
        ];
    }

    public function messages(): array
    {
        return [
            'prenom.required' => 'Le prénom est obligatoire.',
            'nom.required' => 'Le nom est obligatoire.',
            'email.required' => "L'email est obligatoire.",
            'email.email' => "Veuillez saisir une adresse email valide.",
            'etablissement.required' => "Merci de sélectionner l'établissement concerné.",
            'nature_litige.required' => 'Merci de préciser la nature du litige.',
            'description.required' => 'Merci de décrire votre litige.',
            'pieces.*.max' => 'Chaque fichier ne doit pas dépasser 10 Mo.',
            'pieces.*.mimes' => 'Formats acceptés : PDF, JPG, PNG, DOCX.',
            'pieces.max' => '5 fichiers maximum.',
        ];
    }
}
