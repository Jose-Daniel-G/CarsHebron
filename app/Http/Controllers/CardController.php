<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;

class CardController extends Controller
{
    public function index()
    {
        $cards = Card::latest()->paginate();
        // dd($card);
        return view('admin.card.index', compact('cards'));
    }

    public function create(Card $card)
    {
        // return view('card.create');
        return view('admin.card.create', compact('card'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'slug' => 'required|unique,slug',
            'body' => 'required',
        ]);

        $card = Card::create($validatedData);
        return redirect()->edit($card);
    }

    public function show(Card $card)
    {
        //
    }

    public function edit(Card $card)
    {
        return view('card.create', compact('card'));
    }

    public function update(Request $request, Card $card)
    {
        //
    }

    public function destroy(Card $card)
    {
        //
    }
}
