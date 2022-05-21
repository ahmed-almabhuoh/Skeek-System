<div>
<<<<<<< HEAD
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Search</h3>
                            <input type="text" wire:model="searchTerm" style="margin-left: 15px"/>
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
                                    @foreach ($sheeks as $sheek)
                                        <tr>
                                            <td>{{ $sheek->id }}</td>
                                            <td>{{ $sheek->beneficiary_name }}</td>
                                            {{-- <td>
                                                <div class="progress progress-xs">
                                                    <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                                                </div>
                                            </td>
                                            <td><span class="badge bg-danger">55%</span></td> --}}
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
=======
    {{-- Stop trying to control. --}}
    <input type="text" wire:model="searchTerm" />

    @if (!is_null($searchTerm))
        <ul>
            @foreach ($sheeks as $sheek)
                <li>
                    <a href="{{route('sheeks.edit', $sheek->id)}}">{{ $sheek->beneficiary_name }}</a>
                </li>
            @endforeach
        </ul>
    @endif
>>>>>>> 0fcda399259e05067193472199dd5cf0298ef286
</div>
