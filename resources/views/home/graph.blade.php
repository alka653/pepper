@extends('layouts.app')

@section('style')
    <link href="https://unpkg.com/gijgo@1.9.11/css/gijgo.min.css" rel="stylesheet" type="text/css" />
	<style type="text/css" media="screen">
		body{
			background-color: #f2f5f8;
		}
	</style>
@endsection

@section('content')
    <div class="container" style="margin-bottom: 100px">
        <h2 class="text-center">Gráficas</h2>
        <div class="block">
            <div class="row">
                <div class="col-12">
                    <h4>Solicitudes</h4>
                    {{ Form::open(['url' => route('solicitud.json'), 'method' => 'get', 'id' => 'form-solicitud']) }}
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-4">
                                            {{ Form::label('fecha_inicio_solicitud', 'Fecha inicial') }}
                                        </div>
                                        <div class="col-8">
                                            {{ Form::text('fecha_inicio_solicitud', null, ['required', 'class' => 'form-control']) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-4">
                                            {{ Form::label('fecha_final_solicitud', 'Fecha final') }}
                                        </div>
                                        <div class="col-8">
                                            {{ Form::text('fecha_final_solicitud', null, ['required', 'class' => 'form-control']) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                {!! Form::button('Consultar', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
                <div class="col-12" id="table_solicitudes"></div>
                <div class="col-md-6">
                    <div id="graph_bar_solicitud"></div>
                </div>
                <div class="col-md-6">
                    <div id="graph_pie_solicitud"></div>
                </div>
            </div>
        </div>
        <div class="block">
            <div class="row">
                <div class="col-12">
                    <h4>Género sexual de las mascotas</h4>
                    {{ Form::open(['url' => route('mascota.json'), 'method' => 'get', 'id' => 'form-mascota']) }}
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-4">
                                            {{ Form::label('fecha_inicio_mascota', 'Fecha inicial') }}
                                        </div>
                                        <div class="col-8">
                                            {{ Form::text('fecha_inicio_mascota', null, ['required', 'class' => 'form-control']) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-4">
                                            {{ Form::label('fecha_final_mascota', 'Fecha final') }}
                                        </div>
                                        <div class="col-8">
                                            {{ Form::text('fecha_final_mascota', null, ['required', 'class' => 'form-control']) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                {!! Form::button('Consultar', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
                <div class="col-12" id="table_mascotas"></div>
                <div class="col-md-6">
                    <div id="graph_bar_mascota"></div>
                </div>
                <div class="col-md-6">
                    <div id="graph_pie_mascota"></div>
                </div>
            </div>
        </div>
        <div class="block">
            <div class="row">
                <div class="col-12">
                    <h4>Ocupaciones de las mascotas</h4>
                    {{ Form::open(['url' => route('mascota.ocupacion.json'), 'method' => 'get', 'id' => 'form-mascota-ocupacion']) }}
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-4">
                                            {{ Form::label('fecha_inicio_mascota_ocupacion', 'Fecha inicial') }}
                                        </div>
                                        <div class="col-8">
                                            {{ Form::text('fecha_inicio_mascota_ocupacion', null, ['required', 'class' => 'form-control']) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-4">
                                            {{ Form::label('fecha_final_mascota_ocupacion', 'Fecha final') }}
                                        </div>
                                        <div class="col-8">
                                            {{ Form::text('fecha_final_mascota_ocupacion', null, ['required', 'class' => 'form-control']) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                {!! Form::button('Consultar', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
                <div class="col-12" id="table_mascotas_ocupacion"></div>
                <div class="col-md-6">
                    <div id="graph_bar_mascota_ocupacion"></div>
                </div>
                <div class="col-md-6">
                    <div id="graph_pie_mascota_ocupacion"></div>
                </div>
            </div>
        </div>
        <div class="block">
            <div class="row">
                <div class="col-12">
                    <h4>Localizaciones anatómicas de los ataques</h4>
                    {{ Form::open(['url' => route('ataques.localizaciones_anatomicas.json'), 'method' => 'get', 'id' => 'form-mascota-localizacion-anatomica']) }}
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-4">
                                            {{ Form::label('fecha_inicio_localizacion_anatomica', 'Fecha inicial') }}
                                        </div>
                                        <div class="col-8">
                                            {{ Form::text('fecha_inicio_localizacion_anatomica', null, ['required', 'class' => 'form-control']) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-4">
                                            {{ Form::label('fecha_final_localizacion_anatomica', 'Fecha final') }}
                                        </div>
                                        <div class="col-8">
                                            {{ Form::text('fecha_final_localizacion_anatomica', null, ['required', 'class' => 'form-control']) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                {!! Form::button('Consultar', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
                <div class="col-12" id="table_localizacion_anatomica"></div>
                <div class="col-md-6">
                    <div id="graph_bar_localizacion_anatomica"></div>
                </div>
                <div class="col-md-6">
                    <div id="graph_pie_localizacion_anatomica"></div>
                </div>
            </div>
        </div>
        <div class="block">
            <div class="row">
                <div class="col-12">
                    <h4>Tipos de ataques</h4>
                    {{ Form::open(['url' => route('ataques.tipo_ataque.json'), 'method' => 'get', 'id' => 'form-tipo-ataque']) }}
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-4">
                                            {{ Form::label('fecha_inicio_tipo_ataque', 'Fecha inicial') }}
                                        </div>
                                        <div class="col-8">
                                            {{ Form::text('fecha_inicio_tipo_ataque', null, ['required', 'class' => 'form-control']) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-4">
                                            {{ Form::label('fecha_final_tipo_ataque', 'Fecha final') }}
                                        </div>
                                        <div class="col-8">
                                            {{ Form::text('fecha_final_tipo_ataque', null, ['required', 'class' => 'form-control']) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                {!! Form::button('Consultar', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
                <div class="col-12" id="table_tipo_ataque"></div>
                <div class="col-md-6">
                    <div id="graph_bar_tipo_ataque"></div>
                </div>
                <div class="col-md-6">
                    <div id="graph_pie_tipo_ataque"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://unpkg.com/gijgo@1.9.11/js/gijgo.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
        google.charts.load('current', {packages: ['corechart']})
        $('#fecha_inicio_solicitud').datepicker({
			uiLibrary: 'bootstrap4',
			maxDate: new Date()
		})
        $('#fecha_final_solicitud').datepicker({
			uiLibrary: 'bootstrap4',
			maxDate: new Date()
		})
        $('#fecha_inicio_mascota').datepicker({
			uiLibrary: 'bootstrap4',
			maxDate: new Date()
		})
        $('#fecha_final_mascota').datepicker({
			uiLibrary: 'bootstrap4',
			maxDate: new Date()
		})
        $('#fecha_inicio_mascota_ocupacion').datepicker({
			uiLibrary: 'bootstrap4',
			maxDate: new Date()
		})
        $('#fecha_final_mascota_ocupacion').datepicker({
			uiLibrary: 'bootstrap4',
			maxDate: new Date()
		})
        $('#fecha_inicio_localizacion_anatomica').datepicker({
			uiLibrary: 'bootstrap4',
			maxDate: new Date()
		})
        $('#fecha_final_localizacion_anatomica').datepicker({
			uiLibrary: 'bootstrap4',
			maxDate: new Date()
		})
        $('#fecha_inicio_tipo_ataque').datepicker({
			uiLibrary: 'bootstrap4',
			maxDate: new Date()
		})
        $('#fecha_final_tipo_ataque').datepicker({
			uiLibrary: 'bootstrap4',
			maxDate: new Date()
		})
        $('form#form-solicitud').submit(function(e){
            $('#graph_bar_solicitud').empty()
            $('#graph_pie_solicitud').empty()
            $('#table_solicitudes').empty()
            graphSolicitudes($('#fecha_inicio_solicitud').val(), $('#fecha_final_solicitud').val())
            e.preventDefault()
        })
        $('form#form-mascota').submit(function(e){
            $('#graph_bar_mascota').empty()
            $('#graph_pie_mascota').empty()
            $('#table_mascotas').empty()
            graphMascotas($('#fecha_inicio_mascota').val(), $('#fecha_final_mascota').val())
            e.preventDefault()
        })
        $('form#form-mascota-ocupacion').submit(function(e){
            $('#graph_bar_mascota_ocupacion').empty()
            $('#graph_pie_mascota_ocupacion').empty()
            $('#table_mascotas_ocupacion').empty()
            graphMascotasOcupacion($('#fecha_inicio_mascota_ocupacion').val(), $('#fecha_final_mascota_ocupacion').val())
            e.preventDefault()
        })
        $('form#form-mascota-localizacion-anatomica').submit(function(e){
            $('#graph_bar_localizacion_anatomica').empty()
            $('#graph_pie_localizacion_anatomica').empty()
            $('#table_localizacion_anatomica').empty()
            graphLocalizacionAnatomica($('#fecha_inicio_localizacion_anatomica').val(), $('#fecha_final_localizacion_anatomica').val())
            e.preventDefault()
        })

        $('form#form-tipo-ataque').submit(function(e){
            $('#graph_bar_tipo_ataque').empty()
            $('#graph_pie_tipo_ataque').empty()
            $('#table_tipo_ataque').empty()
            graphTipoAtaque($('#fecha_inicio_tipo_ataque').val(), $('#fecha_final_tipo_ataque').val())
            e.preventDefault()
        })
        function graphSolicitudes(fecha_inicio = '', fecha_final = ''){
            $.get($('#form-solicitud').attr('action'), {
                fecha_inicio: fecha_inicio,
                fecha_final: fecha_final
            }, function(response){
                $('#table_solicitudes').html(
                    `
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Pendientes</th>
                                    <th>Finalizados</th>
                                    <th>Cancelados</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>${response.pendientes}</td>
                                    <td>${response.finalizados}</td>
                                    <td>${response.cancelados}</td>
                                </tr>
                            </tbody>
                        </table>
                    `
                )
                google.charts.setOnLoadCallback(function(){
                    const data = google.visualization.arrayToDataTable([
                        ['Estado', 'Cantidad',{ role: 'style' }],
                        ['Pendiente', response.pendientes, '#3498db'],
                        ['Finalizado', response.finalizados, '#2ecc71'],
                        ['Cancelado', response.cancelados, '#e74c3c']
                    ])
                    const options = {
                        title: 'Total de solicitudes',
                        hAxis: {
                            title: 'Estado de casos'
                        },
                        vAxis: {
                            title: 'Cantidad'
                        }
                    }
                    const chart = new google.visualization.ColumnChart(document.getElementById('graph_bar_solicitud'));
				    chart.draw(data, options);
                    const pie = new google.visualization.PieChart(document.getElementById('graph_pie_solicitud'));
				    pie.draw(data, options);
                })

            })
        }
        function graphMascotas(fecha_inicio = '', fecha_final = ''){
            $.get($('#form-mascota').attr('action'), {
                fecha_inicio: fecha_inicio,
                fecha_final: fecha_final
            }, function(response){
                $('#table_mascotas').html(
                    `
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Hembras</th>
                                    <th>Machos</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>${response.hembras}</td>
                                    <td>${response.machos}</td>
                                </tr>
                            </tbody>
                        </table>
                    `
                )
                google.charts.setOnLoadCallback(function(){
                    const data = google.visualization.arrayToDataTable([
                        ['Género', 'Cantidad',{ role: 'style' }],
                        ['Macho', response.machos, '#3498db'],
                        ['Hembra', response.hembras, '#2ecc71']
                    ])
                    const options = {
                        title: 'Total de mascotas',
                        hAxis: {
                            title: 'Género sexual'
                        },
                        vAxis: {
                            title: 'Cantidad'
                        }
                    }
                    const chart = new google.visualization.ColumnChart(document.getElementById('graph_bar_mascota'));
				    chart.draw(data, options);
                    const pie = new google.visualization.PieChart(document.getElementById('graph_pie_mascota'));
				    pie.draw(data, options);
                })

            })
        }
        function graphMascotasOcupacion(fecha_inicio = '', fecha_final = ''){
            $.get($('#form-mascota-ocupacion').attr('action'), {
                fecha_inicio: fecha_inicio,
                fecha_final: fecha_final
            }, function(response){
                let html_head = ''
                let html_body = ''
                let array_graph = [
                    ['Ocupación', 'Cantidad']
                ]
                for(let item in response){
                    html_head += `<th>${item}</th>`
                    html_body += `<td>${response[item]}</td>`
                    array_graph.push([
                        item, response[item]
                    ])
                }
                $('#table_mascotas_ocupacion').html(
                    `
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    ${html_head}
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    ${html_body}
                                </tr>
                            </tbody>
                        </table>
                    `
                )
                google.charts.setOnLoadCallback(function(){
                    const data = google.visualization.arrayToDataTable(array_graph)
                    const options = {
                        title: 'Total de mascotas',
                        hAxis: {
                            title: 'Ocupaciones'
                        },
                        vAxis: {
                            title: 'Cantidad'
                        }
                    }
                    const chart = new google.visualization.ColumnChart(document.getElementById('graph_bar_mascota_ocupacion'));
				    chart.draw(data, options);
                    const pie = new google.visualization.PieChart(document.getElementById('graph_pie_mascota_ocupacion'));
				    pie.draw(data, options);
                })

            })
        }
        function graphLocalizacionAnatomica(fecha_inicio = '', fecha_final = ''){
            $.get($('#form-mascota-localizacion-anatomica').attr('action'), {
                fecha_inicio: fecha_inicio,
                fecha_final: fecha_final
            }, function(response){
                let html_head = ''
                let html_body = ''
                let array_graph = [
                    ['Localización anatómica', 'Cantidad']
                ]
                for(let item in response){
                    html_head += `<th>${item}</th>`
                    html_body += `<td>${response[item]}</td>`
                    array_graph.push([
                        item, response[item]
                    ])
                }
                $('#table_localizacion_anatomica').html(
                    `
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    ${html_head}
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    ${html_body}
                                </tr>
                            </tbody>
                        </table>
                    `
                )
                google.charts.setOnLoadCallback(function(){
                    const data = google.visualization.arrayToDataTable(array_graph)
                    const options = {
                        title: 'Total de ataques',
                        hAxis: {
                            title: 'Localización anatómica'
                        },
                        vAxis: {
                            title: 'Cantidad'
                        }
                    }
                    const chart = new google.visualization.ColumnChart(document.getElementById('graph_bar_localizacion_anatomica'));
				    chart.draw(data, options);
                    const pie = new google.visualization.PieChart(document.getElementById('graph_pie_localizacion_anatomica'));
				    pie.draw(data, options);
                })
            })
        }
        function graphTipoAtaque(fecha_inicio = '', fecha_final = ''){
            $.get($('#form-tipo-ataque').attr('action'), {
                fecha_inicio: fecha_inicio,
                fecha_final: fecha_final
            }, function(response){
                let html_head = ''
                let html_body = ''
                let array_graph = [
                    ['Tipo de ataque', 'Cantidad']
                ]
                for(let item in response){
                    html_head += `<th>${item}</th>`
                    html_body += `<td>${response[item]}</td>`
                    array_graph.push([
                        item, response[item]
                    ])
                }
                $('#table_tipo_ataque').html(
                    `
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    ${html_head}
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    ${html_body}
                                </tr>
                            </tbody>
                        </table>
                    `
                )
                google.charts.setOnLoadCallback(function(){
                    const data = google.visualization.arrayToDataTable(array_graph)
                    const options = {
                        title: 'Total de ataques',
                        hAxis: {
                            title: 'Tipo de ataque'
                        },
                        vAxis: {
                            title: 'Cantidad'
                        }
                    }
                    const chart = new google.visualization.ColumnChart(document.getElementById('graph_bar_tipo_ataque'));
				    chart.draw(data, options);
                    const pie = new google.visualization.PieChart(document.getElementById('graph_pie_tipo_ataque'));
				    pie.draw(data, options);
                })
            })
        }
        $(document).ready(function(){
            graphSolicitudes()
            graphMascotas()
            graphMascotasOcupacion()
            graphLocalizacionAnatomica()
            graphTipoAtaque()
        })
    </script>
@endsection