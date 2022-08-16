<div class="row">
    <!-- left column -->
    <div class="col-md-5 inspire">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header inspire">
                <h3 class="card-title">{{ __('cms.add_skeed') }}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form id="create-form">
                <div class="card-body">
                    <div class="form-group">
                        <label for="beneficiary_name">{{ __('cms.beneficiary_name') }}</label>
                        <input type="text" class="form-control" id="beneficiary_name" wire:model="beneficiary_name"
                            placeholder="Enter Beneficiary Name">
                    </div>
                    <div class="form-group">
                        <label for="amount">{{ __('cms.amount') }}</label>
                        <input type="number" class="form-control" id="amount" placeholder="Enter amount number"
                            wire:model="amount">
                    </div>

                    <div class="form-group">
                        <label>Country</label>
                        <select class="form-control" wire:model="country_id" id="country_id">
                            <option value="0" selected>*</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>{{ __('cms.bank') }}</label>
                        <select class="form-control" id="bank_id" wire:model="bank">
                            <option value="0" selected>*</option>
                            @foreach ($banks as $selected_bank)
                                <option value="{{ $selected_bank->id }}">{{ $selected_bank->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="date">{{ __('cms.date') }}</label>
                        <input type="text" class="form-control" id="date"
                            placeholder="It's prefer to write it like this: 05-Jan-1971" wire:model="date">
                    </div>

                    <div class="form-group">
                        <label>Underline</label>
                        <select class="form-control" id="underline_type" wire:model="line_type">
                            <option value="1">//</option>
                            <option value="2">يصرف للمستفيد الأول</option>
                            <option value="3">غير قابل للتداول</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="desc">{{ __('cms.desc') }}</label>
                        <input type="text" class="form-control" id="desc" placeholder="Enter description"
                            wire:model="desc">
                    </div>
                    <label>{{ __('cms.type') }}</label>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="paid" checked="">
                            <label class="form-check-label">{{ __('cms.paid') }}</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="recived" name="status">
                            <label class="form-check-label">{{ __('cms.recived') }}</label>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="button" onclick="store()" class="btn btn-primary">Submit</button>
                </div>
                <button onclick="window.print()">Print</button>
                {{-- <button onclick="window.print()">Print</button> --}}
            </form>
        </div>
        <!-- /.card -->
    </div>
    <!--/.col (left) -->
    <div class="col-md-7 col-print-12 style-printed-parent ">
        <!-- Form Element sizes -->
        <div class="card style-printed card-success">
            <div class="card-header inspire">
                <h3 class="card-title">{{ __('cms.your_sheek') }}</h3>
            </div>
            <div class="card-body sheek-background ">
                @if ($country_id != 0)
                    @if (is_null($message))
                        <img src="{{ Storage::url($image_name) }}" alt="Sheek Image" class="inspire">
                        <div>
                            <span class="name">{{ $beneficiary_name }}</span> <br>
                            <span class="amount-in-letter">{{ $amount_in_words }}</span> <br>
                            <span class="amount-in-numbers">{{ '#' . $amount . '#' }}</span> <br>
                            <span class="date">{{ $date }}</span>
                        </div>
                    @else
                        {{ $message }}, <a href="{{ route('banks.create') }}">Go to add bank.</a>
                    @endif
                @else
                    {{ $message }}, <a href="{{ route('countries.create') }}">Go to add country.</a>
                @endif
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
