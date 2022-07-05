<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Search</h3>
                    <input type="text" wire:model="searchTerm"
                        style="margin-left: 15px; width: 250px; outline: none;" />
                    <!-- Trigger/Open The Modal -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <button id="myBtn" type="button">Create Country</button>

                    <!-- The Modal -->
                    <div id="myModal" class="modal">
                        <!-- Modal content -->
                        <div class="modal-content">
                            <span class="close">&times;</span>
                            <p>Create new country..</p>
                            <form id="create-form">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">{{ __('cms.name') }}</label>
                                        <input type="text" class="form-control" id="name"
                                            placeholder="Enter country name">
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="active" checked>
                                        <label class="form-check-label" for="active">{{ __('cms.active') }}</label>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="button" onclick="applyStoreCountry()"
                                        class="btn btn-primary">{{ __('cms.create') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>{{ __('cms.name') }}</th>
                                <th>{{ __('cms.bank_count') }}</th>
                                <th>{{ __('cms.active') }}</th>
                                <th>{{ __('cms.created_at') }}</th>
                                <th>{{ __('cms.updated_at') }}</th>
                                <th>{{ __('cms.settings') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <div wire:loading style="margin-left: 40%; font-size: 20px;">
                                Loading
                            </div>
                            @foreach ($countries as $country)
                                <tr>
                                    <td>{{ $country->id }}</td>
                                    <td>{{ $country->name }}</td>
                                    {{-- <td>{{ $country->banks_count }}</td> --}}
                                    <td>
                                        <a class="btn btn-app bg-danger"
                                            href="{{ route('banks.specific', $country->id) }}">
                                            <span class="badge bg-teal">{{ $country->banks_count }}</span>
                                            <i class="fas fa-inbox"></i> {{ __('cms.bank_count') }}
                                        </a>
                                    </td>
                                    <td><span
                                            class="badge @if (!$country->active) bg-danger @else bg-success @endif">{{ $country->active_status }}</span>
                                    </td>
                                    <td>{{ $country->created_at->diffForHumans() }}</td>
                                    <td>{{ $country->updated_at->diffForHumans() }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('countries.edit', $country->id) }}"
                                                class="btn btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" onclick="confirmDestroy({{ $country->id }}, this)"
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
