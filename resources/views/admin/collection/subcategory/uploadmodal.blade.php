    <!-- Modal -->
    <div class='pop-up'>
        <div class="subcontent">
            <div class="subcontainer">
                <span class='close'>&times;</span>
                <h2 class="text-center">Add Subcategory (Brand)</h2>

                <div class="subscribenew">

                    <form action="{{ url('sub-category-store') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class='row'>

                            <div class='col-md-6'>
                                <div class="form-group">
                                    <label>Category</label>
                                    <select name="category_id" class="form-control" required>
                                        <option value="">Select Category</option>
                                        @foreach($category as $cateitem)
                                            <option value="{{ $cateitem->id }}">{{ $cateitem->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class='col-md-6'>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" id="name" name="name" class='form-control' placeholder='Enter Name' required>
                                </div>
                            </div>

                            <div class='col-md-6'>
                                <div class="form-group">
                                    <label>Custom URL</label>
                                    <input type="text" id="url" name="url" class='form-control bg-white' placeholder='Enter URL' readonly>
                                </div>
                            </div>

                            <div class='col-md-6'>
                                <div class="form-group">
                                    <label>Priority</label>
                                    <input type="number" name="priority" class='form-control' placeholder='Enter Priority' required>
                                </div>
                            </div>

                            <div class="col-md-12 mb-2">
                                <div class='form-check form-check-inline form-group pt-2'>
                                    <label class="form-check-label">Status</label> &nbsp;
                                    <input class="form-check-input" name="status" type="checkbox">
                                    <small class='text-dark ml-2'><i>( If you check this checkbox, this will be hidden on our website )</i></small>
                                </div>
                            </div>

                            <div class='col-md-12'>
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control" name="description" rows="4" placeholder='Enter Description' required></textarea>
                                </div>
                            </div>
                            
                        </div>

                        <div class="row mx-1 mt-2">

                            <div class='col-md-12 pro-change'>

                                <div class="preview"> 
                                    <img id='img-preview'>
                                </div>

                                <button id="triggerUpload" class="btn-choose-img" type='button' title="Choose Image">
                                    Choose Image   
                                </button>

                                <input type="file" id="filePicker" name="image" class='prochange-input'>
                                <div class="fileName"></div>

                            </div>

                        </div>

                        <div class="row my-4">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Add Subcategory (Brand)</button>
                                    <button type="reset" class="btn btn-secondary">Cancel</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>