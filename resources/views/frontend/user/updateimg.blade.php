<!-- Update image -->
<div class="modal fade" id="updateimg" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header bg-secondary">
                <h4 class="modal-title mt-2 w-100 text-center font-weight-bold">Update Profile Image</h4>
                <button type="button" class="close font-weight-bold" data-dismiss="modal" aria-label="Close" style="outline:none;"><i class="fas fa-times"></i></button>
            </div>

            <form class="pl-lg-4 mt-3" method="POST" action="{{ url('propic-update/'.Auth::user()->id) }}" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="row pro-change">

                    <div class="col-md-12">

                        <div class="preview">
                            @if(Auth::user()->Image == NULL)
                            <img id='img-preview' src="{{ asset('assets/img/user.jpg')}}" alt="{{Auth::user()->name}}">
                            @else
                            <img id='img-preview' src="{{ asset('uploads/profile/'.Auth::user()->Image)}}" alt="{{Auth::user()->name}}">
                            @endif
                        </div>

                        <!-- Modal Image -->
                        <div id="myModal-img" class="modal-img">
                            <span class="close-img">&times;</span>
                            <img class="modal-content-img" id="img01">
                            <div id="caption-img"></div>
                        </div>

                        <button id="triggerUpload" class="btn blue-gradient btn-sm rounded btn-choose-img" type='button'  hover-tooltip="Choose Image" tooltip-position="bottom" style="outline:none;">
                            <i class="fas fa-camera-retro"></i>
                        </button>

                        <input type="file" id="filePicker" name="Image" class='prochange-input'>
                        <div class="fileName"></div>

                        <button type='submit' class='btn rounded bg-gradient-primary text-white btn-update-img' style="outline:none;">Update Profile Image</button>

                    </div>

                </div>

            </form>

        </div>
    </div>
</div>
