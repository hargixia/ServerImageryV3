<div class="container-fluid">

    <div class="row mt-2">
        <div class="col-2">
            <aside class="sticky-top">
                @include('components.navbar')
            </aside>
        </div>

        <main class="col-10">
            <h1 class="mt-3">Akun : {{ Auth::user()->nama }}</h1>
        </main>

    </div>
</div>
