<div class="modal fade"  id="couponmodal" tabindex="-1" aria-labelledby="couponmodal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark font-weight-bold" id="exampleModalLabel">Add Coupon</h5>
                <span class="font-weight-bold" style="cursor: pointer; font-size: 1.2rem;" data-dismiss="modal" aria-label="Close">&times;</span>
            </div>
            <form action="{{ url('vendor/coupon-store') }}" method="POST">
                {{ csrf_field() }}

                <div class="modal-body">

                    <div class="d-flex justify-content-between mb-4">
                        <div>
                            Date : <b class="text-primary">{{ Carbon\Carbon::now()->format('m/d/Y') }}</b>
                        </div>
                        <div>
                            Uploaded By :
                            @php
                                $user_id = Auth::user()->id;
                                $vendor = App\Models\Models\Request_vendor::where('user_id',$user_id)->get(); // For displaying vendor name
                            @endphp
                            <b class="text-primary">
                                @foreach($vendor as $v)
                                    {{ $v->vendor_name }}
                                @endforeach
                            </b>
                        </div>
                    </div>

                    <div class="row">

                        {{-- offer_name /  vendor_id --}}
                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label>Offer Name</label>
                                <input type="text" name="offer_name" class='form-control' placeholder='Enter Offer Name' required>
                                <input type="hidden" name="vendor_id" value="{{ Auth::user()->id }}" />
                            </div>
                        </div>

                        {{-- product_id --}}
                        <div class="col-md-6 mb-2">
                            <label>Products (Optional)</label>
                            <div class="form-group">
                                <select name="product_id" class="form-control select2-products" style="width: 100%;">
                                    <option value="">Select</option>
                                    @foreach ($product as $prod_item)
                                        <option value="{{ $prod_item->id }}">{{ $prod_item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- coupon_code --}}
                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label>Coupon Code</label>
                                <input type="text" name="coupon_code" class="form-control" placeholder="Enter Coupon Code" required>
                            </div>
                        </div>

                        {{-- coupon_limit --}}
                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label>Coupon Limit</label>
                                <input type="number" name="coupon_limit" class="form-control" placeholder="Enter Coupon Limit" required>
                            </div>
                        </div>

                        {{-- coupon_type --}}
                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label>Coupon Type</label>
                                <select name="coupon_type" class="form-control" required>
                                    <option value="">Select your Coupon Type</option>
                                    <option value="1">Percentage</option>
                                    <option value="2">Amount</option>
                                </select>
                            </div>
                        </div>

                        {{-- coupon_price --}}
                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label>Coupon Price</label>
                                <input type="text" name="coupon_price" class="form-control" placeholder="Enter Coupon Price" required>
                            </div>
                        </div>

                        {{-- start_datetime --}}
                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label>Start Date Time</label>
                                <input type="datetime-local" name="start_datetime" class="form-control" required>
                            </div>
                        </div>

                        {{-- end_datetime --}}
                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label>End Date Time</label>
                                <input type="datetime-local" name="end_datetime" class="form-control" required>
                            </div>
                        </div>

                        {{-- status --}}
                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label>Status</label>
                                <input type="checkbox" name="status"><br>
                                <small class='text-dark'><i>( If you check this checkbox, this coupon will be blocked. )</i></small>
                            </div>
                        </div>

                        {{-- visibility_status --}}
                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label>Visibility Status</label>
                                <input type="checkbox" name="visibility_status"><br>
                                <small class='text-dark'><i>( If you check this checkbox, this coupon will be hidden. )</i></small>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Coupon</button>
                </div>

            </form>
        </div>
    </div>
</div>

<style>
    .select2-container--default .select2-selection--single{
        display: block;
        width: 100%;
        height: calc(1.5em + .75rem + 2px);
        padding: .375rem .75rem;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #6e707e;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #d1d3e2;
        border-radius: .35rem;
        transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #6e707e;
        line-height: 28px;
    }
    .select2-container--default .select2-search--dropdown .select2-search__field{
        outline:none;
        border-radius: 4px;
        border: 1px solid #9c9b9b;
    }
</style>
