@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1>Статистика</h1>
            <ol>
                <li>Какая морфологическая форма, какими способами переводится.</li>
                <li>Сколько жестов обработано.</li>
                <li>Сколько слов обработано</li>
                <li>Сколько словоформ сгенерированно</li>
                <li>Сколько словоформ связанно</li>
                <li>Сколько словоформ несвязано</li>
                <li>Сколько словоформ имеют единичную связь с жестом.</li>
                <li>Сколько словоформ имеют единичную связь с несколькими жестами.</li>
                <li>Сколько словоформ имеют единичную связь с несколькими жестами.</li>
                <li>Какова длина цепочек словоформ.</li>
                <li>Какие жесты задействованны в цепочках (Исключая базовый жест).</li>
            </ol>
        </div>
    </div>
</div>
@endsection