<?php

namespace App\Http\Livewire;

use App\Models\Super;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class FollowUpSuperSearch extends Component
{
    public $searchIP = '';
    public $super;
    protected $super_logs;

    public function mount(Super $super, $super_logs)
    {
        $this->super = $super;
        $this->super_logs = $super_logs;
    }
    public function render()
    {
        // $super_logs = DB::table('super_logs')->where('super_id', $super->id)->latest()->paginate();
        $this->super_logs = DB::table('super_logs')->where([
            ['super_id', $this->super->id],
            ['ip', 'LIKE', '%' . $this->searchIP . '%'],
        ])->latest()->paginate();
        return view('livewire.follow-up-super-search', [
            'super_logs' => $this->super_logs,
        ]);
    }
}
