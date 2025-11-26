<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;

new 
#[Layout('components.layouts.app.frontend')]
class extends Component {
    //
}; ?>

<!-- Controls -->
    <main class="max-w-6xl mx-auto px-6 pb-16">
      <div class="">
        <div class="flex justify-between py-10">
            <div class="">
                <h1 class="text-2xl font-bold">Your notes</h1>
                <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">Quickly find, filter, and manage your notes.</p>
            </div>
          
          
            <button @click="toggleTheme()" class="ml-2 p-2 rounded-md border border-gray-200 dark:border-gray-700" aria-label="Toggle theme">
                <svg x-show="!dark" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v2m0 14v2m9-9h-2M5 12H3m15.36 6.36l-1.42-1.42M7.05 7.05L5.64 5.64m12.02 0L17.95 7.05M7.05 16.95L5.64 18.36" />
                </svg>
                <svg x-show="dark" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z" />
                </svg>
            </button>
        </div>

        <div class="flex items-center gap-3 w-full lg:w-auto">
          <div class="flex items-center gap-2 bg-gray-50 dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-lg px-3 py-2 w-full lg:w-80">
            <flux:icon.magnifying-glass class="size-5" />
            <input x-model="search" type="text" placeholder="Search notes" class="bg-transparent outline-none text-sm w-full" />
          </div>

          <div class="ml-2">
            <select x-model="selectedCategory" class="rounded-lg border border-gray-100 dark:border-gray-700 px-3 py-2 bg-white dark:bg-gray-800 text-sm">
              <template x-for="cat in categories" :key="cat">
                <option x-text="cat"></option>
              </template>
            </select>
          </div>
      </div>

      <!-- Grid of notes -->
<!-- Grid of notes -->
<div class="mt-6 h-60  grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
<!-- Add note card (first) -->
<div @click="openAdd()" class="cursor-pointer p-4 rounded-2xl border border-dashed border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 shadow-sm flex flex-col justify-between">
<div>
<div class="text-3xl">＋</div>
<h3 class="mt-3 font-semibold">Add a new note</h3>
<p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Start a blank note or paste content from anywhere. Editor.js blocks supported.</p>
</div>
<div class="mt-4 text-xs text-gray-400">Quick capture</div>
</div>


<!-- Dynamic notes -->
<template x-for="note in filteredNotes()" :key="note.id">
<div class="h-60 relative p-4 rounded-2xl border border-gray-100 dark:border-gray-800 bg-gradient-to-br from-white/60 to-primary/5 dark:from-gray-800/40 dark:to-gray-800/20 glass shadow-sm">
<div class="flex items-start justify-between">
<div>
<div class="text-xs text-gray-500 dark:text-gray-400"> <span x-text="note.category"></span></div>
<h3 class="mt-2 font-semibold" x-text="note.title"></h3>
</div>
</div>


<p class="mt-3 text-sm text-gray-700 dark:text-gray-200" x-text="note.excerpt"></p>


<div class="mt-4 flex items-center gap-2 absolute bottom-2 right-2">
    <flux:icon.trash color="red" class="size-5" />
</div>
</div>
</template>


</div>
</div>


<!-- Empty state -->
<div class="mt-8 text-center text-gray-500 dark:text-gray-400" x-show="filteredNotes().length === 0">
No notes found. Try a different search or create your first note.
</div>

      <!-- Empty state -->
      <div class="mt-8 text-center text-gray-500 dark:text-gray-400" x-show="filteredNotes().length === 0">
        No notes found. Try a different search or create your first note.
      </div>

    </main>
