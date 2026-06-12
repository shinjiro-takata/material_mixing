@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/recipes.css') }}">
@endsection

@section('content')
<h1>新規レシピ作成</h1>

<div class="form-container">
    <form action="{{ route('recipes.store') }}" method="POST" class="recipe-form">
        @csrf

        <div class="form-group">
            <label for="name">レシピ名 <span class="required">*</span></label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required class="form-input">
            @error('name')
            <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-section">
            <h3>既存の材料</h3>
            <p style="font-size: 13px; color: #666; margin-bottom: 15px;">✓をつけた材料がレシピに含まれます。</p>
            <div class="materials-checklist">
                @foreach($materials as $material)
                <div class="checkbox-group">
                    <label class="checkbox-label">
                        <input
                            type="checkbox"
                            name="material_ids[]"
                            value="{{ $material->id }}"
                            {{ in_array($material->id, old('material_ids', [])) ? 'checked' : '' }}>
                        <span class="material-name">{{ $material->name }}</span>
                        <span class="material-unit">({{ $material->unit }})</span>
                    </label>
                    <input
                        type="number"
                        name="materials[{{ $material->id }}]"
                        step="0.001"
                        value="{{ old('materials.' . $material->id, 0) }}"
                        placeholder="数量を入力"
                        class="quantity-input">
                    @error('materials.' . $material->id)
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                @endforeach
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn">✅ 作成</button>
            <a href="{{ route('recipes.index') }}" class="btn btn-secondary">キャンセル</a>
        </div>
    </form>
</div>

<div class="action-buttons">
    <a href="{{ route('index') }}" class="btn btn-secondary">← トップに戻る</a>
</div>

@endsection