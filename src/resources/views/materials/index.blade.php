@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/materials.css') }}">
@endsection

@section('content')
<h1>材料管理</h1>

<div style="margin-bottom: 30px;">
    <a href="{{ route('materials.create') }}" class="btn">➕ 新しい材料を追加</a>
</div>

@if ($materials->count() > 0)
<div class="table-responsive">
    <table>
        <thead>
            <tr>
                <th>材料名</th>
                <th>単位</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach($materials as $material)
            <tr>
                <td>
                    <strong>{{ $material->name }}</strong>
                </td>
                <td>
                    <span class="unit-badge">{{ $material->unit }}</span>
                </td>
                <td>
                    <div class="action-links">
                        <a href="{{ route('materials.edit', $material->id) }}" class="action-link">✏️ 編集</a>
                        <form action="{{ route('materials.destroy', $material->id) }}" method="POST" class="delete-form" onsubmit="return confirm('この材料を削除してもよろしいですか？');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-link action-link-danger">🗑️ 削除</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- ページング -->
<div class="pagination-wrapper">
    {{ $materials->links() }}
</div>
@else
<div class="empty-state">
    <p>材料がまだ登録されていません</p>
    <a href="{{ route('materials.create') }}" class="btn">➕ 最初の材料を追加</a>
</div>
@endif

<div style="margin-top: 30px;">
    <a href="{{ route('index') }}" class="btn btn-secondary">← トップに戻る</a>
</div>

@endsection