<!-- Request Vendor -->
<div class="modal fade" id="reqvendor" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content" >

            <div class="modal-header bg-secondary">

                <h4 class="modal-title mt-2 w-100 text-center font-weight-bold">Vendor Request Form</h4>
                <button type="button" class="close font-weight-bold" data-dismiss="modal" aria-label="Close" style="outline:none;">
                    <i class="fas fa-times"></i>
                </button>

            </div>

            <form action="{{ url('req_vendor/'.Auth::user()->id) }}" method="POST" id="reqv_form">

                {{ csrf_field() }}

                <div class="modal-body mx-3">

                    <!-- Req infos -->
                    <div class="row">

                        <div class="col-md-6">
                            <div class="md-form input-with-pre-icon form-group">
                                <i class="fas fa-envelope input-prefix"></i>
                                <input type="email" name="email" class="form-control bg-white" value="{{ Auth::user()->email}} " readonly>
                                <label>Your email</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="md-form input-with-pre-icon form-group">
                                <i class="fas fa-user input-prefix"></i>
                                <input type="text" name="name" class="form-control bg-white" value="{{ Auth::user()->name}} " readonly>
                                <label>Your Name</label>
                            </div>
                        </div>

                        {{-- vendor_name --}}
                        <div class="col-md-12">
                            <div class="md-form input-with-pre-icon form-group">
                                <i class="fas fa-user-tie input-prefix"></i>
                                <input type="text" name="vendor_name" class="form-control validate bg-white" spellcheck="false" required>
                                <label>Vendor Display Name</label>
                            </div>
                        </div>

                        {{-- description --}}
                        <div class="col-md-12">
                            <div class="md-form input-with-pre-icon form-group">
                                <i class="fas fa-pencil-alt input-prefix"></i>
                                <textarea class="md-textarea form-control" name="description" rows="3" spellcheck="false"></textarea>
                                <label>Description (Optional)</label>
                            </div>
                        </div>

                    </div>

                    <!-- Instruction -->
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <p class="text-left font-weight-bolder alert alert-info">Pay Online <b>$20</b> for updating to Vendor Account.</p>
                        </div>
                    </div>

                    <!-- Razor Payment -->
                    <div class="mb-form mb-3">
                        <button type="button" class="razorpay_pay_btn btn py-2 px-2 mb-4 btn blue-gradient rounded" hover-tooltip="RazorPay Payment"  tooltip-position="bottom" style="outline:none;">
                            <img width='80px'  src="{{ asset('assets/img/razor.png')}}">
                        </button>
                    </div>

                </div>

            </form>

        </div>
    </div>
</div>

