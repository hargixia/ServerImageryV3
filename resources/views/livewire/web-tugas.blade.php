<div>
    @if ($kirim == 4)
        <p>ini tugas : {{ $dtugas->nama }}</p>
    @endif

    <p>
        Isi Soal : {{ $tugas[0][0] }}
    </p>

    <Form wire:submit='kirimTugas()'>


        <p>
        Isi Tugas:
        </p>
        <textarea wire:model='t_isi' @if ($kirim == 3 || $kirim == 4)
            disabled
        @endif>

        </textarea>

        @if($kirim == 1)
            <input type="submit" class="btn btn-primary" value="Simpan">
        @endif

    </Form>

    @if($kirim == 4)
    <button class="btn btn-primary" wire:click='kembali()'>Kembali</button>
    @endif

    @if($kirim == 1)
        <button class="btn btn-primary" wire:click='kirimTugas()'>Kirim Tugas</button>
    @endif

</div>
