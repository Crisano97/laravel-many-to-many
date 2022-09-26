<div class="mb-3">
    <label for="input-title" class="form-label">title</label>
    <input type="text" class="form-control" id="input-title" name="title" value="{{ old('title', $post->title) }}">
    @include('admin.posts.includes.errors', ['value' => 'title'])
</div>
<div class="mb-3">
    <select id="input-category" class="form-control" name="category_id">
        <option value="">no category</option>
        @foreach ($categories as $category)
            <option value="{{ old('category', $category->id )}}"
                @isset($post->category)
                    {{ $category->id === $post->category->id ? 'selected' : ''}}
                @endisset
                >
                {{ old('category_id', $category->name )}}
            </option>
        @endforeach
    </select>
    @include('admin.posts.includes.errors', ['value' => 'category_id'])
</div>
<div class="mb-3">
    @foreach ($tags as $tag)
        <div class="form-check form-switch">
            @if ($errors->any())
                <input type="checkbox" name="tags[]" id="input-tags" class="form-check-input" value="{{ $tag->id }}"
                {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }}>
            @else
                <input type="checkbox" name="tags[]" id="input-tags" class="form-check-input" value="{{ $tag->id }}"
                {{ $post->tags->contains($tag) ? 'checked' : '' }}>
            @endif
            <label for="input-tags" class="form-check-label">{{ $tag->name }}</label>
        </div>
    @endforeach
    @include('admin.posts.includes.errors', ['value' => 'tags'])
</div>
<div class="mb-3">
    <label for="input-post_content" class="form-label">post content</label>
    <textarea class="form-control" name="post_content" id="input-post_content" cols="30" rows="10">{{ old('post_content', $post->post_content) }}</textarea>
    @include('admin.posts.includes.errors', ['value' => 'post_content'])
</div>
{{-- <div class="mb-3">
    <label for="input-post_image" class="form-label">post_image</label>
    <input type="text" class="form-control" id="input-post_image" name="post_image" value="{{ old('post_image', $post->post_image) }}">
    @include('admin.posts.includes.errors', ['value' => 'post_image'])
</div> --}}
<div class="mb-3">
    <label for="input-post_image" class="form-label">post_image</label>
    <input type="file" class="form-control" id="input-post_image" name="post_image" value="{{ old('post_image', $post->post_image) }}">
    @include('admin.posts.includes.errors', ['value' => 'post_image'])
</div>

<button type="submit" class="btn btn-primary">Submit</button>
