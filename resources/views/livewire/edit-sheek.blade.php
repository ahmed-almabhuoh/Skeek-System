<div class="row">
    <!-- left column -->
    <div class="col-md-5">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">{{ __('Edit sheek') }}</h3>
            </div>
            <!-- /.card-header -->

            <!-- form start -->
            <form>
                <div class="card-body">
                    <div class="form-group">
                        <label for="beneficiary_name">{{ __('Beneficiary name') }}</label>
                        <input type="text" class="form-control" id="beneficiary_name"
                            placeholder="Enter Beneficiary Name" wire:model="beneficiary_name"
                            value="{{ $beneficiary_name }}">
                    </div>

                    <div class="form-group">
                        <label for="amount">{{ __('Amount') }}</label>
                        <input type="number" class="form-control" id="amount" placeholder="Enter amount number"
                            wire:model="amount" value="{{ $amount }}">
                    </div>

                    <div class="form-group">
                        <label>{{__('Currancy')}}</label>
                        <select class="form-control" id="currancy" wire:model="currancy">
                            <option value="Dinar">{{ __('Dinar') }}
                            </option>
                            <option value="Dollar">{{ __('Dollar') }}
                            </option>
                            <option value="Shakel">{{ __('Shakel') }}
                            </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>{{__('Country')}}</label>
                        <select class="form-control" id="country_id" wire:model="selected_country_id">
                            @foreach ($countries as $drop_country)
                                <option value="{{ $drop_country->id }}"
                                    @if ($drop_country->id == $country->id) selected @endif>{{ $drop_country->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="date">{{ __('Date') }}</label>
                        <input type="text" class="form-control" id="date" placeholder="Enter sheek date"
                            wire:model="date" value="{{ $date }}">
                    </div>

                    <div class="form-group">
                        <label>{{ __('Bank') }}</label>
                        <select class="form-control" id="bank_id" wire:model="selected_bank_id">
                            @foreach ($banks as $drop_bank)
                                <option value="{{ $drop_bank->id }}">{{ $drop_bank->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>{{__('Underline')}}</label>
                        <select class="form-control" id="underline_type" wire:model="line_type">
                            <option value="1" @if ($this->sheek->underline_type == 1) selected @endif>//</option>
                            <option value="2" @if ($this->sheek->underline_type == 2) selected @endif>يصرف للمستفيد الأول
                            </option>
                            <option value="3" @if ($this->sheek->underline_type == 3) selected @endif>غير قابل للتداول
                            </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="desc">{{ __('Description') }}</label>
                        <input type="text" class="form-control" id="desc" placeholder="Enter description"
                            wire:model="desc" value="{{ $desc }}">
                    </div>

                    <label>{{ __('Type') }}</label>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="paid"
                                @if ($sheek->type == 'paid') checked @endif>
                            <label class="form-check-label">{{ __('cms.paid') }}</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="recived" name="status"
                                @if ($sheek->type == 'recived') checked @endif>
                            <label class="form-check-label">{{ __('cms.recived') }}</label>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="button" onclick="update({{ $sheek->id }})"
                        class="btn btn-primary">{{__('Update')}}</button>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
    <!--/.col (left) -->
    <div class="col-md-7">
        <!-- Form Element sizes -->
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">{{ __('Your sheek') }}</h3>
            </div>
            <div class="card-body sheek-background">
                <img src="{{ Storage::url($image_name) }}" alt="Sheek Image" class="inspire">
                <span class="name">{{ $beneficiary_name }}</span> <br>
                <span class="amount-in-letter">{{ $amount_in_word }}</span> <br>
                <span class="amount-in-numbers">{{ '#' . $amount . '#' }}</span> <br>
                <span class="date">{{ $date }}</span>
                {{-- Name: {{ $beneficiary_name }}<br>
                Amount: {{ $amount }}<br>
                Currancy: {{ $currancy }}<br>
                Selected Country: {{ $selected_country_id }} <br>
                Underline: {{ $line_type }} <br>
                Description: {{ $desc }} <br> --}}
                {{-- Bank Object: {{ $bank }}<br>
                Country : {{ $country }}<br>
                Banks : {{ $banks }}<br>
                Countries: {{ $countries }} <br> --}}
                {{-- Currancy: {{ $currancy }}<br> --}}
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
