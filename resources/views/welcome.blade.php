<x-layout>
    <x-slot:title>Welcome to HRIS</x-slot:title>
    <x-slot:header>Hello, {{ auth()->user()->name ?? '' }} 👋</x-slot:header>

</x-layout>