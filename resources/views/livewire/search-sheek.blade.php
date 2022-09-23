<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    {{-- {{ dd($sheeks) }} --}}
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('Search') }}</h3>
                            <input type="text" wire:model="searchTerm"
                                style="margin-left: 15px; width: 250px; outline: none;" />
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>{{ __('Beneficiary name') }}</th>
                                        <th>{{ __('Bank name') }}</th>
                                        <th>{{ __('Amount') }}</th>
                                        <th>{{ __('Date') }}</th>
                                        <th>{{ __('Currancy') }}</th>
                                        <th>{{ __('Type') }}</th>
                                        <th>{{ __('Description') }}</th>
                                        <th>{{ __('Created at') }}</th>
                                        <th>{{ __('Updated at') }}</th>
                                        <th>{{ __('Settings') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <div wire:loading style="margin-left: 40%; font-size: 20px;">
                                        {{ __('Loading') }}
                                    </div>
                                    @foreach ($sheeks as $sheek)
                                        <tr>
                                            <td>{{ $sheek->id }}</td>
                                            <td>{{ $sheek->beneficiary_name }}</td>
                                            @if ($sheek->bank)
                                                <td>{{ $sheek->bank->name }}</td>
                                            @else
                                                <td>{{ __('no bank found') }}</td>
                                            @endif
                                            <td>{{ $sheek->amount }}</td>
                                            <td>{{ $sheek->date }}</td>
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
                            @if (count($sheeks) == 0)
                                <tr>
                                    <td colspan="8">
                                        <center>
                                            <div style="font-size: 16px; color: rgb(128, 126, 126)">
                                                {{ __('No data found') }}
                                            </div>
                                        </center>
                                    </td>
                                </tr>
                            @endif
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
