<div class="row">
    <!-- left column -->
    <div class="col-md-6">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">{{ __('cms.add_skeed') }}</h3>
            </div>
            <!-- /.card-header -->
            <div style="margin: 15px;">
                @if ($errors->any())
                    @foreach ($errors->all as $error)
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert"
                                aria-hidden="true">×</button>
                            <h5><i class="icon fas fa-ban"></i> Fail!</h5>
                            {{ $error }}
                        </div>
                    @endforeach
                @endif
            </div>
            <!-- form start -->
            <form id="create-form">
                <div class="card-body">
                    <div class="form-group">
                        <label for="beneficiary_name">{{ __('cms.beneficiary_name') }}</label>
                        <input type="text" class="form-control" id="beneficiary_name"
                            wire:model="beneficiary_name" placeholder="Enter Beneficiary Name"
                            value="{{ old('beneficiary_name') }}">
                    </div>
                    <div class="form-group">
                        <label for="amount">{{ __('cms.amount') }}</label>
                        <input type="number" class="form-control" id="amount" placeholder="Enter amount number"
                            wire:model="amount" value="{{ old('amount') }}">
                    </div>
                    <div class="form-group">
                        <label>Currancy</label>
                        <select class="form-control" id="currancy" wire:model="currany">
                            <option @if (old('currancy') == 'Dinar') selected @endif>{{ __('cms.dinar') }}
                            </option>
                            <option @if (old('currancy') == 'Dollar') selected @endif>{{ __('cms.dollar') }}
                            </option>
                            <option @if (old('currancy') == 'shakel') selected @endif>{{ __('cms.shakel') }}
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>{{ __('cms.bank') }}</label>
                        <select class="form-control" id="bank_name" wire:model="bank">
                            <option>{{ __('cms.palestine') }}</option>
                            <option>{{ __('cms.al_qudes') }}</option>
                            <option>{{ __('cms.al_islamy_al_araby') }}</option>
                            <option>{{ __('cms.al_islamy_al_araby') }}</option>
                            <option>{{ __('cms.al_aurdon') }}</option>
                            <option>{{ __('cms.al_intaj') }}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="desc">{{ __('cms.desc') }}</label>
                        <input type="text" class="form-control" id="desc" placeholder="Enter description"
                            value="{{ old('desc') }}">
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
            </form>
        </div>
        <!-- /.card -->
    </div>
    <!--/.col (left) -->
    <div class="col-md-6">
        <!-- Form Element sizes -->
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">{{ __('cms.your_sheek') }}</h3>
            </div>
            <div class="card-body">
                <h3>Sheek</h3>
                Beneficiary Name: {{ $beneficiary_name }} <br>
                Amount: {{ $amount }} <br>
                Currancy: {{ $currany }} <br>
                Bank: {{ $bank }} <br>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>


