@extends('app')
@section('title', 'Stock')
@section('content')
    <div class="space-y-8">
        <livewire:perte.perte-add></livewire:perte.perte-add>

        <livewire:perte.bande-statistique-perte></livewire:perte.bande-statistique-perte>
        <div>
            <h4 class="font-bold">Liste de tous les pertes</h4>
            <p class="text-sm text-base-content">Évaluation des pertes de stock par variété</p>
        </div>

        <livewire:perte.search-bar-perte></livewire:perte.search-bar-perte>

        <livewire:perte.perte-table></livewire:perte.perte-table>

    </div>
@endsection
