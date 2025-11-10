<div class="d-flex justify-content-center">
    <div class="card" style="width: 50%;margin-top:15%">
        <div class="card-body">

            <div class="row">
                <div class="col-sm-7">

                </div>

                <div class="col-sm-5">
                    <h3 class="text-center"> Masuk Ke Aplikasi {{ config('app.name') }} </h3>
                    <form class="mt-4" wire:submit='login_act'>
                        <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" wire:model='username' class="form-control">
                        </div>
                        <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" wire:model='password' class="form-control" >
                        </div>
                        <div class="row">
                            <div class="col-sm-6 mt-2">
                                <button type="submit" style="width: 100%" class="btn btn-primary">Masuk</button>
                            </div>
                            <div class="col-sm-6 mt-2">
                                <a style="width: 100%" class="btn btn-outline-primary" href="/register">Daftar</a>
                            </div>
                        </div>
                    </form>

                    @if(session('error'))
                        <div id="error_msg" class="badge bg-danger fs-6 mt-3" style="width: 100%;overflow: hidden;text-overflow: -o-ellipsis-lastline;white-space: normal">
                            {{ session('error') }}
                        </div>
                        <script>
                            setTimeout(function() {
                                var errorMsg = document.getElementById('error_msg');
                                if (errorMsg) {
                                    errorMsg.style.display = 'none';
                                }
                            }, 10000);
                        </script>
                    @endif

                </div>
            </div>

        </div>
    </div>
</div>
