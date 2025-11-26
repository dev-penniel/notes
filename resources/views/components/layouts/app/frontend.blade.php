<!doctype html>
<html lang="en" x-data="notesApp()" :class="{ 'dark': dark }">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>EasyNotes — Notes</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        darkMode: 'class',
        theme: {
          extend: {
            colors: {
              primary: '#8FD19E'
            }
          }
        }
      }
    </script>

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
      .glass { backdrop-filter: blur(6px) saturate(1.05); -webkit-backdrop-filter: blur(6px) saturate(1.05); }
    </style>
  </head>

  <body class=" relative bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100 min-h-screen transition-colors duration-200">

    <script>
      function notesApp(){
        return {
          dark: (localStorage.getItem('en_dark') === '1'),
          notes: [
            { id: 1, title: 'Weekend groceries', category: 'Personal', excerpt: 'Milk, Eggs, Coffee, Bananas', updated: '2025-11-25' },
            { id: 2, title: 'Project ideas', category: 'Work', excerpt: 'Notes about a small SaaS for local businesses', updated: '2025-11-22' },
            { id: 3, title: 'Meeting notes', category: 'Work', excerpt: 'Discuss deployment schedule and tasks', updated: '2025-10-03' },
            { id: 4, title: 'Song structure', category: 'Creative', excerpt: 'Intro — verse — chorus — bridge ideas', updated: '2025-09-06' },
            { id: 5, title: 'Weekend groceries', category: 'Personal', excerpt: 'Milk, Eggs, Coffee, Bananas', updated: '2025-11-25' },
            { id: 6, title: 'Project ideas', category: 'Work', excerpt: 'Notes about a small SaaS for local businesses', updated: '2025-11-22' },
            { id: 7, title: 'Meeting notes', category: 'Work', excerpt: 'Discuss deployment schedule and tasks', updated: '2025-10-03' },
            { id: 8, title: 'Song structure', category: 'Creative', excerpt: 'Intro — verse — chorus — bridge ideas', updated: '2025-09-06' }
          ],
          categories: ['All','Work','Personal','Creative'],
          search: '',
          selectedCategory: 'All',
          showModal: false,
          newTitle: '',
          newCategory: 'Personal',
          newExcerpt: '',

          init(){
            this.dark = (localStorage.getItem('en_dark') === '1');
          },

          toggleTheme(){
            this.dark = !this.dark;
            localStorage.setItem('en_dark', this.dark ? '1' : '0');
          },

          filteredNotes(){
            let q = this.search.toLowerCase().trim();
            return this.notes.filter(n => {
              let matchesCategory = (this.selectedCategory === 'All') || (n.category === this.selectedCategory);
              let matchesQuery = q === '' || n.title.toLowerCase().includes(q) || (n.excerpt && n.excerpt.toLowerCase().includes(q));
              return matchesCategory && matchesQuery;
            });
          },

          openAdd(){ this.showModal = true; this.newTitle=''; this.newExcerpt=''; this.newCategory='Personal'; },
          addNote(){
            if(!this.newTitle.trim()) return;
            let id = Date.now();
            this.notes.unshift({ id, title: this.newTitle, category: this.newCategory, excerpt: this.newExcerpt, updated: new Date().toISOString().slice(0,10) });
            this.showModal = false;
          },

          removeNote(id){ this.notes = this.notes.filter(n => n.id !== id); }
        }
      }
    </script>

    {{ $slot }}

    <!-- Modal: Add Note -->
    <div x-show="showModal" x-cloak class="fixed inset-0 z-40 flex items-center justify-center bg-black/40">
      <div @click.away="showModal=false" class="w-full max-w-xl p-6 rounded-2xl bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800">
        <h2 class="text-lg font-bold">New note</h2>
        <div class="mt-4 grid grid-cols-1 gap-3">
          <input x-model="newTitle" type="text" placeholder="Title" class="px-3 py-2 rounded-lg border border-gray-100 dark:border-gray-700 bg-white dark:bg-gray-800" />
          <select x-model="newCategory" class="px-3 py-2 rounded-lg border border-gray-100 dark:border-gray-700 bg-white dark:bg-gray-800">
            <option>Personal</option>
            <option>Work</option>
            <option>Creative</option>
          </select>
          <textarea x-model="newExcerpt" rows="4" placeholder="Short excerpt or paste content..." class="px-3 py-2 rounded-lg border border-gray-100 dark:border-gray-700 bg-white dark:bg-gray-800"></textarea>
        </div>

        <div class="mt-4 flex items-center justify-end gap-3">
          <button @click="showModal=false" class="px-4 py-2 rounded-lg border border-gray-200 dark:border-gray-700">Cancel</button>
          <button @click="addNote()" class="px-4 py-2 rounded-lg bg-primary text-white">Save note</button>
        </div>
      </div>
    </div>

    <!-- FOOTER -->
    <footer class="max-w-6xl mx-auto px-6 py-8 text-sm text-gray-500 dark:text-gray-400">
      <div class="flex items-center justify-center">
        <p class="text-center"><span class="w-full text-center block">Built by <a href="http://penniel.com" class="underline">penniel.com</a></p>
      </div>
    </footer>

    <script>document.getElementById('year').innerText = new Date().getFullYear();</script>
  </body>
</html>