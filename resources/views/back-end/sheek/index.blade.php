@extends('back-end.index')

@section('title', __('cms.sheeks'))
@section('location', __('cms.sheeks'))
@section('index', __('cms.index'))

@section('styles')

    @livewireStyles
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('cms.sheeks') }}</h3>
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
                                            <td>{{ $sheek->created_at->format('Y-m-d H:i') }}</td>
                                            <td>{{ $sheek->updated_at->format('Y-m-d H:i') }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('sheeks.edit', $sheek->id) }}"
                                                        class="btn btn-warning">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button type="button" onclick="confirmDestroy({{$sheek->id}}, this)" class="btn btn-danger">
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
            axios.delete('/check-system/sheeks/' + id)
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
    @livewireScripts
@endsection
