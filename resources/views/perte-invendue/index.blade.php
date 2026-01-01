@extends('app')
@section('title', 'Stock')
@section('content')
    <div class="space-y-8">
        <livewire:perte-add></livewire:perte-add>

        <livewire:bande-statistique-perte></livewire:bande-statistique-perte>
        <div>
            <h4 class="font-bold">Liste de tous les pertes</h4>
            <p class="text-sm text-base-content">Évaluation des pertes de stock par variété</p>
        </div>

        <livewire:search-bar-perte></livewire:search-bar-perte>

        <livewire:perte-table></livewire:perte-table>

    </div>
@endsection
