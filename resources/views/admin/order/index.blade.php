@extends('layouts.admin')

@section('title')
	Orders
@endsection

@section('content')

    <div class="container-fluid mt-5">

        <div class="card mb-4 shadow-sm bg-gray-100 border-left-primary">
            <div class="card-body d-sm-flex align-items-center justify-content-between">
                <h6>
                    <a href="{{ url('/dashboard') }}">Dashboard</a> 
                    <span><i class="fas fa-angle-right mx-1"></i></span> 
                    <span>Orders</span>
                </h6>
            </div>
        </div>

        <div class='row'>
            <div class='col-md-12'>
               <div class='card'>
                    <div class='card-body'>
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <table class='table table-striped table-bordered' id='datatable'>

                            <thead>
                                <th>ID</th>
                                <th>Tracking No</th>
                                <th>C-Name</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Action</th>
                                <th>Proceed</th>
                            </thead>

                            <tbody>
                                @foreach ($orders as $item)

                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->tracking_no }}</td>
                                    <td>{{ $item->user->name.' '.$item->user->Iname }}</td>
                                    <td>{{ $item->user->phone }}</td>
                                    <td>
                                        @if ($item->order_status == '0')
                                            <span class="px-2 py-2 badge badge-pill badge-warning">Order Pending</span>
                                        @elseif($item->order_status == '1')
                                            <span class="px-2 py-2 badge badge-pill badge-success">Order Completed</span>
                                        @elseif($item->order_status == '2')
                                            <span class="px-2 py-2 badge badge-pill badge-danger">Order Cancelled :</span>
                                            {{ $item->cancel_reason }}
                                        @endif
                                   </td>
                                    <td>
                                        <a href="{{ url('order-view/'.$item->id) }}" class="btn btn-sm btn-primary">View</a>
                                    </td>
                                    <td>
                                        <a href="{{ url('order-proceed/'.$item->id) }}" class="btn btn-sm btn-success">Proceed</a>
                                    </td>
                                </tr>
                                
                                @endforeach
                            </tbody>
                        </table>
                    </div>
               </div>
            </div>
        </div>

    </div>

@endsection
