<?php

namespace App\Http\Livewire;

use App\Models\Todo as ModelsTodo;
use Livewire\Component;

class Todo extends Component
{
    public $todos, $title, $description, $is_completed = false, $isUpdate = false, $todo_id;

    public function resetFields(){
        $this->title = null;
        $this->description = null;
        $this->todo_id = null;
    }
    public function render()
    {
        $this->todos = ModelsTodo::latest()->get();
        return view('livewire.todo');
    }

    public function save()
    {
        if ($this->isUpdate) {
            $todo = ModelsTodo::findOrFail($this->todo_id);
            $data = $this->validate([
                'title' => 'required',
                'description' => 'nullable|min:3'
            ]);
            $todo->update($data);
            session()->flash('success', 'Task Updated');
            $this->resetFields();
            $this->isUpdate = false;
        }else{
            $data = $this->validate([
                'title' => 'required',
                'description' => 'nullable|min:3'
            ]);
            ModelsTodo::create($data);
            session()->flash('success', 'Task Added');
            $this->resetFields();
        }
    }

    public function edit($id){
        $todo = ModelsTodo::findOrFail($id);
        $this->title = $todo->title;
        $this->description = $todo->description;
        $this->is_completed = $todo->is_completed;
        $this->isUpdate = true;
        $this->todo_id = $todo->id;
    }

    public function toggleTodo($id)
    {
        $todo = ModelsTodo::findorFail($id);
        $todo->is_completed = !$todo->is_completed;
        $todo->save();
    }
}
