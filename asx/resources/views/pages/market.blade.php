
@extends('layouts.master')
@section('title')
    Market
@stop
@section('body')
    <?php
    $stocks = DB::table('stocks')->orderBy('symbol', 'asc')->paginate(50);
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
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="input-group" >
                        <input type="text" class="form-control searchBar"   placeholder="Find a company...">
                        <span class="input-group-btn">
                                <button class="btn btn-primary searchBar" type="button"><span class="glyphicon glyphicon-search"></span></button>
                                </span>
                    </div><!-- /input-group -->
                </div><!-- /.col-lg-6 -->
            </div>

        </div>
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="dash-content-wrapper">
                    <div class="row">

                        <table class="leader-table table-striped table table-responsive tableSmall">
                            <tr class="leader-headings info">
                                <td align="center" class="ranking-col">Company Symbol</td>
                                <td>Company Name</td>
                                <td align="center">Share Worth</td>
                                <td align="center">% (+/-)</td>
                            </tr>
                            @foreach ($stocks as $stock)
                                @if ($stock->name != "N/A")
                                <tr>
                                    <td align="center"><strong><a href = "{{ route('passSymbolBuy', [$stock->symbol]) }}"> {{$stock->symbol}} </a> </strong></td>
                                    <td>{{ $stock->name }}</td>
                                    <td align="center"> ${{$stock->price}}</td>
                                    <td align="center">{{$stock->perChange}}</td>
                                </tr>
                                @endif
                            @endforeach
                        </table>
                        <div class ="paginateMarket"> {{ $stocks->links() }} </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection