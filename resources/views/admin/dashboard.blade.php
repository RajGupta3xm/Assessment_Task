@extends('layouts.admin')

@section('title', 'Admin Dashboard')
@section('page-title', 'Admin Dashboard')

@section('content')
<div class="card">
    <div class="card-body">
        <h5>Welcome, {{ auth('admin')->user()->name }}</h5>
        <p class="text-muted mb-0">Live customer presence</p>
    </div>

    <div class="card-body">
        <table class="table table-bordered" id="customerTable">
            <thead class="table-light">
                <tr>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Last Seen</th>
                </tr>
            </thead>
            <tbody>
                @foreach($customers as $customer)
                    <tr id="customer-{{ $customer->id }}">
                        <td>{{ $customer->name }}</td>

                        <td class="status">
                            @if($customer->is_online)
                                <span class="text-success">🟢 Online</span>
                            @else
                                <span class="text-danger">🔴 Offline</span>
                            @endif
                        </td>

                        <td class="last_seen">
                            {{ $customer->last_seen_at ?? '—' }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection



@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    console.log("ADMIN DASHBOARD JS LOADED");

    Echo.channel('test-channel')
        //  LOGIN EVENT
        .listen('.user.online', function(e){
            console.log("🟢 ONLINE EVENT:", e);

            let row = document.getElementById('customer-'+e.id);
            if(row){
                row.querySelector('.status').innerHTML =
                    '<span class="text-success">🟢 Online</span>';

                row.querySelector('.last_seen').innerText = 'Just now';
            }
        })

        //  LOGOUT EVENT
        .listen('.user.offline', function(e){
            console.log("🔴 OFFLINE EVENT:", e);

            let row = document.getElementById('customer-'+e.id);
            if(row){
                row.querySelector('.status').innerHTML =
                    '<span class="text-danger">🔴 Offline</span>';

                row.querySelector('.last_seen').innerText =
                    new Date().toLocaleString();
            }
        });

});
</script>
@endpush




