@extends('app')
@section('title', 'Stock')
@section('content')
    <div class="space-y-8">
        <x-title-page class_icon="fa-solid fa-box text-primary" title="Gestion des stocks"
            sub_title="Contrôle des niveaux de stock en temps réel"></x-title-page>
        <livewire:stock.bande-statistique-stock></livewire:stock.bande-statistique-stock>
        <livewire:stock.search-bar-stock></livewire:stock.search-bar-stock>
        {{-- Table des stocks --}}
        <livewire:stock.stock-table></livewire:stock.stock-table>
    </div>
@endsection
