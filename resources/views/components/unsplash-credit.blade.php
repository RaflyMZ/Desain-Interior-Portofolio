@props(['media'])

@if($media->source === 'unsplash')
<div class="unsplash-credit">
    Photo by
    <a href="{{ $media->credit_url }}" target="_blank" rel="noopener noreferrer">{{ $media->credit_name }}</a>
    on
    <a href="https://unsplash.com/?utm_source=portofolio_interior&utm_medium=referral" target="_blank" rel="noopener noreferrer">Unsplash</a>
</div>
@endif
