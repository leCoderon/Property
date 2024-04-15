<div class="property-item">
    <a href="{{ route('property.show', ['slug' => $property->getSlug(), 'property' => $property->id]) }}"
        class="img">
        <img src="{{$image}}"
            alt="Image" class="img-fluid" style="height: 300px" />
        {{-- <img src="{{ $property->images->first()?->imageUrl() }}" alt="Image"
            class="img-fluid" /> --}}
    </a>

    <div class="property-content">
        <div class="price mb-2">
            <span>${{ number_format($property->price, thousands_separator: ' ') }}</span>
        </div>
        <div>
            <span class="d-block mb-2 text-black-50">{{ $property->postal_code }} -
                {{ $property->city }}</span>
            <span class="city d-block mb-3">{{ $property->title }}</span>

            <div class="specs d-flex mb-4">
                <span class="d-block d-flex align-items-center me-3">
                    <span class="icon-bed me-2"></span>
                    <span class="caption">{{ $property->bedrooms }} beds</span>
                </span>
                <span class="d-block d-flex align-items-center">
                    <span class="icon-bath me-2"></span>
                    <span class="caption">{{ $property->rooms }} rooms</span>
                </span>
            </div>
            <a href="{{ route('property.show', ['slug' => $property->getSlug(), 'property' => $property->id]) }}"
                class="btn btn-primary py-2 px-3">See
                details</a>
        </div>
    </div>
</div>