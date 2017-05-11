
@extends('layouts.master')
@section('title')
    Market
@stop
@section('body')
    <?php
    $stocks = DB::table('stocks')->orderBy('name', 'asc')->get();
    ?>
    <div class="navbarMargin">
        <div class="container-fluid">
            <div class="container-fluid">
                <div>
                    <h2 class="pageHeading">Market</h2>
                    <hr>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="dash-content-wrapper">
                    <div class="row">

                        <table class="leader-table table-striped table table-responsive">
                            <tr class="leader-headings info">
                                <td align="center" class="ranking-col">Company Symbol</td>
                                <td>Company Name</td>
                                <td align="center">Share Worth</td>
                                <td align="center">% (+/-)</td>
                            </tr>
                            @foreach ($stocks as $stock)
                                <tr>
                                    <td align="center"><strong><a href = "{{ route('passSymbolBuy', [$stock->symbol]) }}"> {{$stock->symbol}} </a> </strong></td>
                                    <td>{{ $stock->name }}</td>
                                    <td align="center"> ${{$stock->price}}</td>
                                    <td align="center">{{$stock->perChange}}</td>
                                </tr>
                            @endforeach
                        </table>


                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection