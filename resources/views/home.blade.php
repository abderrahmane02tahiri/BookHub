@extends('layouts.admin')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    Dashboard
                </div>

                <div class="card-body">
                    @if(session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="{{ $settings1['column_class'] }}">
                            <div class="card text-white bg-primary">
                                <div class="card-body pb-0">
                                    <div class="text-value">{{ number_format($settings1['total_number']) }}</div>
                                    <div>{{ $settings1['chart_title'] }}</div>
                                    <br />
                                </div>
                            </div>
                        </div>
                        <div class="{{ $settings2['column_class'] }}">
                            <div class="card text-white bg-primary">
                                <div class="card-body pb-0">
                                    <div class="text-value">{{ number_format($settings2['total_number']) }}</div>
                                    <div>{{ $settings2['chart_title'] }}</div>
                                    <br />
                                </div>
                            </div>
                        </div>
                        <div class="{{ $settings3['column_class'] }}">
                            <div class="card text-white bg-primary">
                                <div class="card-body pb-0">
                                    <div class="text-value">{{ number_format($settings3['total_number']) }}</div>
                                    <div>{{ $settings3['chart_title'] }}</div>
                                    <br />
                                </div>
                            </div>
                        </div>
                        <div class="{{ $settings4['column_class'] }}">
                            <div class="card text-white bg-primary">
                                <div class="card-body pb-0">
                                    <div class="text-value">{{ number_format($settings4['total_number']) }}</div>
                                    <div>{{ $settings4['chart_title'] }}</div>
                                    <br />
                                </div>
                            </div>
                        </div>
                        <div class="{{ $chart5->options['column_class'] }}">
                            <h3>{!! $chart5->options['chart_title'] !!}</h3>
                            {!! $chart5->renderHtml() !!}
                        </div>
                        <div class="{{ $chart6->options['column_class'] }}">
                            <h3>{!! $chart6->options['chart_title'] !!}</h3>
                            {!! $chart6->renderHtml() !!}
                        </div>
                        <div class="{{ $chart7->options['column_class'] }}">
                            <h3>{!! $chart7->options['chart_title'] !!}</h3>
                            {!! $chart7->renderHtml() !!}
                        </div>
                        <div class="{{ $chart8->options['column_class'] }}">
                            <h3>{!! $chart8->options['chart_title'] !!}</h3>
                            {!! $chart8->renderHtml() !!}
                        </div>
                        {{-- Widget - latest entries --}}
                        <div class="{{ $settings9['column_class'] }}" style="overflow-x: auto;">
                            <h3>{{ $settings9['chart_title'] }}</h3>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        @foreach($settings9['fields'] as $key => $value)
                                            <th>
                                                {{ trans(sprintf('cruds.%s.fields.%s', $settings9['translation_key'] ?? 'pleaseUpdateWidget', $key)) }}
                                            </th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($settings9['data'] as $entry)
                                        <tr>
                                            @foreach($settings9['fields'] as $key => $value)
                                                <td>
                                                    @if($value === '')
                                                        {{ $entry->{$key} }}
                                                    @elseif(is_iterable($entry->{$key}))
                                                        @foreach($entry->{$key} as $subEentry)
                                                            <span class="label label-info">{{ $subEentry->{$value} }}</span>
                                                        @endforeach
                                                    @else
                                                        {{ data_get($entry, $key . '.' . $value) }}
                                                    @endif
                                                </td>
                                            @endforeach
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="{{ count($settings9['fields']) }}">{{ __('No entries found') }}</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{-- Widget - latest entries --}}
                        <div class="{{ $settings10['column_class'] }}" style="overflow-x: auto;">
                            <h3>{{ $settings10['chart_title'] }}</h3>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        @foreach($settings10['fields'] as $key => $value)
                                            <th>
                                                {{ trans(sprintf('cruds.%s.fields.%s', $settings10['translation_key'] ?? 'pleaseUpdateWidget', $key)) }}
                                            </th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($settings10['data'] as $entry)
                                        <tr>
                                            @foreach($settings10['fields'] as $key => $value)
                                                <td>
                                                    @if($value === '')
                                                        {{ $entry->{$key} }}
                                                    @elseif(is_iterable($entry->{$key}))
                                                        @foreach($entry->{$key} as $subEentry)
                                                            <span class="label label-info">{{ $subEentry->{$value} }}</span>
                                                        @endforeach
                                                    @else
                                                        {{ data_get($entry, $key . '.' . $value) }}
                                                    @endif
                                                </td>
                                            @endforeach
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="{{ count($settings10['fields']) }}">{{ __('No entries found') }}</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>{!! $chart5->renderJs() !!}{!! $chart6->renderJs() !!}{!! $chart7->renderJs() !!}{!! $chart8->renderJs() !!}
@endsection