<?php

namespace App\Http\Livewire;

use App\Models\User as ModelsUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;

class User extends Component
{
    use WithFileUploads;
    public $users, $name, $email, $description, $isUpdate = false, $user_id, $image = null;

    public function resetInputFields(){
        $this->name = "";
        $this->email = "";
        $this->description = "";
        $this->image = null;
    }

    public function render()
    {
        $this->users = ModelsUser::all();
        return view('livewire.user');
    }

    public function save(Request $request){
        if($this->isUpdate){
            // update
            $user = ModelsUser::findOrFail($this->user_id);
            $data = $this->validate([
                'name' => 'required|min:6',
                'email' => 'required|email',
            ]);
            if($this->image){
                $data['image'] = 'user-'.date('Ymdhis').rand(100,999).'.'.$this->image->getClientOriginalExtension();
                $this->image->storeAs('users', $data['image'], 'public');
                if (!empty($user->image) && File::exists(public_path('storage/users/'.$user->image)) ) {
                    unlink(public_path('storage/users/'.$user->image));
                }
            }
            $success = $user->update($data);
            if($success){
                session()->flash('success', 'A user updated successfully');
            }else{
                session()->flash('error', 'Sorry something went wrong');
            }
            $this->isUpdate = false;
            $this->resetInputFields();
        }else{
            // create a new user
            $data = $this->validate([
                'name' => 'required|min:6',
                'email' => 'required|email',
                'image' => 'image'
            ]);
            $data['password'] = Hash::make('admin123');
            if($this->image){
                $data['image'] = 'user-'.date('Ymdhis').rand(100,999).'.'.$this->image->getClientOriginalExtension();
                $this->image->storeAs('users', $data['image'], 'public');
            }
            $success = ModelsUser::create($data);
            if($success){
                session()->flash('success', 'A user created successfully');
            }else{
                session()->flash('error', 'Sorry something went wrong');
            }
            $this->resetInputFields();
        }
    }
    public function edit($id)
    {
        $user = ModelsUser::findOrFail($id);
        $this->user_id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->description = $user->description;
        $this->isUpdate = true;
    }
    public function delete($id)
    {
        $user = ModelsUser::findOrFail($id);
        $success = $user->delete();
        if($success){
            session()->flash('success', 'User deleted successfully.');
        }else{
            session()->flash('error', 'Something went wrong.');
        }
    }
}
