@extends ('layouts.app')
@section('content')
<div class="container">
    <h1 class="text-primary text-center mt-3">Expense Tracker</h1>
    <div class="p-4 card shadow-lg mt-3">
        <div class="card-title">
            <h3 class="text-center">Available Balance:
                <b class="@if($totalCount < 0) text-danger @elseif($totalCount == 0)  @else text-success @endif">
                    {{ $totalCount }} Rs.
                </b>
        </div>
        <div class="card-body">
            <div class="row">
                <!-- Expenses Table -->
                <div class="col-md-12 ">
                    <div class="expenseTable table-responsive">
                        <h5 class="mb-3">Expense List</h5>
                        <a class="text-end btn btn-success ml-auto mb-3" href="/expenses/addExpenses">Add Expense</a>
                        <a class="text-end btn btn-warning ml-auto mb-3" href="/expenses/addIncome">Add Income</a>
                        <table class="table table-hover table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>S. No</th>
                                    <th>Category</th>
                                    <th>Amount</th>
                                    <th>Description</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($expenses as $expense)
                                    <tr>
                                        <td>{{$loop->index + 1}}</td>
                                        <td>{{ $expense->categories ? $expense->categories->category_name : 'No Category' }}
                                        </td>
                                        <td>{{$expense->amount}} Rs.</td>
                                        <td>{{$expense->description}}</td>

                                        <td>{{$expense->date}}</td>
                                        <td>
                                            <a href="{{ url('/expenses/' . base64_encode(Crypt::encrypt($expense->id))) . '/edit' }}"
                                                class="btn btn-sm btn-warning me-2">Edit</a>

                                            <form class="d-inline"
                                                action="{{ route('expenses.delete', Crypt::encryptString($expense->id)) }}"
                                                method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this expense?')">
                                                @csrf
                                                @method('DELETE') <!-- Since it's a delete operation -->
                                                <button type="submit" class="btn btn-danger">Delete Expense</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Add Expense Form -->

            </div>

        </div>
    </div>
</div>
@endsection