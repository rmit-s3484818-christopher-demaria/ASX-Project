@extends('layouts.master')
@section('title')
    Market
@stop
@section('body')
    <?php
    if(isset($searchTerm)) //displays all stocks on first load, or loads stocks matching the users search term if they searched
    {
        $stocks = DB::table('stocks')->orderBy('symbol', 'asc')->where('symbol', 'LIKE', '%'.$searchTerm.'%')->orwhere('name', 'LIKE', '%'.$searchTerm.'%')->paginate(50);
    }else{
        $stocks = DB::table('stocks')->orderBy('symbol', 'asc')->paginate(50);
    }
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

                        <form role ="form" method="POST" action="{{ route('search') }}"> <!-- Takes users search input -->
                              <span class="input-group-btn">
                            <input type="text" class="form-control searchBar" name ="searchTerm" id = "searchTerm" placeholder="Find a company by symbol or name...">
                            <button class="btn btn-primary searchBar" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                              </span>
                        </form>

                        <form role ="form" method="POST" action="{{ route('search') }}"> <!-- Resets the search term -->
                            <input type="hidden" class="form-control searchBar" name ="searchTerm" id = "searchTerm" value="">
                            <button class="btn btn-primary searchBar" type="submit"><span></span>Reset</button>
                        </form>

                    </div>
                </div>
            </div>

        </div>
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="dash-content-wrapper">
                    <div class="row symbolList">

                        <table class="leader-table table-striped table table-responsive tableSmall">
                            <tr class="leader-headings info">
                                <td align="center" class="ranking-col">Company Symbol</td>
                                <td>Company Name</td>
                                <td align="center">Share Worth</td>
                                <td align="center">% (+/-)</td>
                            </tr>
                            @foreach ($stocks as $stock)  <!-- Loops through the selected stocks -->
                                @if ($stock->name != "N/A") <!-- Doesn't display stocks that didn't have any data -->
                                    <tr>
                                        <td align="center"><strong><a href = "{{ route('passSymbolBuy', [$stock->symbol]) }}"> {{$stock->symbol}} </a> </strong></td> <!-- Opens up the buy page with the selected symbol -->
                                        <td>{{ $stock->name }}</td>
                                        <td align="center"> ${{$stock->price}}</td>
                                        <td align="center">{{$stock->perChange}}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </table>
                        <div class ="paginateMarket"> {{ $stocks->links() }} </div> <!-- Paginate ad on that automates page system -->
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection