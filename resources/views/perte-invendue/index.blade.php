@extends('app')
@section('title', 'Stock')
@section('content')
    <div class="space-y-8">
        <div class="flex justify-between items-center">
            <x-title-page class_icon="fas fa-exclamation-triangle text-orange-300" title="Gestion des pertes"
                sub_title="Analyse et justification des pertes enregistrées"></x-title-page>
            <livewire:perte.perte-add></livewire:perte.perte-add>
        </div>

        <livewire:perte.bande-statistique-perte></livewire:perte.bande-statistique-perte>
        <livewire:perte.search-bar-perte></livewire:perte.search-bar-perte>

        <livewire:perte.perte-table></livewire:perte.perte-table>

    </div>
@endsection
