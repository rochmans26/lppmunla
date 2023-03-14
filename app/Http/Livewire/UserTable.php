<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Mail\SendPassword;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserTable extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $username,$name, $level, $email;
    public $eusername,$ename, $elevel, $eemail, $eid;
    
    
    public $result = 10;
    public $search = "";


    public function render()
    {
        return view('livewire.user-table', [
            'users' => User::orderBy('id', 'desc')
            ->where('name', 'like', '%'.$this->search.'%')
            ->orWhere('username', 'like', '%'.$this->search.'%')
            ->orWhere('level', 'like', '%'.$this->search.'%')
            ->orWhere('email', 'like', '%'.$this->search.'%')
            ->paginate($this->result)
        ])
        ->extends('layouts.master')
        ->section('content');
    }

    public function create()
    {
        $random_pw = Str::random(30);
        $this->validate([
            'name' => 'required|string|min:4',
            'username' => 'required|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'level' => 'required'
        ]);
        User::create([
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'level' => $this->level,
            'password' => Hash::make($random_pw)
        ]);
        $data = [
            'username' => $this->username,
            'password' => $random_pw
        ];

        Mail::to($this->email)->send(new SendPassword($data));
        session()->flash('success', 'Berhasil Menambahkan User Admin!');
        $this->dispatchBrowserEvent('closeModal');
        $this->ClearForm();
    }

    // Clear Form
    public function ClearForm()
    {
        $this->name = Null;
        $this->username = Null;
        $this->email = Null;
        $this->level = Null;
    }
    
    // Edit
    public function edit($id)
    {
        $user = User::where('id', $id)->first();
        $this->eid = $user->id;
        $this->ename = $user->name;
        $this->eusername = $user->username;
        $this->eemail = $user->email;
        $this->elevel = $user->level;
    }

    public function update()
    {
        $data = [
            'name' => $this->ename,
            'username' => $this->eusername,
            'email' => $this->eemail,
            'level' => $this->elevel
        ];
        $get=User::where('id', $this->eid)->update($data);
        session()->flash('success', 'Berhasil Edit User Admin!');
        $this->dispatchBrowserEvent('closeModal');
        $this->ClearForm();
    }

    public function confirm($id)
    {
        $user = User::where('id', $id)->first();
        $this->eid = $user->id;
    }

    public function delete()
    {
        $del = User::where('id', $this->eid)->delete();

        session()->flash('success', 'Data Berhasil Dihapus');
        $this->dispatchBrowserEvent('closeModal');
        $this->ClearForm();
    }
}
