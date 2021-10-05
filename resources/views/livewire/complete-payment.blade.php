@section('title','Complete Payment')
<div class='container-fluid' onbeforeunload="refreshAndClose();">
    <div class='row'>
        <div class='col-lg-12'>
            <div class="card">
                <div class="card-body">
                    <p class="card-text">
                        @if(!$paymentDone)
                        <div class="form-group">
                            <label for="title">Property Name</label>
                            <input type="text" class="form-control" id="property" placeholder="Property Name" value='{{ $property->title }}' required disabled>
                            @error('property')
                                <span class='text-danger'>{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="pname">Card Holder Name</label>
                            <input type="text" class="form-control" id="pname" placeholder="Card Holder Name" wire:model.defer='pname' required>
                            @error('pname')
                                <span class='text-danger'>{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="inlineFormInputGroupAmount">Amount</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                  <div class="input-group-text">AUD</div>
                                </div>
                                <input type="text" class="form-control" id="inlineFormInputGroupAmount" placeholder="Property Price" wire:model.defer='amount' required disabled>
                            </div>
                            @error('amount')
                                <span class='text-danger'>{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="cardNumber">Card number</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-credit-card"></i></span>
                                </div>
                                <input type="text" class="form-control" id="inlineFormInputGroupCard" placeholder="Card Number" wire:model.defer='card_number' maxlength='16' required>
                            </div>
                            @error('card_number')
                            <span class='text-danger'>{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-row">
                            <div class="col-3">
                                <label for="mm">MM</label>
                                <input type="text" class="form-control" id="mm" placeholder="MM" wire:model.defer='mm' maxlength='2' required>
                            </div>
                            <div class="col-3">
                                <label for="yy">YY</label>
                                <input type="text" class="form-control" id="yy" placeholder="YY" wire:model.defer='yy' maxlength='2' required>
                            </div>
                            <div class="col-3">
                                <label for="cvc">CVC</label>
                                <input type="text" class="form-control" id="cvc" placeholder="CVC" wire:model.defer='cvc' maxlength='3' required>
                            </div>
                            <div class="col-3">
                                <label for="zip">ZIP Code</label>
                                <input type="text" class="form-control" id="zip" placeholder="ZIP Code" wire:model.defer='zip' maxlength='5' required>
                            </div>
                            <div class='mb-3 col-12'>
                            @error('credit')
                            <span class='text-danger'>{{ $message }}</span>
                            @enderror
                            </div>
                        </div>
                        <div class='form-group'>
                            <div class='row'>
                                <div class='col-12'>
                                    <button class='btn btn-success col-12' wire:click='proceedPayment'>Pay</button>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class='my-5 text-center'>
                            <i class="fas fa-check-circle text-success fa-6x"></i>
                            <div class='pt-4 pb-2 h3'>
                                Payment Completed!
                            </div>
                            <input type="button" class='btn btn-success' value="Close this window" onclick="refreshAndClose();">
                        </div>
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
    <script>
        function refreshAndClose() {
            window.opener.location.reload(true);
            window.close();
        }
    </script>
</div>