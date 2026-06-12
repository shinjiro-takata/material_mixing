# Code Citations

## License: MIT
https://github.com/robjuz/futtertrog/blob/b82dcffd825d9cd3d9882552a6c081b77336a473/resources/views/order/index.blade.php

```
Good 出だし！では残りを埋めていきます：

---

## **修正ポイント**

### **1. form の action**
```blade
<form action="{{ route('logs.index') }}" method="GET">
```

### **2. select は何を選ぶ？**

商品（レシピ） と オペレーター（ユーザー）の2つ：

```blade
<!-- 商品 -->
<select name="recipe_id">
    <option value="">-- 商品を選択 --</option>
    @foreach($recipes as $recipe)
        <option value="{{ $recipe->id }}" {{ request('recipe_id') == $recipe->id ? 'selected' : '' }}>
            {{ $recipe->name }}
        </option>
    @endforeach
</select>

<!-- オペレーター -->
<select name="user_id">
    <option value="">-- オペレーターを選択 --</option>
    @foreach($users as $user)
        <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
            {{ $user->name }}
        </option>
    @endforeach
</select>
```

### **3. 検索結果の表示**

```blade
<table>
    <thead>
        <tr>
            <th>日付</th>
            <th>商品</th>
            <th>オペレーター</th>
            <th>備考</th>
        </tr>
    </thead>
    <tbody>
        @foreach($logs as $log)
        <tr>
            <td>{{ $log->weighed_at }}</td>
            <td>{{ $log->recipe->name }}</td>
            <td>{{ $log->user->name }}</td>
            <td>{{ $log->notes }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
```

### **4. controller
```


## License: MIT
https://github.com/robjuz/futtertrog/blob/b82dcffd825d9cd3d9882552a6c081b77336a473/resources/views/order/index.blade.php

```
Good 出だし！では残りを埋めていきます：

---

## **修正ポイント**

### **1. form の action**
```blade
<form action="{{ route('logs.index') }}" method="GET">
```

### **2. select は何を選ぶ？**

商品（レシピ） と オペレーター（ユーザー）の2つ：

```blade
<!-- 商品 -->
<select name="recipe_id">
    <option value="">-- 商品を選択 --</option>
    @foreach($recipes as $recipe)
        <option value="{{ $recipe->id }}" {{ request('recipe_id') == $recipe->id ? 'selected' : '' }}>
            {{ $recipe->name }}
        </option>
    @endforeach
</select>

<!-- オペレーター -->
<select name="user_id">
    <option value="">-- オペレーターを選択 --</option>
    @foreach($users as $user)
        <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
            {{ $user->name }}
        </option>
    @endforeach
</select>
```

### **3. 検索結果の表示**

```blade
<table>
    <thead>
        <tr>
            <th>日付</th>
            <th>商品</th>
            <th>オペレーター</th>
            <th>備考</th>
        </tr>
    </thead>
    <tbody>
        @foreach($logs as $log)
        <tr>
            <td>{{ $log->weighed_at }}</td>
            <td>{{ $log->recipe->name }}</td>
            <td>{{ $log->user->name }}</td>
            <td>{{ $log->notes }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
```

### **4. controller
```


## License: MIT
https://github.com/robjuz/futtertrog/blob/b82dcffd825d9cd3d9882552a6c081b77336a473/resources/views/order/index.blade.php

```
Good 出だし！では残りを埋めていきます：

---

## **修正ポイント**

### **1. form の action**
```blade
<form action="{{ route('logs.index') }}" method="GET">
```

### **2. select は何を選ぶ？**

商品（レシピ） と オペレーター（ユーザー）の2つ：

```blade
<!-- 商品 -->
<select name="recipe_id">
    <option value="">-- 商品を選択 --</option>
    @foreach($recipes as $recipe)
        <option value="{{ $recipe->id }}" {{ request('recipe_id') == $recipe->id ? 'selected' : '' }}>
            {{ $recipe->name }}
        </option>
    @endforeach
</select>

<!-- オペレーター -->
<select name="user_id">
    <option value="">-- オペレーターを選択 --</option>
    @foreach($users as $user)
        <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
            {{ $user->name }}
        </option>
    @endforeach
</select>
```

### **3. 検索結果の表示**

```blade
<table>
    <thead>
        <tr>
            <th>日付</th>
            <th>商品</th>
            <th>オペレーター</th>
            <th>備考</th>
        </tr>
    </thead>
    <tbody>
        @foreach($logs as $log)
        <tr>
            <td>{{ $log->weighed_at }}</td>
            <td>{{ $log->recipe->name }}</td>
            <td>{{ $log->user->name }}</td>
            <td>{{ $log->notes }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
```

### **4. controller
```

