<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\bidang;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class WebPengguna extends Component
{
    public $data_bidang;
    public $pengguna;

    // input tambah
    public $username, $nama, $tanggal_lahir, $jenis_kelamin, $id_role, $id_bidang, $password;

    // input edit
    public $user_id, $username_edit, $nama_edit, $tanggal_lahir_edit, $jenis_kelamin_edit, $id_role_edit, $id_bidang_edit;

    // hapus
    public $delete_id;

    public function mount(){
        $this->data_bidang = bidang::all();
    }

    public function render()
    {
        $this->pengguna = User::orderBy('id', 'desc')->get();
        return view('livewire.web-pengguna');
    }

    // tambah pengguna
    public function storeUser()
    {
        $this->validate([
            'username' => 'required|unique:users',
            'nama' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'id_role' => 'required|in:1,2',
            'id_bidang' => 'required|integer',
            'password' => 'required|min:6',
        ]);

        User::create([
            'username' => $this->username,
            'nama' => $this->nama,
            'tanggal_lahir' => $this->tanggal_lahir,
            'jenis_kelamin' => $this->jenis_kelamin,
            'password' => Hash::make($this->password),
            'id_role' => $this->id_role,
            'id_bidang' => $this->id_bidang,
        ]);

        session()->flash('message', 'Pengguna berhasil ditambahkan.');
        $this->resetInput();
    }

    // tampil data untuk edit
    public function editUser($id)
    {
        $user = User::findOrFail($id);
        $this->user_id = $user->id;
        $this->username_edit = $user->username;
        $this->nama_edit = $user->nama;
        $this->tanggal_lahir_edit = $user->tanggal_lahir;
        $this->jenis_kelamin_edit = $user->jenis_kelamin;
        $this->id_role_edit = $user->id_role;
        $this->id_bidang_edit = $user->id_bidang;
    }

    // update pengguna
    public function updateUser()
    {
        $this->validate([
            'username_edit' => 'required|string',
            'nama_edit' => 'required|string',
            'tanggal_lahir_edit' => 'required|date',
            'jenis_kelamin_edit' => 'required|in:L,P',
            'id_role_edit' => 'required|in:1,2',
            'id_bidang_edit' => 'required|integer',
        ]);

        $user = User::findOrFail($this->user_id);
        $user->update([
            'username' => $this->username_edit,
            'nama' => $this->nama_edit,
            'tanggal_lahir' => $this->tanggal_lahir_edit,
            'jenis_kelamin' => $this->jenis_kelamin_edit,
            'id_role' => $this->id_role_edit,
            'id_bidang' => $this->id_bidang_edit,
        ]);

        session()->flash('message', 'Data pengguna berhasil diperbarui.');
        $this->resetInput();
    }

    // hapus
    public function deleteUser($id)
    {
        $this->delete_id = $id;
    }

    public function confirmDelete()
    {
        $user = User::findOrFail($this->delete_id);
        $user->delete();

        session()->flash('message', 'Pengguna berhasil dihapus.');
        $this->resetInput();
    }

    private function resetInput()
    {
        $this->username = $this->nama = $this->tanggal_lahir = $this->jenis_kelamin = $this->id_role = $this->id_bidang = $this->password = '';
        $this->username_edit = $this->nama_edit = $this->tanggal_lahir_edit = $this->jenis_kelamin_edit = $this->id_role_edit = $this->id_bidang_edit = '';
        $this->user_id = $this->delete_id = null;
    }
}
