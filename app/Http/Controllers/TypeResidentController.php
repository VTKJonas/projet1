<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreTypeResidentRequest;
use App\Models\TypeResident;

class TypeResidentController extends Controller
{
    
    public function index()
    {
        $types = TypeResident::all();
        return view('types_resident.index', compact('types'));
    }
    

   
    public function create()
    {
        return view('types_resident.create');
    }

    
    public function store(Request $request)
    {
          $request->validate([
            'libelle' => 'required|string|max:255|unique:type_residents,libelle',
        ]);

        TypeResident::create($request->only('libelle'));

        return redirect()->route('types-resident.index')->with('success', 'Type de résident ajouté avec succès.');
    }
    

    
    public function show(string $id)
    {
        //
    }

    
    public function edit(string $id)
    {
         $type = TypeResident::findOrFail($id);
        return view('types_resident.edit', compact('type'));
    }

    
    public function update(Request $request, string $id)
    {
         $request->validate([
            'libelle' => 'required|string|max:255',
        ]);

        $type = TypeResident::findOrFail($id);
        $type->update($request->only('libelle'));

        return redirect()->route('types-resident.index')->with('success', 'Type modifié avec succès.');
    }

   
    public function destroy(string $id)
    {
         $type = TypeResident::findOrFail($id);
        $type->delete();

        return redirect()->route('types-resident.index')->with('success', 'Type supprimé avec succès.');
    }
}
