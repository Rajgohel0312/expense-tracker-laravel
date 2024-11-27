@extends ('layouts.app')
@section('content')

<div class="col-md-12 col-sm-12">

    <div class="addExpenses p-3 border rounded bg-light">
        @if (session('success'))
            <div class="alert mt-4 alert-success">{{ session('success') }} </div>
        @endif
        <h5 class="mb-3">Add Income</h5>
        <form action="/expenses/createIncome" method="POST">
            @csrf
            @method('POST')

            <div class="form-group mb-3">
                <label for="amount">Enter Income Amount</label>
                <input value="@old('amount')" type="number" id="amount" name="amount" class="form-control"
                    placeholder="Enter amount">
            </div>
            <button type="submit" class="btn btn-primary w-100">Add Income</button>
        </form>
    </div>
</div>

@endsection