<!doctype html>
<html lang="en" x-data="themeToggle()" :class="{ 'dark': dark }">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>PennielNotes — Keep notes simple</title>

    <!-- Tailwind CDN for quick prototype -->
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

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
      /* small helper to make the large hero image mock look nice */
      .glass {
        backdrop-filter: blur(6px) saturate(1.1);
        -webkit-backdrop-filter: blur(6px) saturate(1.1);
      }
    </style>
  </head>
  <body class="bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100 min-h-screen transition-colors duration-200">

    <!-- Alpine: theme store -->
    <script>
      function themeToggle(){
        return {
          dark: (localStorage.getItem('en_dark') === '1'),
          init(){
            this.dark = (localStorage.getItem('en_dark') === '1');
          },
          toggle(){
            this.dark = !this.dark;
            localStorage.setItem('en_dark', this.dark ? '1' : '0');
          }
        }
      }
    </script>

    <!-- NAV -->
    <nav class="max-w-6xl mx-auto px-6 py-6 flex items-center justify-between">
      <div class="flex items-center gap-3">
        <div class="w-10 h-10 rounded-lg flex items-center justify-center bg-primary/20 dark:bg-primary/30 glass">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" class="text-primary dark:text-white">
            <path d="M4 6h16v12H4z" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"></path>
            <path d="M8 10h8" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"></path>
          </svg>
        </div>
        <a href="#" class="text-lg font-semibold">PennielNotes</a>
      </div>

      <div class="flex items-center gap-4">
        <!-- links kept as-is: Login, Logout, Dashboard -->
            @if (Route::has('login'))
                <nav class="flex items-center justify-end gap-4">
                    @auth
                        <a
                            href="{{ url('/dashboard') }}"
                            class="text-sm px-2 py-3 rounded-md bg-primary text-white hover:opacity-95"
                        >
                            Dashboard
                        </a>
                    @else
                        <a
                            href="{{ route('login') }}"
                            class="text-sm px-2 py-2 rounded-md hover:bg-gray-100 dark:hover:bg-gray-800"
                        >
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a
                                href="{{ route('register') }}"
                                class="text-sm px-2 py-2 rounded-md hover:bg-gray-100 dark:hover:bg-gray-800">
                                Register
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif

        <!-- theme toggle -->
        <button @click="toggle()" class="ml-2 p-2 rounded-md border border-gray-200 dark:border-gray-700" aria-label="Toggle theme">
          <svg x-show="!dark" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v2m0 14v2m9-9h-2M5 12H3m15.36 6.36l-1.42-1.42M7.05 7.05L5.64 5.64m12.02 0L17.95 7.05M7.05 16.95L5.64 18.36" />
          </svg>
          <svg x-show="dark" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z" />
          </svg>
        </button>
      </div>
    </nav>

    <!-- HERO -->
    <header class="max-w-6xl mx-auto px-6 py-12 lg:py-24 flex flex-col lg:flex-row items-center gap-12">
      <div class="flex-1">
        <h1 class="text-4xl lg:text-5xl font-extrabold leading-tight">PennielNotes — simple notes, free forever</h1>
        <p class="mt-4 text-gray-600 dark:text-gray-300 max-w-xl">A lightweight notes app built for quick capture, organized thoughts, and worry-free syncing. Powered by Editor.js so your notes are content-rich, editable, and future-proof.</p>

        <div class="mt-8 grid grid-cols-2 sm:grid-cols-3 gap-4 text-sm text-gray-600 dark:text-gray-300">
          <div class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-md flex items-center justify-center bg-primary/20 dark:bg-primary/30">📝</div>
            <div>
              <div class="font-semibold">Quick capture</div>
              <div class="text-xs">Jot ideas instantly with a focused editor.</div>
            </div>
          </div>

          <div class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-md flex items-center justify-center bg-primary/20 dark:bg-primary/30">🔒</div>
            <div>
              <div class="font-semibold">Private by default</div>
              <div class="text-xs">Notes stay private — export or share when you're ready.</div>
            </div>
          </div>

          <div class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-md flex items-center justify-center bg-primary/20 dark:bg-primary/30">⚡</div>
            <div>
              <div class="font-semibold">Fast & tiny</div>
              <div class="text-xs">Optimized for speed — no bloat, just notes.</div>
            </div>
          </div>
        </div>
      </div>

      <div class="flex-1 w-full max-w-lg">
        <!-- Mock editor card -->
        <div class="rounded-2xl border border-gray-100 dark:border-gray-800 p-6 bg-gradient-to-br from-white/60 to-primary/10 dark:from-gray-800/40 dark:to-gray-800/20 glass">
          <div class="flex items-center justify-between mb-4">
            <div>
              <div class="text-xs uppercase text-gray-500 dark:text-gray-400">New note</div>
              <div class="font-semibold">Shopping list — weekend</div>
            </div>
            <div class="text-xs text-gray-400">Edited 10m ago</div>
          </div>

          <div class="mt-3 space-y-3 text-sm text-gray-700 dark:text-gray-200">
            <p>• Milk
            <br>• Eggs
            <br>• Coffee</p>

            <p class="text-xs text-gray-500">— Add images, checklists, code blocks, and more with Editor.js</p>

            <div class="mt-4 flex items-center gap-3">
              <button class="px-3 py-2 rounded-md bg-primary/90 text-white text-sm">Open</button>
              <button class="px-3 py-2 rounded-md border border-gray-200 dark:border-gray-700 text-sm">Duplicate</button>
            </div>
          </div>
        </div>
      </div>
    </header>

    <!-- FEATURES / BENEFITS -->
    <section class="max-w-6xl mx-auto px-6 py-12">
      <h2 class="text-2xl font-bold">Features</h2>
      <p class="text-gray-600 dark:text-gray-300 mt-2 max-w-2xl">Everything you need to keep ideas — no distractions. Built with Editor.js for block-based, structured content.</p>

      <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="p-6 rounded-xl border border-gray-100 dark:border-gray-800">
          <div class="text-2xl">✍️</div>
          <h3 class="mt-3 font-semibold">Block editor</h3>
          <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">Rich content blocks (paragraphs, lists, images, code, checklists) powered by Editor.js.</p>
        </div>

        <div class="p-6 rounded-xl border border-gray-100 dark:border-gray-800">
          <div class="text-2xl">🔎</div>
          <h3 class="mt-3 font-semibold">Search & tags</h3>
          <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">Find notes instantly with fast search and simple tags/folders.</p>
        </div>

        <div class="p-6 rounded-xl border border-gray-100 dark:border-gray-800">
          <div class="text-2xl">☁️</div>
          <h3 class="mt-3 font-semibold">Export & backup</h3>
          <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">Export JSON, Markdown or print-friendly PDFs — your data, your control.</p>
        </div>

        <div class="p-6 rounded-xl border border-gray-100 dark:border-gray-800">
          <div class="text-2xl">🔒</div>
          <h3 class="mt-3 font-semibold">Privacy-first</h3>
          <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">Notes are private by default. Optional sharing links when you want them.</p>
        </div>

        <div class="p-6 rounded-xl border border-gray-100 dark:border-gray-800">
          <div class="text-2xl">⚡</div>
          <h3 class="mt-3 font-semibold">Offline-ready</h3>
          <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">Keep taking notes even when offline — sync when you reconnect.</p>
        </div>

        <div class="p-6 rounded-xl border border-gray-100 dark:border-gray-800">
          <div class="text-2xl">🔁</div>
          <h3 class="mt-3 font-semibold">Simple sync</h3>
          <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">Sync across devices using your preferred backend (API-ready).</p>
        </div>

      </div>
    </section>

    <!-- CTA -->
    <section class="max-w-6xl mx-auto px-6 py-12 flex items-center justify-between bg-gray-50 dark:bg-gray-800 rounded-2xl">
      <div>
        <h3 class="text-xl font-bold">Ready to simplify your notes?</h3>
        <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">Sign in and start writing — it's fast, lightweight, and friendly.</p>
      </div>
      <div class="flex items-center gap-3">
        <a href="/login" class="px-4 py-3 rounded-lg border border-gray-200 dark:border-gray-700">Login</a>
        <a href="/dashboard" class="px-4 py-3 rounded-lg bg-primary text-white">Get Started</a>
      </div>
    </section>

    <!-- FOOTER -->
    <footer class="max-w-6xl mx-auto px-6 py-8 text-sm text-gray-500 dark:text-gray-400">
      <div class="flex items-center justify-between">
        <div>© <span id="year"></span> PennielNotes</div>
        <div>Built by <a href="http//:penniel.com">dev.penniel</a></div>
        <div class="flex items-center gap-4">
          <a href="#">Privacy</a>
          <a href="#">Contact</a>
        </div>
      </div>
    </footer>

    <script>
      document.getElementById('year').innerText = new Date().getFullYear();
    </script>
  </body>
</html>
