
@extends('layouts.master')
@section('title')
    Market
@stop
@section('body')
    <?php
    $rankings = DB::table('asxes')->orderBy('id', 'asc')->get();
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
                                <td align="right">Company Worth</td>
                            </tr>
                            @foreach ($rankings as $ranking)
                                <tr>
                                    <td align="center"><strong> {{$ranking->symbol}}</strong></td>
                                    <td>
                                                {{ $ranking->name }}
                                    </td>
                                    <td align="right"> </td>
                                </tr>
                            @endforeach
                        </table>


                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection