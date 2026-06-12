@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/materials.css') }}">
@endsection

@section('content')
<h1>材料を編集</h1>

<div class="form-container">
    <form action="{{ route('materials.update', $material->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">材料名 <span class="required">*</span></label>
            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name', $material->name) }}"
                required
                class="form-input">
            @error('name')
            <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="unit">単位 <span class="required">*</span></label>
            <input
                type="text"
                id="unit"
                name="unit"
                value="{{ old('unit', $material->unit) }}"
                required
                class="form-input">
            @error('unit')
            <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn">✏️ 更新</button>
            <a href="{{ route('materials.index') }}" class="btn btn-secondary">キャンセル</a>
        </div>
    </form>
</div>

<div style="margin-top: 30px;">
    <a href="{{ route('index') }}" class="btn btn-secondary">← トップに戻る</a>
</div>

@endsection