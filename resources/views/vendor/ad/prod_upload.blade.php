<div class="modal fade"  id="addprod" tabindex="-1" aria-labelledby="couponmodal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark font-weight-bold" id="exampleModalLabel">Upload Product</h5>
                <span class="font-weight-bold" style="cursor: pointer; font-size: 1.2rem;" data-dismiss="modal" aria-label="Close">&times;</span>
            </div>
            <form action="{{ url('vendor/ad-prod-store/'.$slider->id) }}" method="POST">
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

                        {{-- product_id --}}
                        <div class="col-md-12 mb-2">
                            <label>Products</label>
                            <div class="form-group">
                                <select name="product_id" class="form-control select2-products" style="width: 100%;" required>
                                    <option value="">--- Select Product ---</option>
                                    @foreach ($products as $i)
                                        <option value="{{ $i->id }}">{{ $i->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>

                </div>


                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Upload Product</button>
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
