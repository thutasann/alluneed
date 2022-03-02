<div class="modal fade"  id="sendcouponmodal" tabindex="-1" aria-labelledby="couponmodal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark font-weight-bold" id="exampleModalLabel">Send Coupon</h5>
                <span class="font-weight-bold" style="cursor: pointer; font-size: 1.2rem;" data-dismiss="modal" aria-label="Close">&times;</span>
            </div>

            <form action="{{ url('v/coupon-send/'.$coupon->id) }}" method="POST">
                {{ csrf_field() }}

                <input type="hidden" name="vendor_name" value="{{ $vendor->vendor_name }}" />
                <input type="hidden" name="vendor_email" value="{{ Auth::user()->email }}" />

                <div class="modal-body">
                    <div class="row">

                        {{-- offer_name --}}
                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label>Offer Name</label>
                                <input type="text" name="offer_name" value="{{ $coupon->offer_name }}" class='form-control bg-white' placeholder='Enter Offer Name' readonly>
                            </div>
                        </div>

                        {{-- coupon_code --}}
                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label>Coupon Code</label>
                                <input type="text" name="coupon_code" value="{{ $coupon->coupon_code }}" class="form-control bg-white" placeholder="Enter Coupon Code" readonly>
                            </div>
                        </div>

                        {{-- start_datetime --}}
                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label>Start Date</label>
                                <input type="date-local" name="start_datetime" value="{{ date('Y-m-d' , strtotime($coupon->start_datetime )) }}" class="form-control bg-white" readonly>
                            </div>
                        </div>

                        {{-- end_datetime --}}
                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label>End Date</label>
                                <input type="date-local" name="end_datetime" value="{{ date('Y-m-d' , strtotime($coupon->end_datetime )) }}" class="form-control bg-white" readonly>
                            </div>
                        </div>

                        {{-- user_email --}}
                        <div class="col-md-12 mb-2">
                            <label>Customers</label>
                            <div class="form-group">
                                <select name="user_email" class="form-control select2-products" style="width: 100%;">
                                    <option value="0">Select Customer you want to send to</option>
                                    @foreach ($users as $i)
                                        <option value="{{ $i->email }}">
                                            {{ $i->name }} [ {{ $i->email }} ]
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Send Coupon</button>
                    <button type="reset" class="btn btn-secondary">Cancel</button>
                </div>

            </form>

        </div>
    </div>
</div>
