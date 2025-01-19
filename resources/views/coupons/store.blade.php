@extends('layouts.default')

@section('content')
    <div class="flex items-center gap-2">
        <span class="px-2 py-1 text-xs text-white rounded-sm bg-zinc-950">store</span>
        <em class="text-zinc-500">Viser aktuelle rabattkoder for {{ $email }}</em>
    </div>
    
    <x-notification :message="$message" />

@endsection