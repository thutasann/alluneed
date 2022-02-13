<!-- Update password -->
<div class="modal fade" id="updatepsw" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-secondary">
                <h4 class="modal-title mt-2 w-100 text-center font-weight-bold">Update Password</h4>
                <button type="button" class="close font-weight-bold" data-dismiss="modal" aria-label="Close" style="outline:none;"><i class="fas fa-times"></i></button>
            </div>
            <form action="{{ url('password-update/'.Auth::user()->id) }}" method="POST">
                {{ csrf_field() }}
                <div class="modal-body mx-3">
                    <div class="md-form mb-4 input-with-pre-icon form-group">
                        <i class="fas fa-envelope input-prefix"></i>
                        <input type="email" class="form-control bg-white" value="{{ Auth::user()->email}} " readonly>
                        <label>Your email</label>
                    </div>
                    <div class="md-form mb-4 input-with-pre-icon form-group">
                        <i class="fas fa-lock input-prefix"></i>
                        <input type="password" class="form-control validate" name='newpsw' required>
                        <label>New Password</label>
                    </div>
                    <div class="md-form mb-4 mt-2 float-right">
                        <button class="btn btn-primary" type="submit" style="outline:none;">Update Password</button>
                        <button class="btn btn-secondary" type="reset" data-dismiss="modal" style="outline:none;">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
