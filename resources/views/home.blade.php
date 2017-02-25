@extends('layouts.app')
@section('page.title','DashBoard')
@section('head')
    <style>

        ul#mainmenu {
            margin: 0;
        }

        ul#mainmenu li {
            float: left;
            padding: 0;
        }

        ul#mainmenu li a {
            display: block;
        }

        .datapartenza, .dataarrivo {
            background-color: yellow;
        }

        td.room {
            padding: 0;
            position: relative;
        }

        td.room button {
            margin: 0;
            border: 0;
            display: block;
            border-radius: 0;
            width: 100%;
            height: 100%;
            padding: 0;
            position: absolute;;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
        }

    </style>
@endsection
@section('content')
<div class="container">

    <div class="pull-right">
        <ul style="list-style-type: none; margin: 0; padding: 0">
            <li style="float: left; padding: 4px;"><div style="display: inline-block; width: 24px; height: 24px;" class="occupata"></div></li>
            <li style="float: left; padding: 4px;"><span class="hidden-xs">Occupata</span></li>
            <li style="float: left; padding: 4px;"><div style="display: inline-block; width: 24px; height: 24px;" class="daconfermare"></div></li>
            <li style="float: left; padding: 4px;"><span class="hidden-xs">Da Confermare</span></li>
            <li style="float: left; padding: 4px;"><div style="display: inline-block; width: 24px; height: 24px;" class="daconfermareweb"></div></li>
            <li style="float: left; padding: 4px;"><span class="hidden-xs">Da Confermare (Contatto dal Sito)</span></li>
        </ul>
    </div>
    <form action="{{ url('') }}" method="get" id="periodo" class="form-inline" style="margin-bottom: 10px;">
        <div class="form-group">
            <label for="month" class="control-label">Periodo: </label>
            <select name="month" id="month" class="form-control input-sm" title="">
                @for($i = 0; $i<12; $i++)
                    <option value="{{ $i+1 }}"{{ ($i+1) == $month ? ' selected' : '' }}>{{ MONTHS[$i] }}</option>
                @endfor
            </select>
        </div>

        <div class="form-group">
            <select name="year" id="year" class="form-control input-sm" title="">
                @for($i = date('Y', time())-1; $i <date('Y', time())+3; $i++)
                    <option value="{{ $i }}"{{ $i == $year ? ' selected' : '' }}>{{ $i }}</option>
                @endfor
            </select>
        </div>

        <div class="form-group">
            <button class="btn btn-primary btn-sm">Cambia</button>
        </div>

    </form>

    <div class="panel panel-default">
        <div class="table-responsive">

            <table class="table table-bordered table-condensed table-hover" style="font-size: 12px;">
                <thead>
                <tr>
                    <th>Camera</th>
                    @for($i = 1; $i<32; $i++)
                        <th>{{ str_pad($i,2,'0',STR_PAD_LEFT) }}</th>
                    @endfor
                </tr>
                </thead>
                <tbody>
                @foreach($rooms as $room)
                    <tr data-room="{{ $room->id }}">
                        <td>{{ $room->titolo }}</td>
                        @for($i = 1; $i<32; $i++)
                            @php($date = \Carbon\Carbon::create($year, $month, $i))
                            @if($i > $monthdays)
                                <td style="background-color: #999;"></td>
                            @else
                                <td class="room" data-day="{{ str_pad($i,2,'0',STR_PAD_LEFT) }}">
                                    @php($prenotazioni = $room->prenotations()->day($date))
                                    @if(!$prenotazioni->count())
                                        <button class="btn btn-default" data-trigger="focus"></button>
                                    @else
                                        <button data-prenotazione="{{ $prenotazioni->first()->id }}" class="btn {{ $prenotazioni->first()->stato == PRENOT_CONFERMATA ? 'occupata' : ($prenotazioni->first()->origine == PRENOT_ORIG_WEB ? 'daconfermareweb' : 'daconfermare') }}" data-trigger="focus"></button>
                                    @endif


                                </td>

                                {{--}}<td data-day="{{ $i }}" data-room="{{ $room->id }}" data-title="Prenotazione" data-content=""></td>
                                    @else
                                <td data-day="{{ $i }}" data-room="{{ $room->id }}" data-title="Prenotazione" data-content="" class=""></td>
                                    @endif--}}
                            @endif
                        @endfor
                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">Menu Principale</h3></div>

                <div class="panel-body">
                    <ul>
                    @foreach($menu as $item)
                        <li><a href="{{ url($item->url) }}">{{ $item->titolo }}</a></li>
                    @endforeach
                    </ul>

                    <a href="{{ url('logout') }}" class="btn btn-link text-danger"><span class="text-danger"><i class="fa fa-power-off"></i> Esci</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('bottom')

    <script>

        var
            prenota = {
                room: 0,
                arrivo: null,
                partenza: null
            },
            current_room = 0,
            month = '{{ $month }}',
            year = {{ $year }},
            rooms =  {!! $rooms->toJson() !!};

        $(function() {

            $('.room button').popover({
                html: true,
                container: 'body',
                placement: 'auto',
                title: 'Prenotazione',
                content: getContent
            });

            $('form#periodo select').on('change', function() {
               //$(this).parents('form').first().submit();
            });

            $('body').on('click','.btn-arrivo', function(e) {
                e.preventDefault();
                var data = $(this).data();

                prenota.room = data.room;
                prenota.arrivo = data.day;

                $('[data-room='+data.room+'] [data-day='+data.day+'] button').addClass('dataarrivo');

            }).on('click','.btn-partenza', function(e) {
                e.preventDefault();
                var data = $(this).data();

                prenota.partenza = data.day;

                var partenza = year+'-'+month+'-'+data.day;
                var arrivo = year+'-'+month+'-'+prenota.arrivo;

                var url = '{{route('prenotations.create')}}/?DataArrivo='+arrivo+'&DataPartenza='+partenza+'&room_id='+prenota.room;

                location.href = url;

            }).on('click','.btn-annulla', function(e) {
                e.preventDefault();
                var data = $(this).data();

                $('.dataarrivo').removeClass('dataarrivo');

                prenota.room = 0;
                prenota.arrivo = null;
                prenota.partenza = null;

            });

        });

        function getContent(e) {

            var $this = $(this), room = $this.parents('tr').attr('data-room'), day = $this.parent().attr('data-day'), idprenotazione = $this.attr('data-prenotazione');

            current_room = room;

            if(!idprenotazione) {

                if(!prenota.room) {
                    return 'Nessuna Prenotazione per questa data. <br><br><a data-day="'+day+'" data-room="'+room+'" href="" class="btn btn-link btn-arrivo">Imposta come data di arrivo</a>';
                } else {

                    if(prenota.room != room)
                        return 'Hai già settato una data di arrivo però su un\'altra camera!';

                    if(prenota.arrivo == day)
                        return "Data di Arrivo Prenotazione.<br><br>" +
                            '<a href="#" class="btn btn-link btn-annulla">Annulla</a>';

                    if(prenota.arrivo > day)
                        return "Hai già settato una data di arrivo che è successiva a questa data!";

                    return 'Data di Arrivo: <strong>'+prenota.arrivo+'/'+month+'/'+year+'</strong>' +
                        '<a href="#" class="btn btn-link btn-partenza" data-day="'+day+'" data-room="'+room+'">Imposta come data di partenza</a>';
                }
            } else {

                var prenotazione = rooms.find(function(rm) { return rm.id == room}).prenotations.find(function(prenot) { return prenot.id == idprenotazione});
                if(prenotazione) {

                    return 'Stato: <strong>'+(prenotazione.stato ? 'Occupata': 'Da Confermare'+(prenotazione.origine == 1 ? ' (Web)' : ''))+'</strong><br>' +
                        'Cliente: <strong>'+prenotazione.Nome+' '+prenotazione.Cognome+'</strong><br>' +
                        'Permanenza: <strong>'+prenotazione.DataArrivo+' - '+prenotazione.DataPartenza+'</strong>' +
                        '<br><br><a href="{{ url('prenotations')}}/'+prenotazione.id+'/edit" class="btn btn-link">Dettagli Prenotazione</a>';

                }

            }

        }

    </script>

@endsection
