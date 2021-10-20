<div class="field">
    <label class="label" for="name">Name</label>
    <div class="control">
        <input id="name" class="input" type="text" name="name" value="{{ old('name') }}">
    </div>
    @if($errors->has('name'))
        <p class="help is-danger">{{$errors->first('name')}}</p>
    @endif
</div>

<div class="field">
    <label class="label" for="youtube">Youtube link</label>
    <div class="control">
        <input id="youtube" class="input" type="text" name="youtube" placeholder="Put here your Youtube video link..." value="{{ old('youtube') }}">
    </div>
    @if($errors->has('youtube'))
        <p class="help is-danger">{{$errors->first('youtube')}}</p>
    @endif
</div>

<div class="field">
    <label class="label" for="file">Markdown file (.md)</label>
    <div class="control">
        <input id="file" class="input" type="file" name="file">
    </div>
    @if($errors->has('file'))
        <p class="help is-danger">{{$errors->first('file')}}</p>
    @endif
</div>
