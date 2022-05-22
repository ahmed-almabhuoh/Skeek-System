<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Search</h3>
                            <input type="text" wire:model="searchTerm"
                                style="margin-left: 15px; width: 250px; outline: none;" />
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>{{ __('cms.beneficiary_name') }}</th>
                                        <th>{{ __('cms.bank_name') }}</th>
                                        <th>{{ __('cms.amount') }}</th>
                                        <th>{{ __('cms.currancy') }}</th>
                                        <th>{{ __('cms.type') }}</th>
                                        <th>{{ __('cms.desc') }}</th>
                                        <th>{{ __('cms.created_at') }}</th>
                                        <th>{{ __('cms.updated_at') }}</th>
                                        <th>{{ __('cms.settings') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <div wire:loading style="margin-left: 40%; font-size: 20px;">
                                        Loading
                                    </div>
                                    @foreach ($sheeks as $sheek)
                                        <tr>
                                            <td>{{ $sheek->id }}</td>
                                            <td>{{ $sheek->beneficiary_name }}</td>
                                            <td>{{ $sheek->bank_name }}</td>
                                            <td>{{ $sheek->amount }}</td>
                                            <td>{{ $sheek->currancy }}</td>
                                            <td>{{ $sheek->type }}</td>
                                            <td>{{ $sheek->desc }}</td>
                                            <td>{{ $sheek->created_at->diffForHumans() }}</td>
                                            <td>{{ $sheek->updated_at->diffForHumans() }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('sheeks.edit', $sheek->id) }}"
                                                        class="btn btn-warning">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button type="button"
                                                        onclick="confirmDestroy({{ $sheek->id }}, this)"
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
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
</div>
