@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Expense List</div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Expense Type</th>
                                <th scope="col">Title</th>
                                <th scope="col">Date</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Description</th>
                                <th scope="col">
                                    <a href="{{ route('expenses.create') }}" class="btn btn-primary">+ New</a>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($expenses->isEmpty())
                                <tr>
                                    <td colspan="7">
                                        No expense!
                                    </td>
                                </tr>
                            @else
                                @foreach ($expenses as $expense)
                                    <tr>
                                        <td scope="row">{{ $loop->index + 1 }}</td>
                                        <td>{{ $expense->expenseType->title }}</td>
                                        <td>{{ $expense->title }}</td>
                                        <td>{{ $expense->expense_date }}</td>
                                        <td>{{ $expense->amount }}</td>
                                        <td>{{ $expense->description }}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                @can('updateExpense', $expense)
                                                    <a href="{{ route('expenses.edit', ['expense' => $expense->id]) }}" class="btn btn-info">Edit</a>
                                                @endcan

                                                @can('deleteExpense', $expense)
                                                    <form id="form{{ $expense->id }}" method="POST" action="{{ route('expenses.destroy', ['expense' => $expense->id]) }}"> 
                                                        @csrf
                                                        @method('DELETE')
                                                        <a href="javascript:void" onclick="onDelete('form{{ $expense->id }}')" class="btn btn-danger">Delete</a>
                                                        <script type="text/javascript">
                                                            function onDelete(formId) {
                                                                if (confirm('Are you sure?')) {
                                                                    document.getElementById(formId).submit();
                                                                }
                                                            }
                                                        </script>
                                                    </form>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    <div class="pagination">
                        {{ $expenses->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
