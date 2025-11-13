<div class="container-fluid p-0">
    <div class="row g-0">
        <div class="col-2 bg-light border-end vh-100 p-3 position-sticky top-0 d-none d-md-block">
            <aside class="sticky-top">
                @include('components.navbar')
            </aside>
        </div>

        <main class="col-12 col-lg-10 p-4">
            <h1 class="mt-3">Selamat Datang {{ Auth::user()->nama }}</h1>
        </main>

    </div>
</div>
