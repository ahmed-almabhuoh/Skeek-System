<?php

namespace App\Http\Livewire;

use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class FollowUpUserSearch extends Component
{
    public $admin;
    private $userLogs;
    public $searchIP = '';

    public function mount(Admin $admin, $userLogs)
    {
        $this->admin = $admin;
        $this->userLogs = $userLogs;
    }

    public function render()
    {
        // $userLogs = DB::table('user_logs')->where('admin_id', $admin->id)->orderBy('created_at', 'DESC')->paginate();

        $this->userLogs = DB::table('user_logs')->where([
            ['admin_id', $this->admin->id],
            ['ip', 'LIKE', '%' . $this->searchIP . '%'],
        ])->orderBy('created_at', 'DESC')->paginate();
        
        return view('livewire.follow-up-user-search', [
            'userLogs' => $this->userLogs,
        ]);
    }
}
