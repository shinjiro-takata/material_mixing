@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/logs.css') }}">
@endsection

@section('content')
<h1>計量ログ一覧</h1>

<div class="filter-section">
    <form action="{{ route('logs.index') }}" method="GET" class="search-form">
        <div class="search-form__group">
            <label for="start_date" class="search-form__label">期間</label>
            <input class="search-form__input search-form__input--date" type="date" id="start_date" name="start_date" value="{{ request('start_date') }}">
            <span class="search-form__separator">〜</span>
            <input class="search-form__input search-form__input--date" type="date" id="end_date" name="end_date" value="{{ request('end_date') }}">
        </div>

        <div class="search-form__group">
            <label for="recipe_id" class="search-form__label">レシピ</label>
            <select id="recipe_id" name="recipe_id" class="search-form__select">
                <option value="">全てのレシピ</option>
                @foreach($recipes as $recipe)
                <option value="{{ $recipe->id }}" {{ request('recipe_id') == $recipe->id ? 'selected' : '' }}>{{ $recipe->name }}</option>
                @endforeach
            </select>
        </div>

        <button class="search-form__button" type="submit">検索</button>
    </form>

    <div class="action-section">
        <a href="{{ route('logs.create') }}" class="btn">➕ 新規入力</a>
        <form action="{{ route('logs.export') }}" method="GET" class="export-form">
            <input type="hidden" name="start_date" value="{{ request('start_date') }}">
            <input type="hidden" name="end_date" value="{{ request('end_date') }}">
            <input type="hidden" name="recipe_id" value="{{ request('recipe_id') }}">
            <button type="submit" class="btn btn-secondary">📥 Excelエクスポート</button>
        </form>
    </div>
</div>

<div class="table-responsive">
    <h2>計量ログ一覧</h2>
    <table>
        <thead>
            <tr>
                <th>日時</th>
                <th>レシピ</th>
                <th>備考</th>
                @foreach($allMaterials as $material)
                <th>{{ $material->name }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            <tr class="total-row">
                <td colspan="3"><strong>合計</strong></td>
                @foreach($allMaterials as $material)
                <td>
                    <strong>
                        {{ number_format($logs->sum(function($log) use($material) { return $log->materials->where('id', $material->id)->first()?->pivot->actual_quantity ?? 0; }), 3) }}
                    </strong>
                </td>
                @endforeach
            </tr>
            @forelse($logs as $log)
            <tr>
                <td>{{ $log->weighed_at }}</td>
                <td>{{ $log->recipe->name }}</td>
                <td>{{ $log->notes ?: '-' }}</td>
                @foreach($allMaterials as $material)
                <td>{{ $log->materials->where('id', $material->id)->first()?->pivot->actual_quantity ?? '-' }}</td>
                @endforeach
            </tr>
            @empty
            <tr>
                <td colspan="{{ 3 + count($allMaterials) }}" class="text-center">ログデータがありません</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="action-buttons">
    <a href="{{ route('index') }}" class="btn btn-secondary">← トップに戻る</a>
</div>

@endsection