@extends('app')
@section('title', 'Vente')
@section('content')
    <div class="space-y-8">
        <livewire:vente.vente-add></livewire:vente.vente-add>
        {{-- statisques table --}}
        <livewire:vente.bande-statistique-vente></livewire:vente.bande-statistique-vente>
        {{-- title table --}}
        <div class="space-y-4">
            <div>
                <h4 class="font-bold">Liste de tous les ventes</h4>
                <p class="text-sm text-base-content">Double cliquer sur une ligne pour voir les infos en detaille</p>
            </div>
            {{-- Table des ventes --}}
            <livewire:vente.vente-table></livewire:vente.vente-table>
        </div>
    </div>
@endsection
