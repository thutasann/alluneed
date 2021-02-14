<!-- sidebar -->
<div class="col-lg-3">
    <div class="sidebar">
        <div class="widget">
            <input type="search" id="woocommerce-product-search-field" class="search-field" placeholder="Search" value="" name="s" title="Search for:">
        </div>
        <div class="widget mt-3">
            <h3 class="widget-title">Collections</h3>
            <ul>
                @php
                    $group = App\Models\Groups::where('status','!=','2')->get();
                @endphp
                
                @foreach ($group as $group_nav_item)
					<li>
						<a href="{{url('collection/'.$group_nav_item->url)}}" class='waves-effect'>{{$group_nav_item->name}}</a>
					</li>
				@endforeach
            </ul>
        </div>
        <div class="widget mt-3 widget-tag-cloud">
            <h3 class="widget-title">Product Tags</h3>
            <div class="tagcloud">
                <a href="#">Art</a>
                <a href="#">Design</a>
                <a href="#">Music</a>
                <a href="#">Photography</a>
            </div>
        </div>
    </div>
</div>