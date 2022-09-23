<div>
    {{-- The best athlete wants his opponent at his best. --}}
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{__('Search')}}</h3>
                    <input type="text" wire:model="searchTerm"
                        style="margin-left: 15px; width: 250px; outline: none;" />
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Country') }}</th>
                                <th>{{ __('Active') }}</th>
                                <th>{{ __('Created at') }}</th>
                                <th>{{ __('Updated at') }}</th>
                                <th>{{ __('Settings') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <div wire:loading style="margin-left: 40%; font-size: 20px;">
                                {{__('Loading')}}
                            </div>
                            @foreach ($banks as $bank)
                                <tr>
                                    <td>{{ $bank->id }}</td>
                                    <td>{{ $bank->name }}</td>
                                    <td>{{ $bank->country->name ?? 'No Country' . ', ' . $bank->city }}</td>
                                    <td><span
                                            class="badge @if (!$bank->active) bg-danger @else bg-success @endif">{{ $bank->active_status }}</span>
                                    </td>
                                    <td>{{ $bank->created_at->diffForHumans() }}</td>
                                    <td>{{ $bank->updated_at->diffForHumans() }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('banks.edit', $bank->id) }}" class="btn btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" onclick="confirmDestroy({{ $bank->id }}, this)"
                                                class="btn btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
</div>
