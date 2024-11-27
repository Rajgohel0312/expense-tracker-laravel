@extends ('layouts.app')
@section('content')

<div class="col-md-12 col-sm-12">

    <div class="addExpenses p-3 border rounded bg-light">
        @if (session('success'))
            <div class="alert mt-4 alert-success">{{ session('success') }} </div>
        @endif
        <h5 class="mb-3">Add Expense</h5>
        <form action="/expenses/create" method="POST">
            @csrf
            @method('POST')
            <div class="form-group mb-3">
                <label for="category">Category</label>
                <select id="category" name="category" class="form-control">
                    <option value="">Select Category</option>
                    <option value="1">Food</option>
                    <option value="2">Travel</option>
                    <option value="3">Shopping</option>
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="amount">Amount</label>
                <input value="@old('amount')" type="number" id="amount" name="amount" class="form-control"
                    placeholder="Enter amount">
            </div>
            <div class="form-group mb-3">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="3" class="form-control"
                    placeholder="Enter description">{{@old('description')}}</textarea>
            </div>
            <div class="form-group mb-3">
                <label for="date">Date</label>
                <input type="date" id="date" name="date" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary w-100">Add Expense</button>
        </form>
    </div>
</div>

@endsection