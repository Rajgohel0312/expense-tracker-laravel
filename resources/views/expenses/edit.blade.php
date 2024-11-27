@extends ('layouts.app')
@section('content')

<div class="col-md-12 col-sm-12">

    <div class="addExpenses p-3 border rounded bg-light">
        @if (session('success'))
            <div class="alert mt-4 alert-success">{{ session('success') }} </div>
        @endif
        <h5 class="mb-3">Add Expense</h5>
        <form <form action="{{ route('expenses.update', $expenses->id) }}" method="POST">
            @csrf
            @method('PUT')

            <input type="hidden" name="id" value="{{ $expenses->id }}">
            <div class="form-group mb-3">
                <label for="category">Category</label>
                <select id="category" name="category" class="form-control">
                    <option value="">Select Category</option>
                    <option value="1" {{ old('category', $expenses->category_id) == 1 ? 'selected' : '' }}>Food</option>
                    <option value="2" {{ old('category', $expenses->category_id) == 2 ? 'selected' : '' }}>Travel</option>
                    <option value="3" {{ old('category', $expenses->category_id) == 3 ? 'selected' : '' }}>Shopping
                    </option>
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="amount">Amount</label>
                <input value="{{ old('amount', $expenses->amount) }}" type="number" id="amount" name="amount"
                    class="form-control" placeholder="Enter amount">

            </div>
            <div class="form-group mb-3">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="3" class="form-control"
                    placeholder="Enter description">{{@old('description', $expenses->description)}}</textarea>
            </div>
            <div class="form-group mb-3">
                <label for="date">Date</label>
                <input type="date" id="date" name="date" class="form-control"
                    value="{{ old('date', $expenses->date ?? '') }}">
            </div>
            <button type="submit" class="btn btn-primary w-100">Update Expense</button>
        </form>
    </div>
</div>

@endsection