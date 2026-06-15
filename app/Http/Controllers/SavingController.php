<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Saving;

class SavingController extends Controller
{
    public function index(Request $request)
    {
        $query = Saving::query();
        if ($request->has('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        return $query->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
        ]);

        return Saving::create($validated);
    }

    public function show(Saving $saving)
    {
        return $saving;
    }

    public function update(Request $request, Saving $saving)
    {
        $validated = $request->validate([
            'amount' => 'sometimes|numeric|min:0',
            'category_id' => 'sometimes|exists:categories,id',
            'description' => 'nullable|string',
        ]);

        $saving->update($validated);
        return $saving  ;
    }

    public function destroy(Saving $saving)
    {
        $saving->delete();
        return response()->noContent();
    }
}
