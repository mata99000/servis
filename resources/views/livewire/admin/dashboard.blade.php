<div>
    <h2>Admin Dashboard</h2>
    <div class="devices">
        @foreach ($devices as $device)
            <div class="device">
                <h3>{{ $device->name }}</h3>
                <p>{{ $device->description }}</p>
                <div class="device-images">
                    @foreach ($device->images as $image)
                        <img src="{{ asset('storage/' . $image->path) }}" alt="Device Image" style="width: 100px; height: 100px;">
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</div>
