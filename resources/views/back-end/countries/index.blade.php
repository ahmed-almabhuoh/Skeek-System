@extends('back-end.index')

@section('title', __('cms.countries'))
@section('location', __('cms.countries'))
@section('index', __('cms.index'))

@section('styles')

@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        {{-- <div class="card-header">
                            <h3 class="card-title">Search</h3>
                            <input type="text" wire:model="searchTerm"
                                style="margin-left: 15px; width: 250px; outline: none;" />
                        </div> --}}
                        <div class="card-header">
                            <h3 class="card-title">{{ __('cms.countries') }}</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
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
                                                    <button type="button"
                                                        onclick="confirmDestroy({{ $country->id }}, this)"
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
@endsection

@section('scripts')
    <script>
        function confirmDestroy(id, refrance) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    destoy(id, refrance);
                }
            });
        }

        function destoy(id, refrance) {
            // check-system/sheeks/{sheek} 
            axios.delete('/check-system/countries/' + id)
                .then(function(response) {
                    // handle success
                    console.log(response);
                    refrance.closest('tr').remove();
                    showDeletingMessage(response.data);
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                    showDeletingMessage(error.response.data);
                })
                .then(function() {
                    // always executed
                });
        }

        function showDeletingMessage(data) {
            Swal.fire({
                icon: 'success',
                title: 'Your work has been saved',
                showConfirmButton: false,
                timer: 2000
            });
        }
    </script>
@endsection
