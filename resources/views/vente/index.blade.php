@extends('app')
@section('title', 'Vente')
@section('content')
    <div class="space-y-4">
        <div class="flex justify-between items-center">
            <x-title-page class_icon="fas fa-shopping-cart text-red-900" title="Gestion des ventes"
                sub_title="Suivi des transactions et des performances commerciales"></x-title-page>
            <livewire:vente.vente-add></livewire:vente.vente-add>
        </div>

        {{-- statisques table --}}
        <livewire:vente.bande-statistique-vente></livewire:vente.bande-statistique-vente>
        {{-- title table --}}
        <div class="space-y-4">
            {{-- Table des ventes --}}
            <livewire:vente.vente-table></livewire:vente.vente-table>
        </div>
    </div>
@endsection
