<div class="field">
    <p class="control">
        <input class="input" type="text" name="name" placeholder="New channel's name" value="{{ old('name') }}">
        @if($errors->has('name'))
            <p class="help is-danger">{{$errors->first('name')}}</p>
        @endif
    </p>
</div>

<div class="field">
    <p class="control">
        <label class="label" for="image">Channel's illustration picture</label>
        <input class="input" type="file" name="image">
    @if($errors->has('image'))
        <p class="help is-danger">{{$errors->first('image')}}</p>
        @endif
        </p>
</div>

<div class="field">
    <label class="label" for="colour">Channel's main colour</label>
    <div class="control">
        <label class="radio">
            <input type="radio" name="colour" value="danger" value="">
            <span class="tag is-danger" value=""> </span>
        </label>
        <label class="radio">
            <input type="radio" name="colour" value="primary">
            <span class="tag is-primary"> </span>
        </label>
        <label class="radio">
            <input type="radio" name="colour" value="success">
            <span class="tag is-success"> </span>
        </label>
        <label class="radio">
            <input type="radio" name="colour" value="link">
            <span class="tag is-link"> </span>
        </label>
        <label class="radio">
            <input type="radio" name="colour" value="info">
            <span class="tag is-info"> </span>
        </label>
        <label class="radio">
            <input type="radio" name="colour" value="warning">
            <span class="tag is-warning"> </span>
        </label>
        <label class="radio">
            <input type="radio" name="colour" value="dark">
            <span class="tag is-dark"> </span>
        </label>
        <label class="radio">
            <input type="radio" name="colour" value="black">
            <span class="tag is-black"> </span>
        </label>
        <label class="radio">
            <input type="radio" name="colour" value="light">
            <span class="tag is-light"> </span>
        </label>
        <label class="radio">
            <input type="radio" name="colour" value="white" checked>
            <span class="tag is-white"> </span>
        </label>
    </div>
</div>
