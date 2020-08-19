@extends('layouts.main')

@section('content')
    <show-report :report-id="{{$report->id}}"></show-report>
<!-- <table>
    <thead>
        <th>
            <td><a class="btn btn-primary" href="/reports">Nazad</a></td>
            <td>Izvještaj broj {{$report->id}}</td>
        </th>
        <tbody>
            <tr>
                <td>{{$report->project}}</td>
                <td>{{$report->user_id}}</td>
            </tr>
        </tbody>
    </thead>
</table>
    <h1>show page</h1>
    {{$report->description}} -->
@endsection