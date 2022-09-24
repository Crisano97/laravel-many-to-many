<div class="mb-3">
    <label for="input-name" class="form-label">name</label>
    <input type="text" class="form-control" id="input-name" name="name" value="{{ old('name', $category->name) }}">
    @include('admin.categories.includes.errors', ['value' => 'name'])
    <label for="input-color" class="form-label">color</label>
    <input type="text" class="form-control" id="input-color" name="color" value="{{ old('color', $category->color) }}">
    @include('admin.categories.includes.errors', ['value' => 'color'])
</div>
{{-- <div class="mb-3">
    <select id="input-category" class="form-control" name="category_id">
        <option value="">no category</option>
        @foreach ($categories as $category)
            <option value="{{ old('category', $category->id )}}"
                @isset($category)
                    {{ $category->id === $category->id ? 'selected' : ''}}
                @endisset
                >
                {{ old('category_id', $category->name )}}
            </option>
        @endforeach
    </select>
    @include('admin.categories.includes.errors', ['value' => 'category_id'])
</div> --}}

<button type="submit" class="btn btn-primary">Submit</button>
