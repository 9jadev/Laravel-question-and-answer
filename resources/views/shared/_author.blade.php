<span class="text-muted"> {{ $label." ". $model->created_date }}</span>
<div class="media mt-2">
    <a href="{{ $model->user->url }}" class="pr-2">
        <img src="{{ $model->user->avatar }}" alt="profile image" />
    </a>
    <div class="media-body">
        <a href="{{ $model->user->url }}" class="pr-2">{{ $model->user->name }}</a>
    </div>
</div>