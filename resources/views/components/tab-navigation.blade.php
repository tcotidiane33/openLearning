<div class="tabs">
    <ul class="tab-list">
        @foreach($tabs as $tab)
            <li class="tab-item {{ $activeTab == $tab['id'] ? 'active' : '' }}">
                <a href="{{ $tab['url'] }}">{{ $tab['label'] }}</a>
            </li>
        @endforeach
    </ul>
</div>

<style>
.tabs { margin-bottom: 1rem; }
.tab-list { display: flex; list-style: none; padding: 0; }
.tab-item { margin-right: 1rem; }
.tab-item.active { font-weight: bold; }
</style>

{{-- 
used :
@php
    $tabs = [
        ['id' => 'individual', 'label' => 'Individual', 'url' => '/subscriptions/individual'],
        ['id' => 'teams', 'label' => 'Teams', 'url' => '/subscriptions/teams'],
    ];
@endphp

<x-tab-navigation :tabs="$tabs" :activeTab="'individual'" /> --}}