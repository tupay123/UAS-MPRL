@if ($socialmedia->count() > 0)
<div class="widget glass-widget p-4 rounded-2xl shadow-lg">
    <div class="widget-title mb-4">
        <h5 class="text-white text-xl font-semibold">Stay connected</h5>
    </div>
    <div class="widget-stay-connected">
        <div class="list grid grid-cols-1 sm:grid-cols-2 gap-4">
            @foreach ($socialmedia as $media)
            <a href="{{ $media->link }}" target="_blank">
                <div class="item flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300"
                     style="background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255, 255, 255, 0.3); backdrop-filter: blur(10px); border-radius: 10px">
                    <i class="{{ $media->icon }} text-white text-xl"></i>
                    <p class="text-white font-medium">{{ $media->title }}</p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</div>
@endif
