<div>
    <p>
        Isi Soal : {{ $tugas[0][0] }}
    </p>

    <Form wire:submit='kirimTugas()'>
        <p>
        Isi Tugas:
        </p>
        <textarea wire:model='t_isi'>

        </textarea>

        <input type="submit" class="btn btn-primary" value="Kirim Tugas">
    </Form>
</div>
