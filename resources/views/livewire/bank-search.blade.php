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
                        <button id="myBtn" type="button">{{__('Create Bank')}}</button>
                        <!-- The Modal -->
                        <div id="myModal" class="modal">
                            <!-- Modal content -->
                            <div class="modal-content">
                                <span class="close">&times;</span>
                                <p>{{__('Create new Bank..')}}</p>
                                <form id="create-form" method="POST" action="{{ route('banks.store') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="name">{{ __('Name') }}</label>
                                            @error('name')
                                                <p class="text-danger" style="display: inline-block; padding: 0 0 0 10px;">
                                                    {{ $message }}</p>
                                            @enderror
                                            <input type="text" class="form-control" id="name" name="name"
                                                placeholder="Enter bank name">
                                        </div>
                                        <div class="form-group">
                                            <label for="city">{{ __('City') }}</label>
                                            @error('city')
                                                <p class="text-danger" style="display: inline-block; padding: 0 0 0 10px;">
                                                    {{ $message }}</p>
                                            @enderror
                                            <input type="text" class="form-control" id="city" name="city"
                                                placeholder="Enter city">
                                        </div>
                                        <div class="form-group">
                                            <label for="sheek_image">{{ __('Image') }}</label>
                                            @error('sheek_image')
                                                <p class="text-danger" style="display: inline-block; padding: 0 0 0 10px;">
                                                    {{ $message }}</p>
                                            @enderror
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="sheek_image"
                                                        name="sheek_image">
                                                    <label class="custom-file-label"
                                                        for="sheek_image">{{ __('Select sheek image') }}</label>
                                                </div>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">{{ __('Upload') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="active"
                                                name="active" checked>
                                            <label class="form-check-label"
                                                for="active">{{ __('Active') }}</label>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        {{-- <button type="button" onclick="applyStoreBank()"
                                            class="btn btn-primary">{{ __('cms.create') }}</button> --}}
                                        <input type="submit" value="{{__('Create')}}" class="btn btn-primary">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Country') }}</th>
                                <th>{{__('Currancy')}}</th>
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
                                    <td>{{ $bank->currancy->name ?? '-' }}</td>
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
                            {{--  --}}
                            @if (count($banks) == 0)
                                <tr>
                                    <td colspan="8">
                                        <center>
                                            <div style="font-size: 16px; color: rgb(128, 126, 126)">
                                                {{__('No data found')}}
                                            </div>
                                        </center>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
</div>
