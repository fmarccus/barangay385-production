@extends('layouts.server_test')
@section('title', 'Pregnant women')
@section('content')

<section class="mt-3 mb-5">
    @if(session()->has('created'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'User created successfully',
        })
    </script>
    @elseif(session()->has('deleted'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'User deleted',
        })
    </script>
    @elseif(session()->has('failed'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Invalid password',
        })
    </script>
    @endif
    <div class="d-flex bd-highlight mb-3">
        <div class="me-auto p-2 bd-highlight">
            <h4 class="card-title">
                ({{ $pregnants->count() }}) Pregnant women
            </h4>
        </div>
        <div class="p-2 bd-highlight">

        </div>
        <div class="p-2">
            <div id="outside"></div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table shadow-sm bg-white caption-top admin-card-text rounded-3" style="width:100%" id="pregnantTable">
            <caption> <a class="btn btn-light btn-sm" href="{{route('dashboard')}}"> <i class="fa-solid fa-chart-line"></i> Dashboard</a></li>
                <a href="{{route('residents.index')}}" class="text-secondary float-end"> <i class="fa-solid fa-table-cells"></i> Show Resident Masterlist</a>
            </caption>
            <thead class="bg-modern text-white">
                <tr>
                    <th></th>
                    <th>Address</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Age group</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="align-middle">
                @foreach($pregnants as $pregnant)
                <tr>
                    <td>
                        @if($pregnant->sex=="Male")
                        <img src="https://thumbs.dreamstime.com/b/person-gray-photo-placeholder-man-t-shirt-white-background-147541161.jpg" class="rounded-start" alt="..." height=40>
                        @else
                        <img src="https://st4.depositphotos.com/9998432/27431/v/600/depositphotos_274313380-stock-illustration-person-gray-photo-placeholder-woman.jpg" class="rounded-start" alt="..." height=40>
                        @endif
                    </td>
                    <td> {{$pregnant->household_id}} {{App\Http\Controllers\StreetController::street_name($pregnant->household->street_id)}} St. </td>
                    <td> {{$pregnant->surname}}, {{$pregnant->given_name}}</td>
                    <td data-order="{{$pregnant->age}}">
                        {{$pregnant->age}}
                    </td>
                    <td>
                        @if($pregnant->age < 1) <span class="ms-2 badge rounded-pill fw-normal" style="background-color:#08306b">Infant</span>
                            @elseif($pregnant->age >= 1 && $pregnant->age <= 17) <span class="ms-2 badge rounded-pill fw-normal" style="background-color:#08519c">Child</span>
                                @elseif($pregnant->age >= 18 && $pregnant->age <= 59) <span class="badge rounded-pill fw-normal" style="background-color:#2171b5">Adult</span>
                                    @elseif($pregnant->age >= 60)
                                    <span class="badge rounded-pill fw-normal" style="background-color:#4292c6">Senior</span>
                                    @endif
                    </td>
                    <td><a class="btn btn-sm btn-light" href="{{route('residents.view',$pregnant->id)}}">View</a></td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
@endsection