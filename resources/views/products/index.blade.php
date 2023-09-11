@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Patient Details</h2>
            </div>
            <div class="pull-right">
                @can('patient-create')
                <a class="btn btn-success" href="{{ route('products.create') }}">+Add Patient</a>
                @endcan
            </div>
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Patient Name</th>
            <th>Disease Details</th>
            <th>Pay Amount</th>
            <th width="280px">Action</th>
        </tr>
	    @foreach ($products as $product)
	    <tr>
	        <td>{{ ++$i }}</td>
	        <td>{{ $product->name }}</td>
	        <td>{{ $product->detail }}</td>
	        <td>{{ $product->amount }}</td>
	        <td>
                {{-- <form action="{{url('payments')}}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{$product->id}}">
                    <button type="submit" class="btn btn-secondary">PAY</button>
                </form> --}}
                <form action="/generatepayment" method="POST" >
                    @csrf
                    <script src="https://checkout.razorpay.com/v1/checkout.js"
                       data-key="rzp_test_BHbtdhRAvN4syq"
                       data-amount={{($product->amount)*100}}{{-- it is takking amount last two digin in paise so we have to add 2 extra zeros after the ammount --}}
                       data-currency="INR"
                       data-buttontext="Pay {{$product->amount}} INR"
                       data-name="Programming Solutions"
                       data-description="Rozerpay"
                       data-image="https://cybercollege.info/wp-content/uploads/2021/06/cropped-logo.png"
                       data-prefill.name="name"
                       data-prefill.email="email"
                       data-theme.color="#CD5C5C"
                      ></script>
                 </form>
                <form action="{{ route('products.destroy',$product->id) }}" method="POST">
                    {{-- <a class="btn btn-info" href="{{ route('products.show',$product->id) }}">Show</a> --}}
                    @can('patient-edit')
                    <a class="btn btn-primary" href="{{ route('products.edit',$product->id) }}">Edit</a>
                   
                    @endcan

                    @csrf
                    @method('DELETE')
                    @can('patient-delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                    @endcan
                </form>
               
	        </td>
	    </tr>
	    @endforeach
    </table>


    {!! $products->links() !!}


@endsection