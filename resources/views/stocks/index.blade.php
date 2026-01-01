@extends('app')
@section('title', 'Stock')
@section('content')
    <div class="space-y-8">
        <livewire:stock.bande-statistique-stock></livewire:stock.bande-statistique-stock>
        <div>
            <h4 class="font-bold">Liste de tous les stoks</h4>
            <p class="text-sm text-base-content">Visualiser les variétés disponibles en stock et celles en rupture</p>
        </div>
        <livewire:stock.search-bar-stock></livewire:stock.search-bar-stock>
        {{-- Table des stocks --}}
        <livewire:stock.stock-table></livewire:stock.stock-table>
    </div>
@endsection
