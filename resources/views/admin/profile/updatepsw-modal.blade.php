<!-- Modal -->
<div class='pop-up'>
    <div class="subcontent" style="height:auto; margin: 80px auto;">
        <div class="subcontainer">
            <span class='close'>&times;</span>
            <h2 class="text-center">Update Password ?</h2>

            <div class="subscribenew" >
                <form action="{{ url('password-update') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="container-fluid">
                        <div class="form-group">
                            <label>Email address</label>
                            <input type="email"  class="form-control bg-white" value="{{ Auth::user()->email}}" readonly spellcheck="false">
                        </div>

                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password" class="form-control" name='newpsw' required>
                        </div>

                        <div class="form-group mt-4">
                            <button class="btn btn-primary" type="submit">Update Password</button>
                            <button class="btn btn-secondary" type="reset">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
