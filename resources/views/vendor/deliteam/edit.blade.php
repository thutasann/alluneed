@extends('layouts.vendor')

@section('title')
	Edit Shipping Team
@endsection

@section('content')
    <div class="container-fluid mt-5">

        <div class="card mb-4 shadow-sm bg-gray-100 border-left-primary">

            <div class="card-body d-sm-flex align-items-center justify-content-between">

                <h6>
                    <a href="{{ url('vendor/shipping-teams')}}">Shipping Teams</a>
                    <span><i class="fas fa-angle-right mx-1"></i></span>
                    <span>Edit shipping team</span>
                </h6>

            </div>

        </div>

        <div class='row'>
            <div class='col-md-12'>
                <div class='card shadow-sm mb-4'>
                        <div class='card-body'>

                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{session('status')}}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <form action="{{ url('v/team-update/'.$team->id) }}" method="POST">

                                {{ csrf_field() }}
                                {{ method_field('PUT') }}

                                <div class='row'>

                                    <div class='col-md-6'>
                                        <div class="form-group">
                                            <label>Team Name</label>
                                            <input type="text" id="name" name="name" class='form-control' value="{{ $team->name }}" placeholder='Enter Team Name' required>
                                        </div>
                                    </div>

                                    <div class='col-md-6'>
                                        <div class="form-group">
                                            <label>Branch</label>
                                            <select name="branch_id" class="form-control" required>
                                                <option value="{{ $team->id }}">{{ $team->branch->name }}</option>
                                                @foreach($branch as $i)
                                                    <option value="{{ $i->id }}">{{ $i->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class='col-md-6'>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" name="email" value={{ $team->email }} id="form-autocomplete-country" class='form-control' placeholder='Enter Email' required>
                                        </div>
                                    </div>

                                    <div class='col-md-6'>
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input type="number" value={{ $team->phone  }} name="phone" class='form-control' placeholder='Enter Phone Number' value="" required>
                                        </div>
                                    </div>

                                    <div class='col-md-12 my-2'>
                                        <div class="form-group relative">
                                            <label>Schedule (M/DD/YYYY HH:MM A - M/DD/YYYY HH:MM A)</label>
                                            <input type="text" name="schedule" value="{{ $team->schedule }}" class='form-control' required />
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Free or Unavailable</label>
                                            <select name="status" class="form-control">
                                                @if ($team->status == "0")
                                                    <option value="0">Free</option>
                                                @elseif ($team->status == "1")
                                                    <option value="1">Unavailable</option>
                                                @endif
                                                <option value="0">Free</option>
                                                <option value="1">Unavailable</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12 my-4">
                                        <div class='form-group'>
                                            <button type='submit' class='btn btn-primary'>Add Shipping team</button>
                                            <button type='reset' class='btn btn-secondary'>Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- date time range picker -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <script>
        $(function() {
            $('input[name="schedule"]').daterangepicker({
                timePicker: false,
                timePickerSeconds: false,
                // startDate: moment().startOf('hour'),
                // endDate: moment().startOf('hour').add(32, 'hour'),
                locale: {
                format: 'MM/DD/YYYY hh:mm A'
                },

            });
		});
    </script>
@endsection
